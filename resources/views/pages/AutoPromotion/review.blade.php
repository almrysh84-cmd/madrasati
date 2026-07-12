@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('AutoPromotion_trans.review_title') }}
@endsection
@section('PageTitle')
    {{ trans('AutoPromotion_trans.review_title') }}
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title" style="font-family: Cairo">
                        <i class="ti-list"></i> {{ trans('AutoPromotion_trans.review_title') }}
                        <span class="badge bg-warning text-dark">{{ $logs->count() }}</span>
                    </h5>
                    <div class="d-flex gap-2">
                        <form method="post" action="{{ route('auto_promotion.approveAll') }}" style="display:inline">
                            @csrf
                            @if($logs->count() > 0)
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('{{ trans('AutoPromotion_trans.confirm_approve_all') }}')">
                                    <i class="ti-check-box"></i> {{ trans('AutoPromotion_trans.approve_all') }}
                                </button>
                            @endif
                        </form>
                        <form method="post" action="{{ route('auto_promotion.executeApproved') }}" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('{{ trans('AutoPromotion_trans.confirm_execute') }}')">
                                <i class="ti-control-play"></i> {{ trans('AutoPromotion_trans.execute_approved') }}
                            </button>
                        </form>
                        <a href="{{ route('auto_promotion.index') }}" class="btn btn-secondary btn-sm">
                            <i class="ti-arrow-left"></i> {{ trans('AutoPromotion_trans.back') }}
                        </a>
                    </div>
                </div>

                <hr>

                @if($logs->isEmpty())
                    <div class="alert alert-info text-center" style="font-family: Cairo">
                        <i class="ti-info-alt"></i> {{ trans('AutoPromotion_trans.no_pending') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{ trans('AutoPromotion_trans.student_name') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.from_grade') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.to_grade') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.average') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.failed_count') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.academic_year') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $log->student ? $log->student->name : '—' }}</td>
                                        <td>{{ $log->fromGrade ? $log->fromGrade->getTranslation('Name', 'ar') : '—' }}</td>
                                        <td>{{ $log->toGrade ? $log->toGrade->getTranslation('Name', 'ar') : '—' }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $log->overall_average }}</span>
                                        </td>
                                        <td>
                                            @if($log->failed_subjects_count > 0)
                                                <span class="badge bg-danger">{{ $log->failed_subjects_count }}</span>
                                            @else
                                                <span class="badge bg-success">0</span>
                                            @endif
                                        </td>
                                        <td>{{ $log->academic_year }} → {{ $log->academic_year_new }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                {{-- Approve --}}
                                                <form method="post" action="{{ route('auto_promotion.approve', $log->id) }}" style="display:inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm" title="{{ trans('AutoPromotion_trans.approve') }}">
                                                        <i class="ti-check"></i>
                                                    </button>
                                                </form>

                                                {{-- Reject (with note) --}}
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $log->id }}" title="{{ trans('AutoPromotion_trans.reject') }}">
                                                    <i class="ti-close"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Reject Modal --}}
                                    <div class="modal fade" id="rejectModal{{ $log->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post" action="{{ route('auto_promotion.reject') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $log->id }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ trans('AutoPromotion_trans.reject_title') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ trans('AutoPromotion_trans.reject_confirm') }} <strong>{{ $log->student ? $log->student->name : '' }}</strong>؟</p>
                                                        <div class="form-group">
                                                            <label>{{ trans('AutoPromotion_trans.review_note') }}</label>
                                                            <textarea class="form-control" name="review_note" rows="3" placeholder="{{ trans('AutoPromotion_trans.review_note_placeholder') }}"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('AutoPromotion_trans.cancel') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{ trans('AutoPromotion_trans.confirm_reject') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
