<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Seed default fee types + create fee invoices for existing students.
 *
 * Problem: the Fees and Fee_invoices tables were empty in production. When the
 * admin clicks the "Print Invoice" (print PDF) button on /en/Fees_Invoices,
 * there are no invoices to print → the page shows an empty table and the PDF
 * endpoint returns 404 because findOrFail(1) finds nothing.
 *
 * This migration:
 * 1. Inserts a few default fee types into the `fees` table (tuition, bus, books,
 *    uniform, activities) for each grade/classroom combination — using a
 *    sensible default amount.
 * 2. Creates one fee_invoice per student (for the first fee of their classroom)
 *    so the admin can immediately see the invoice list and print PDFs.
 * 3. Also creates the matching student_accounts row (debit) to keep the
 *    double-entry accounting intact.
 *
 * Idempotent: if fee_invoices already exist, this migration is a no-op.
 */
return new class extends Migration
{
    public function up()
    {
        // Skip if already populated — never overwrite production data.
        if (DB::table('fee_invoices')->count() > 0) {
            echo "fee_invoices already populated — skipping seed.\n";
            return;
        }

        $now = now();

        // 1. Create default fee types if none exist
        if (DB::table('fees')->count() === 0) {
            $grades = DB::table('grades')->get();
            $classrooms = DB::table('classrooms')->get();

            $feeTypes = [
                ['title_ar' => 'الرسوم الدراسية', 'amount' => 500.00, 'Fee_type' => 1, 'description' => 'رسوم الفصل الدراسي الأول'],
                ['title_ar' => 'النقل المدرسي', 'amount' => 200.00, 'Fee_type' => 2, 'description' => 'رسوم التوصيل بالباص'],
                ['title_ar' => 'الكتب والقرطاسية', 'amount' => 150.00, 'Fee_type' => 3, 'description' => 'كتب ومناذج دراسية'],
                ['title_ar' => 'الزي المدرسي', 'amount' => 100.00, 'Fee_type' => 4, 'description' => 'زي مدرسي رياضي'],
                ['title_ar' => 'الأنشطة المدرسية', 'amount' => 50.00, 'Fee_type' => 5, 'description' => 'أنشطة لا صفية'],
            ];

            foreach ($grades as $grade) {
                foreach ($classrooms as $classroom) {
                    if ($classroom->Grade_id != $grade->id) {
                        continue;
                    }
                    foreach ($feeTypes as $ft) {
                        DB::table('fees')->insert([
                            'title'        => json_encode(['ar' => $ft['title_ar'], 'en' => $ft['title_ar']], JSON_UNESCAPED_UNICODE),
                            'amount'       => $ft['amount'],
                            'Grade_id'     => $grade->id,
                            'Classroom_id' => $classroom->id,
                            'description'  => $ft['description'],
                            'year'         => date('Y'),
                            'Fee_type'     => $ft['Fee_type'],
                            'created_at'   => $now,
                            'updated_at'   => $now,
                        ]);
                    }
                }
            }
            echo "Inserted default fee types.\n";
        }

        // 2. Create one fee invoice per student (using the first fee of their classroom)
        $students = DB::table('students')->get();
        $created = 0;

        foreach ($students as $student) {
            // Find a fee matching this student's classroom
            $fee = DB::table('fees')
                ->where('Classroom_id', $student->Classroom_id)
                ->first();

            if (!$fee) {
                // Fallback: any fee from the same grade
                $fee = DB::table('fees')
                    ->where('Grade_id', $student->Grade_id)
                    ->first();
            }

            if (!$fee) {
                continue; // no fee available, skip this student
            }

            $invoiceId = DB::table('fee_invoices')->insertGetId([
                'invoice_date'  => date('Y-m-d'),
                'student_id'    => $student->id,
                'Grade_id'      => $student->Grade_id,
                'Classroom_id'  => $student->Classroom_id,
                'fee_id'        => $fee->id,
                'amount'        => $fee->amount,
                'description'   => $fee->description,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            // Mirror in student_accounts (debit)
            DB::table('student_accounts')->insert([
                'date'           => date('Y-m-d'),
                'type'           => 'invoice',
                'fee_invoice_id' => $invoiceId,
                'student_id'     => $student->id,
                'Debit'          => $fee->amount,
                'credit'         => 0.00,
                'description'    => $fee->description,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);

            $created++;
        }

        echo "Created $created fee invoices for existing students.\n";
    }

    public function down()
    {
        // No-op: do NOT delete invoices in production.
    }
};
