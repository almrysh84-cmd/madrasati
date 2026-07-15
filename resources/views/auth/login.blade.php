<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>تسجيل الدخول — برنامج مور المدرسي</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/mor-logo.jpg') }}" type="image/jpeg" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cairo', sans-serif; }
        body {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden; background: #f0f4ff;
        }
        .bg-layer { position: absolute; inset: 0; z-index: 0; }
        .bg-gradient {
            position: absolute; inset: 0;
            background: linear-gradient(160deg, #e0e7ff 0%, #f0f4ff 30%, #dbeafe 60%, #ede9fe 100%);
        }
        .floating-shape { position: absolute; border-radius: 50%; backdrop-filter: blur(20px); }
        .fs-1 { width: 350px; height: 350px; top: -80px; right: -80px; background: rgba(59,130,246,0.07); }
        .fs-2 { width: 280px; height: 280px; bottom: -60px; left: -60px; background: rgba(139,92,246,0.06); }
        .bg-icon { position: absolute; font-size: 70px; opacity: 0.03; color: #1e40af; }
        .bg-icon-1 { top: 15%; right: 10%; transform: rotate(-15deg); }
        .bg-icon-2 { bottom: 20%; left: 12%; transform: rotate(20deg); }

        .login-container {
            position: relative; z-index: 10;
            width: 100%; max-width: 880px;
            display: flex; border-radius: 24px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(30,58,95,0.15);
            background: #fff;
        }

        /* Left panel */
        .left-panel {
            flex: 1; padding: 50px 40px;
            display: flex; flex-direction: column; justify-content: center;
            background: linear-gradient(160deg, #1e3a5f 0%, #2563eb 50%, #1e40af 100%);
            color: #fff; position: relative;
        }
        .left-panel .logo-img {
            width: 80px; height: 80px; border-radius: 22px; overflow: hidden;
            margin-bottom: 22px; border: 2px solid rgba(255,255,255,0.3); box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        .left-panel .logo-img img { width: 100%; height: 100%; object-fit: cover; }
        .left-panel h2 { font-size: 24px; font-weight: 900; margin-bottom: 12px; line-height: 1.4; }
        .left-panel p { font-size: 14px; line-height: 1.8; opacity: 0.85; margin-bottom: 25px; }
        .left-panel .features { list-style: none; }
        .left-panel .features li { font-size: 13px; margin-bottom: 9px; opacity: 0.8; }
        .left-panel .features li i { margin-left: 8px; opacity: 0.6; }
        .left-panel .footer-links { margin-top: auto; padding-top: 25px; font-size: 12px; opacity: 0.5; }
        .left-panel .footer-links a { color: #fff; text-decoration: none; margin-left: 12px; }

        /* Right panel */
        .right-panel { flex: 1; padding: 50px 40px; display: flex; flex-direction: column; justify-content: center; }
        .role-badge {
            display: inline-block; padding: 6px 16px; border-radius: 20px;
            font-size: 13px; font-weight: 600; margin-bottom: 18px;
        }
        .role-badge i { margin-left: 5px; }
        .right-panel h3 { font-size: 24px; font-weight: 700; color: #1e3a5f; margin-bottom: 6px; }
        .right-panel .subtitle { font-size: 14px; color: #64748b; margin-bottom: 28px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 7px; }
        .input-wrapper { position: relative; }
        .input-wrapper i { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 16px; }
        .form-control {
            width: 100%; padding: 14px 45px 14px 18px;
            border: 2px solid #e2e8f0; border-radius: 12px;
            font-size: 15px; font-family: 'Cairo', sans-serif;
            transition: border-color 0.3s, box-shadow 0.3s; outline: none;
        }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }

        .form-options { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
        .form-options label { font-size: 14px; color: #64748b; cursor: pointer; }
        .form-options a { font-size: 14px; color: #2563eb; text-decoration: none; }
        .form-options a:hover { text-decoration: underline; }

        .btn-login {
            width: 100%; padding: 15px; border: none; border-radius: 12px;
            font-size: 16px; font-weight: 700; font-family: 'Cairo', sans-serif; cursor: pointer;
            background: linear-gradient(135deg, #1e3a5f, #2563eb);
            color: #fff; transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37,99,235,0.3); }
        .btn-login:active { transform: translateY(0); }

        .back-link { text-align: center; margin-top: 18px; }
        .back-link a { color: #94a3b8; font-size: 14px; text-decoration: none; }
        .back-link a:hover { color: #2563eb; }

        .alert-error {
            background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
            padding: 12px 18px; border-radius: 10px; font-size: 14px; margin-bottom: 20px;
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
    <div class="bg-layer">
        <div class="bg-gradient"></div>
        <div class="floating-shape fs-1"></div>
        <div class="floating-shape fs-2"></div>
        <i class="fas fa-book bg-icon bg-icon-1"></i>
        <i class="fas fa-pencil-alt bg-icon bg-icon-2"></i>
    </div>

    <div class="login-container">
        <div class="left-panel">
            <div class="logo-img"><img src="{{ asset('assets/images/mor-logo.jpg') }}" alt="مور"></div>
            <h2>برنامج مور المدرسي الشامل</h2>
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

        <div class="right-panel">
            @php
                $roleConfig = [
                    'admin'   => ['icon' => 'fa-user-shield',       'title' => 'تسجيل دخول الإدارة',  'color' => '#ef4444', 'desc' => 'لوحة تحكم المدير'],
                    'teacher' => ['icon' => 'fa-chalkboard-teacher', 'title' => 'تسجيل دخول معلم',    'color' => '#10b981', 'desc' => 'الحضور، الواجبات، الاختبارات'],
                    'student' => ['icon' => 'fa-user-graduate',      'title' => 'تسجيل دخول طالب',    'color' => '#3b82f6', 'desc' => 'الدرجات، الواجبات، المواد'],
                    'parent'  => ['icon' => 'fa-user-tie',           'title' => 'تسجيل دخول ولي أمر', 'color' => '#f59e0b', 'desc' => 'متابعة الأبناء والرسوم'],
                ];
                $cfg = $roleConfig[$type] ?? $roleConfig['admin'];
            @endphp

            <span class="role-badge" style="background: {{ $cfg['color'] }}15; color: {{ $cfg['color'] }};">
                <i class="fas {{ $cfg['icon'] }}"></i> {{ $cfg['desc'] }}
            </span>

            <h3>{{ $cfg['title'] }}</h3>
            <p class="subtitle">أدخل بياناتك للوصول إلى حسابك</p>

            @if (\Session::has('message'))
                <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {!! \Session::get('message') !!}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" value="{{ $type }}" name="type">

                <div class="form-group">
                    <label>البريد الإلكتروني *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus placeholder="example@mor.app">
                    </div>
                    @error('email') <small style="color:#ef4444;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>كلمة المرور *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required placeholder="••••••••">
                    </div>
                    @error('password') <small style="color:#ef4444;">{{ $message }}</small> @enderror
                </div>

                <div class="form-options">
                    <label><input type="checkbox" name="two"> تذكرني</label>
                    <a href="#">هل نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</button>
            </form>

            <div class="back-link">
                <a href="{{ route('selection') }}"><i class="fas fa-arrow-right"></i> رجوع لاختيار نوع المستخدم</a>
            </div>
        </div>
    </div>
</body>
</html>
