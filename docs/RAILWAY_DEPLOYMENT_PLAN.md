# خطة النشر على Railway - نظام مدرستي (madrasati)

## نظرة عامة

يتم نشر نظام "مدرستي" على Railway باستخدام Docker (`php:8.2-apache`) مع `entrypoint.sh` الذي ينفذ `migrate:fresh --force` ثم `db:seed --force` عند كل نشر (مما يمسح قاعدة البيانات ويعيد بذرها).

---

## معلومات النشر الحالية

| العنصر | القيمة |
|--------|--------|
| Railway Project ID | `8deb1ea9-0a80-4c22-8700-5de5e5a32bf3` |
| Railway Web Service ID | `0eb4ef37-dbaa-4f6b-b0b1-e00b9a4ce928` |
| Railway API Token | `3502410e-3c96-4596-847b-9dc9dbacc00d` |
| Railway GraphQL Endpoint | `https://backboard.railway.com/graphql/v2` |
| Public URL | `https://madrasati-production.up.railway.app` |
| Git Remote | `https://almrysh84-cmd:ghp_***@github.com/almrysh84-cmd/madrasati.git` |
| أحدث commit منشور | `0a11e23` |

---

## متغيرات البيئة الجديدة المطلوبة على Railway

### الميزة 4: الإشعارات الفورية (Pusher)

```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=<your_pusher_app_id>
PUSHER_APP_KEY=<your_pusher_app_key>
PUSHER_APP_SECRET=<your_pusher_app_secret>
PUSHER_APP_CLUSTER=<your_pusher_cluster>
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
```

> **ملاحظة:** إذا لم يتم إعداد Pusher، يمكن تعيين `BROADCAST_DRIVER=null` لتعطيل البث. التطبيق سيعمل بشكل طبيعي لكن الإشعارات لن تكون فورية (ستظهر عند إعادة تحميل الصفحة فقط).

### الميزة 5: PWA

> **لا تتطلب متغيرات بيئة إضافية.** يتم تقديم `manifest.json` و `service-worker.js` و `offline.html` من المجلد `public/` مباشرة.

### الميزة 6: تحسين الأداء (Redis)

```env
CACHE_DRIVER=redis
QUEUE_CONNECTION=database
REDIS_HOST=<railway_redis_internal_host>
REDIS_PASSWORD=<railway_redis_password>
REDIS_PORT=<railway_redis_port>
REDIS_CLIENT=predis
```

> **ملاحظة:** إذا لم يتم إضافة Redis على Railway، يمكن تعيين `CACHE_DRIVER=file` كبديل. التطبيق سيعمل لكن بدون تخزين مؤقت Redis. CacheService مصمم للتراجع تلقائياً عند فشل Redis.

> **لإضافة Redis على Railway:** Railway Dashboard → Add → Database → Redis. سيتم تعبئة متغيرات `REDIS_*` تلقائياً.

### الميزة 7: تكامل واتساب (Twilio)

```env
TWILIO_SID=<your_twilio_account_sid>
TWILIO_TOKEN=<your_twilio_auth_token>
TWILIO_WHATSAPP_FROM=whatsapp:+14155238886
TWILIO_WHATSAPP_ENABLED=true
```

> **ملاحظة:** للاختبار، يمكن استخدام رقم Twilio Sandbox المجاني `whatsapp:+14155238886`. يجب ربط المستلمون بالـ Sandbox أولاً. للإنتاج، يلزم رقم Twilio WhatsApp معتمد.

> **إذا لم تريد تفعيل واتساب:** اترك `TWILIO_WHATSAPP_ENABLED=false`. التطبيق سيعمل، صفحات واتساب ستعرض "الخدمة غير مفعّلة".

### الميزة 1-3: لا تتطلب متغيرات بيئة جديدة

- بنك الأسئلة، محرك الترقية، لوحة الإعلانات — كلها تستخدم قاعدة البيانات فقط.

### الميزة 2: محرك الترقية (معايير اختيارية)

