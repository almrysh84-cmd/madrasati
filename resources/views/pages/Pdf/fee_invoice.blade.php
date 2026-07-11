@extends('pages.Pdf._layout')

@section('content')
<div class="title-bar">
    <h3>فاتورة الرسوم الدراسية</h3>
</div>

<div class="info-box">
    <div class="row">
        <span><strong>رقم الفاتورة:</strong> #{{ $invoice->id }}</span>
        <span><strong>تاريخ الفاتورة:</strong> {{ $invoice->invoice_date }}</span>
    </div>
    <div class="row">
        <span><strong>اسم الطالب:</strong> {{ $invoice->student ? $invoice->student->getTranslation('name', 'ar') : '' }}</span>
        <span><strong>المرحلة:</strong> {{ $invoice->grade ? $invoice->grade->getTranslation('Name', 'ar') : '' }}</span>
    </div>
    <div class="row">
        <span><strong>الصف:</strong> {{ $invoice->classroom ? $invoice->classroom->getTranslation('Name_Class', 'ar') : '' }}</span>
        <span><strong>السنة الدراسية:</strong> {{ $invoice->fees ? $invoice->fees->year : '' }}</span>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 50%">البيان</th>
            <th style="width: 50%">المبلغ (ريال)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $invoice->fees ? $invoice->fees->getTranslation('title', 'ar') : 'رسوم دراسية' }}</td>
            <td>{{ number_format($invoice->amount, 2) }}</td>
        </tr>
        @if($invoice->description)
        <tr>
            <td colspan="2"><strong>ملاحظات:</strong> {{ $invoice->description }}</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="total-box">
    <h3>الإجمالي المطلوب: {{ number_format($invoice->amount, 2) }} ريال</h3>
</div>

<p style="text-align: center; margin-top: 20px; font-size: 11px; color: #7f8c8d;">
    يرجى السداد في موعد أقصاه نهاية الشهر. تأخر السداد قد يؤدي إلى رسوم إضافية.
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
