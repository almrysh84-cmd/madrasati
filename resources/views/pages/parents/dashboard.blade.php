<!DOCTYPE html>
<html lang="en">
@section('title')
{{trans('main_trans.Main_title')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        @include('layouts.main-header')
        @include('layouts.main-sidebar')

        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">
                            <i class="fas fa-user-tie text-primary"></i>
                            مرحبا بك: {{ auth()->user()->getTranslation('Name_Father', 'ar') }}
                        </h4>
                    </div>
                </div>
            </div>

            @php
                // جلب كل الأبناء مع علاقاتهم (eager-load لتفادي N+1)
                $sons = \App\Models\Student::where('parent_id', auth()->user()->id)
                    ->with(['grade', 'classroom', 'section', 'gender'])
                    ->get();

                // إحصائيات سريعة لكل ابن
                $childStats = [];
                foreach ($sons as $son) {
                    $degrees = \App\Models\Degree::where('student_id', $son->id)->get();
                    $attendanceRecords = \App\Models\Attendance::where('student_id', $son->id)->count();
                    $absentDays = \App\Models\Attendance::where('student_id', $son->id)->where('attendence_status', 0)->count();
                    $presentDays = \App\Models\Attendance::where('student_id', $son->id)->where('attendence_status', 1)->count();
                    $attendanceRate = $attendanceRecords > 0 ? round(($presentDays / $attendanceRecords) * 100, 1) : 0;

                    // آخر اختبار لم يدخله الطالب (درجته 0 أو لم يخضه)
                    $missedExams = \App\Models\Quizze::where('grade_id', $son->Grade_id)
                        ->where('classroom_id', $son->Classroom_id)
                        ->where('section_id', $son->section_id)
                        ->whereNotIn('id', $degrees->pluck('quizze_id'))
                        ->count();

                    // الواجبات غير المنجزة
                    $homeworks = \App\Models\Homework::where('grade_id', $son->Grade_id)
                        ->where('classroom_id', $son->Classroom_id)
                        ->where('section_id', $son->section_id)
                        ->count();

                    // الفواتير غير المدفوعة
                    $unpaidInvoices = \App\Models\Fee_invoice::where('student_id', $son->id)->count();
                    $paidReceipts = \App\Models\ReceiptStudent::whereHas('student', function($q) use ($son) {
                        $q->where('id', $son->id);
                    })->count();

                    $childStats[$son->id] = [
                        'exams_taken'    => $degrees->count(),
                        'total_score'    => $degrees->sum('score'),
                        'avg_score'      => $degrees->count() > 0 ? round($degrees->avg('score'), 1) : 0,
                        'attendance_rate'=> $attendanceRate,
                        'absent_days'    => $absentDays,
                        'present_days'   => $presentDays,
                        'missed_exams'   => $missedExams,
                        'homeworks'      => $homeworks,
                        'unpaid_invoices'=> max($unpaidInvoices - $paidReceipts, 0),
                    ];
                }

                // إجمالي الإشعارات غير المقروءة
                $unreadNotifs = auth()->user()->unreadNotifications->count();
            @endphp

            {{-- ===== تنبيه سريع بالإشعارات --}}
            @if($unreadNotifs > 0)
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-family: 'Cairo', sans-serif">
                    <i class="fas fa-bell"></i>
                    لديك <strong>{{ $unreadNotifs }}</strong> إشعار غير مقروء.
                    <a href="{{ route('parent.notifications.index') }}" class="alert-link">عرض الإشعارات</a>
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            {{-- ===== بطاقات الأبناء --}}
            <section style="background-color: #f5f7fa;">
                <div class="container-fluid py-4">
                    <h4 class="mb-3" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-children text-primary"></i> أبنائي ({{ $sons->count() }})
                    </h4>

                    @if($sons->isEmpty())
                        <div class="alert alert-warning text-center" style="font-family: 'Cairo', sans-serif">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                            <h5>لا يوجد أبناء مرتبطون بحسابك</h5>
                            <p>يرجى التواصل مع إدارة المدرسة لربط أبنائك بحسابك.</p>
                        </div>
                    @else
                        <div class="row">
                            @foreach($sons as $son)
                                @php $stats = $childStats[$son->id]; @endphp
                                <div class="col-md-6 col-xl-4 mb-4">
                                    <div class="card shadow-sm h-100 border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                                                <i class="fas fa-child"></i>
                                                {{ $son->getTranslation('name', 'ar') }}
                                            </h5>
                                        </div>
                                        <div class="card-body" style="font-family: 'Cairo', sans-serif">
                                            {{-- معلومات أساسية --}}
                                            <p class="text-muted small mb-2">
                                                {{ $son->grade ? $son->grade->getTranslation('Name', 'ar') : '-' }} /
                                                {{ $son->classroom ? $son->classroom->getTranslation('Name_Class', 'ar') : '-' }} /
                                                {{ $son->section ? $son->section->getTranslation('Name_Section', 'ar') : '-' }}
                                            </p>

                                            {{-- إحصائيات سريعة --}}
                                            <div class="row text-center mb-3">
                                                <div class="col-4">
                                                    <div class="border rounded p-2">
                                                        <h5 class="text-info mb-0">{{ $stats['exams_taken'] }}</h5>
                                                        <small>اختبار</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="border rounded p-2">
                                                        <h5 class="text-success mb-0">{{ $stats['avg_score'] }}</h5>
                                                        <small>متوسط الدرجة</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="border rounded p-2">
                                                        <h5 class="text-primary mb-0">{{ $stats['attendance_rate'] }}%</h5>
                                                        <small>نسبة الحضور</small>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- تنبيهات --}}
                                            @if($stats['missed_exams'] > 0 || $stats['absent_days'] > 0 || $stats['unpaid_invoices'] > 0)
                                                <div class="alert alert-warning py-2 mb-3">
                                                    <strong><i class="fas fa-exclamation-triangle"></i> تنبيهات:</strong>
                                                    <ul class="mb-0 mt-1 small">
                                                        @if($stats['missed_exams'] > 0)
                                                            <li>اختبارات فاتته: <strong>{{ $stats['missed_exams'] }}</strong></li>
                                                        @endif
                                                        @if($stats['absent_days'] > 0)
                                                            <li>أيام الغياب: <strong>{{ $stats['absent_days'] }}</strong></li>
                                                        @endif
                                                        @if($stats['unpaid_invoices'] > 0)
                                                            <li>فواتير غير مدفوعة: <strong>{{ $stats['unpaid_invoices'] }}</strong></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @else
                                                <div class="alert alert-success py-2 mb-3">
                                                    <i class="fas fa-check-circle"></i> كل شيء على ما يرام!
                                                </div>
                                            @endif

                                            {{-- روابط سريعة --}}
                                            <div class="btn-group-vertical w-100" role="group">
                                                <a href="{{ route('sons.results', $son->id) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-chart-bar"></i> عرض التقديرات والدرجات
                                                </a>
                                                <a href="{{ route('sons.attendances') }}" class="btn btn-outline-info btn-sm">
                                                    <i class="fas fa-calendar-check"></i> تقرير الحضور والغياب
                                                </a>
                                                <a href="{{ route('sons.fees') }}" class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-money-bill"></i> الرسوم والمدفوعات
                                                </a>
                                                <a href="{{ route('parent.messages.index') }}" class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-comment"></i> مراسلة المعلمين
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.footer-scripts')
    @livewireScripts
</body>
</html>
