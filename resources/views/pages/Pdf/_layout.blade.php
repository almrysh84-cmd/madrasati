<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $school_name ?? 'مدرستي' }}</title>
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url('https://fonts.gstatic.com/s/cairo/v28/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-W1ToLQ-HmkA.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Cairo';
            src: url('https://fonts.gstatic.com/s/cairo/v28/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-W1ToLk-HmkA.woff2') format('woff2');
            font-weight: bold;
            font-style: normal;
        }
        * {
            font-family: 'Cairo', 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            direction: rtl;
            text-align: right;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 3px solid #2c3e50;
            margin-bottom: 20px;
        }
        .header .logo {
            width: 70px;
            height: 70px;
        }
        .header .school-info {
            text-align: center;
            flex-grow: 1;
        }
        .header .school-info h2 {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 5px;
        }
        .header .school-info p {
            color: #7f8c8d;
            font-size: 11px;
        }
        .header .dates {
            text-align: left;
            font-size: 10px;
            color: #7f8c8d;
        }
        .title-bar {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .title-bar h3 {
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background: #34495e;
            color: white;
            padding: 8px 10px;
            text-align: center;
            font-size: 11px;
            border: 1px solid #2c3e50;
        }
        table td {
            padding: 6px 10px;
            text-align: center;
            border: 1px solid #bdc3c7;
            font-size: 11px;
        }
        table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding: 8px 0;
        }
        .info-box {
            background: #ecf0f1;
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .info-box .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .info-box .row strong {
            color: #2c3e50;
        }
        .total-box {
            background: #e8f6f3;
            border: 2px solid #1abc9c;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin: 15px 0;
        }
        .total-box h3 {
            color: #1abc9c;
            font-size: 18px;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature-section .sig {
            text-align: center;
            width: 30%;
        }
        .signature-section .sig p {
            border-top: 1px solid #333;
            padding-top: 5px;
            margin-top: 40px;
            font-size: 11px;
        }
        @page {
            margin: 20px 15px 30px 15px;
        }
    </style>
</head>
<body>
    {{-- الترويسة --}}
    <div class="header">
        <div class="logo">
            <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="شعار" style="width:70px;height:70px;" onerror="this.style.display='none'">
        </div>
        <div class="school-info">
            <h2>{{ $school_name ?? 'مدرستي' }}</h2>
            <p>جميع الحقوق محفوظة — {{ $developer ?? 'أحمد المريش' }}</p>
        </div>
        <div class="dates">
            <p>التاريخ الميلادي: {{ $date_gregorian }}</p>
            <p>التاريخ الهجري: {{ $date_hijri }}</p>
        </div>
    </div>

    {{-- محتوى التقرير --}}
    @yield('content')

    {{-- التذييل --}}
    <div class="footer">
        <p>
            {{ $school_name ?? 'مدرستي' }} | 
            جميع الحقوق محفوظة &copy; {{ date('Y') }} — 
            المطور: {{ $developer ?? 'أحمد المريش' }} |
            صفحة {{ $page ?? '' }}
        </p>
    </div>
</body>
</html>