```env
PROMOTION_MIN_AVERAGE=50
PROMOTION_MAX_FAILED_SUBJECTS=2
PROMOTION_AUTO_NOTIFY_PARENTS=true
```

> هذه لها قيم افتراضية في الكود، لكن يُفضل ضبطها صراحةً.

---

## خطوات النشر

### الخطوة 1: التحقق من الكود محلياً

```bash
cd /workspace/madrasati_repo

# فحص صياغة PHP لجميع الملفات الجديدة
find app/Policies app/Channels app/Services app/Notifications app/Events \
     app/Repository/WhatsApp*.php app/Http/Controllers/WhatsApp \
     app/Http/Requests/WhatsApp*.php app/Providers -name "*.php" \
     -exec php -l {} \;

# فحص الترحيلات
php -l database/migrations/2026_07_16_*.php

# فحص البذور
php -l database/seeders/NewFeaturesSeeder.php
php -l database/seeders/DatabaseSeeder.php
```

### الخطوة 2: تحديث composer autoload

```bash
composer dump-autoload
```

> هذا يضمن تسجيل السياسات (Policies)، القنوات (Channels)، والخدمات (Services) الجديدة في autoload.

### الخطوة 3: Git commit و push

```bash
cd /workspace/madrasati_repo
git add -A
git commit -m "feat: add WhatsApp integration, Gates/Policies, seeders, and .env.example updates

- Feature 7: WhatsApp integration (Twilio) - bulk messaging, settings, logs
  - WhatsAppService, WhatsAppChannel, WhatsAppNotification
  - WhatsAppRepository + Interface, Controller, FormRequest
  - Views: index, settings, logs (Bootstrap 5 RTL)
  - Routes + sidebar link + translations

- Cross-cutting: Gates/Policies for QuestionBank, PromotionLog, Announcement
  - Registered in AuthServiceProvider
  - Multi-guard aware (User, Teacher, Student, My_Parent)

- NewFeaturesSeeder: Question Bank + Announcements sample data
- .env.example: added REDIS_CLIENT, fixed TWILIO_WHATSAPP_ENABLED
- docs/TEST_PLAN.md and docs/RAILWAY_DEPLOYMENT_PLAN.md"

git push origin main
```

### الخطوة 4: إضافة متغيرات البيئة على Railway

#### الطريقة A: عبر Railway Dashboard

