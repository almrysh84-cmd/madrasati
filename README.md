# 🏫 مدرستي — Madrasati

أفضل نظام إدارة مدارس عربي مفتوح المصدر، مبني بـ Laravel + Livewire + Tailwind.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-9-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)](https://php.net)

## ✨ الميزات

### 📚 الأكاديميات
- إدارة الطلاب (CRUD + ترقية + تخرج + صور)
- إدارة المعلمين (مع ربط بالفصول والمواد)
- إدارة أولياء الأمور (ربط بالأبناء + مراقبة)
- المراحل / الصفوف / الأقسام / المواد (بترمين دراسيين)
- نظام الحضور والغياب (يومي + تقارير)
- الواجبات (3 أنواع: ملف، صورة، أسئلة)

### 📝 الاختبارات الإلكترونية المتقدمة
- **5 أنواع أسئلة**: اختيار من متعدد، اختيار متعدد، صح/خطأ، أكمل الفراغ، مقالي
- **تصحيح آلي** للأسئلة الموضوعية
- **مؤقت** مع تسليم تلقائي
- **مضاد الغش**: كشف تبديل التبويب + ترتيب عشوائي
- **إعدادات متقدمة**: مدة، محاولات، درجة نجاح، توفّر زمني

### 💰 المدفوعات
- هيكل رسوم لكل صف/شعبة
- فواتير تلقائية
- سندات قبض/صرف + قيد مزدوج
- دفع إلكتروني عبر Stripe (اختياري)
- دفع يدوي (نقدي/تحويل بنكي) مع إيصال
- تقارير مالية شاملة

### 📊 التحليلات والتقارير
- توزيع الطلاب حسب المرحلة
- متوسط درجات المواد
- اتجاه الحضور (30 يوماً)
- أفضل 10 طلاب
- تقرير مالي (تحصيل + متأخرات)
- تصدير Excel + PDF

### 💬 التواصل
- رسائل داخلية (معلم ↔ طالب ↔ ولي أمر)
- إعلانات موجّهة (لفصل/شعبة/المدرسة)
- إشعارات فورية (bell dropdown)
- إشعارات بالدرجات + الواجبات + الغياب

### 🔌 REST API (v1)
- 20+ endpoint موثق
- مصادقة Laravel Sanctum (Token-based)
- Rate limiting (60 req/min)
- استجابات JSON خفيفة للجوال

### 🏢 Multi-Tenancy (تعدد المؤسسات)
- كل مدرسة لها بياناتها المعزولة
- tenant_id على كل الجداول
- لوحة Super Admin لإدارة المدارس

## 🚀 التثبيت

```bash
# 1. استنساخ المستودع
git clone https://github.com/almrysh84-cmd/madrasati.git
cd madrasati

# 2. تثبيت الـ dependencies
composer install
npm install

# 3. إعداد البيئة
cp .env.example .env
php artisan key:generate

# 4. قاعدة البيانات
php artisan migrate
php artisan db:seed

# 5. تشغيل
php artisan serve
```

## 🔑 بيانات الدخول الافتراضية

| الدور | البريد | كلمة المرور |
|---|---|---|
| مدير | `khaled@example.com` | `12345678` |
| معلم | `khaled@example.com` | `12345678` |
| طالب | `student1@madrasati.app` | `12345678` |
| ولي أمر | `parent_3@madrasati.app` | `12345678` |

## 🛠️ التقنيات

| التقنية | الإصدار |
|---|---|
| Laravel | 9.19 |
| PHP | 8.2+ |
| Livewire | 2.10 |
| MySQL | 8.0+ |
| Chart.js | 4.4 |
| Bootstrap | 5.2 (مرحلة انتقال لـ Tailwind) |

## 📡 API

```bash
# تسجيل دخول
curl -X POST https://your-domain.com/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"khaled@example.com","password":"12345678","type":"admin"}'

# جلب الطلاب
curl -H "Authorization: Bearer YOUR_TOKEN" \
  https://your-domain.com/api/v1/students
```

## 📄 الترخيص
MIT License — مفتوح المصدر بالكامل.

## 🤝 المساهمة
نرحب بالمساهمات! يرجى فتح issue أولاً لمناقشة التغييرات المقترحة.
