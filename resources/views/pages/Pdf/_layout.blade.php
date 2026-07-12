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
        /* ===== الترويسة: تخطيط ثلاثي الأعمدة ===== */
        .header {
            display: table;
            width: 100%;
            border-bottom: 3px double #2c3e50;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .header .col {
            display: table-cell;
            vertical-align: middle;
        }
        .header .col-right {
            width: 38%;
            text-align: right;
        }
        .header .col-center {
            width: 24%;
            text-align: center;
        }
        .header .col-left {
            width: 38%;
            text-align: left;
        }
        .header .school-name {
            color: #1a3a5c;
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .header .school-line {
            color: #555;
            font-size: 11px;
            margin-bottom: 2px;
        }
        .header .logo-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .header .logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #1a3a5c;
            background: #eaf0f6;
            color: #1a3a5c;
            font-size: 34px;
            font-weight: bold;
            line-height: 74px;
            text-align: center;
            display: inline-block;
        }
        .header .date-line {
            font-size: 10px;
            color: #555;
            margin-bottom: 2px;
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
        {{-- العمود الأيمن: اسم المدرسة والمديرية والمحافظة والمركز --}}
        <div class="col col-right">
            <div class="school-name">{{ $school_name ?? 'مدرستي' }}</div>
            @if(!empty($directorate))<div class="school-line">{{ $directorate }}</div>@endif
            @if(!empty($governorate))<div class="school-line">{{ $governorate }}</div>@endif
            @if(!empty($center))<div class="school-line">{{ $center }}</div>@endif
        </div>

        {{-- العمود الأوسط: شعار المدرسة --}}
        <div class="col col-center">
            @if(!empty($logo_path))
                <img class="logo-img" src="{{ $logo_path }}" alt="شعار">
            @else
                <span class="logo-placeholder">م</span>
            @endif
        </div>

        {{-- العمود الأيسر: التواريخ --}}
        <div class="col col-left">
            <div class="date-line">التاريخ الميلادي: {{ $date_gregorian }}</div>
            <div class="date-line">التاريخ الهجري: {{ $date_hijri }}</div>
        </div>
    </div>

    {{-- محتوى التقرير --}}
    @yield('content')

    {{-- التذييل --}}
    <div class="footer">
        <p>
            {{ $school_name ?? 'مدرستي' }} |
            جميع الحقوق محفوظة &copy; {{ date('Y') }} —
            المطور: {{ $developer ?? 'أحمد المريش' }}
        </p>
    </div>
</body>
</html>
