<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>برنامج مورا سوفت لادارة المدارس</title>
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
            background: linear-gradient(135deg, #1a237e 0%, #283593 40%, #3949ab 70%, #5c6bc0 100%);
            position: relative;
            overflow: hidden;
        }
        /* Decorative shapes */
        .shape { position: absolute; border-radius: 50%; opacity: 0.08; background: #fff; }
        .shape-1 { width: 400px; height: 400px; top: -100px; right: -100px; }
        .shape-2 { width: 300px; height: 300px; bottom: -80px; left: -80px; }
        .shape-3 { width: 200px; height: 200px; top: 40%; left: 10%; }
        .shape-4 { width: 150px; height: 150px; bottom: 20%; right: 15%; }

        .container-box {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 920px;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header h1 {
            color: #fff;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .header p {
            color: rgba(255,255,255,0.85);
            font-size: 16px;
        }
        .header .logo-icon {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.3);
        }
        .header .logo-icon i { font-size: 36px; color: #fff; }

        .cards-wrapper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 768px) {
            .cards-wrapper { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .cards-wrapper { grid-template-columns: 1fr; }
        }

        .role-card {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }
        .role-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            transition: height 0.3s;
        }
        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .role-card:hover::before { height: 100%; opacity: 0.03; }

        .role-card .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            transition: transform 0.3s;
        }
        .role-card:hover .icon-circle { transform: scale(1.1); }
        .role-card .icon-circle i { font-size: 32px; color: #fff; }

        .role-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
        .role-card p { font-size: 13px; color: #666; }

        /* Card colors */
        .card-admin .icon-circle { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .card-admin::before { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .card-teacher .icon-circle { background: linear-gradient(135deg, #27ae60, #229954); }
        .card-teacher::before { background: linear-gradient(135deg, #27ae60, #229954); }
        .card-student .icon-circle { background: linear-gradient(135deg, #3498db, #2980b9); }
        .card-student::before { background: linear-gradient(135deg, #3498db, #2980b9); }
        .card-parent .icon-circle { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .card-parent::before { background: linear-gradient(135deg, #f39c12, #e67e22); }

        .footer {
            text-align: center;
            margin-top: 35px;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
        }
        .footer a { color: rgba(255,255,255,0.8); text-decoration: none; margin: 0 10px; }
        .footer a:hover { color: #fff; }

        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        .header .logo-icon { animation: float 3s ease-in-out infinite; }
    </style>
</head>

<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>

    <div class="container-box">
        <div class="header">
            <div class="logo-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1>برنامج مورا سوفت المدرسي الشامل</h1>
            <p>نظام متكامل لإدارة المدارس — اختر طريقة الدخول</p>
        </div>

        <div class="cards-wrapper">
            <a href="{{ route('login.show', 'admin') }}" class="role-card card-admin">
                <div class="icon-circle"><i class="fas fa-user-shield"></i></div>
                <h3>الإدارة</h3>
                <p>لوحة تحكم المدير</p>
            </a>

            <a href="{{ route('login.show', 'teacher') }}" class="role-card card-teacher">
                <div class="icon-circle"><i class="fas fa-chalkboard-teacher"></i></div>
                <h3>معلم</h3>
                <p>الحضور، الواجبات، الاختبارات</p>
            </a>

            <a href="{{ route('login.show', 'student') }}" class="role-card card-student">
                <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
                <h3>طالب</h3>
                <p>الدرجات، الواجبات، المواد</p>
            </a>

            <a href="{{ route('login.show', 'parent') }}" class="role-card card-parent">
                <div class="icon-circle"><i class="fas fa-user-tie"></i></div>
                <h3>ولي أمر</h3>
                <p>متابعة الأبناء والرسوم</p>
            </a>
        </div>

        <div class="footer">
            <p>&copy; 2024 برنامج مورا سوفت المدرسي الشامل</p>
            <p>
                <a href="#">شروط الاستخدام</a> •
                <a href="#">سياسة الخصوصية</a> •
                <a href="#">الدعم الفني</a>
            </p>
        </div>
    </div>
</body>
</html>
