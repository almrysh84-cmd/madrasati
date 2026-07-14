# 🏗️ معمارية مدرستي Pro — وثيقة التطوير الشاملة

## الرؤية
تحويل "مدرستي" إلى أفضل نظام إدارة مدارس عربي مفتوح المصدر، متفوقاً على openSIS، Skuul، Unifiedtransform، CloudSchool، khaleddoosama.

## التقنيات الأساسية
- **Backend**: Laravel 11 (ترقية من 9)
- **Frontend**: Livewire 3 + Tailwind CSS 4 (ترقية من Bootstrap)
- **Database**: MySQL 8+ (Shared Database + tenant_id)
- **Cache/Queue**: Redis
- **Real-time**: Laravel Echo + Pusher

---

## 1. هيكل المجلدات المخطط

```
madrasati/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       ├── ImportStudents.php
│   │       ├── GenerateInvoices.php
│   │       └── SendFeeReminders.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/V1/           # REST API controllers
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── StudentController.php
│   │   │   │   ├── AttendanceController.php
│   │   │   │   ├── GradeController.php
│   │   │   │   ├── QuizController.php
│   │   │   │   ├── FeeController.php
│   │   │   │   ├── LibraryController.php
│   │   │   │   └── MessageController.php
│   │   │   ├── SuperAdmin/       # Multi-tenant management
│   │   │   │   ├── TenantController.php
│   │   │   │   └── DashboardController.php
│   │   │   └── ... (existing controllers)
│   │   ├── Requests/             # Form validation
│   │   │   ├── StoreQuizRequest.php
│   │   │   ├── StoreQuestionRequest.php
│   │   │   ├── ProcessPaymentRequest.php
│   │   │   └── ...
│   │   └── Resources/            # API resources
│   │       ├── StudentResource.php
│   │       ├── GradeResource.php
│   │       └── ...
│   ├── Livewire/
│   │   ├── QuizBuilder.php       # إنشاء اختبار متقدم
│   │   ├── QuizTaker.php         # أداء الاختبار (طالب)
│   │   ├── QuizResults.php       # نتائج + تحليلات
│   │   ├── PaymentPortal.php     # بوابة الدفع
│   │   ├── AnalyticsDashboard.php # لوحة التحليلات
│   │   └── ...
│   ├── Models/
│   │   ├── Traits/
│   │   │   └── BelongsToTenant.php  # Multi-tenant trait
│   │   ├── Tenant.php            # المدرسة (مؤسسة)
│   │   ├── Quiz.php              # (مُحدّث)
│   │   ├── Question.php          # (مُحدّث — 5 أنواع)
│   │   ├── QuizAttempt.php       # محاولة اختبار
│   │   ├── QuizAnswer.php        # إجابة طالب
│   │   ├── Payment.php           # دفعة
│   │   ├── Invoice.php           # فاتورة
│   │   ├── DigitalResource.php   # ملف مكتبة رقمية
│   │   └── ... (existing models)
│   ├── Policies/                 # الصلاحيات
│   │   ├── QuizPolicy.php
│   │   ├── PaymentPolicy.php
│   │   ├── StudentPolicy.php
│   │   └── ...
│   ├── Repositories/             # الوصول للبيانات (موجود)
│   ├── Services/                 # المنطق التجاري
│   │   ├── PaymentService.php
│   │   ├── GradeService.php
│   │   ├── AttendanceService.php
│   │   ├── QuizService.php
│   │   ├── AnalyticsService.php
│   │   ├── NotificationService.php
│   │   └── ImportExportService.php
│   └── Notifications/
│       ├── FeeDueNotification.php
│       ├── QuizResultNotification.php
│       └── ...
├── database/
│   ├── migrations/
│   │   ├── 2026_07_20_000001_create_tenants_table.php
│   │   ├── 2026_07_20_000002_add_tenant_id_to_all_tables.php
│   │   ├── 2026_07_20_000010_create_quiz_attempts_table.php
│   │   ├── 2026_07_20_000011_create_quiz_answers_table.php
│   │   ├── 2026_07_20_000012_update_questions_for_advanced_types.php
│   │   ├── 2026_07_20_000020_create_payments_table.php
│   │   ├── 2026_07_20_000021_create_invoices_table.php
│   │   ├── 2026_07_20_000030_create_digital_resources_table.php
│   │   └── ...
│   └── seeders/
│       ├── TenantDemoSeeder.php  # 3 مدارس تجريبية
│       └── ...
├── routes/
│   ├── web.php                   # (مُحدّث)
│   ├── api.php                   # REST API v1
│   ├── super_admin.php           # لوحة Super Admin
│   └── channels.php              # (مُحدّث)
├── tests/
│   ├── Feature/
│   │   ├── Auth/
│   │   ├── Quiz/
│   │   ├── Payment/
│   │   └── ...
│   └── Unit/
│       ├── Services/
│       └── ...
└── docs/
    ├── ARCHITECTURE.md           # هذه الوثيقة
    ├── API.md                    # توثيق API
    └── DEPLOYMENT.md             # دليل النشر
```

