<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * نظام الرسائل بين أولياء الأمور والمعلمين
 *
 * يتيح لولي الأمر التواصل مع معلمي ابنه مباشرة عبر النظام
 * (محادثة خاصة بين كل ولي أمر وكل معلم يُدرّس ابنه).
 *
 * الجدول يحوي:
 * - sender_type: 'parent' أو 'teacher'
 * - sender_id: معرف المُرسِل (من جدول my__parents أو teachers)
 * - receiver_type: 'parent' أو 'teacher'
 * - receiver_id: معرف المُستقبِل
 * - student_id: الطالب الذي تدور حوله المحادثة (اختياري — لمساعدة المعلم
 *   على معرفة أي ابن يقصد ولي الأمر)
 * - body: نص الرسالة
 * - read_at: تاريخ القراءة (null = غير مقروءة)
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->string('sender_type', 20);    // 'parent' or 'teacher'
                $table->unsignedBigInteger('sender_id');
                $table->string('receiver_type', 20);  // 'parent' or 'teacher'
                $table->unsignedBigInteger('receiver_id');
                $table->unsignedBigInteger('student_id')->nullable(); // context: which child
                $table->text('body');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();

                // Indexes for fast queries
                $table->index(['sender_type', 'sender_id']);
                $table->index(['receiver_type', 'receiver_id']);
                $table->index('student_id');
                $table->index('read_at');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
