<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * جداول المدفوعات الإلكترونية + معالجة Stripe.
 */
return new class extends Migration
{
    public function up()
    {
        // 1. جدول الدفعات الإلكترونية
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('fee_invoice_id')->nullable()->constrained('fee_invoices')->onDelete('cascade');
                $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
                $table->decimal('amount', 8, 2);
                $table->enum('method', ['stripe', 'cash', 'bank_transfer', 'card_manual']);
                $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
                $table->string('stripe_payment_intent_id')->nullable()->unique();
                $table->string('transaction_reference')->nullable(); // رقم إيصال البنك
                $table->string('receipt_file')->nullable(); // مرفق الإيصال (للدفع اليدوي)
                $table->timestamp('paid_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->index(['student_id', 'status']);
                $table->index('method');
            });
        }

        // 2. إضافة عمود stripe_id لجدول receipt_students (لربط المدفوعات)
        if (Schema::hasTable('receipt_students') && !Schema::hasColumn('receipt_students', 'payment_id')) {
            Schema::table('receipt_students', function (Blueprint $table) {
                $table->unsignedBigInteger('payment_id')->nullable()->after('id');
                $table->index('payment_id');
            });
        }

        // 3. جدول إعدادات Stripe
        if (!Schema::hasTable('payment_settings')) {
            Schema::create('payment_settings', function (Blueprint $table) {
                $table->id();
                $table->boolean('stripe_enabled')->default(false);
                $table->string('stripe_publishable_key')->nullable();
                $table->string('stripe_secret_key')->nullable();
                $table->string('stripe_webhook_secret')->nullable();
                $table->string('currency')->default('SAR');
                $table->boolean('manual_payment_enabled')->default(true);
                $table->boolean('bank_transfer_enabled')->default(true);
                $table->string('bank_name')->nullable();
                $table->string('bank_account_name')->nullable();
                $table->string('bank_account_number')->nullable();
                $table->string('bank_iban')->nullable();
                $table->timestamps();
            });

            // إدراج إعدادات افتراضية
            \DB::table('payment_settings')->insert([
                'stripe_enabled'           => false,
                'manual_payment_enabled'   => true,
                'bank_transfer_enabled'    => true,
                'currency'                 => 'SAR',
                'created_at'               => now(),
                'updated_at'               => now(),
            ]);
        }
    }

    public function down()
    {
        if (Schema::hasTable('receipt_students') && Schema::hasColumn('receipt_students', 'payment_id')) {
            Schema::table('receipt_students', function (Blueprint $table) {
                $table->dropColumn('payment_id');
            });
        }
        Schema::dropIfExists('payments');
        Schema::dropIfExists('payment_settings');
    }
};
