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
    <link href="{{ URL::asset('assets/css/student-ui.css') }}" rel="stylesheet">
</head>

<body class="student-page" style="font-family: 'Cairo', sans-serif">

    <div class="wrapper student-scope" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

 <div id="pre-loader">
     <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
 </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            @php
                $stu = auth()->user();
                $gradeId = $stu->Grade_id;
                $classroomId = $stu->Classroom_id;
                $sectionId = $stu->section_id;
                $pendingHomework = \App\Models\Homework::where('grade_id', $gradeId)
                    ->where('classroom_id', $classroomId)->where('section_id', $sectionId)->count();
                $availableExams = \App\Models\Quizze::whereHas('subject', fn($q) =>
                        $q->where('grade_id', $gradeId)->where('classroom_id', $classroomId))
                    ->whereDoesntHave('degree', fn($q) => $q->where('student_id', $stu->id))->count();
                $avgDegree = \App\Models\Degree::where('student_id', $stu->id)->avg('score');
                $takenExams = \App\Models\Degree::where('student_id', $stu->id)->count();
            @endphp

            {{-- ===== Hero welcome ===== --}}
            <div class="stu-hero">
                <h3>مرحباً بك، {{ $stu->name }} 👋</h3>
                <p>إليك ملخّص نشاطك الدراسي اليوم — استمر في التميّز!</p>
                <i class="fas fa-graduation-cap stu-hero-icon"></i>
            </div>

            {{-- ===== Stat cards ===== --}}
            <div class="stu-stats">
                <div class="stu-stat-card">
                    <div class="stu-stat-icon stu-ic-primary"><i class="fas fa-book"></i></div>
                    <div><div class="stu-stat-value">{{ $availableExams }}</div><div class="stu-stat-label">اختبارات متاحة</div></div>
                </div>
                <div class="stu-stat-card">
                    <div class="stu-stat-icon stu-ic-warning"><i class="fas fa-tasks"></i></div>
                    <div><div class="stu-stat-value">{{ $pendingHomework }}</div><div class="stu-stat-label">واجبات</div></div>
                </div>
                <div class="stu-stat-card">
                    <div class="stu-stat-icon stu-ic-success"><i class="fas fa-star"></i></div>
                    <div><div class="stu-stat-value">{{ is_numeric($avgDegree) ? number_format($avgDegree, 1) : '0' }}</div><div class="stu-stat-label">معدّل درجاتي</div></div>
                </div>
                <div class="stu-stat-card">
                    <div class="stu-stat-icon stu-ic-info"><i class="fas fa-pen-alt"></i></div>
                    <div><div class="stu-stat-value">{{ $takenExams }}</div><div class="stu-stat-label">اختبارات أديتها</div></div>
                </div>
            </div>

            <div class="calendar-main mb-30">
                <livewire:calender-student />
            </div>

            {{-- ===== Chart.js ===== --}}
            <div class="stu-card">
                <h5 class="stu-section-title"><i class="fas fa-chart-bar"></i> نتائج اختباراتي</h5>
                <canvas id="studentResultsChart" height="80"></canvas>
            </div>

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>
    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

    {{-- ===== Chart.js (Phase 2) ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
    (function() {
        Chart.defaults.font.family = "'Cairo', 'Tajawal', sans-serif";
        Chart.defaults.font.size = 12;
        @php
            $sDegrees = \App\Models\Degree::where('student_id', auth()->user()->id)
                ->with('quizze')->orderBy('id', 'desc')->take(10)->get();
        @endphp
        var sCtx = document.getElementById('studentResultsChart');
        if (sCtx) {
            new Chart(sCtx, {
                type: 'bar',
                data: {
                    labels: @json($sDegrees->map(function($d){ return $d->quizze ? $d->quizze->getTranslation('name','ar') : 'اختبار'; })),
                    datasets: [{
                        label: 'الدرجة',
                        data: @json($sDegrees->pluck('score')),
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
            });
        }
    })();
    </script>
    {{-- ===== End Chart.js ===== --}}
</body>

</html>
