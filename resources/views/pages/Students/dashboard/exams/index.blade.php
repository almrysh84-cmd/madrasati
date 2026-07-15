@extends('layouts.master')
@section('css')
    @toastr_css
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
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body" style="font-family: 'Cairo', sans-serif">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0"
                           data-page-length="50" style="text-align: center">
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
                                @php
                                    $myDegree = $quizze->degree->where('student_id', auth()->user()->id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $quizze->subject ? $quizze->subject->name : "-" }}</td>
                                    <td>{{ $quizze->name }}</td>
                                    <td>
                                        @if($quizze->exam_type == 'monthly')
                                            <span class="badge badge-primary">شهري</span>
                                        @elseif($quizze->exam_type == 'compensatory')
                                            <span class="badge badge-warning">تعويضي</span>
                                        @elseif($quizze->exam_type == 'activities')
                                            <span class="badge badge-info">أنشطة</span>
                                        @else
                                            <span class="badge badge-secondary">عام</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($myDegree)
                                            @if($myDegree->abuse == '1')
                                                <span class="badge badge-danger">ملغي (تلاعب)</span>
                                            @else
                                                <span class="badge badge-success">{{ $myDegree->score }}</span>
                                                <small class="text-muted">/ {{ $quizze->questions->sum('score') }}</small>
                                            @endif
                                        @else
                                            <a href="{{ url('/en/take_quiz/' . $quizze->id) }}"
                                               class="btn btn-outline-success btn-sm" role="button">
                                                <i class="fas fa-pen"></i> أداء الاختبار
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
