@extends('pages.Pdf._layout')

@section('content')
<div class="title-bar">
    <h3>مصفوفة الحضور والغياب الشهرية</h3>
</div>

<div class="info-box">
    <div class="row">
        <span><strong>الشهر:</strong> {{ $month }} / {{ $year }}</span>
        @if($section)
        <span><strong>القسم:</strong> {{ $section->getTranslation('Name_Section', 'ar') }}</span>
        @endif
        <span><strong>عدد الطلاب:</strong> {{ count($matrix) }}</span>
    </div>
    <div class="row" style="font-size: 10px;">
        <span><strong>مفتاح الرموز:</strong> ✓ = حاضر | ✗ = غائب | - = لا يوجد سجل</span>
    </div>
</div>

<table style="font-size: 9px;">
    <thead>
        <tr>
            <th style="width: 4%">#</th>
            <th style="width: 20%">اسم الطالب</th>
            @for($day = 1; $day <= $daysInMonth; $day++)
            <th style="width: {{ 76 / $daysInMonth }}%">{{ $day }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach($matrix as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td style="text-align: right;">{{ $row['student']->getTranslation('name', 'ar') }}</td>
            @for($day = 1; $day <= $daysInMonth; $day++)
            <td>{{ $row['days'][$day] }}</td>
            @endfor
        </tr>
        @endforeach
        @if(count($matrix) == 0)
        <tr>
            <td colspan="{{ $daysInMonth + 2 }}">لا توجد بيانات حضور لهذا الشهر</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="signature-section">
    <div class="sig">
        <p>معلم الفصل</p>
    </div>
    <div class="sig">
        <p>رئيس القسم</p>
    </div>
    <div class="sig">
        <p>مدير المدرسة</p>
    </div>
</div>
@endsection
