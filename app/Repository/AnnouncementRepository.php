<?php

namespace App\Repository;

use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    /**
     * عرض قائمة جميع الإعلانات (للإدارة)
     */
    public function index()
    {
        $announcements = Announcement::with('creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.Announcements.index', compact('announcements'));
    }

    /**
     * عرض نموذج إنشاء إعلان جديد
     */
    public function create()
    {
        return view('pages.Announcements.create');
    }

    /**
     * حفظ إعلان جديد
     */
    public function store($request)
    {
        try {
            $attachmentPath = null;

            // رفع المرفق إن وجد
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $attachmentPath = $file->storeAs('announcements', $fileName, 'public');
            }

            // تحديد حالة النشر
            $isPublished = false;
            $publishAt = null;

            if ($request->filled('publish_at')) {
                $publishAt = $request->publish_at;
                $isPublished = (strtotime($publishAt) <= time());
            } else {
                $isPublished = true;
            }

            Announcement::create([
                'title'           => $request->title,
                'body'            => $request->body,
                'target_audience' => $request->target_audience,
                'publish_at'      => $publishAt,
                'is_published'    => $isPublished,
                'attachment'      => $attachmentPath,
                'created_by'      => auth()->user()->id,
                'creator_type'    => $request->creator_type ?? 'admin',
            ]);

            toastr()->success(trans('Announcements_trans.created_success'));
            return redirect()->route('announcements.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * عرض نموذج تعديل إعلان
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('pages.Announcements.edit', compact('announcement'));
    }

    /**
     * تحديث إعلان
     */
    public function update($request)
    {
        try {
            $announcement = Announcement::findOrFail($request->id);

            $attachmentPath = $announcement->attachment;

            // رفع مرفق جديد إن وجد
            if ($request->hasFile('attachment')) {
                // حذف المرفق القديم
                if ($announcement->attachment && Storage::disk('public')->exists($announcement->attachment)) {
                    Storage::disk('public')->delete($announcement->attachment);
                }
                $file = $request->file('attachment');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $attachmentPath = $file->storeAs('announcements', $fileName, 'public');
            }

            // تحديد حالة النشر
            $isPublished = false;
            $publishAt = null;

            if ($request->filled('publish_at')) {
                $publishAt = $request->publish_at;
                $isPublished = (strtotime($publishAt) <= time());
            } else {
                $isPublished = true;
            }

            $announcement->update([
                'title'           => $request->title,
                'body'            => $request->body,
                'target_audience' => $request->target_audience,
                'publish_at'      => $publishAt,
                'is_published'    => $isPublished,
                'attachment'      => $attachmentPath,
            ]);

            toastr()->success(trans('Announcements_trans.updated_success'));
            return redirect()->route('announcements.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * حذف إعلان
     */
    public function destroy($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);

            // حذف المرفق
            if ($announcement->attachment && Storage::disk('public')->exists($announcement->attachment)) {
                Storage::disk('public')->delete($announcement->attachment);
            }

            $announcement->delete();

            toastr()->success(trans('Announcements_trans.deleted_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * تبديل حالة النشر (نشر / إخفاء)
     */
    public function togglePublish($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            $announcement->update([
                'is_published' => !$announcement->is_published,
            ]);

            $message = $announcement->is_published
                ? trans('Announcements_trans.published_success')
                : trans('Announcements_trans.unpublished_success');

            toastr()->success($message);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * جلب الإعلانات المنشورة الموجهة لدور معين
     * يُستخدم في لوحات تحكم الأدوار المختلفة
     */
    public function getForRole($role)
    {
        return Announcement::with('creator')
            ->published()
            ->forAudience($role)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
