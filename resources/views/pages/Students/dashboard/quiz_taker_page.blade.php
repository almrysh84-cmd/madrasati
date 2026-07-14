@extends('layouts.master')

@section('css')
    @toastr_css
    @livewireStyles
    @section('title')
        اختبار: {{ $quiz->getTranslation('name', 'ar') }}
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        أداء الاختبار
    @stop
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            @livewire('quiz-taker', ['quizId' => $quiz->id])
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
@endsection
