@extends('layouts.master')
@section('css')
    @toastr_css
    <link href="{{ URL::asset('assets/css/student-ui.css') }}" rel="stylesheet">
    @section('title')
        قائمة الاختبارات
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
        قائمة الاختبارات
    @stop
@endsection
@section('content')
<div class="student-scope">
    <div class="stu-card">
        <h4 class="stu-section-title"><i class="fas fa-book-open"></i> اختباراتي</h4>
        @if($quizzes->isEmpty())
            <div class="stu-empty">
                <i class="fas fa-file-alt"></i>
                <h5>لا توجد اختبارات متاحة</h5>
                <p>عند تخصيص معلمك اختباراً لصفك سيظهر هنا</p>
            </div>
        @else
        <div class="stu-table-wrap table-responsive">
            <table id="datatable" class="table table-hover" data-page-length="50" style="text-align:center;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المادة الدراسية</th>
                        <th>اسم الاختبار</th>
                        <th>نوع الاختبار</th>
                        <th>دخول / درجة الاختبار</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quizze)
                        @php $myDegree = $quizze->degree->where('student_id', auth()->user()->id)->first(); @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $quizze->subject ? $quizze->subject->name : "-" }}</td>
                            <td>{{ $quizze->name }}</td>
                            <td>
                                @if($quizze->exam_type == 'monthly')
                                    <span class="stu-badge primary"><i class="fas fa-calendar"></i> شهري</span>
                                @elseif($quizze->exam_type == 'compensatory')
                                    <span class="stu-badge warning"><i class="fas fa-redo"></i> تعويضي</span>
                                @elseif($quizze->exam_type == 'activities')
                                    <span class="stu-badge info"><i class="fas fa-running"></i> أنشطة</span>
                                @else
                                    <span class="stu-badge secondary">عام</span>
                                @endif
                            </td>
                            <td>
                                @if ($myDegree)
                                    @if($myDegree->abuse == '1')
                                        <span class="stu-badge danger"><i class="fas fa-ban"></i> ملغي (تلاعب)</span>
                                    @else
                                        <span class="stu-badge success">{{ $myDegree->score }}</span>
                                        <small class="text-muted">/ {{ $quizze->questions->sum('score') }}</small>
                                    @endif
                                @else
                                    <a href="{{ url('/en/take_quiz/' . $quizze->id) }}" class="stu-btn stu-btn-outline">
                                        <i class="fas fa-pen"></i> أداء الاختبار
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
