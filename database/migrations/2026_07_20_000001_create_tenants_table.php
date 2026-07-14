<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Multi-Tenancy: إضافة عمود tenant_id لكل الجداول.
 *
 * نهج: Shared Database + عمود tenant_id.
 * كل مدرسة لها tenant_id فريد. كل الاستعلامات تُصفّى تلقائياً.
 *
 * هذا الـ migration يضيف:
 * 1. جدول tenants (المدارس)
 * 2. عمود tenant_id لكل جدول بيانات
 * 3. index على tenant_id للأداء
 */
return new class extends Migration
{
    private $tenantTables = [
        'users', 'students', 'teachers', 'my__parents',
        'grades', 'classrooms', 'sections', 'subjects',
        'fees', 'fee_invoices', 'receipt_students', 'processing_fees',
        'payment_students', 'student_accounts', 'fund_accounts',
        'quizzes', 'questions', 'degrees', 'attendances',
        'homeworks', 'homework_questions', 'student_grades',
        'online_classes', 'library', 'announcements', 'messages',
        'promotions', 'images', 'parent_attachments',
        'question_bank',
    ];

    public function up()
    {
        // 1. إنشاء جدول tenants (المدارس)
        if (!Schema::hasTable('tenants')) {
            Schema::create('tenants', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique(); // للنطاق الفرعي: schoolname.madrasati.com
                $table->string('domain')->nullable()->unique(); // نطاق مخصص
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->string('address')->nullable();
                $table->string('logo')->nullable();
                $table->string('plan')->default('free'); // free, pro, enterprise
                $table->timestamp('trial_ends_at')->nullable();
                $table->boolean('is_active')->default(true);
                $table->json('settings')->nullable(); // إعدادات المدرسة
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // 2. إضافة tenant_id لكل جدول
        foreach ($this->tenantTables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'tenant_id')) {
                Schema::table($table, function (Blueprint $schema) use ($table) {
                    $schema->unsignedBigInteger('tenant_id')->nullable()->after('id');
                    $schema->index('tenant_id');
                });
            }
        }

        // 3. إنشاء tenant افتراضي (المدرسة الحالية)
        $defaultTenantId = DB::table('tenants')->insertGetId([
            'name'       => 'مدرسة السعيد',
            'slug'       => 'al-saeed',
            'domain'     => null,
            'email'      => 'info@al-saeed.edu',
            'phone'      => '0500000000',
            'address'    => 'تعز - اليمن',
            'plan'       => 'pro',
            'is_active'  => true,
            'settings'   => json_encode(['academic_year' => '2024/2025']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. ربط كل البيانات الحالية بالـ tenant الافتراضي
        foreach ($this->tenantTables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'tenant_id')) {
                DB::table($table)->whereNull('tenant_id')->update(['tenant_id' => $defaultTenantId]);
            }
        }

        echo "Multi-tenancy setup complete. Default tenant ID: $defaultTenantId\n";
    }

    public function down()
    {
        // إزالة tenant_id من كل الجداول
        foreach ($this->tenantTables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'tenant_id')) {
                Schema::table($table, function (Blueprint $schema) {
                    $schema->dropIndex(['tenant_id']);
                    $schema->dropColumn('tenant_id');
                });
            }
        }

        Schema::dropIfExists('tenants');
    }
};
