<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>برنامج مور المدرسي الشامل</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/mor-logo.jpg') }}" type="image/jpeg" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cairo', sans-serif; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: #f0f4ff;
        }

        /* ===== الخلفية المدرسية الفاتحة ===== */
        .bg-layer { position: absolute; inset: 0; z-index: 0; }
        .bg-gradient {
            position: absolute; inset: 0;
            background: linear-gradient(160deg, #e0e7ff 0%, #f0f4ff 30%, #dbeafe 60%, #ede9fe 100%);
        }
        /* أشكال زخرفية فاتحة */
        .floating-shape { position: absolute; border-radius: 50%; backdrop-filter: blur(20px); }
        .fs-1 { width: 500px; height: 500px; top: -150px; right: -150px; background: rgba(59,130,246,0.08); }
        .fs-2 { width: 400px; height: 400px; bottom: -100px; left: -100px; background: rgba(139,92,246,0.07); }
        .fs-3 { width: 200px; height: 200px; top: 50%; left: 5%; background: rgba(34,197,94,0.06); }
        .fs-4 { width: 150px; height: 150px; bottom: 30%; right: 10%; background: rgba(251,191,36,0.06); }

        /* أيقونات مدرسية مزخرفة في الخلفية */
        .bg-icon { position: absolute; font-size: 80px; opacity: 0.04; color: #1e40af; }
        .bg-icon-1 { top: 10%; right: 8%; transform: rotate(-15deg); }
        .bg-icon-2 { bottom: 15%; left: 10%; transform: rotate(20deg); }
        .bg-icon-3 { top: 60%; right: 12%; font-size: 60px; transform: rotate(10deg); }
        .bg-icon-4 { top: 20%; left: 15%; font-size: 50px; transform: rotate(-10deg); }

        /* ===== المحتوى ===== */
        .container-box {
            position: relative; z-index: 10;
            width: 100%; max-width: 480px;
            padding: 30px 20px;
            display: flex; flex-direction: column; align-items: center;
        }

        /* الشعار — صورة المستخدم */
        .logo {
            width: 100px; height: 100px;
            border-radius: 28px;
            overflow: hidden;
            margin-bottom: 18px;
            box-shadow: 0 8px 32px rgba(30,64,175,0.25);
            border: 3px solid rgba(255,255,255,0.8);
            animation: floatLogo 4s ease-in-out infinite;
        }
        .logo img { width: 100%; height: 100%; object-fit: cover; }
        @keyframes floatLogo {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .header { text-align: center; margin-bottom: 30px; }
        .header h1 {
            color: #1e3a5f;
            font-size: 26px; font-weight: 900;
            margin-bottom: 8px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .header p { color: #64748b; font-size: 14px; }

        /* ===== البطاقات ===== */
        .cards-wrapper { width: 100%; display: flex; flex-direction: column; gap: 14px; }

        .role-card {
            display: flex; align-items: center;
            padding: 18px 22px;
            border-radius: 18px;
            text-decoration: none;
            position: relative; overflow: hidden;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 4px 15px rgba(30,58,95,0.06);
        }
        .role-card::before {
            content: ''; position: absolute;
            right: 0; top: 0; bottom: 0; width: 5px;
            transition: width 0.3s;
        }
        .role-card:hover {
            transform: translateX(-8px);
            background: rgba(255,255,255,0.9);
            box-shadow: 0 10px 30px rgba(30,58,95,0.12);
        }
        .role-card:hover::before { width: 8px; }

        .role-card .icon-box {
            width: 56px; height: 56px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin-left: 16px; flex-shrink: 0;
            transition: transform 0.3s;
        }
        .role-card:hover .icon-box { transform: scale(1.1) rotate(-5deg); }
        .role-card .icon-box i { font-size: 24px; color: #fff; }

        .role-card .text-box { flex: 1; }
        .role-card .text-box h3 { color: #1e3a5f; font-size: 17px; font-weight: 700; margin-bottom: 3px; }
        .role-card .text-box p { color: #64748b; font-size: 13px; }
        .role-card .arrow { color: #94a3b8; font-size: 18px; transition: all 0.3s; }
        .role-card:hover .arrow { color: #1e3a5f; transform: translateX(-6px); }

        /* ألوان البطاقات الفاتحة */
        .card-student .icon-box { background: linear-gradient(135deg, #60a5fa, #3b82f6); }
        .card-student::before { background: linear-gradient(180deg, #60a5fa, #3b82f6); }
        .card-teacher .icon-box { background: linear-gradient(135deg, #34d399, #10b981); }
        .card-teacher::before { background: linear-gradient(180deg, #34d399, #10b981); }
        .card-parent .icon-box { background: linear-gradient(135deg, #fbbf24, #f59e0b); }
        .card-parent::before { background: linear-gradient(180deg, #fbbf24, #f59e0b); }
        .card-admin .icon-box { background: linear-gradient(135deg, #f87171, #ef4444); }
        .card-admin::before { background: linear-gradient(180deg, #f87171, #ef4444); }

        /* التذييل */
        .footer { text-align: center; margin-top: 28px; color: #94a3b8; font-size: 12px; }
        .footer-links { margin-top: 8px; }
        .footer-links a {
            color: #64748b; text-decoration: none; margin: 0 8px; font-size: 12px; transition: color 0.2s;
        }
        .footer-links a:hover { color: #1e3a5f; }

        /* ===== التجاوب ===== */
        @media (max-width: 480px) {
            .container-box { padding: 20px 15px; }
            .logo { width: 80px; height: 80px; border-radius: 22px; }
            .header h1 { font-size: 22px; }
            .role-card { padding: 15px 18px; }
            .role-card .icon-box { width: 48px; height: 48px; }
            .role-card .icon-box i { font-size: 20px; }
        }
        @media (min-height: 800px) { .cards-wrapper { gap: 16px; } .role-card { padding: 22px 26px; } }
    </style>
</head>

<body>
    <!-- الخلفية -->
    <div class="bg-layer">
        <div class="bg-gradient"></div>
        <div class="floating-shape fs-1"></div>
        <div class="floating-shape fs-2"></div>
        <div class="floating-shape fs-3"></div>
        <div class="floating-shape fs-4"></div>
        <!-- أيقونات مدرسية مزخرفة -->
        <i class="fas fa-book bg-icon bg-icon-1"></i>
        <i class="fas fa-pencil-alt bg-icon bg-icon-2"></i>
        <i class="fas fa-calculator bg-icon bg-icon-3"></i>
        <i class="fas fa-flask bg-icon bg-icon-4"></i>
    </div>

    <!-- المحتوى -->
    <div class="container-box">
        <!-- الشعار -->
        <div class="logo">
            <img src="{{ asset('assets/images/mor-logo.jpg') }}" alt="مور">
        </div>

        <div class="header">
            <h1>برنامج مور المدرسي الشامل</h1>
            <p>نظام متكامل لإدارة المدارس — اختر طريقة الدخول</p>
        </div>

        <div class="cards-wrapper">
            <a href="{{ route('login.show', 'student') }}" class="role-card card-student">
                <div class="icon-box"><i class="fas fa-user-graduate"></i></div>
                <div class="text-box"><h3>طالب</h3><p>الدرجات، الواجبات، المواد الدراسية</p></div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>
            <a href="{{ route('login.show', 'teacher') }}" class="role-card card-teacher">
                <div class="icon-box"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="text-box"><h3>معلم</h3><p>الحضور، الواجبات، الاختبارات الإلكترونية</p></div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>
            <a href="{{ route('login.show', 'parent') }}" class="role-card card-parent">
                <div class="icon-box"><i class="fas fa-user-tie"></i></div>
                <div class="text-box"><h3>ولي أمر</h3><p>متابعة الأبناء، الرسوم، التواصل مع المعلمين</p></div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>
            <a href="{{ route('login.show', 'admin') }}" class="role-card card-admin">
                <div class="icon-box"><i class="fas fa-user-shield"></i></div>
                <div class="text-box"><h3>الإدارة</h3><p>لوحة تحكم المدير، التحليلات، التقارير</p></div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>
        </div>

        <div class="footer">
            <p>&copy; 2024 برنامج مور المدرسي الشامل</p>
            <div class="footer-links">
                <a href="#">شروط الاستخدام</a> • <a href="#">سياسة الخصوصية</a> • <a href="#">الدعم الفني</a>
            </div>
        </div>
    </div>
</body>
</html>
