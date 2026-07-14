@extends('layouts.master')

@section('css')
    @toastr_css
    @livewireStyles
    @section('title')
        محرر الاختبار: {{ $quiz->getTranslation('name', 'ar') }}
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        محرر الاختبار المتقدم
    @stop
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 mb-30">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>
                        <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-light ml-2">
                            <i class="fas fa-arrow-right"></i> رجوع
                        </a>
                        {{ $quiz->getTranslation('name', 'ar') }}
                    </span>
                    <span class="badge badge-light">
                        {{ $quiz->questions()->count() }} سؤال
                    </span>
                </div>
            </div>

            <livewire:quiz-builder :quizId="{{ $quiz->id }}" />
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
@endsection
