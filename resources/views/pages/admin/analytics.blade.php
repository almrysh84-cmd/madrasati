@extends('layouts.master')

@section('css')
    @toastr_css
    @section('title')
        لوحة التحليلات المتقدمة
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        لوحة التحليلات المتقدمة
    @stop
@endsection

@section('content')
<div class="row" style="font-family: 'Cairo', sans-serif;">
    {{-- ===== الإحصائيات السريعة ===== --}}
    <div class="col-md-12 mb-3">
        <h4 class="mb-3"><i class="fas fa-chart-line text-primary"></i> نظرة عامة</h4>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card border-primary text-center">
                    <div class="card-body">
                        <i class="fas fa-user-graduate text-primary fa-2x"></i>
                        <h2 class="mt-2 mb-0 text-primary">{{ $stats['students_count'] }}</h2>
                        <small class="text-muted">طالب</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-success text-center">
                    <div class="card-body">
                        <i class="fas fa-chalkboard-teacher text-success fa-2x"></i>
                        <h2 class="mt-2 mb-0 text-success">{{ $stats['teachers_count'] }}</h2>
                        <small class="text-muted">معلم</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-info text-center">
                    <div class="card-body">
                        <i class="fas fa-money-bill text-info fa-2x"></i>
                        <h2 class="mt-2 mb-0 text-info">{{ number_format($stats['receipts_total'], 0) }}</h2>
                        <small class="text-muted">إجمالي المحصّل</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-warning text-center">
                    <div class="card-body">
                        <i class="fas fa-exclamation-triangle text-warning fa-2x"></i>
                        <h2 class="mt-2 mb-0 text-warning">{{ number_format($stats['pending_fees'], 0) }}</h2>
                        <small class="text-muted">رسوم متأخرة</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== توزيع الطلاب حسب المرحلة ===== --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fas fa-chart-pie"></i> توزيع الطلاب حسب المرحلة</h6>
            </div>
            <div class="card-body">
                <canvas id="studentsByGradeChart" height="200"></canvas>
            </div>
        </div>
    </div>

    {{-- ===== متوسط درجات المواد ===== --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-chart-bar"></i> متوسط درجات المواد</h6>
            </div>
            <div class="card-body">
                <canvas id="subjectAveragesChart" height="200"></canvas>
            </div>
        </div>
    </div>

    {{-- ===== اتجاه الحضور (30 يوم) ===== --}}
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-calendar-check"></i> اتجاه الحضور والغياب (آخر 30 يوماً)</h6>
            </div>
            <div class="card-body">
                <canvas id="attendanceTrendChart" height="80"></canvas>
            </div>
        </div>
    </div>

    {{-- ===== أفضل 10 طلاب ===== --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-warning text-white">
                <h6 class="mb-0"><i class="fas fa-trophy"></i> أفضل 10 طلاب</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr><th>#</th><th>الاسم</th><th>المرحلة</th><th>الدرجة</th></tr>
                    </thead>
                    <tbody>
                        @foreach($topStudents as $idx => $student)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ $student['name'] }}</td>
                                <td>{{ $student['grade'] }}</td>
                                <td><span class="badge badge-success">{{ $student['score'] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ===== التقرير المالي ===== --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> التقرير المالي</h6>
            </div>
            <div class="card-body">
                <div class="row text-center mb-3">
                    <div class="col-md-4">
                        <h5 class="text-primary">{{ number_format($financial['total_invoiced'], 0) }}</h5>
                        <small>إجمالي الفواتير</small>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-success">{{ number_format($financial['total_collected'], 0) }}</h5>
                        <small>إجمالي المحصّل</small>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-danger">{{ number_format($financial['total_pending'], 0) }}</h5>
                        <small>المتأخر</small>
                    </div>
                </div>
                <div class="progress mb-3" style="height: 20px;">
                    <div class="progress-bar bg-success" style="width: {{ $financial['collection_rate'] }}%">
                        {{ $financial['collection_rate'] }}% تحصيل
                    </div>
                </div>
                <hr>
                <h6>تفصيل حسب المرحلة:</h6>
                <table class="table table-sm">
                    <thead>
                        <tr><th>المرحلة</th><th>الفواتير</th><th>المحصّل</th><th>المتبقي</th></tr>
                    </thead>
                    <tbody>
                        @foreach($financial['by_grade'] as $g)
                            <tr>
                                <td>{{ $g['grade'] }}</td>
                                <td>{{ number_format($g['invoiced'], 0) }}</td>
                                <td class="text-success">{{ number_format($g['collected'], 0) }}</td>
                                <td class="text-danger">{{ number_format($g['pending'], 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    Chart.defaults.font.family = "'Cairo', 'Tajawal', sans-serif";
    Chart.defaults.font.size = 12;

    // توزيع الطلاب حسب المرحلة
    new Chart(document.getElementById('studentsByGradeChart'), {
        type: 'doughnut',
        data: {
            labels: @json($studentsByGrade['labels']),
            datasets: [{
                data: @json($studentsByGrade['values']),
                backgroundColor: ['#4e73df','#1cc88a','#36b9cc','#f6c23e','#e74a3b','#858796','#5a5c69','#f8f9fc'],
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // متوسط درجات المواد
    new Chart(document.getElementById('subjectAveragesChart'), {
        type: 'bar',
        data: {
            labels: @json($subjectAverages['labels']),
            datasets: [{
                label: 'متوسط الدرجة',
                data: @json($subjectAverages['values']),
                backgroundColor: 'rgba(28, 200, 138, 0.7)',
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });

    // اتجاه الحضور
    new Chart(document.getElementById('attendanceTrendChart'), {
        type: 'line',
        data: {
            labels: @json($attendanceTrend['labels']),
            datasets: [
                { label: 'حاضر', data: @json($attendanceTrend['present']), borderColor: '#1cc88a', backgroundColor: 'rgba(28,200,138,0.1)', fill: true },
                { label: 'غائب', data: @json($attendanceTrend['absent']), borderColor: '#e74a3b', backgroundColor: 'rgba(231,74,59,0.1)', fill: true },
            ]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
