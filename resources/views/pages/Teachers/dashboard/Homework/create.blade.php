@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    إضافة واجب جديد
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    إضافة واجب جديد
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('homework.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">عنوان الواجب باللغة العربية</label>
                                        <input type="text" name="title_ar" class="form-control" required>
                                    </div>

                                    <div class="col">
                                        <label for="title">عنوان الواجب باللغة الإنجليزية</label>
                                        <input type="text" name="title_en" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="description_ar">وصف الواجب باللغة العربية</label>
                                        <textarea name="description_ar" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="col">
                                        <label for="description_en">وصف الواجب باللغة الإنجليزية</label>
                                        <textarea name="description_en" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="type">نوع الواجب : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="type" id="homework_type" required>
                                                <option selected disabled>حدد نوع الواجب...</option>
                                                <option value="file">رفع ملف</option>
                                                <option value="image">رفع صورة</option>
                                                <option value="question">أسئلة</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col" id="file_field" style="display: none;">
                                        <div class="form-group">
                                            <label for="file_name">الملف المرفق : <span class="text-danger">*</span></label>
                                            <input type="file" name="file_name" id="file_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="due_date">تاريخ التسليم : <span class="text-danger">*</span></label>
                                            <input type="date" name="due_date" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="score">الدرجة : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score" required>
                                                <option selected disabled>حدد الدرجة...</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
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

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Grade_id" id="Grade_id" required>
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id" id="Classroom_id" required>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id" id="section_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ البيانات</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            // إظهار/إخفاء حقل رفع الملف حسب نوع الواجب
            $('select[name="type"]').on('change', function () {
                var type = $(this).val();
                if (type === 'file' || type === 'image') {
                    $('#file_field').show();
                    $('#file_name').attr('required', 'required');
                } else {
                    $('#file_field').hide();
                    $('#file_name').removeAttr('required');
                }
            });

            // AJAX: تحميل الصفوف عند اختيار المرحلة
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Classroom_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="Classroom_id"]').empty();
                }
            });

            // AJAX: تحميل الأقسام عند اختيار الصف
            $('select[name="Classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="section_id"]').empty();
                }
            });
        });
    </script>
@endsection
