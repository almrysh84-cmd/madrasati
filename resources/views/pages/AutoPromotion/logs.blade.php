@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('AutoPromotion_trans.logs_title') }}
@endsection
@section('PageTitle')
    {{ trans('AutoPromotion_trans.logs_title') }}
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title" style="font-family: Cairo">
                        <i class="ti-book"></i> {{ trans('AutoPromotion_trans.logs_title') }}
                    </h5>
                    <a href="{{ route('auto_promotion.index') }}" class="btn btn-secondary btn-sm">
                        <i class="ti-arrow-left"></i> {{ trans('AutoPromotion_trans.back') }}
                    </a>
                </div>

                <hr>

                @if($logs->isEmpty())
                    <div class="alert alert-info text-center" style="font-family: Cairo">
                        <i class="ti-info-alt"></i> {{ trans('AutoPromotion_trans.no_logs') }}
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
                                    <th>{{ trans('AutoPromotion_trans.status') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.academic_year') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.reviewed_by') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.review_note') }}</th>
                                    <th>{{ trans('AutoPromotion_trans.created_at') }}</th>
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
                                        <td><span class="badge bg-info">{{ $log->overall_average }}</span></td>
                                        <td>
                                            @if($log->failed_subjects_count > 0)
                                                <span class="badge bg-warning">{{ $log->failed_subjects_count }}</span>
                                            @else
                                                <span class="badge bg-success">0</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $log->status_color }}">{{ $log->status_text }}</span>
                                        </td>
                                        <td>{{ $log->academic_year }} → {{ $log->academic_year_new }}</td>
                                        <td>{{ $log->reviewer ? $log->reviewer->name : '—' }}</td>
                                        <td>{{ $log->review_note ?? '—' }}</td>
                                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            @if($log->status === 'approved')
                                                <form method="post" action="{{ route('auto_promotion.reverse', $log->id) }}" style="display:inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('{{ trans('AutoPromotion_trans.confirm_reverse') }}')" title="{{ trans('AutoPromotion_trans.reverse') }}">
                                                        <i class="ti-arrow-back"></i>
                                                    </button>
                                                </form>
                                            @endif
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
<!-- row closed -->
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
