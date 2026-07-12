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

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title" style="font-family: Cairo">
                        <i class="ti-announcement"></i> {{ trans('Announcements_trans.title') }}
                    </h5>
                    <a href="{{ route('announcements.create') }}" class="btn btn-primary btn-sm">
                        <i class="ti-plus"></i> {{ trans('Announcements_trans.add_new') }}
                    </a>
                </div>

                <hr>

                @if($announcements->isEmpty())
                    <div class="alert alert-info text-center" style="font-family: Cairo">
                        <i class="ti-info-alt"></i> {{ trans('Announcements_trans.no_announcements') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{ trans('Announcements_trans.title_label') }}</th>
                                    <th>{{ trans('Announcements_trans.target_audience') }}</th>
                                    <th>{{ trans('Announcements_trans.published') }}</th>
                                    <th>{{ trans('Announcements_trans.publish_date') }}</th>
                                    <th>{{ trans('Announcements_trans.attachment') }}</th>
                                    <th>{{ trans('Announcements_trans.created_by') }}</th>
                                    <th>{{ trans('Announcements_trans.created_at') }}</th>
                                    <th>{{ trans('Announcements_trans.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($announcements as $announcement)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $announcement->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ \Str::limit($announcement->body, 60) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $announcement->target_audience_color }}">
                                                {{ $announcement->target_audience_text }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($announcement->is_published)
                                                <span class="badge bg-success">{{ trans('Announcements_trans.yes') }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ trans('Announcements_trans.no') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $announcement->publish_at ? $announcement->publish_at->format('Y-m-d H:i') : '—' }}</td>
                                        <td>
                                            @if($announcement->attachment)
                                                <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank" class="btn btn-info btn-sm">
                                                    <i class="ti-download"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>{{ $announcement->creator ? $announcement->creator->name : '—' }}</td>
                                        <td>{{ $announcement->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('announcements.edit', $announcement->id) }}" class="btn btn-warning btn-sm" title="{{ trans('Announcements_trans.edit') }}">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <form method="post" action="{{ route('announcements.togglePublish', $announcement->id) }}" style="display:inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-{{ $announcement->is_published ? 'secondary' : 'success' }} btn-sm" title="{{ $announcement->is_published ? trans('Announcements_trans.unpublish') : trans('Announcements_trans.publish') }}">
                                                        <i class="ti-{{ $announcement->is_published ? 'eye' : 'arrow-up' }}"></i>
                                                    </button>
                                                </form>
                                                <form method="post" action="{{ route('announcements.destroy', $announcement->id) }}" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ trans('Announcements_trans.confirm_delete') }}')" title="{{ trans('Announcements_trans.delete') }}">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
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
