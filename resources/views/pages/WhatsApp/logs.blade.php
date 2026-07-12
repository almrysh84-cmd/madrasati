@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('WhatsApp_trans.logs') }}
@endsection
@section('PageTitle')
    {{ trans('WhatsApp_trans.logs') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title" style="font-family: Cairo">
                        <i class="fas fa-history"></i> {{ trans('WhatsApp_trans.logs') }}
                    </h5>
                    <a href="{{ route('whatsapp.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ trans('WhatsApp_trans.bulk_send') }}
                    </a>
                </div>

                <hr>

                @if(empty($logs))
                    <div class="alert alert-info text-center" style="font-family: Cairo">
                        <i class="fas fa-info-circle"></i> {{ trans('WhatsApp_trans.no_logs') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th style="width:5%">#</th>
                                    <th style="width:20%">{{ trans('WhatsApp_trans.date_time') }}</th>
                                    <th>{{ trans('WhatsApp_trans.log_content') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $index => $log)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <small class="text-muted">{{ $log }}</small>
                                        </td>
                                        <td>
                                            <code style="word-break: break-all; white-space: pre-wrap;">{{ $log }}</code>
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
