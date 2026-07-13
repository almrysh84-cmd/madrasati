@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        الرسائل — أولياء الأمور
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
        الرسائل — أولياء الأمور
    @stop
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-comments"></i> محادثات مع أولياء الأمور
                    </h5>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    @if($parents->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            لا توجد محادثات بعد. أولياء الأمور سيبدؤون المحادثة معك عند الحاجة.
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($parents as $parent)
                                <a href="{{ route('teacher.messages.show', $parent->id) }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-user-tie text-primary ml-2"></i>
                                        <strong>{{ $parent->getTranslation('Name_Father', 'ar') }}</strong>
                                        <small class="text-muted">— {{ $parent->email }}</small>
                                    </div>
                                    @if(isset($unreadCounts[$parent->id]) && $unreadCounts[$parent->id] > 0)
                                        <span class="badge badge-danger badge-pill">
                                            {{ $unreadCounts[$parent->id] }} رسالة جديدة
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
