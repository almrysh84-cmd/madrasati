@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تقرير تقديرات الطلاب
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تقرير تقديرات الطلاب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('grades.search') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">معلومات البحث</h6><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subject_id">المادة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="subject_id">
                                    <option value="0">الكل</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section_id">القسم</label>
                                <select class="custom-select mr-sm-2" name="section_id">
                                    <option value="0">الكل</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->Name_Section }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="term">الفصل الدراسي</label>
                                <select class="custom-select mr-sm-2" name="term">
                                    <option value="">الكل</option>
                                    <option value="first">الفصل الأول</option>
                                    <option value="second">الفصل الثاني</option>
                                    <option value="third">الفصل الثالث</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">بحث</button>
                </form>

                @isset($grades)
                <hr>
                <h6 style="font-family: 'Cairo', sans-serif;color: green">نتائج البحث</h6><br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="10" style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">اسم الطالب</th>
                            <th class="alert-success">المادة</th>
                            <th class="alert-success">المرحلة</th>
                            <th class="alert-success">القسم</th>
                            <th class="alert-success">الدرجة</th>
                            <th class="alert-success">التقدير</th>
                            <th class="alert-success">الفصل</th>
                            <th class="alert-success">التاريخ</th>
                            <th class="alert-success">ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($grades as $grade)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{$grade->student->name ?? '—'}}</td>
                                <td>{{$grade->subject->name ?? '—'}}</td>
                                <td>{{$grade->grade->Name ?? '—'}}</td>
                                <td>{{$grade->section->Name_Section ?? '—'}}</td>
                                <td>
                                    @if($grade->score !== null)
                                        <span class="badge badge-primary">{{$grade->score}}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    @if($grade->grade_text)
                                        <span class="badge badge-info">{{$grade->grade_text}}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    @if($grade->term == 'first') الفصل الأول
                                    @elseif($grade->term == 'second') الفصل الثاني
                                    @elseif($grade->term == 'third') الفصل الثالث
                                    @endif
                                </td>
                                <td>{{$grade->date}}</td>
                                <td>{{$grade->note ?? '—'}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="alert-danger">لا توجد نتائج</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @endisset

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
