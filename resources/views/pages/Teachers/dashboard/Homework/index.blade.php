@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمة الواجبات
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الواجبات
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('homework.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">إضافة واجب جديد</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان الواجب</th>
                                            <th>النوع</th>
                                            <th>المادة</th>
                                            <th>المرحلة</th>
                                            <th>الصف</th>
                                            <th>القسم</th>
                                            <th>تاريخ التسليم</th>
                                            <th>الدرجة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($homeworks as $homework)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$homework->title}}</td>
                                                <td>
                                                    @if($homework->type == 'file')
                                                        <span class="badge badge-primary">ملف</span>
                                                    @elseif($homework->type == 'image')
                                                        <span class="badge badge-info">صورة</span>
                                                    @elseif($homework->type == 'question')
                                                        <span class="badge badge-warning">أسئلة</span>
                                                    @endif
                                                </td>
                                                <td>{{$homework->subject ? $homework->subject->name : "-"}}</td>
                                                <td>{{$homework->grade ? $homework->grade->Name : "-"}}</td>
                                                <td>{{$homework->classroom ? $homework->classroom->Name_Class : "-"}}</td>
                                                <td>{{$homework->section ? $homework->section->Name_Section : "-"}}</td>
                                                <td>{{$homework->due_date}}</td>
                                                <td>{{$homework->score}}</td>
                                                <td>
                                                    <a href="{{route('homework.show',$homework->id)}}"
                                                       class="btn btn-warning btn-sm" title="عرض التفاصيل" role="button" aria-pressed="true"><i
                                                            class="fa fa-binoculars"></i></a>
                                                    <a href="{{route('homework.edit',$homework->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    @if($homework->file_name)
                                                        <a href="{{route('homework.download',$homework->file_name)}}"
                                                           class="btn btn-success btn-sm" title="تنزيل الملف" role="button" aria-pressed="true"><i
                                                                class="fa fa-download"></i></a>
                                                    @endif
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_hw{{ $homework->id }}" title="حذف"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_hw{{$homework->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('homework.destroy',$homework->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">حذف واجب</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ trans('My_Classes_trans.Warning_Grade') }} {{$homework->title}}</p>
                                                                <input type="hidden" name="id" value="{{$homework->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="alert-danger">لا توجد واجبات حاليا</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
@endsection
