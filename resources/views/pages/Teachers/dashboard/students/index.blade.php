@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمة الحضور والغياب للطلاب
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الحضور والغياب للطلاب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif

    <h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('attendance') }}" autocomplete="off">

        @csrf
        <div class="form-row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subject_id">المادة الدراسية : <span class="text-danger">*</span></label>
                    <select class="custom-select mr-sm-2" name="subject_id" required>
                        <option selected disabled>حدد المادة الدراسية...</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                <th class="alert-success">{{ trans('Students_trans.section') }}</th>
                <th class="alert-success">الحضور والغياب</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender ? $student->gender->Name : '-' }}</td>
                    <td>{{ $student->grade ? $student->grade->Name : '-' }}</td>
                    <td>{{ $student->classroom ? $student->classroom->Name_Class : '-' }}</td>
                    <td>{{ $student->section ? $student->section->Name_Section : '-' }}</td>
                    <td>
                        @php
                            // استخدام البيانات المحمَّلة مسبقاً بدلاً من استعلام لكل طالب (N+1 fix)
                            $todayAtt = isset($todayAttendance[$student->id]) ? $todayAttendance[$student->id] : null;
                        @endphp
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendences[{{ $student->id }}]"
                                   {{ $todayAtt && $todayAtt->attendence_status == 1 ? 'checked' : '' }}
                                   class="leading-tight" type="radio"
                                   value="presence">
                            <span class="text-success">حضور</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendences[{{ $student->id }}]"
                                   {{ $todayAtt && $todayAtt->attendence_status == 0 ? 'checked' : '' }}
                                   class="leading-tight" type="radio"
                                   value="absent">
                            <span class="text-danger">غياب</span>
                        </label>

                        <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                        <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