1. افتح [Railway Dashboard](https://railway.app)
2. اختر مشروع `madrasati`
3. اختر خدمة الويب (`madrasati-production`)
4. تبويب **Variables**
5. أضف المتغيرات الجديدة:

```env
REDIS_CLIENT=predis
CACHE_DRIVER=redis
TWILIO_SID=
TWILIO_TOKEN=
TWILIO_WHATSAPP_FROM=whatsapp:+14155238886
TWILIO_WHATSAPP_ENABLED=false
PROMOTION_MIN_AVERAGE=50
PROMOTION_MAX_FAILED_SUBJECTS=2
PROMOTION_AUTO_NOTIFY_PARENTS=true
```

6. اضبط `BROADCAST_DRIVER=pusher` وملء متغيرات Pusher إذا توفرت.

#### الطريقة B: عبر Railway API

```bash
# مثال: إضافة متغير عبر GraphQL API
curl -X POST https://backboard.railway.com/graphql/v2 \
  -H "Authorization: Bearer 3502410e-3c96-4596-847b-9dc9dbacc00d" \
  -H "Content-Type: application/json" \
  -d '{"query":"mutation { variableUpsert(input: { environmentId: \"<env_id>\", name: \"TWILIO_WHATSAPP_ENABLED\", value: \"false\" }) { id } }"}'
```

### الخطوة 5: مراقبة النشر

```bash
# مراقبة حالة النشر عبر API
curl -s -X POST https://backboard.railway.com/graphql/v2 \
  -H "Authorization: Bearer 3502410e-3c96-4596-847b-9dc9dbacc00d" \
  -H "Content-Type: application/json" \
  -d '{"query":"{ project(id: \"8deb1ea9-0a80-4c22-8700-5de5e5a32bf3\") { deployments { edges { node { status createdAt } } } } }"}'

# التحقق من عمل الموقع
curl -sI https://madrasati-production.up.railway.app | head -5
```

### الخطوة 6: التحقق بعد النشر

1. **تسجيل الدخول:** admin / 12345678
2. **لوحة التحكم:** تظهر مع الرسوم البيانية
3. **بنك الأسئلة:** `/ar/question_bank` — يعرض الأسئلة المبذورة
4. **محرك الترقية:** `/ar/auto_promotion` — يعرض الصفحة الرئيسية
5. **الإعلانات:** `/ar/announcements` — يعرض الإعلانات المبذورة
6. **واتساب:** `/ar/whatsapp` — يعرض صفحة الإرسال الجماعي
7. **PWA:** أيقونة التثبيت تظهر في Chrome
8. **الإشعارات:** الجرس في الهيدر يعمل

---

## معالجة المشكلات الشائعة

### مشكلة: `Class 'App\Policies\QuestionBankPolicy' not found`
**الحل:** تأكد من تشغيل `composer dump-autoload` قبل النشر. يحدث هذا تلقائياً في entrypoint.sh إذا كان موجوداً.

### مشكلة: `Redis connection refused`
**الحل:** عيّن `CACHE_DRIVER=file` بدلاً من `redis`، أو أضف Redis plugin على Railway.

### مشكلة: `Twilio\Rest\Client not found`
**الحل:** تأكد من تثبيت `twilio/sdk` عبر composer. يجب أن يكون في `composer.json`:
```json
"twilio/sdk": "^7.0"
```

### مشكلة: `predis/predis not found`
**الحل:** تأكد من تثبيت `predis/predis`:
```json
"predis/predis": "^2.0"
```

### مشكلة: Pusher errors في console
**الحل:** إذا لم تملك حساب Pusher، عيّن `BROADCAST_DRIVER=null`. الإشعارات ستعمل عند إعادة تحميل الصفحة.

### مشكلة: Migration duplicate index
**الحل:** تم إصلاح هذا مسبقاً. تأكد من عدم وجود فهارس مكررة في ترحيلات الإشعارات.

---

## هيكل الملفات الجديدة

```
app/
├── Channels/
│   └── WhatsAppChannel.php                    (Feature 7)
├── Events/
│   ├── NewGradeEvent.php                      (Feature 4)
│   ├── NewQuizEvent.php                       (Feature 4)
│   └── NewMessageEvent.php                    (Feature 4)
├── Http/
│   ├── Controllers/
│   │   ├── WhatsApp/WhatsAppController.php    (Feature 7)
│   │   ├── Question_Bank/...                  (Feature 1)
│   │   ├── AutoPromotion/...                  (Feature 2)
│   │   └── Announcements/...                  (Feature 3)
│   └── Requests/
│       └── WhatsAppBulkRequest.php            (Feature 7)
├── Models/
│   ├── QuestionBank.php                       (Feature 1)
│   ├── PromotionLog.php                       (Feature 2)
│   └── Announcement.php                       (Feature 3)
├── Notifications/
│   ├── RealTimeNotification.php               (Feature 4)
│   └── WhatsAppNotification.php               (Feature 7)
├── Policies/
│   ├── QuestionBankPolicy.php                 (Cross-cutting)
│   ├── PromotionLogPolicy.php                 (Cross-cutting)
│   └── AnnouncementPolicy.php                 (Cross-cutting)
├── Providers/
│   ├── AuthServiceProvider.php                (Updated - Policies + Gates)
│   ├── AppServiceProvider.php                 (Updated - Service singletons)
│   ├── BroadcastServiceProvider.php           (Updated - Multi-guard)
│   └── RepoServiceProvider.php               (Updated - WhatsApp binding)
├── Repository/
│   ├── WhatsAppRepositoryInterface.php        (Feature 7)
│   ├── WhatsAppRepository.php                 (Feature 7)
│   └── ...                                    (Features 1-3)
└── Services/
    ├── WhatsAppService.php                    (Feature 7)
    ├── RealTimeNotificationService.php        (Feature 4)
    └── CacheService.php                       (Feature 6)

config/
├── services.php                               (Updated - Twilio config)
└── database.php                               (Updated - predis default)

database/
├── migrations/
│   ├── 2026_07_16_000001_create_question_bank_table.php
│   ├── 2026_07_16_000002_create_promotion_logs_table.php
│   ├── 2026_07_16_000003_create_announcements_table.php
│   └── 2026_07_16_000004_add_performance_indexes_to_tables.php
└── seeders/
    └── NewFeaturesSeeder.php                  (Features 1, 3)

public/
├── manifest.json                              (Feature 5)
├── service-worker.js                          (Feature 5)
├── offline.html                               (Feature 5)
└── icons/                                     (Feature 5)

resources/
├── views/
│   ├── layouts/
│   │   ├── head.blade.php                     (Updated - PWA meta)
│   │   ├── footer-scripts.blade.php           (Updated - Pusher + SW)
│   │   └── main-sidebar/admin-main-sidebar.blade.php  (Updated - WhatsApp link)
│   └── pages/
│       ├── WhatsApp/                          (Feature 7)
│       ├── Question_Bank/                     (Feature 1)
│       ├── AutoPromotion/                     (Feature 2)
│       └── Announcements/                     (Feature 3)
└── lang/ar/
    ├── WhatsApp_trans.php                     (Feature 7)
    └── ...                                    (Features 1-3)

routes/
├── web.php                                    (Updated - WhatsApp routes)
└── channels.php                               (Updated - Multi-guard channels)

.env.example                                   (Updated - All new vars)
docs/
├── TEST_PLAN.md
└── RAILWAY_DEPLOYMENT_PLAN.md
```

---

## أوامر Composer النهائية

```bash
# تثبيت الحزم الجديدة (إذا لزم)
composer require predis/predis:^2.0
composer require pusher/pusher-php-server:^7.2
composer require twilio/sdk:^7.0

# تحديث autoload
composer dump-autoload

# ترحيل + بذر (يدوياً للاختبار المحلي)
php artisan migrate:fresh --force
php artisan db:seed --force
```

---

## ملخص المتغيرات الكامل للنشر

```env
# Existing
APP_NAME=Laravel
APP_ENV=production
APP_KEY=<generated>
APP_DEBUG=false
APP_URL=https://madrasati-production.up.railway.app
DB_CONNECTION=mysql
DB_HOST=<railway_mysql_host>
DB_PORT=<railway_mysql_port>
DB_DATABASE=<railway_mysql_db>
DB_USERNAME=<railway_mysql_user>
DB_PASSWORD=<railway_mysql_pass>
SESSION_DRIVER=file
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local
ACTIVITY_LOGGER_ENABLED=true

# Feature 4: Broadcasting (Pusher)
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=<pusher_id>
PUSHER_APP_KEY=<pusher_key>
PUSHER_APP_SECRET=<pusher_secret>
PUSHER_APP_CLUSTER=<pusher_cluster>
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https

# Feature 6: Redis
CACHE_DRIVER=redis
REDIS_HOST=<railway_redis_host>
REDIS_PASSWORD=<railway_redis_password>
REDIS_PORT=<railway_redis_port>
REDIS_CLIENT=predis

# Feature 7: WhatsApp (Twilio)
TWILIO_SID=<twilio_sid>
TWILIO_TOKEN=<twilio_token>
TWILIO_WHATSAPP_FROM=whatsapp:+14155238886
TWILIO_WHATSAPP_ENABLED=false

# Feature 2: Auto Promotion Criteria
PROMOTION_MIN_AVERAGE=50
PROMOTION_MAX_FAILED_SUBJECTS=2
PROMOTION_AUTO_NOTIFY_PARENTS=true
```
