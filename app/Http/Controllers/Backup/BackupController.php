<?php

namespace App\Http\Controllers\Backup;

use App\Http\Controllers\Controller;
use App\Repository\BackupRepositoryInterface;
use Illuminate\Http\Request;

/**
 * متحكم النسخ الاحتياطي
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class BackupController extends Controller
{
    protected $backupRepository;

    public function __construct(BackupRepositoryInterface $backupRepository)
    {
        $this->backupRepository = $backupRepository;
    }

    /**
     * عرض قائمة النسخ الاحتياطية
     */
    public function index()
    {
        return $this->backupRepository->index();
    }

    /**
     * إنشاء نسخة احتياطية جديدة
     */
    public function create()
    {
        return $this->backupRepository->create();
    }

    /**
     * تنزيل نسخة احتياطية
     */
    public function download($fileName)
    {
        return $this->backupRepository->download($fileName);
    }

    /**
     * حذف نسخة احتياطية (AJAX)
     */
    public function delete($fileName)
    {
        return $this->backupRepository->delete($fileName);
    }
}
