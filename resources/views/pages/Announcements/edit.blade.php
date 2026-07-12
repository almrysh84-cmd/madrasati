@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('Announcements_trans.edit') }}
@endsection
@section('PageTitle')
    {{ trans('Announcements_trans.edit') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <h5 class="card-title" style="font-family: Cairo">
                    <i class="ti-pencil"></i> {{ trans('Announcements_trans.edit') }}
                </h5>
                <hr>

                <form method="post" action="{{ route('announcements.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $announcement->id }}">

                    <div class="form-group mb-3">
                        <label>{{ trans('Announcements_trans.title_label') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $announcement->title) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>{{ trans('Announcements_trans.body_label') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="body" rows="6" required>{{ old('body', $announcement->body) }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>{{ trans('Announcements_trans.target_audience') }} <span class="text-danger">*</span></label>
                                <select class="form-select" name="target_audience" required>
                                    <option value="all" {{ $announcement->target_audience == 'all' ? 'selected' : '' }}>{{ trans('Announcements_trans.audience_all') }}</option>
                                    <option value="admin" {{ $announcement->target_audience == 'admin' ? 'selected' : '' }}>{{ trans('Announcements_trans.audience_admin') }}</option>
                                    <option value="teachers" {{ $announcement->target_audience == 'teachers' ? 'selected' : '' }}>{{ trans('Announcements_trans.audience_teachers') }}</option>
                                    <option value="students" {{ $announcement->target_audience == 'students' ? 'selected' : '' }}>{{ trans('Announcements_trans.audience_students') }}</option>
                                    <option value="parents" {{ $announcement->target_audience == 'parents' ? 'selected' : '' }}>{{ trans('Announcements_trans.audience_parents') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>{{ trans('Announcements_trans.publish_date') }}</label>
                                <input type="datetime-local" class="form-control" name="publish_at" value="{{ old('publish_at', $announcement->publish_at ? $announcement->publish_at->format('Y-m-d\TH:i') : '') }}">
                                <small class="text-muted">{{ trans('Announcements_trans.publish_date_hint') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>{{ trans('Announcements_trans.attachment') }}</label>
                        @if($announcement->attachment)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="ti-download"></i> {{ trans('Announcements_trans.current_attachment') }}
                                </a>
                            </div>
                        @endif
                        <input type="file" class="form-control" name="attachment">
                        <small class="text-muted">{{ trans('Announcements_trans.attachment_hint') }}</small>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-save"></i> {{ trans('Announcements_trans.save') }}
                        </button>
                        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
                            <i class="ti-arrow-left"></i> {{ trans('Announcements_trans.back') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
