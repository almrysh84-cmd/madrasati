@extends('layouts.master')

@section('css')
    @toastr_css
    <link href="{{ URL::asset('assets/css/student-ui.css') }}" rel="stylesheet">
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
<div class="student-scope">
    <div class="stu-card">
        <h4 class="stu-section-title"><i class="fas fa-tasks"></i> واجباتي ({{ $homeworks->count() }})</h4>

        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($homeworks->isEmpty())
            <div class="stu-empty">
                <i class="fas fa-clipboard-list"></i>
                <h5>لا توجد واجبات حالياً</h5>
                <p>عند تخصيص معلمك واجباً لصفك سيظهر هنا</p>
            </div>
        @else
            <div class="stu-table-wrap table-responsive">
                <table id="datatable" class="table table-hover" data-page-length="25" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>#</th><th>عنوان الواجب</th><th>المادة</th><th>المعلم</th>
                            <th>النوع</th><th>تاريخ التسليم</th><th>الدرجة</th><th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($homeworks as $hw)
                        @php $typeMap = ['file' => 'ملف', 'image' => 'صورة', 'question' => 'أسئلة']; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hw->getTranslation('title', 'ar') }}</td>
                            <td>{{ $hw->subject ? $hw->subject->getTranslation('name', 'ar') : '-' }}</td>
                            <td>{{ $hw->teacher ? $hw->teacher->getTranslation('name', 'ar') : '-' }}</td>
                            <td><span class="stu-badge info">{{ $typeMap[$hw->type] ?? $hw->type }}</span></td>
                            <td>
                                @if($hw->due_date)
                                    @php $overdue = \Carbon\Carbon::parse($hw->due_date)->lt(now()); @endphp
                                    <span class="stu-badge {{ $overdue ? 'danger' : 'success' }}">
                                        <i class="fas fa-clock"></i> {{ $hw->due_date }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td><span class="stu-badge warning">{{ $hw->score }}</span></td>
                            <td>
                                <a href="{{ url('/en/my_homework/' . $hw->id) }}" class="stu-btn stu-btn-primary" style="padding:6px 12px;" title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(in_array($hw->type, ['file','image']) && $hw->file_name)
                                    <a href="{{ url('/en/student_homework_download/' . $hw->file_name) }}" class="stu-btn stu-btn-success" style="padding:6px 12px;" title="تنزيل الملف" target="_blank">
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
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
