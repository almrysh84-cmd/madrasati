<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>برنامج مورا سوفت المدرسي الشامل</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
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
            background: #0f172a;
        }

        /* ===== الخلفية المدرسية ===== */
        .bg-layer {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 0;
        }
        .bg-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 25%, #2563eb 50%, #1e40af 75%, #1e3a8a 100%);
        }
        /* أشكال هندسية عائمة */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            backdrop-filter: blur(20px);
        }
        .fs-1 { width: 500px; height: 500px; top: -150px; right: -150px; background: rgba(59,130,246,0.12); }
        .fs-2 { width: 400px; height: 400px; bottom: -100px; left: -100px; background: rgba(139,92,246,0.10); }
        .fs-3 { width: 200px; height: 200px; top: 50%; left: 5%; background: rgba(34,197,94,0.08); }
        .fs-4 { width: 150px; height: 150px; bottom: 30%; right: 10%; background: rgba(251,191,36,0.08); }

        /* نمط شبكي خفيف */
        .bg-pattern {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(59,130,246,0.06) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139,92,246,0.06) 0%, transparent 50%);
        }

        /* ===== المحتوى ===== */
        .container-box {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* الشعار */
        .logo {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.05));
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255,255,255,0.15);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            animation: floatLogo 4s ease-in-out infinite;
        }
        .logo i { font-size: 42px; color: #fff; }
        @keyframes floatLogo {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(2deg); }
        }

        .header { text-align: center; margin-bottom: 35px; }
        .header h1 {
            color: #fff;
            font-size: 26px;
            font-weight: 900;
            margin-bottom: 8px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.3);
            line-height: 1.3;
        }
        .header p {
            color: rgba(255,255,255,0.75);
            font-size: 14px;
            line-height: 1.6;
        }

        /* ===== البطاقات العمودية ===== */
        .cards-wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .role-card {
            display: flex;
            align-items: center;
            padding: 18px 22px;
            border-radius: 18px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .role-card::before {
            content: '';
            position: absolute;
            right: 0; top: 0; bottom: 0;
            width: 5px;
            transition: width 0.3s;
        }
        .role-card:hover {
            transform: translateX(-8px);
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.2);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .role-card:hover::before { width: 8px; }

        .role-card .icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 16px;
            flex-shrink: 0;
            transition: transform 0.3s;
        }
        .role-card:hover .icon-box { transform: scale(1.1) rotate(-5deg); }
        .role-card .icon-box i { font-size: 24px; color: #fff; }

        .role-card .text-box { flex: 1; }
        .role-card .text-box h3 {
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 3px;
        }
        .role-card .text-box p {
            color: rgba(255,255,255,0.6);
            font-size: 13px;
        }
        .role-card .arrow {
            color: rgba(255,255,255,0.4);
            font-size: 18px;
            transition: transform 0.3s, color 0.3s;
        }
        .role-card:hover .arrow {
            color: #fff;
            transform: translateX(-6px);
        }

        /* ألوان البطاقات */
        .card-student .icon-box { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .card-student::before { background: linear-gradient(180deg, #3b82f6, #1d4ed8); }
        .card-teacher .icon-box { background: linear-gradient(135deg, #22c55e, #15803d); }
        .card-teacher::before { background: linear-gradient(180deg, #22c55e, #15803d); }
        .card-parent .icon-box { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .card-parent::before { background: linear-gradient(180deg, #f59e0b, #d97706); }
        .card-admin .icon-box { background: linear-gradient(135deg, #ef4444, #b91c1c); }
        .card-admin::before { background: linear-gradient(180deg, #ef4444, #b91c1c); }

        /* التذييل */
        .footer {
            text-align: center;
            margin-top: 30px;
            color: rgba(255,255,255,0.5);
            font-size: 12px;
        }
        .footer-links { margin-top: 8px; }
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            margin: 0 8px;
            font-size: 12px;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: #fff; }

        /* ===== التجاوب ===== */
        @media (max-width: 480px) {
            .container-box { padding: 20px 15px; }
            .logo { width: 75px; height: 75px; border-radius: 22px; }
            .logo i { font-size: 34px; }
            .header h1 { font-size: 22px; }
            .header p { font-size: 13px; }
            .role-card { padding: 15px 18px; }
            .role-card .icon-box { width: 48px; height: 48px; border-radius: 14px; }
            .role-card .icon-box i { font-size: 20px; }
            .role-card .text-box h3 { font-size: 15px; }
            .role-card .text-box p { font-size: 12px; }
        }

        @media (min-height: 800px) {
            .container-box { max-width: 500px; }
            .cards-wrapper { gap: 16px; }
            .role-card { padding: 22px 26px; }
        }

        /* منع التحديد */
        .role-card { -webkit-user-select: none; user-select: none; }
    </style>
</head>

<body>
    <!-- الخلفية -->
    <div class="bg-layer">
        <div class="bg-gradient"></div>
        <div class="bg-pattern"></div>
        <div class="floating-shape fs-1"></div>
        <div class="floating-shape fs-2"></div>
        <div class="floating-shape fs-3"></div>
        <div class="floating-shape fs-4"></div>
    </div>

    <!-- المحتوى -->
    <div class="container-box">
        <!-- الشعار -->
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
        </div>

        <!-- العنوان -->
        <div class="header">
            <h1>برنامج مورا سوفت المدرسي الشامل</h1>
            <p>نظام متكامل لإدارة المدارس — اختر طريقة الدخول</p>
        </div>

        <!-- البطاقات العمودية -->
        <div class="cards-wrapper">
            <!-- 1. طالب -->
            <a href="{{ route('login.show', 'student') }}" class="role-card card-student">
                <div class="icon-box"><i class="fas fa-user-graduate"></i></div>
                <div class="text-box">
                    <h3>طالب</h3>
                    <p>الدرجات، الواجبات، المواد الدراسية</p>
                </div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>

            <!-- 2. معلم -->
            <a href="{{ route('login.show', 'teacher') }}" class="role-card card-teacher">
                <div class="icon-box"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="text-box">
                    <h3>معلم</h3>
                    <p>الحضور، الواجبات، الاختبارات الإلكترونية</p>
                </div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>

            <!-- 3. ولي أمر -->
            <a href="{{ route('login.show', 'parent') }}" class="role-card card-parent">
                <div class="icon-box"><i class="fas fa-user-tie"></i></div>
                <div class="text-box">
                    <h3>ولي أمر</h3>
                    <p>متابعة الأبناء، الرسوم، التواصل مع المعلمين</p>
                </div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>

            <!-- 4. إدارة -->
            <a href="{{ route('login.show', 'admin') }}" class="role-card card-admin">
                <div class="icon-box"><i class="fas fa-user-shield"></i></div>
                <div class="text-box">
                    <h3>الإدارة</h3>
                    <p>لوحة تحكم المدير، التحليلات، التقارير</p>
                </div>
                <i class="fas fa-chevron-left arrow"></i>
            </a>
        </div>

        <!-- التذييل -->
        <div class="footer">
            <p>&copy; 2024 برنامج مورا سوفت المدرسي الشامل</p>
            <div class="footer-links">
                <a href="#">شروط الاستخدام</a> •
                <a href="#">سياسة الخصوصية</a> •
                <a href="#">الدعم الفني</a>
            </div>
        </div>
    </div>
</body>
</html>
