@extends('pages.Pdf._layout')

@section('content')
<div class="title-bar">
    <h3>إيصال استلام دفعة</h3>
</div>

<div class="info-box">
    <div class="row">
        <span><strong>رقم الإيصال:</strong> #{{ $receipt->id }}</span>
        <span><strong>تاريخ الإيصال:</strong> {{ $receipt->date }}</span>
    </div>
    <div class="row">
        <span><strong>اسم الطالب:</strong> {{ $receipt->student ? $receipt->student->getTranslation('name', 'ar') : '' }}</span>
        <span><strong>البريد الإلكتروني:</strong> {{ $receipt->student ? $receipt->student->email : '' }}</span>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 60%">البيان</th>
            <th style="width: 40%">المبلغ المدفوع (ريال)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $receipt->description }}</td>
            <td>{{ number_format($receipt->Debit, 2) }}</td>
        </tr>
    </tbody>
</table>

<div class="total-box">
    <h3>المبلغ المستلم: {{ number_format($receipt->Debit, 2) }} ريال</h3>
</div>

<p style="text-align: center; margin-top: 20px; font-size: 11px; color: #7f8c8d;">
    تم استلام المبلغ المذكور أعلاه كاملاً. هذا الإيصال دليل على السداد.
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
