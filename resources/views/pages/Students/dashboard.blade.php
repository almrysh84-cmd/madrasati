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
            <div class="page-title" >
                <div class="row">
                    <div class="col-sm-6" >
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">مرحبا بك : {{auth()->user()->name}}</h4>
                    </div><br><br>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <div class="calendar-main mb-30">
                <livewire:calender-student />
            </div>

            {{-- ===== Chart.js (Phase 2) ===== --}}
            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 style="font-family: 'Cairo', sans-serif" class="card-title mb-3">
                                <i class="fas fa-chart-bar text-primary"></i> نتائج اختباراتي
                            </h5>
                            <canvas id="studentResultsChart" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ===== End Chart.js ===== --}}
            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

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
