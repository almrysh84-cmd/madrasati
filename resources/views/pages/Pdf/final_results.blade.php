@extends('pages.Pdf._layout')

@section('content')
<div class="title-bar">
    <h3>كشف النتائج النهائية للطالب</h3>
</div>

<div class="info-box">
    <div class="row">
        <span><strong>اسم الطالب:</strong> {{ $student->getTranslation('name', 'ar') }}</span>
        <span><strong>البريد الإلكتروني:</strong> {{ $student->email }}</span>
    </div>
    <div class="row">
        <span><strong>المرحلة:</strong> {{ $student->grade ? $student->grade->getTranslation('Name', 'ar') : '' }}</span>
        <span><strong>الصف:</strong> {{ $student->classroom ? $student->classroom->getTranslation('Name_Class', 'ar') : '' }}</span>
        <span><strong>القسم:</strong> {{ $student->section ? $student->section->getTranslation('Name_Section', 'ar') : '' }}</span>
    </div>
    <div class="row">
        <span><strong>الجنس:</strong> {{ $student->gender ? $student->gender->getTranslation('Name', 'ar') : '' }}</span>
        <span><strong>الجنسية:</strong> {{ $student->Nationality ? $student->Nationality->getTranslation('Name', 'ar') : '' }}</span>
        <span><strong>السنة الدراسية:</strong> {{ $student->academic_year }}</span>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 5%">#</th>
            <th style="width: 35%">الاختبار / المادة</th>
            <th style="width: 20%">المادة</th>
            <th style="width: 15%">الدرجة</th>
            <th style="width: 15%">التاريخ</th>
            <th style="width: 10%">الحالة</th>
        </tr>
    </thead>
    <tbody>
        @foreach($degrees as $index => $degree)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $degree->quizze ? $degree->quizze->getTranslation('name', 'ar') : '' }}</td>
            <td>{{ $degree->quizze && $degree->quizze->subject ? $degree->quizze->subject->getTranslation('name', 'ar') : '' }}</td>
            <td>{{ $degree->score }}</td>
            <td>{{ $degree->date }}</td>
            <td>{{ $degree->abuse == '1' ? 'إساءة' : 'عادي' }}</td>
        </tr>
        @endforeach
        @if($degrees->count() == 0)
        <tr>
            <td colspan="6">لا توجد نتائج متاحة</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="total-box">
    <h3>المجموع الكلي: {{ $total_score }} | المتوسط: {{ $average }}</h3>
</div>

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
