@extends('pages.Pdf._layout')

@section('content')
<div class="title-bar">
    <h3>كشف أسماء طلاب الفصل</h3>
</div>

<div class="info-box">
    <div class="row">
        <span><strong>المرحلة:</strong> {{ $section->Grades ? $section->Grades->getTranslation('Name', 'ar') : '' }}</span>
        <span><strong>الصف:</strong> {{ $section->My_classs ? $section->My_classs->getTranslation('Name_Class', 'ar') : '' }}</span>
        <span><strong>القسم:</strong> {{ $section->getTranslation('Name_Section', 'ar') }}</span>
    </div>
    <div class="row">
        <span><strong>عدد الطلاب:</strong> {{ $students->count() }}</span>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 5%">#</th>
            <th style="width: 30%">اسم الطالب</th>
            <th style="width: 15%">الجنس</th>
            <th style="width: 20%">الجنسية</th>
            <th style="width: 15%">تاريخ الميلاد</th>
            <th style="width: 15%">السنة الدراسية</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $index => $student)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $student->getTranslation('name', 'ar') }}</td>
            <td>{{ $student->gender ? $student->gender->getTranslation('Name', 'ar') : '' }}</td>
            <td>{{ $student->Nationality ? $student->Nationality->getTranslation('Name', 'ar') : '' }}</td>
            <td>{{ $student->Date_Birth }}</td>
            <td>{{ $student->academic_year }}</td>
        </tr>
        @endforeach
        @if($students->count() == 0)
        <tr>
            <td colspan="6">لا يوجد طلاب في هذا القسم</td>
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
