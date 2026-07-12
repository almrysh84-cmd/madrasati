@extends('layouts.master')

@section('css')
    @toastr_css
    @section('title')
        واجباتي
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        واجباتي الدراسية
    @stop
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h4 class="mb-3" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-tasks text-primary"></i>
                        واجباتي ({{ $homeworks->count() }})
                    </h4>

                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($homeworks->isEmpty())
                        <div class="alert alert-info text-center" style="font-family: 'Cairo', sans-serif">
                            <i class="fas fa-info-circle"></i>
                            لا توجد واجبات حالياً في صفك.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-sm table-bordered"
                                   data-page-length="25" style="text-align: center; font-family: 'Cairo', sans-serif">
                                <thead>
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>عنوان الواجب</th>
                                    <th>المادة</th>
                                    <th>المعلم</th>
                                    <th>النوع</th>
                                    <th>تاريخ التسليم</th>
                                    <th>الدرجة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($homeworks as $hw)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $hw->getTranslation('title', 'ar') }}</td>
                                        <td>{{ $hw->subject ? $hw->subject->getTranslation('name', 'ar') : '-' }}</td>
                                        <td>{{ $hw->teacher ? $hw->teacher->getTranslation('name', 'ar') : '-' }}</td>
                                        <td>
                                            @php
                                                $typeMap = ['file' => 'ملف', 'image' => 'صورة', 'question' => 'أسئلة'];
                                            @endphp
                                            <span class="badge badge-info">{{ $typeMap[$hw->type] ?? $hw->type }}</span>
                                        </td>
                                        <td>
                                            @if($hw->due_date)
                                                <span style="color: {{ \Carbon\Carbon::parse($hw->due_date)->lt(now()) ? '#dc3545' : '#28a745' }}">
                                                    {{ $hw->due_date }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td><span class="badge badge-warning">{{ $hw->score }}</span></td>
                                        <td>
                                            <a href="{{ route('student.homework.show', $hw->id) }}"
                                               class="btn btn-primary btn-sm" title="عرض التفاصيل">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(in_array($hw->type, ['file','image']) && $hw->file_name)
                                                <a href="{{ route('student.homework.download', $hw->file_name) }}"
                                                   class="btn btn-success btn-sm" title="تنزيل الملف" target="_blank">
                                                    <i class="fas fa-download"></i>
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
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
