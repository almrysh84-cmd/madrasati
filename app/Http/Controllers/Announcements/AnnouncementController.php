<?php

namespace App\Http\Controllers\Announcements;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Repository\AnnouncementRepositoryInterface;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    protected $announcement;

    public function __construct(AnnouncementRepositoryInterface $announcement)
    {
        $this->announcement = $announcement;
    }

    public function index()
    {
        return $this->announcement->index();
    }

    public function create()
    {
        return $this->announcement->create();
    }

    public function store(AnnouncementRequest $request)
    {
        return $this->announcement->store($request);
    }

    public function edit($id)
    {
        return $this->announcement->edit($id);
    }

    public function update(AnnouncementRequest $request)
    {
        return $this->announcement->update($request);
    }

    public function destroy($id)
    {
        return $this->announcement->destroy($id);
    }

    public function togglePublish($id)
    {
        return $this->announcement->togglePublish($id);
    }

    /**
     * عرض الإعلانات الموجهة لدور معين (للوحات التحكم)
     * تُستدعى عبر AJAX من لوحات تحكم الأدوار
     */
    public function forRole($role)
    {
        $announcements = $this->announcement->getForRole($role);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => true,
                'count'  => $announcements->count(),
                'html'   => view('pages.Announcements.partials._announcements_list', compact('announcements'))->render(),
            ]);
        }

        return view('pages.Announcements.role_view', compact('announcements', 'role'));
    }
}
