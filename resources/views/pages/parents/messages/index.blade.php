@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        الرسائل — معلمو أبنائي
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
        الرسائل — معلمو أبنائي
    @stop
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-comments"></i> التواصل مع المعلمين
                    </h5>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    <p class="text-muted">يمكنك التواصل مع معلمي أبنائك مباشرة. اختر معلماً لبدء محادثة أو متابعتها.</p>

                    @if($teachers->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            لا يوجد معلمون مرتبطون بأبنائك حالياً. تواصل مع الإدارة.
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($teachers as $teacher)
                                <a href="{{ route('parent.messages.show', $teacher->id) }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-chalkboard-teacher text-primary ml-2"></i>
                                        <strong>{{ $teacher->getTranslation('name', 'ar') }}</strong>
                                        <small class="text-muted">— {{ $teacher->email }}</small>
                                    </div>
                                    @if(isset($unreadCounts[$teacher->id]) && $unreadCounts[$teacher->id] > 0)
                                        <span class="badge badge-danger badge-pill">
                                            {{ $unreadCounts[$teacher->id] }} رسالة جديدة
                                        </span>
                                    @else
                                        <i class="fas fa-arrow-left text-muted"></i>
                                    @endif
                                </a>
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
