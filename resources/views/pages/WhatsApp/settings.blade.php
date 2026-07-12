@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('WhatsApp_trans.settings') }}
@endsection
@section('PageTitle')
    {{ trans('WhatsApp_trans.settings') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title" style="font-family: Cairo">
                        <i class="fas fa-cog"></i> {{ trans('WhatsApp_trans.settings') }}
                    </h5>
                    <a href="{{ route('whatsapp.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ trans('WhatsApp_trans.bulk_send') }}
                    </a>
                </div>

                <hr>

                {{-- ===== Service Status ===== --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">{{ trans('WhatsApp_trans.service_status') }}</h6>
                    @if($config['enabled'])
                        <span class="badge bg-success p-2 fs-6">
                            <i class="fas fa-check-circle"></i> {{ trans('WhatsApp_trans.service_enabled') }}
                        </span>
                    @else
                        <span class="badge bg-danger p-2 fs-6">
                            <i class="fas fa-times-circle"></i> {{ trans('WhatsApp_trans.service_disabled') }}
                        </span>
                    @endif
                </div>

                {{-- ===== Current Configuration (read-only, masked) ===== --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th style="width:40%">{{ trans('WhatsApp_trans.twilio_sid') }}</th>
                                <th>{{ trans('WhatsApp_trans.whatsapp_from') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td><code>{{ $config['sid'] ?: '—' }}</code></td>
                                <td><code>{{ $config['whatsapp_from'] ?: '—' }}</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- ===== Info Note ===== --}}
                <div class="alert alert-info mt-3" style="font-family: Cairo">
                    <i class="fas fa-info-circle"></i> {{ trans('WhatsApp_trans.settings_note') }}
                    <hr>
                    <code class="d-block mb-1">TWILIO_SID=your_twilio_sid</code>
                    <code class="d-block mb-1">TWILIO_TOKEN=your_twilio_token</code>
                    <code class="d-block mb-1">TWILIO_WHATSAPP_FROM=whatsapp:+14155238886</code>
                    <code class="d-block">TWILIO_WHATSAPP_ENABLED=true</code>
                </div>

                {{-- ===== Dummy Update Form (updates are via .env) ===== --}}
                <form method="POST" action="{{ route('whatsapp.updateSettings') }}">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fas fa-save"></i> {{ trans('WhatsApp_trans.update_settings') }}
                    </button>
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
