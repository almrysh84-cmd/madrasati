@extends('layouts.master')

@section('PageTitle', trans('Excel_trans.title'))

@section('page-header')
<div class="page-header">
    <div class="page-title">
        <h3>{{ trans('Excel_trans.title') }}</h3>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('has_errors'))
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-statistics">
                <div class="card-header bg-warning">
                    <div class="card-heading">
                        <h4 class="mb-0 text-white"><i class="fas fa-exclamation-triangle"></i> {{ trans('Excel_trans.errors_found') }} ({{ session('error_count') }})</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p>{{ trans('Excel_trans.errors_description') }}</p>
                    <a href="{{ route('excel.downloadErrors', ['filename' => session('error_file')]) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-download"></i> {{ trans('Excel_trans.download_errors') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <!-- بطاقة الطلاب -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-statistics">
                <div class="card-header">
                    <div class="card-heading">
                        <h4 class="mb-0"><i class="fas fa-user-graduate text-primary"></i> {{ trans('Excel_trans.students') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('excel.importStudents') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>{{ trans('Excel_trans.select_file') }}</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-1">
                            <i class="fas fa-file-import"></i> {{ trans('Excel_trans.import') }}
                        </button>
                    </form>
                    <a href="{{ route('excel.exportStudents') }}" class="btn btn-info btn-sm w-100 text-white">
                        <i class="fas fa-file-export"></i> {{ trans('Excel_trans.export') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- بطاقة المعلمين -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-statistics">
                <div class="card-header">
                    <div class="card-heading">
                        <h4 class="mb-0"><i class="fas fa-chalkboard-teacher text-success"></i> {{ trans('Excel_trans.teachers') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('excel.importTeachers') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>{{ trans('Excel_trans.select_file') }}</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-1">
                            <i class="fas fa-file-import"></i> {{ trans('Excel_trans.import') }}
                        </button>
                    </form>
                    <a href="{{ route('excel.exportTeachers') }}" class="btn btn-info btn-sm w-100 text-white">
                        <i class="fas fa-file-export"></i> {{ trans('Excel_trans.export') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- بطاقة المراحل الدراسية -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-statistics">
                <div class="card-header">
                    <div class="card-heading">
                        <h4 class="mb-0"><i class="fas fa-school text-warning"></i> {{ trans('Excel_trans.grades') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('excel.importGrades') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>{{ trans('Excel_trans.select_file') }}</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-1">
                            <i class="fas fa-file-import"></i> {{ trans('Excel_trans.import') }}
                        </button>
                    </form>
                    <a href="{{ route('excel.exportGrades') }}" class="btn btn-info btn-sm w-100 text-white">
                        <i class="fas fa-file-export"></i> {{ trans('Excel_trans.export') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- بطاقة الحضور -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-statistics">
                <div class="card-header">
                    <div class="card-heading">
                        <h4 class="mb-0"><i class="fas fa-clipboard-check text-danger"></i> {{ trans('Excel_trans.attendance') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('excel.importAttendance') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>{{ trans('Excel_trans.select_file') }}</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-1">
                            <i class="fas fa-file-import"></i> {{ trans('Excel_trans.import') }}
                        </button>
                    </form>
                    <a href="{{ route('excel.exportAttendance') }}" class="btn btn-info btn-sm w-100 text-white">
                        <i class="fas fa-file-export"></i> {{ trans('Excel_trans.export') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- تعليمات التنسيق -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <div class="card-heading">
                        <h4 class="mb-0"><i class="fas fa-info-circle"></i> {{ trans('Excel_trans.format_instructions') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{ trans('Excel_trans.students_format') }}</h5>
                            <ul>
                                <li>name_ar, name_en, email, password, gender, nationality, blood_type, date_birth, grade, classroom, section, parent_email, academic_year</li>
                            </ul>
                            <h5>{{ trans('Excel_trans.teachers_format') }}</h5>
                            <ul>
                                <li>name_ar, name_en, email, password, gender, specialization, joining_date, address</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ trans('Excel_trans.grades_format') }}</h5>
                            <ul>
                                <li>name_ar, name_en, notes</li>
                            </ul>
                            <h5>{{ trans('Excel_trans.attendance_format') }}</h5>
                            <ul>
                                <li>student_email, attendance_date, status (حاضر/غائب)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
