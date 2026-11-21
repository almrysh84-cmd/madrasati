@extends('layouts.master')

@section('css')
    @toastr_css
    <link href="{{ URL::asset('assets/css/student-ui.css') }}" rel="stylesheet">
    @section('title')
        المواد الدراسية
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        المواد الدراسية
    @stop
@endsection

@section('content')
<div class="student-scope">
    <div class="stu-card">
        <h4 class="stu-section-title"><i class="fas fa-book-open"></i> المواد الدراسية</h4>

        {{-- ===== أزرار الترم ===== --}}
        <div class="stu-term-row">
            <a href="{{ url('/en/student_subjects?term=1') }}"
               class="stu-term-pill {{ $term == 1 ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> الفصل الدراسي الأول
            </a>
            <a href="{{ url('/en/student_subjects?term=2') }}"
               class="stu-term-pill {{ $term == 2 ? 'active success' : '' }}">
                <i class="fas fa-calendar-check"></i> الفصل الدراسي الثاني
            </a>
        </div>

        <h5 class="stu-section-title" style="font-size:.98rem;">
            @if($term == 1)
                <i class="fas fa-calendar-alt"></i> مواد الفصل الأول ({{ $subjects->count() }})
            @else
                <i class="fas fa-calendar-check" style="color:var(--stu-success);"></i> مواد الفصل الثاني ({{ $subjects->count() }})
            @endif
        </h5>

        @if($subjects->isEmpty())
            <div class="stu-empty">
                <i class="fas fa-folder-open"></i>
                <h5>لا توجد مواد مسجّلة لهذا الفصل</h5>
                <p>تواصل مع إدارة المدرسة لتسجيل موادك</p>
            </div>
        @else
            <div class="stu-subject-grid">
                @foreach($subjects as $subject)
                    <a href="{{ url('/en/student_subjects/' . $subject->id) }}" class="stu-subject-card {{ $term == 2 ? 'success' : '' }}">
                        <div class="stu-subj-head {{ $term == 2 ? 'success' : 'primary' }}">
                            <div class="stu-subj-icon"><i class="fas fa-book"></i></div>
                            <h5>{{ $subject->getTranslation('name', 'ar') }}</h5>
                        </div>
                        <div class="stu-subj-body">
                            @if($subject->teacher)
                                <div class="stu-subj-teacher">
                                    <i class="fas fa-chalkboard-teacher" style="color:var(--stu-info);"></i>
                                    {{ $subject->teacher->getTranslation('name', 'ar') }}
                                </div>
                            @else
                                <div class="stu-subj-teacher">
                                    <i class="fas fa-user-slash" style="color:var(--stu-warning);"></i>
                                    لا يوجد معلم مرتبط
                                </div>
                            @endif
                            <div class="stu-subj-stats">
                                <div class="stu-subj-stat">
                                    <div class="num info">{{ $subject->homeworks_count }}</div>
                                    <span class="lbl">واجب</span>
                                </div>
                                <div class="stu-subj-stat">
                                    <div class="num warning">{{ $subject->quizzes_count }}</div>
                                    <span class="lbl">اختبار</span>
                                </div>
                                <div class="stu-subj-stat">
                                    <div class="num success">{{ $subject->total_score }}</div>
                                    <span class="lbl">درجتي</span>
                                </div>
                            </div>
                        </div>
                        <div class="stu-subj-foot">
                            <i class="fas fa-arrow-left"></i> عرض التفاصيل
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
