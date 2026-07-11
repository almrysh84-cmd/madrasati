@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل الواجب {{$homework->title}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تعديل الواجب {{$homework->title}}
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
                            <form action="{{route('homework.update','test')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$homework->id}}">

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">عنوان الواجب باللغة العربية</label>
                                        <input type="text" name="title_ar" value="{{$homework->getTranslation('title','ar')}}" class="form-control" required>
                                    </div>

                                    <div class="col">
                                        <label for="title">عنوان الواجب باللغة الإنجليزية</label>
                                        <input type="text" name="title_en" value="{{$homework->getTranslation('title','en')}}" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="description_ar">وصف الواجب باللغة العربية</label>
                                        <textarea name="description_ar" class="form-control" rows="3">{{$homework->getTranslation('description','ar')}}</textarea>
                                    </div>

                                    <div class="col">
                                        <label for="description_en">وصف الواجب باللغة الإنجليزية</label>
                                        <textarea name="description_en" class="form-control" rows="3">{{$homework->getTranslation('description','en')}}</textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="type">نوع الواجب : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="type" id="homework_type" required>
                                                <option value="file" {{$homework->type == 'file' ? "selected" : ""}}>رفع ملف</option>
                                                <option value="image" {{$homework->type == 'image' ? "selected" : ""}}>رفع صورة</option>
                                                <option value="question" {{$homework->type == 'question' ? "selected" : ""}}>أسئلة</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col" id="file_field" style="@if($homework->type == 'file' || $homework->type == 'image') display: block; @else display: none; @endif">
                                        <div class="form-group">
                                            <label for="file_name">تغيير الملف المرفق : (اتركه فارغ للإبقاء على الحالي)</label>
                                            <input type="file" name="file_name" id="file_name" class="form-control">
                                            @if($homework->file_name)
                                                <small class="text-muted">الملف الحالي: {{$homework->file_name}}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="due_date">تاريخ التسليم : <span class="text-danger">*</span></label>
                                            <input type="date" name="due_date" value="{{$homework->due_date}}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="score">الدرجة : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score" required>
                                                @foreach([5,10,15,20,25,50,100] as $sc)
                                                    <option value="{{$sc}}" {{$homework->score == $sc ? "selected" : ""}}>{{$sc}}</option>
                                                @endforeach
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
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{$subject->id == $homework->subject_id ? "selected" : ""}}>{{ $subject->name }}</option>
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
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" {{$grade->id == $homework->grade_id ? "selected" : ""}}>{{ $grade->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id" id="Classroom_id" required>
                                                <option value="{{$homework->classroom_id}}">{{$homework->classroom->Name_Class}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id" id="section_id">
                                                <option value="{{$homework->section_id}}">{{$homework->section->Name_Section}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">تأكيد التعديل</button>
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
                } else {
                    $('#file_field').hide();
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
