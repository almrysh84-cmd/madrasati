<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;

class LibraryRepository implements LibraryRepositoryInterface
{

    use AttachFilesTrait;

    public function index()
    {
        // P1-3 fix: eager-load grade to avoid N+1 on library index
        $books = Library::with('grade')->get();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    public function store($request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            // P0-7 fix: use sanitized filename returned by uploadFile
            $books->file_name = $this->uploadFile($request, 'file_name', 'library');
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('library.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit', compact('book', 'grades'));
    }

    public function update($request)
    {
        try {

            $book = library::findorFail($request->id);
            $book->title = $request->title;

            if ($request->hasfile('file_name')) {

                $this->deleteFile($book->file_name, 'library');

                // P0-7 fix: capture sanitized filename from uploadFile
                $new_filename = $this->uploadFile($request, 'file_name', 'library');
                $book->file_name = $new_filename;
            }

            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->deleteFile($request->file_name, 'library');
        library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        // P0-6 fix: Path Traversal — sanitize with basename()
        $filename = basename($filename);
        if ($filename === '' || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            abort(400, 'Invalid file request');
        }

        $relative = 'attachments/library/' . $filename;
        if (!\Illuminate\Support\Facades\Storage::disk('upload_attachments')->exists($relative)) {
            abort(404, 'الملف غير موجود');
        }

        return \Illuminate\Support\Facades\Storage::disk('upload_attachments')->download($relative);
    }
}
