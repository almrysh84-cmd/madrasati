@extends('pages.Pdf._layout')

@section('content')
<div class="title-bar">
    <h3>سند صرف</h3>
</div>

<div class="info-box">
    <div class="row">
        <span><strong>رقم السند:</strong> #{{ $processingFee->id }}</span>
        <span><strong>تاريخ السند:</strong> {{ $processingFee->date }}</span>
    </div>
    <div class="row">
        <span><strong>اسم الطالب:</strong> {{ $processingFee->student ? $processingFee->student->getTranslation('name', 'ar') : '' }}</span>
        <span><strong>البريد الإلكتروني:</strong> {{ $processingFee->student ? $processingFee->student->email : '' }}</span>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 60%">البيان</th>
            <th style="width: 40%">المبلغ المصروف (ريال)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $processingFee->description }}</td>
            <td>{{ number_format($processingFee->amount, 2) }}</td>
        </tr>
    </tbody>
</table>

<div class="total-box">
    <h3>المبلغ المصروف: {{ number_format($processingFee->amount, 2) }} ريال</h3>
</div>

<p style="text-align: center; margin-top: 20px; font-size: 11px; color: #7f8c8d;">
    تم صرف المبلغ المذكور أعلاه. هذا السند دليل على الصرف.
</p>

<div class="signature-section">
    <div class="sig">
        <p>المحاسب</p>
    </div>
    <div class="sig">
        <p>ولي الأمر</p>
    </div>
    <div class="sig">
        <p>مدير المدرسة</p>
    </div>
</div>
@endsection
