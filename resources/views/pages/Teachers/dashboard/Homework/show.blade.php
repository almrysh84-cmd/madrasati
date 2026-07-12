@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تفاصيل الواجب {{$homework->title}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تفاصيل الواجب : <span class="text-danger">{{$homework->title}}</span>
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

                    <!-- تفاصيل الواجب -->
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="alert-success" style="width: 20%">عنوان الواجب</th>
                                    <td>{{$homework->title}}</td>
                                </tr>
                                <tr>
                                    <th class="alert-success">الوصف</th>
                                    <td>{{$homework->description}}</td>
                                </tr>
                                <tr>
                                    <th class="alert-success">النوع</th>
                                    <td>
                                        @if($homework->type == 'file')
                                            <span class="badge badge-primary">ملف</span>
                                        @elseif($homework->type == 'image')
                                            <span class="badge badge-info">صورة</span>
                                        @elseif($homework->type == 'question')
                                            <span class="badge badge-warning">أسئلة</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="alert-success">المادة</th>
                                    <td>{{$homework->subject->name}}</td>
                                </tr>
                                <tr>
                                    <th class="alert-success">المرحلة / الصف / القسم</th>
                                    <td>{{$homework->grade->Name}} / {{$homework->classroom->Name_Class}} / {{$homework->section->Name_Section}}</td>
                                </tr>
                                <tr>
                                    <th class="alert-success">تاريخ التسليم</th>
                                    <td>{{$homework->due_date}}</td>
                                </tr>
                                <tr>
                                    <th class="alert-success">الدرجة</th>
                                    <td>{{$homework->score}}</td>
                                </tr>
                                @if($homework->file_name)
                                <tr>
                                    <th class="alert-success">الملف المرفق</th>
                                    <td>
                                        <a href="{{route('homework.download',$homework->file_name)}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-download"></i> {{$homework->file_name}}
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                            <a href="{{route('homework.index')}}" class="btn btn-secondary btn-sm">رجوع للقائمة</a>
                        </div>
                    </div>

                    <!-- قائمة الأسئلة (للنوع question فقط) -->
                    @if($homework->type == 'question')
                    <hr>
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <h4>قائمة الأسئلة</h4><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">السؤال</th>
                                        <th class="alert-success">الإجابات</th>
                                        <th class="alert-success">الإجابة الصحيحة</th>
                                        <th class="alert-success">الدرجة</th>
                                        <th class="alert-success">العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($questions as $question)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{$question->title}}</td>
                                            <td>{{$question->answers}}</td>
                                            <td>{{$question->right_answer}}</td>
                                            <td>{{$question->score}}</td>
                                            <td>
                                                <a href="{{route('homework.question.destroy',$question->id)}}" class="btn btn-danger btn-sm" title="حذف السؤال" onclick="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="alert-danger">لا توجد أسئلة حاليا</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- نموذج إضافة سؤال جديد -->
                            <hr>
                            <h4>إضافة سؤال جديد</h4><br>
                            <form action="{{route('homework.question.store')}}" method="post" autocomplete="off">
                                @csrf
                                <input type="hidden" name="homework_id" value="{{$homework->id}}">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">السؤال</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="answers">الإجابات <span style="color: red; font-size: smaller">يجب فصل بعلامة - بين الإجابات</span></label>
                                        <textarea name="answers" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="right_answer">الإجابة الصحيحة</label>
                                        <input type="text" name="right_answer" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="score">الدرجة</label>
                                        <select class="custom-select mr-sm-2" name="score">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ السؤال</button>
                            </form>
                        </div>
                    </div>
                    @endif

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
