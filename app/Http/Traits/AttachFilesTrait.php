<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait AttachFilesTrait
{
    /**
     * Allowed file extensions for uploads (P0-7 fix: prevent executable uploads / RCE).
     */
    protected $allowedUploadExtensions = [
        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx',
        'jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp',
        'txt', 'csv',
        'zip',
    ];

    /**
     * Maximum upload size in kilobytes (10 MB).
     */
    protected $maxUploadSizeKb = 10240;

    public function uploadFile($request, $name, $folder)
    {
        // P0-7 fix: validate extension, size, and sanitize filename
        $file = $request->file($name);
        $originalName = $file->getClientOriginalName();
        $ext = strtolower($file->getClientOriginalExtension());

        if (!in_array($ext, $this->allowedUploadExtensions)) {
            throw new \InvalidArgumentException('نوع الملف غير مسموح: ' . $ext);
        }

        if ($file->getSize() > $this->maxUploadSizeKb * 1024) {
            throw new \InvalidArgumentException('حجم الملف يتجاوز الحد المسموح به');
        }

        // Sanitize filename: remove path components, slugify the base name, prefix with timestamp
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $sanitizedBase = Str::slug($baseName);
        if ($sanitizedBase === '') {
            $sanitizedBase = 'file_' . time();
        }
        $file_name = time() . '_' . $sanitizedBase . '.' . $ext;

        $file->storeAs('attachments/', $folder . '/' . $file_name, 'upload_attachments');

        // Return the stored filename so callers can persist it in DB
        return $file_name;
    }

    public function deleteFile($name, $folder)
    {
        // P0-7 fix: sanitize name before any filesystem operation
        $name = basename($name);
        $folder = basename($folder);

        $exists = Storage::disk('upload_attachments')->exists('attachments/' . $folder . '/' . $name);

        if ($exists) {
            Storage::disk('upload_attachments')->delete('attachments/' . $folder . '/' . $name);
        }
    }
}
