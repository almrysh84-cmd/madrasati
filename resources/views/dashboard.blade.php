<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ trans('main_trans.Main_title') }}
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
    @livewireStyles
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
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">لوحة تحكم الادمن</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">عدد الطلاب</p>
                                    <h4>{{ \App\Models\Student::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('Students.index') }}" target="_blank"><span class="text-danger">عرض
                                        البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">عدد المعلمين</p>
                                    <h4>{{ \App\Models\Teacher::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('Teachers.index') }}" target="_blank"><span class="text-danger">عرض
                                        البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">عدد اولياء الامور</p>
                                    <h4>{{ \App\Models\My_Parent::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('add_parent') }}" target="_blank"><span class="text-danger">عرض
                                        البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">عدد الفصول الدراسية</p>
                                    <h4>{{ \App\Models\Section::count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ route('Sections.index') }}" target="_blank"><span class="text-danger">عرض
                                        البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- widgets -->

            {{-- ===== Chart.js Statistical Charts (Phase 2) ===== --}}
            <div class="row">
                <!-- Students by Grade - Bar Chart -->
                <div class="col-xl-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 style="font-family: 'Cairo', sans-serif" class="card-title mb-3">
                                <i class="fas fa-chart-bar text-primary"></i> توزيع الطلاب حسب المراحل الدراسية
                            </h5>
                            <canvas id="studentsByGradeChart" height="120"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Students by Gender - Doughnut Chart -->
                <div class="col-xl-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 style="font-family: 'Cairo', sans-serif" class="card-title mb-3">
                                <i class="fas fa-chart-pie text-success"></i> توزيع الطلاب حسب النوع
                            </h5>
                            <canvas id="studentsByGenderChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Attendance last 7 days - Line Chart -->
                <div class="col-xl-8 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 style="font-family: 'Cairo', sans-serif" class="card-title mb-3">
                                <i class="fas fa-calendar-check text-info"></i> الحضور والغياب - آخر 7 أيام
                            </h5>
                            <canvas id="attendance7DaysChart" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Fees Overview - Doughnut Chart -->
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 style="font-family: 'Cairo', sans-serif" class="card-title mb-3">
                                <i class="fas fa-money-bill-wave text-warning"></i> الرسوم الدراسية
                            </h5>
                            <canvas id="feesOverviewChart" height="140"></canvas>
                            @php
                                $totalInvoiced = \App\Models\Fee_invoice::sum('amount');
                                $totalCollected = \App\Models\ReceiptStudent::sum('Debit');
                                $totalPending = max($totalInvoiced - $totalCollected, 0);
                            @endphp
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    المحصّل: <strong class="text-success">{{ number_format($totalCollected, 2) }}</strong> |
                                    المتبقي: <strong class="text-danger">{{ number_format($totalPending, 2) }}</strong>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== End Chart.js Section ===== --}}


            <div class="row">

                <div style="height: 400px;" class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">اخر العمليات
                                            علي النظام</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                    href="#students" role="tab" aria-controls="students"
                                                    aria-selected="true"> الطلاب</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="teachers-tab" data-toggle="tab"
                                                    href="#teachers" role="tab" aria-controls="teachers"
                                                    aria-selected="false">المعلمين
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="parents-tab" data-toggle="tab"
                                                    href="#parents" role="tab" aria-controls="parents"
                                                    aria-selected="false">اولياء الامور
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="fee_invoices-tab" data-toggle="tab"
                                                    href="#fee_invoices" role="tab" aria-controls="fee_invoices"
                                                    aria-selected="false">الفواتير
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">

                                    {{-- students Table --}}
                                    <div class="tab-pane fade active show" id="students" role="tabpanel"
                                        aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>اسم الطالب</th>
                                                        <th>البريد الالكتروني</th>
                                                        <th>النوع</th>
                                                        <th>المرحلة الدراسية</th>
                                                        <th>الصف الدراسي</th>
                                                        <th>القسم</th>
                                                        <th>تاريخ الاضافة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td>{{ $student->email }}</td>
                                                            <td>{{ $student->gender->Name }}</td>
                                                            <td>{{ $student->grade->Name }}</td>
                                                            <td>{{ $student->classroom->Name_Class }}</td>
                                                            <td>{{ $student->section->Name_Section }}</td>
                                                            <td class="text-success">{{ $student->created_at }}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- teachers Table --}}
                                    <div class="tab-pane fade" id="teachers" role="tabpanel"
                                        aria-labelledby="teachers-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>اسم المعلم</th>
                                                        <th>النوع</th>
                                                        <th>تاريخ التعين</th>
                                                        <th>التخصص</th>
                                                        <th>تاريخ الاضافة</th>
                                                    </tr>
                                                </thead>

                                                @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $teacher->name }}</td>
                                                            <td>{{ $teacher->genders->Name }}</td>
                                                            <td>{{ $teacher->Joining_Date }}</td>
                                                            <td>{{ $teacher->specializations->Name }}</td>
                                                            <td class="text-success">{{ $teacher->created_at }}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                        </tr>
                                                    </tbody>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>

                                    {{-- parents Table --}}
                                    <div class="tab-pane fade" id="parents" role="tabpanel"
                                        aria-labelledby="parents-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>اسم ولي الامر</th>
                                                        <th>البريد الالكتروني</th>
                                                        <th>رقم الهوية</th>
                                                        <th>رقم الهاتف</th>
                                                        <th>تاريخ الاضافة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\My_Parent::latest()->take(5)->get() as $parent)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $parent->Name_Father }}</td>
                                                            <td>{{ $parent->email }}</td>
                                                            <td>{{ $parent->National_ID_Father }}</td>
                                                            <td>{{ $parent->Phone_Father }}</td>
                                                            <td class="text-success">{{ $parent->created_at }}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- sections Table --}}
                                    <div class="tab-pane fade" id="fee_invoices" role="tabpanel"
                                        aria-labelledby="fee_invoices-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-info text-danger">
                                                        <th>#</th>
                                                        <th>تاريخ الفاتورة</th>
                                                        <th>اسم الطالب</th>
                                                        <th>المرحلة الدراسية</th>
                                                        <th>الصف الدراسي</th>
                                                        <th>القسم</th>
                                                        <th>نوع الرسوم</th>
                                                        <th>المبلغ</th>
                                                        <th>تاريخ الاضافة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse(\App\Models\Fee_invoice::latest()->take(10)->get() as $section)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $section->invoice_date }}</td>
                                                            <td>{{ $section->My_classs->Name_Class }}</td>
                                                            <td class="text-success">{{ $section->created_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="alert-danger" colspan="9">لاتوجد بيانات</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <livewire:calendar />

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

    {{-- ===== Chart.js CDN + Chart Initialization (Phase 2) ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
    (function() {
        // تعيين اتجاه RTL للخطوط العربية
        Chart.defaults.font.family = "'Cairo', 'Tajawal', sans-serif";
        Chart.defaults.font.size = 12;
        Chart.defaults.color = '#333';

        // ===== 1. توزيع الطلاب حسب المراحل (Bar Chart) =====
        @php
            $gradeData = \App\Models\Student::select('Grade_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->with('grade')->groupBy('Grade_id')->get();
        @endphp
        var gradeCtx = document.getElementById('studentsByGradeChart');
        if (gradeCtx) {
            new Chart(gradeCtx, {
                type: 'bar',
                data: {
                    labels: @json($gradeData->map(function($i){ return $i->grade ? $i->grade->getTranslation('Name','ar') : 'غير محدد'; })),
                    datasets: [{
                        label: 'عدد الطلاب',
                        data: @json($gradeData->pluck('total')),
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });
        }

        // ===== 2. توزيع الطلاب حسب النوع (Doughnut Chart) =====
        @php
            $genderData = \App\Models\Student::select('gender_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->with('gender')->groupBy('gender_id')->get();
        @endphp
        var genderCtx = document.getElementById('studentsByGenderChart');
        if (genderCtx) {
            new Chart(genderCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($genderData->map(function($i){ return $i->gender ? $i->gender->getTranslation('Name','ar') : 'غير محدد'; })),
                    datasets: [{
                        data: @json($genderData->pluck('total')),
                        backgroundColor: ['rgba(46, 204, 113, 0.8)', 'rgba(231, 76, 60, 0.8)', 'rgba(241, 196, 15, 0.8)'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }

        // ===== 3. الحضور والغياب آخر 7 أيام (Line Chart) =====
        @php
            $last7Days = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $last7Days[] = [
                    'date'    => $date,
                    'present' => \App\Models\Attendance::where('attendence_date', $date)->where('attendence_status', 1)->count(),
                    'absent'  => \App\Models\Attendance::where('attendence_date', $date)->where('attendence_status', 0)->count(),
                ];
            }
        @endphp
        var attCtx = document.getElementById('attendance7DaysChart');
        if (attCtx) {
            new Chart(attCtx, {
                type: 'line',
                data: {
                    labels: @json(collect($last7Days)->pluck('date')),
                    datasets: [
                        {
                            label: 'الحضور',
                            data: @json(collect($last7Days)->pluck('present')),
                            borderColor: 'rgba(46, 204, 113, 1)',
                            backgroundColor: 'rgba(46, 204, 113, 0.2)',
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: 'الغياب',
                            data: @json(collect($last7Days)->pluck('absent')),
                            borderColor: 'rgba(231, 76, 60, 1)',
                            backgroundColor: 'rgba(231, 76, 60, 0.2)',
                            fill: true,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });
        }

        // ===== 4. الرسوم الدراسية (Doughnut Chart) =====
        var feesCtx = document.getElementById('feesOverviewChart');
        if (feesCtx) {
            new Chart(feesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['المحصّل', 'المتبقي'],
                    datasets: [{
                        data: [{{ $totalCollected ?? 0 }}, {{ $totalPending ?? 0 }}],
                        backgroundColor: ['rgba(46, 204, 113, 0.8)', 'rgba(231, 76, 60, 0.8)'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }
    })();
    </script>
    {{-- ===== End Chart.js Section ===== --}}

</body>

</html>
