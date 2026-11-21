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

        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        @include('layouts.main-header')
        @include('layouts.main-sidebar')

        {{-- ===== Main content ===== --}}
        <div class="content-wrapper">
            @php
                $stu = auth()->user();
                $gradeId = $stu->Grade_id;
                $classroomId = $stu->Classroom_id;
                $sectionId = $stu->section_id;
                $today = \Carbon\Carbon::today();

                // ---- Stats (one query each, cached) ----
                $pendingHomework = \App\Models\Homework::where('grade_id', $gradeId)
                    ->where('classroom_id', $classroomId)->where('section_id', $sectionId)->count();
                $availableExams = \App\Models\Quizze::whereHas('subject', fn($q) =>
                        $q->where('grade_id', $gradeId)->where('classroom_id', $classroomId))
                    ->whereDoesntHave('degree', fn($q) => $q->where('student_id', $stu->id))->count();
                $avgDegree = \App\Models\Degree::where('student_id', $stu->id)->avg('score');
                $takenExams = \App\Models\Degree::where('student_id', $stu->id)->distinct('quizze_id')->count('quizze_id');

                // ---- Today's tasks: homework (with due_date) + available exams, merged + sorted by urgency ----
                $hwTasks = \App\Models\Homework::where('grade_id', $gradeId)
                    ->where('classroom_id', $classroomId)->where('section_id', $sectionId)
                    ->with('subject')->orderBy('due_date', 'asc')->limit(8)->get()
                    ->map(function($h) {
                        return (object)[
                            'kind' => 'hw',
                            'title' => $h->getTranslation('title','ar'),
                            'subject' => $h->subject ? $h->subject->getTranslation('name','ar') : '',
                            'due' => $h->due_date,
                            'url' => '/en/my_homework',
                            'icon' => 'fa-tasks',
                        ];
                    });
                $takenIds = \App\Models\Degree::where('student_id', $stu->id)->pluck('quizze_id')->unique();
                $examTasks = \App\Models\Quizze::whereHas('subject', fn($q) =>
                        $q->where('grade_id', $gradeId)->where('classroom_id', $classroomId))
                    ->whereNotIn('id', $takenIds)
                    ->with('subject')->orderBy('available_to', 'asc')->limit(8)->get()
                    ->map(function($q) use ($stu) {
                        return (object)[
                            'kind' => 'exam',
                            'title' => $q->getTranslation('name','ar'),
                            'subject' => $q->subject ? $q->subject->getTranslation('name','ar') : '',
                            'due' => $q->available_to,
                            'url' => '/en/student_exams',
                            'icon' => 'fa-pen-alt',
                            'duration' => $q->duration_minutes,
                        ];
                    });
                $tasks = $hwTasks->concat($examTasks)->sortBy(function($t){
                    return $t->due ? strtotime($t->due) : 9999999999;
                })->take(6);

                // ---- Subject progress (avg degree per subject) ----
                $subjectProgress = \App\Models\Degree::where('student_id', $stu->id)
                    ->whereNotNull('quizze_id')->with('quizze.subject')
                    ->get()->groupBy(fn($d) => $d->quizze && $d->quizze->subject ? $d->quizze->subject->id : 0)
                    ->map(function($grp){
                        $subj = $grp->first()->quizze->subject ?? null;
                        return (object)[
                            'name' => $subj ? $subj->getTranslation('name','ar') : 'مادة',
                            'avg' => round($grp->avg('score'), 1),
                        ];
                    })->sortByDesc('avg')->take(5)->values();

                // ---- Latest grades ----
                $latestGrades = \App\Models\Degree::where('student_id', $stu->id)
                    ->whereNotNull('quizze_id')->with('quizze')
                    ->orderByDesc('id')->limit(5)->get();

                // ---- Announcements for students ----
                $announcements = \App\Models\Announcement::where('is_published', 1)
                    ->where(function($q){
                        $q->where('target_audience','students')->orWhere('target_audience','all');
                    })
                    ->where('publish_at','<=', now())->orderByDesc('publish_at')->limit(4)->get();
            @endphp

            {{-- ===== Hero welcome ===== --}}
            <div class="stu-hero">
                <h3>مرحباً بك، {{ $stu->name }} 👋</h3>
                <p>إليك ملخّص نشاطك الدراسي اليوم — {{ now()->format('Y/m/d') }}</p>
                <i class="fas fa-graduation-cap stu-hero-icon"></i>
            </div>

            {{-- ===== Quick actions (one tap to main sections) ===== --}}
            <div class="stu-quickactions">
                <a href="{{ url('/en/student_subjects') }}" class="stu-qa stu-qa-primary">
                    <span class="stu-qa-ic"><i class="fas fa-book"></i></span>
                    <span class="stu-qa-label">موادي</span>
                    <span class="stu-qa-sub">استعرض المواد والدروس</span>
                </a>
                <a href="{{ url('/en/my_homework') }}" class="stu-qa stu-qa-warning">
                    <span class="stu-qa-ic"><i class="fas fa-tasks"></i></span>
                    <span class="stu-qa-label">واجباتي</span>
                    <span class="stu-qa-sub">{{ $pendingHomework }} واجب معلق</span>
                </a>
                <a href="{{ url('/en/student_exams') }}" class="stu-qa stu-qa-info">
                    <span class="stu-qa-ic"><i class="fas fa-pen-alt"></i></span>
                    <span class="stu-qa-label">اختباراتي</span>
                    <span class="stu-qa-sub">{{ $availableExams }} متاح الآن</span>
                </a>
                <a href="{{ url('/notifications') }}" class="stu-qa stu-qa-success">
                    <span class="stu-qa-ic"><i class="fas fa-bell"></i></span>
                    <span class="stu-qa-label">إشعاراتي</span>
                    <span class="stu-qa-sub">آخر التحديثات</span>
                </a>
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

            {{-- ===== Today's tasks (combined, sorted by urgency) ===== --}}
            <div class="stu-card">
                <h5 class="stu-section-title"><i class="fas fa-list-check"></i> مهام اليوم — ابدأ من هنا</h5>
                @if($tasks->isEmpty())
                    <div class="stu-empty">🎉 لا توجد مهام معلّقة حالياً — أحسنت! راجع جدولك الأسبوعي بالأسفل.</div>
                @else
                    <ul class="stu-tasks">
                        @foreach($tasks as $t)
                            @php
                                $dueClass = 'stu-due-ok'; $dueText = 'بدون موعد';
                                if ($t->due) {
                                    $days = \Carbon\Carbon::parse($t->due)->startOfDay()->diffInDays($today, false);
                                    if ($days < 0) { $dueText = 'متبقّي '.abs($days).' يوم'; $dueClass = $days >= -2 ? 'stu-due-urgent' : 'stu-due-soon'; }
                                    elseif ($days === 0) { $dueText = 'اليوم'; $dueClass = 'stu-due-urgent'; }
                                    else { $dueText = 'منتهي قبل '.$days.' يوم'; $dueClass = 'stu-due-urgent'; }
                                }
                            @endphp
                            <li class="stu-task stu-task-{{ $t->kind }}">
                                <span class="stu-task-ic"><i class="fas {{ $t->icon }}"></i></span>
                                <div class="stu-task-main">
                                    <div class="stu-task-title">{{ $t->title }}</div>
                                    <div class="stu-task-meta">
                                        {{ $t->subject ?: 'عام' }}
                                        @if($t->kind === 'exam' && !empty($t->duration)) · {{ $t->duration }} دقيقة @endif
                                    </div>
                                </div>
                                <span class="stu-due {{ $dueClass }}">{{ $dueText }}</span>
                                <a href="{{ url($t->url) }}" class="stu-task-go stu-btn-primary">
                                    {{ $t->kind === 'exam' ? 'ابدأ' : 'فتح' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- ===== Two-column: results + progress/announcements ===== --}}
            <div class="stu-two-col">
                <div class="stu-col-stack">
                    {{-- Results chart --}}
                    <div class="stu-card">
                        <h5 class="stu-section-title"><i class="fas fa-chart-bar"></i> نتائج اختباراتي الأخيرة</h5>
                        <canvas id="studentResultsChart" height="90"></canvas>
                    </div>
                    {{-- Latest grades list --}}
                    <div class="stu-card">
                        <h5 class="stu-section-title"><i class="fas fa-award"></i> آخر الدرجات</h5>
                        @if($latestGrades->isEmpty())
                            <div class="stu-empty">لم تخض أي اختبار بعد.</div>
                        @else
                            @foreach($latestGrades as $g)
                                @php
                                    $sc = $g->score;
                                    $pill = $sc >= 90 ? 'stu-grade-good' : ($sc >= 70 ? 'stu-grade-mid' : 'stu-grade-low');
                                @endphp
                                <div class="stu-grade-row">
                                    <div class="stu-grade-name">{{ $g->quizze ? $g->quizze->getTranslation('name','ar') : 'اختبار' }}</div>
                                    <span class="stu-grade-pill {{ $pill }}">{{ $sc >= 90 ? 'ممتاز' : ($sc >= 70 ? 'جيد' : 'يحتاج مراجعة') }}</span>
                                    <div class="stu-grade-score">{{ number_format($sc,1) }}</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="stu-col-stack">
                    {{-- Subject progress --}}
                    <div class="stu-card">
                        <h5 class="stu-section-title"><i class="fas fa-trophy"></i> تقدّمي في المواد</h5>
                        @if($subjectProgress->isEmpty())
                            <div class="stu-empty">ستظهر أشرطة التقدّم بعد أداء أول اختبار.</div>
                        @else
                            @foreach($subjectProgress as $sp)
                                <div class="stu-prog-item">
                                    <div class="stu-prog-head">
                                        <span class="stu-prog-name">{{ $sp->name }}</span>
                                        <span>{{ number_format($sp->avg,1) }}%</span>
                                    </div>
                                    <div class="stu-prog-bar"><div class="stu-prog-fill" style="width: {{ min(100, max(0, (int)$sp->avg)) }}%"></div></div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    {{-- Announcements --}}
                    <div class="stu-card">
                        <h5 class="stu-section-title"><i class="fas fa-bullhorn"></i> إعلانات المدرسة</h5>
                        @if($announcements->isEmpty())
                            <div class="stu-empty">لا توجد إعلانات حالياً.</div>
                        @else
                            @foreach($announcements as $an)
                                <div class="stu-announce">
                                    <div class="stu-an-title">{{ $an->title }}</div>
                                    <div class="stu-an-body">{{ \Illuminate\Support\Str::limit(strip_tags($an->body), 110) }}</div>
                                    <div class="stu-an-date">{{ $an->publish_at ? $an->publish_at->format('Y/m/d') : '' }}</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- ===== Calendar ===== --}}
            <div class="calendar-main mb-30">
                <livewire:calender-student />
            </div>

            @include('layouts.footer')
        </div>
    </div>
    </div>
    </div>

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

    {{-- ===== Chart.js ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
    (function() {
        Chart.defaults.font.family = "'Cairo', 'Tajawal', sans-serif";
        Chart.defaults.font.size = 12;
        @php
            $sDegrees = \App\Models\Degree::where('student_id', auth()->user()->id)
                ->with('quizze')->orderBy('id', 'desc')->take(8)->get();
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
</body>

</html>