---

## 2. خطة التنفيذ المرحلية

### المرحلة 1: الأساس (1-2 أسبوع)
- [x] إنشاء وثيقة المعمارية
- [ ] Multi-Tenancy (stancl/tenancy أو tenant_id يدوي)
- [ ] ترقية Laravel 9 → 11
- [ ] ترقية Livewire 2 → 3
- [ ] تثبيت Tailwind CSS (بجانب Bootstrap مؤقتاً)
- [ ] Service Layer + Repository Pattern
- [ ] Soft Deletes على كل الموديلات

### المرحلة 2: الميزات المتقدمة (2-3 أسابيع)
- [ ] Quiz Builder متقدم (5 أنواع + تصحيح آلي + مضاد غش)
- [ ] بوابة الدفع (Stripe + يدوي)
- [ ] لوحة التحليلات (10+ تقارير)
- [ ] مركز التواصل (رسائل + إشعارات + SMS)

### المرحلة 3: التكاملات (1-2 أسبوع)
- [ ] REST API (20+ endpoints + Scribe docs)
- [ ] المكتبة الرقمية (Spatie MediaLibrary)
- [ ] الاستيراد/التصدير المتقدم

### المرحلة 4: الجودة (1-2 أسبوع)
- [ ] اختبارات PHPUnit (70%+ coverage)
- [ ] اختبارات Dusk (Livewire)
- [ ] تأمين (Fortify + spatie/permission + Purify)
- [ ] التوثيق الكامل (README + API docs)

---

## 3. أوامر التثبيت المطلوبة

```bash
# Multi-Tenancy
composer require stancl/tenancy

# Livewire 3 (ترقية)
composer require livewire/livewire:^3.0

# Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init

# Spatie Media Library (للمكتبة الرقمية)
composer require spatie/laravel-medialibrary

# Spatie Permission (للأدوار)
composer require spatie/laravel-permission

# Laravel Cashier (Stripe)
composer require laravel/cashier

# Scribe (API docs)
composer require knuckleswtf/scribe

# Laravel Charts
composer require laravelweekly/laravel-charts

# Laravel Excel (موجود بالفعل)
# maatwebsite/excel

# Laravel Horizon (queues)
composer require laravel/horizon

# Laravel Telescope (debug)
composer require laravel/telescope --dev
```

---

## 4. معايير النجاح

| المعيار | الهدف | الحالة الحالية |
|---|---|---|
| تعدد المؤسسات | 3+ مدارس تجريبية | ❌ غير موجود |
| نظام اختبارات | 5+ أنواع + تصحيح آلي | ⚠️ نوع واحد فقط |
| Stripe | معاملات تجريبية | ❌ غير موجود |
| تقارير تحليلية | 10+ مع مخططات | ⚠️ 3 مخططات أساسية |
| API | 20+ endpoints موثق | ❌ 2 endpoints فقط |
| اختبارات | 70%+ coverage | ❌ 0% |
| N+1 Queries | صفر | ✅ تم إصلاحها |
| دعم عربي | كامل في كل ميزة | ✅ موجود |

---

## 5. الترخيص
MIT License — مفتوح المصدر بالكامل.
