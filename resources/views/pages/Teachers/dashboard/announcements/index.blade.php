@extends('layouts.master')

@section('css')
    @toastr_css
    @section('title')
        إعلاناتي
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        لوحة الإعلانات
    @stop
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 style="font-family: 'Cairo', sans-serif">
                            <i class="fas fa-bullhorn text-primary"></i>
                            إعلاناتي
                        </h4>
                        <a href="{{ route('teacher.announcements.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> إضافة إعلان جديد
                        </a>
                    </div>

                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- ===== إعلاناتي أنا ===== -->
                    <h5 class="text-primary mb-3" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-edit"></i> إعلانات أنشأتها
                    </h5>

                    @if($myAnnouncements->isEmpty())
                        <div class="alert alert-info">لم تنشئ أي إعلان بعد.</div>
                    @else
                        <div class="table-responsive mb-5">
                            <table class="table table-hover table-bordered" style="text-align: center; font-family: 'Cairo', sans-serif">
                                <thead>
                                <tr class="alert-warning">
                                    <th>#</th>
                                    <th>العنوان</th>
                                    <th>الجمهور</th>
                                    <th>تاريخ النشر</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($myAnnouncements as $ann)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ann->title }}</td>
                                        <td>
                                            <span class="badge badge-{{ $ann->target_audience_color }}">
                                                {{ $ann->target_audience_text }}
                                            </span>
                                        </td>
                                        <td>{{ $ann->publish_at ? $ann->publish_at->format('Y-m-d H:i') : $ann->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <form action="{{ route('teacher.announcements.destroy', $ann->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذا الإعلان؟')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- ===== إعلانات الإدارة ===== -->
                    <h5 class="text-info mb-3" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-info-circle"></i> إعلانات من الإدارة
                    </h5>

                    @if($adminAnnouncements->isEmpty())
                        <div class="alert alert-secondary">لا توجد إعلانات من الإدارة حالياً.</div>
                    @else
                        <div class="row">
                            @foreach($adminAnnouncements as $ann)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-info">
                                        <div class="card-header bg-light">
                                            <strong>{{ $ann->title }}</strong>
                                            <span class="badge badge-{{ $ann->target_audience_color }} float-left">
                                                {{ $ann->target_audience_text }}
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">{!! nl2br(e($ann->body)) !!}</p>
                                            <small class="text-muted">
                                                <i class="far fa-clock"></i>
                                                {{ $ann->created_at->diffForHumans() }}
                                                @if($ann->creator)
                                                    | <i class="far fa-user"></i>
                                                    {{ $ann->creator->name ?? $ann->creator->email }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
