<?php

namespace App\Repository;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * مستودع النسخ الاحتياطي
 *
 * المطور: أحمد المريش
 * المشروع: madrasati - نظام إدارة المدارس
 */
class BackupRepository implements BackupRepositoryInterface
{
    /** قرص النسخ الاحتياطي */
    protected $disk;

    /** المسار داخل القرص */
    protected $backupPath = 'Laravel-backup';

    public function __construct()
    {
        $this->disk = Storage::disk(config('backup.backup.destination.disks')[0] ?? 'local');
    }

    /**
     * عرض قائمة النسخ الاحتياطية المتاحة
     */
    public function index()
    {
        $backups = [];
        $totalSize = 0;

        try {
            $files = $this->disk->files($this->backupPath);

            foreach ($files as $file) {
                // تجاهل الملفات المخفية وغير الـ zip
                if (!Str::endsWith($file, '.zip')) {
                    continue;
                }

                $size = $this->disk->size($file);
                $totalSize += $size;

                $backups[] = [
                    'name' => basename($file),
                    'size' => $this->formatSize($size),
                    'size_bytes' => $size,
                    'date' => date('Y-m-d H:i:s', $this->disk->lastModified($file)),
                ];
            }

            // ترتيب من الأحدث للأقدم
            usort($backups, function ($a, $b) {
                return strcmp($b['date'], $a['date']);
            });
        } catch (\Exception $e) {
            // في حال عدم وجود مجلد النسخ بعد
            $backups = [];
        }

        $totalSizeFormatted = $this->formatSize($totalSize);

        return view('pages.Backup.index', compact('backups', 'totalSizeFormatted'));
    }

    /**
     * إنشاء نسخة احتياطية جديدة (قاعدة البيانات فقط)
     */
    public function create()
    {
        try {
            Artisan::call('backup:run', ['--only-db' => true]);

            toastr()->success('تم إنشاء النسخة الاحتياطية بنجاح');

            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error('حدث خطأ أثناء إنشاء النسخة الاحتياطية: ' . $e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * تنزيل نسخة احتياطية
     */
    public function download($fileName)
    {
        $filePath = $this->backupPath . '/' . $fileName;

        if (!$this->disk->exists($filePath)) {
            abort(404, 'النسخة الاحتياطية غير موجودة');
        }

        return response()->streamDownload(function () use ($filePath) {
            echo $this->disk->get($filePath);
        }, $fileName, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    /**
     * حذف نسخة احتياطية
     */
    public function delete($fileName)
    {
        $filePath = $this->backupPath . '/' . $fileName;

        if (!$this->disk->exists($filePath)) {
            return response()->json(['success' => false, 'message' => 'النسخة الاحتياطية غير موجودة'], 404);
        }

        $this->disk->delete($filePath);

        return response()->json(['success' => true, 'message' => 'تم حذف النسخة الاحتياطية بنجاح']);
    }

    /**
     * تنسيق حجم الملف بصيغة مقروءة
     */
    protected function formatSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' B';
        }
    }
}
