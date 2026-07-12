@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('Announcements_trans.title') }}
@endsection
@section('PageTitle')
    {{ trans('Announcements_trans.title') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title" style="font-family: Cairo">
                    <i class="ti-announcement"></i> {{ trans('Announcements_trans.title') }}
                </h5>
                <hr>
                @include('pages.Announcements.partials._announcements_list', ['announcements' => $announcements])
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
