<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use App\Notifications\NewStudentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{


    public function Get_Student()
    {
        // P1-3 fix: eager-load relationships to avoid N+1 queries on the students index page.
        $students = Student::with(['gender', 'grade', 'classroom', 'section', 'Nationality', 'myparent'])
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.Students.index', compact('students'));
    }

    public function Edit_Student($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $Students =  Student::findOrFail($id);
        return view('pages.Students.edit', $data, compact('Students'));
    }

    public function Show_Student($id) {
        $Student = Student::findorfail($id);
        return view('pages.Students.show',compact('Student'));
    }

    public function Update_Student($request)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            // P0-10 fix: only re-hash password when a non-empty value is submitted.
            // Previously this hashed an empty string on every update, locking the student out.
            if ($request->filled('password')) {
                $Edit_Students->password = Hash::make($request->password);
            }
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function Create_Student()
    {

        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add', $data);
    }

    public function Get_classrooms($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }

    //Get Sections
    public function Get_Sections($id)
    {
        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }

    public function Store_Student($request)
    {

        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            // insert img
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    // P0-7 fix: validate extension + sanitize filename
                    $ext = strtolower($file->getClientOriginalExtension());
                    $allowed = ['pdf','jpg','jpeg','png','gif','webp','bmp'];
                    if (!in_array($ext, $allowed)) {
                        throw new \Exception('نوع الملف غير مسموح: ' . $ext);
                    }
                    if ($file->getSize() > 10 * 1024 * 1024) {
                        throw new \Exception('حجم الملف يتجاوز الحد المسموح به');
                    }
                    $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $sanitized = \Illuminate\Support\Str::slug($baseName);
                    if ($sanitized === '') {
                        $sanitized = 'file_' . time();
                    }
                    $name = time() . '_' . $sanitized . '.' . $ext;
                    $file->storeAs('attachments/students/' . $students->name, $name, 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit(); // insert data

            // ===== إرسال إشعار لولي الأمر =====
            if ($students->parent_id) {
                $parent = My_Parent::find($students->parent_id);
                if ($parent) {
                    $gradeName = $students->grade ? $students->grade->getTranslation('Name', 'ar') : null;
                    $parent->notify(new NewStudentNotification($request->name_ar, $gradeName));
                }
            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Delete_Student($request)
    {
        Student::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

    public function Upload_attachment($request)
    {
        foreach ($request->file('photos') as $file) {
            // P0-7 fix: validate extension + sanitize filename
            $ext = strtolower($file->getClientOriginalExtension());
            $allowed = ['pdf','jpg','jpeg','png','gif','webp','bmp'];
            if (!in_array($ext, $allowed)) {
                throw new \Exception('نوع الملف غير مسموح: ' . $ext);
            }
            if ($file->getSize() > 10 * 1024 * 1024) {
                throw new \Exception('حجم الملف يتجاوز الحد المسموح به');
            }
            $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitized = \Illuminate\Support\Str::slug($baseName);
            if ($sanitized === '') {
                $sanitized = 'file_' . time();
            }
            $name = time() . '_' . $sanitized . '.' . $ext;

            // P0-7 fix: sanitize student_name to prevent path traversal
            $safeStudentName = basename($request->student_name);
            $file->storeAs('attachments/students/' . $safeStudentName, $name, 'upload_attachments');

            // insert in image_table
            $images = new image();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.show', $request->student_id);
    }

    public function Download_attachment($studentsname, $filename)
    {
        // P0-6 fix: Path Traversal — sanitize filename parts with basename()
        $studentsname = basename($studentsname);
        $filename = basename($filename);

        // Block any remaining path components
        if ($studentsname === '' || $filename === '' || strpos($studentsname, '/') !== false || strpos($studentsname, '\\') !== false) {
            abort(400, 'Invalid file request');
        }

        $relative = 'attachments/students/' . $studentsname . '/' . $filename;

        if (!Storage::disk('upload_attachments')->exists($relative)) {
            abort(404, 'الملف غير موجود');
        }

        return Storage::disk('upload_attachments')->download($relative);
    }

    public function Delete_attachment($request)
    {
        DB::beginTransaction();

        try {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);

        // Delete in data
        image::where('id', $request->id)->where('filename', $request->filename)->delete();

        DB::commit(); // insert data

        toastr()->error(trans('messages.Delete'),' ');
        return redirect()->route('Students.show', $request->student_id);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('Students.show', $request->student_id)->withErrors(['error' => $e->getMessage()]);
        }
    }

}
