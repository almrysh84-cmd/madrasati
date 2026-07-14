@extends('layouts.master')

@section('css')
    @toastr_css
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
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h4 class="mb-4" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-book-open text-primary"></i>
                        المواد الدراسية
                    </h4>

                    {{-- ===== زرا الترم الأول والثاني ===== --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ url('/en/student_subjects?term=1') }}"
                               class="btn btn-lg btn-{{ $term == 1 ? 'primary' : 'outline-primary' }} w-100 py-3"
                               style="font-family: 'Cairo', sans-serif; font-size: 18px;">
                                <i class="fas fa-calendar-alt"></i>
                                الفصل الدراسي الأول
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('/en/student_subjects?term=2') }}"
                               class="btn btn-lg btn-{{ $term == 2 ? 'success' : 'outline-success' }} w-100 py-3"
                               style="font-family: 'Cairo', sans-serif; font-size: 18px;">
                                <i class="fas fa-calendar-check"></i>
                                الفصل الدراسي الثاني
                            </a>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3" style="font-family: 'Cairo', sans-serif">
                        @if($term == 1)
                            <i class="fas fa-calendar-alt text-primary"></i>
                            مواد الفصل الدراسي الأول ({{ $subjects->count() }})
                        @else
                            <i class="fas fa-calendar-check text-success"></i>
                            مواد الفصل الدراسي الثاني ({{ $subjects->count() }})
                        @endif
                    </h5>

                    @if($subjects->isEmpty())
                        <div class="alert alert-info text-center" style="font-family: 'Cairo', sans-serif">
                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                            <h5>لا توجد مواد مسجلة لهذا الفصل</h5>
                        </div>
                    @else
                        <div class="row">
                            @foreach($subjects as $subject)
                                <div class="col-md-6 col-xl-4 mb-4">
                                    <a href="{{ url('/en/student_subjects/' . $subject->id) }}" class="text-decoration-none">
                                        <div class="card shadow-sm h-100 border-{{ $term == 1 ? 'primary' : 'success' }}" style="cursor: pointer; transition: transform 0.2s;">
                                            <div class="card-header bg-{{ $term == 1 ? 'primary' : 'success' }} text-white">
                                                <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                                                    <i class="fas fa-book"></i>
                                                    {{ $subject->getTranslation('name', 'ar') }}
                                                </h5>
                                            </div>
                                            <div class="card-body" style="font-family: 'Cairo', sans-serif">
                                                @if($subject->teacher)
                                                    <p class="text-muted mb-2">
                                                        <i class="fas fa-chalkboard-teacher text-info"></i>
                                                        {{ $subject->teacher->getTranslation('name', 'ar') }}
                                                    </p>
                                                @else
                                                    <p class="text-muted mb-2">
                                                        <i class="fas fa-chalkboard-teacher text-warning"></i>
                                                        لا يوجد معلم مرتبط
                                                    </p>
                                                @endif

                                                <div class="row text-center">
                                                    <div class="col-4">
                                                        <div class="border rounded p-2 mb-1">
                                                            <h5 class="text-info mb-0">{{ $subject->homeworks_count }}</h5>
                                                            <small>واجب</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border rounded p-2 mb-1">
                                                            <h5 class="text-warning mb-0">{{ $subject->quizzes_count }}</h5>
                                                            <small>اختبار</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="border rounded p-2 mb-1">
                                                            <h5 class="text-success mb-0">{{ $subject->total_score }}</h5>
                                                            <small>درجتي</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-light text-center">
                                                <span class="text-{{ $term == 1 ? 'primary' : 'success' }}">
                                                    <i class="fas fa-arrow-left"></i>
                                                    عرض التفاصيل
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
