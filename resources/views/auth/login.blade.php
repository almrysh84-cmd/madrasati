<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>تسجيل الدخول — برنامج مورا سوفت المدرسي</title>
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
        .shape { position: absolute; border-radius: 50%; opacity: 0.07; background: #fff; }
        .shape-1 { width: 350px; height: 350px; top: -80px; right: -80px; }
        .shape-2 { width: 280px; height: 280px; bottom: -60px; left: -60px; }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 900px;
            display: flex;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            background: #fff;
        }

        /* Left panel — description */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #1a237e 0%, #3949ab 100%);
            color: #fff;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        .left-panel .logo {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            border: 2px solid rgba(255,255,255,0.3);
        }
        .left-panel .logo i { font-size: 32px; }
        .left-panel h2 { font-size: 26px; font-weight: 900; margin-bottom: 15px; line-height: 1.4; }
        .left-panel p { font-size: 15px; line-height: 1.8; opacity: 0.9; margin-bottom: 30px; }
        .left-panel .features { list-style: none; }
        .left-panel .features li {
            font-size: 14px;
            margin-bottom: 10px;
            opacity: 0.85;
        }
        .left-panel .features li i { margin-left: 8px; opacity: 0.7; }
        .left-panel .footer-links {
            margin-top: auto;
            padding-top: 30px;
            font-size: 13px;
            opacity: 0.6;
        }
        .left-panel .footer-links a { color: #fff; text-decoration: none; margin-left: 15px; }

        /* Right panel — form */
        .right-panel {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-panel h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1a237e;
            margin-bottom: 8px;
        }
        .right-panel .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }
        .role-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .role-badge i { margin-left: 5px; }

        .form-group { margin-bottom: 22px; }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .input-wrapper {
            position: relative;
        }
        .input-wrapper i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 16px;
        }
        .form-control {
            width: 100%;
            padding: 14px 45px 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Cairo', sans-serif;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
        }
        .form-control:focus {
            border-color: #3949ab;
            box-shadow: 0 0 0 3px rgba(57,73,171,0.1);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .form-options label { font-size: 14px; color: #666; cursor: pointer; }
        .form-options a { font-size: 14px; color: #3949ab; text-decoration: none; }
        .form-options a:hover { text-decoration: underline; }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1a237e, #3949ab);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26,35,126,0.4);
        }
        .btn-login:active { transform: translateY(0); }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #999;
            font-size: 14px;
            text-decoration: none;
        }
        .back-link a:hover { color: #3949ab; }

        .alert-error {
            background: #ffebee;
            border: 1px solid #ef9a9a;
            color: #c62828;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .login-container { flex-direction: column; max-width: 420px; }
            .left-panel { padding: 30px; }
            .left-panel .features { display: none; }
            .right-panel { padding: 30px; }
        }
    </style>
</head>

<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>

    <div class="login-container">
        <!-- Left panel — description -->
        <div class="left-panel">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2>برنامج مورا سوفت المدرسي الشامل</h2>
            <p>نظام متكامل لإدارة المدارس — يوفر بيئة تعليمية ذكية تربط الإدارة والمعلمين والطلاب وأولياء الأمور في منصة واحدة.</p>
            <ul class="features">
                <li><i class="fas fa-check-circle"></i> إدارة الطلاب والمعلمين والحضور</li>
                <li><i class="fas fa-check-circle"></i> اختبارات إلكترونية تفاعلية</li>
                <li><i class="fas fa-check-circle"></i> واجبات ومواد دراسية بترمين</li>
                <li><i class="fas fa-check-circle"></i> رسوم ومدفوعات وإيصالات</li>
                <li><i class="fas fa-check-circle"></i> تقارير وتحليلات شاملة</li>
                <li><i class="fas fa-check-circle"></i> تواصل مباشر بين المعلمين وأولياء الأمور</li>
            </ul>
            <div class="footer-links">
                <a href="#">شروط الاستخدام</a>
                <a href="#">سياسة الخصوصية</a>
            </div>
        </div>

        <!-- Right panel — form -->
        <div class="right-panel">
            @php
                $roleConfig = [
                    'admin'   => ['icon' => 'fa-user-shield',       'title' => 'تسجيل دخول الإدارة',  'color' => '#e74c3c', 'desc' => 'لوحة تحكم المدير'],
                    'teacher' => ['icon' => 'fa-chalkboard-teacher', 'title' => 'تسجيل دخول معلم',    'color' => '#27ae60', 'desc' => 'الحضور، الواجبات، الاختبارات'],
                    'student' => ['icon' => 'fa-user-graduate',      'title' => 'تسجيل دخول طالب',    'color' => '#3498db', 'desc' => 'الدرجات، الواجبات، المواد'],
                    'parent'  => ['icon' => 'fa-user-tie',           'title' => 'تسجيل دخول ولي أمر', 'color' => '#f39c12', 'desc' => 'متابعة الأبناء والرسوم'],
                ];
                $cfg = $roleConfig[$type] ?? $roleConfig['admin'];
            @endphp

            <span class="role-badge" style="background: {{ $cfg['color'] }}20; color: {{ $cfg['color'] }};">
                <i class="fas {{ $cfg['icon'] }}"></i> {{ $cfg['desc'] }}
            </span>

            <h3>{{ $cfg['title'] }}</h3>
            <p class="subtitle">أدخل بياناتك للوصول إلى حسابك</p>

            @if (\Session::has('message'))
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i> {!! \Session::get('message') !!}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" value="{{ $type }}" name="type">

                <div class="form-group">
                    <label>البريد الإلكتروني *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus
                               placeholder="example@madrasati.app">
                    </div>
                    @error('email') <small style="color:#e74c3c;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>كلمة المرور *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required placeholder="••••••••">
                    </div>
                    @error('password') <small style="color:#e74c3c;">{{ $message }}</small> @enderror
                </div>

                <div class="form-options">
                    <label><input type="checkbox" name="two"> تذكرني</label>
                    <a href="#">هل نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('selection') }}"><i class="fas fa-arrow-right"></i> رجوع لاختيار نوع المستخدم</a>
            </div>
        </div>
    </div>
</body>
</html>
