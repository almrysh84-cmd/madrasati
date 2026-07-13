<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * إنشاء أولياء أمور حقيقيين لكل طالب.
 *
 * المشكلة: SchoolDataSeeder كان يضبط parent_id = 1 لكل 333 طالباً،
 * فيصبح ولي أمر واحد "أسامة" مسؤولاً عن كل الطلاب.
 *
 * هذا الـ migration يصلح المشكلة:
 * 1. يفحص كل طالب
 * 2. يستخرج اسم العائلة (آخر كلمة من الاسم)
 * 3. ينشئ ولي أمر جديد لكل عائلة (إذا لم يكن موجوداً)
 * 4. يربط الطالب بولي أمر عائلته
 *
 * النتيجة: كل طالب مرتبط بولي أمره الحقيقي (من نفس العائلة).
 * الإخوة (نفس اسم العائلة) يشاركون نفس ولي الأمر.
 *
 * كلمات مرور كل أولياء الأمور: 12345678
 * البريد الإلكتروني: parent_{N}@madrasati.app (حيث N = رقم ولي الأمر)
 */
return new class extends Migration
{
    public function up()
    {
        // تجاوز فحص المفاتيح الأجنبية مؤقتاً
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // جلب كل الطلاب مع parent_id الحالي
        $students = DB::table('students')->orderBy('id')->get();

        if ($students->isEmpty()) {
            echo "No students found — skipping.\n";
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return;
        }

        // تجميع الطلاب حسب اسم العائلة (آخر كلمة من الاسم العربي)
        $families = [];
        foreach ($students as $student) {
            $nameAr = $student->name;
            // اسم الطالب مُخزَّن كـ JSON: {"ar":"...","en":"..."}
            $decoded = json_decode($nameAr, true);
            $arName = $decoded['ar'] ?? $nameAr;

            // استخراج اسم العائلة = آخر كلمة
            $parts = explode(' ', trim($arName));
            $familyName = end($parts);
            $familyName = trim($familyName);

            if (!isset($families[$familyName])) {
                $families[$familyName] = [];
            }
            $families[$familyName][] = $student->id;
        }

        echo "Found " . count($families) . " unique families.\n";

        // الحصول على آخر parent ID
        $lastParentId = (int) DB::table('my__parents')->max('id');
        $newParentId = $lastParentId;
        $created = 0;
        $linked = 0;

        // جلب بيانات المرجعية للجنسية/فصيلة الدم/الدين (نستخدم القيم الافتراضية)
        $nationalityId = DB::table('nationalities')->value('id') ?? 1;
        $bloodId = DB::table('type__bloods')->value('id') ?? 1;
        $religionId = DB::table('religions')->value('id') ?? 1;
        $genderId = DB::table('genders')->value('id') ?? 1;

        foreach ($families as $familyName => $studentIds) {
            $newParentId++;

            // اسم ولي الأمر = "ولي أمر" + اسم العائلة
            $parentNameAr = 'ولي أمر ' . $familyName;
            $parentNameEn = 'Parent of ' . $familyName;

            // إنشاء ولي أمر جديد
            DB::table('my__parents')->insert([
                'email'                 => 'parent_' . $newParentId . '@madrasati.app',
                'password'              => Hash::make('12345678'),
                'Name_Father'           => json_encode(['ar' => $parentNameAr, 'en' => $parentNameEn], JSON_UNESCAPED_UNICODE),
                'National_ID_Father'    => '000000000' . $newParentId,
                'Passport_ID_Father'    => '000000000' . $newParentId,
                'Phone_Father'          => '050000000' . ($newParentId % 1000),
                'Job_Father'            => json_encode(['ar' => 'موظف', 'en' => 'Employee'], JSON_UNESCAPED_UNICODE),
                'Nationality_Father_id' => $nationalityId,
                'Blood_Type_Father_id'  => $bloodId,
                'Religion_Father_id'    => $religionId,
                'Address_Father'        => 'العنوان - ' . $familyName,
                'Name_Mother'           => json_encode(['ar' => 'السيدة ' . $familyName, 'en' => 'Mrs. ' . $familyName], JSON_UNESCAPED_UNICODE),
                'National_ID_Mother'    => '000000000' . ($newParentId + 10000),
                'Passport_ID_Mother'    => '000000000' . ($newParentId + 10000),
                'Phone_Mother'          => '050000000' . (($newParentId + 1000) % 1000),
                'Job_Mother'            => json_encode(['ar' => 'ربة منزل', 'en' => 'Housewife'], JSON_UNESCAPED_UNICODE),
                'Nationality_Mother_id' => $nationalityId,
                'Blood_Type_Mother_id'  => $bloodId,
                'Religion_Mother_id'    => $religionId,
                'Address_Mother'        => 'العنوان - ' . $familyName,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);

            $created++;

            // ربط كل الطلاب من نفس العائلة بولي الأمر الجديد
            foreach ($studentIds as $sid) {
                DB::table('students')->where('id', $sid)->update(['parent_id' => $newParentId]);
                $linked++;
            }
        }

        echo "Created $created parents for $linked students.\n";

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down()
    {
        // لا يمكن التراجع — البيانات الأصلية كانت خاطئة
        // (كل الطلاب بولي أمر واحد)
    }
};
