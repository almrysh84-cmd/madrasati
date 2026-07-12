@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('AutoPromotion_trans.title') }}
@endsection
@section('PageTitle')
    {{ trans('AutoPromotion_trans.title') }}
@endsection
@section('content')
<!-- row -->
<div class="row">

    {{-- ===== Statistics Cards ===== --}}
    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="card-text">{{ trans('AutoPromotion_trans.pending_count') }}</p>
                        <h3 class="card-title text-warning">{{ $pendingCount }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="ti-time text-warning font-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="card-text">{{ trans('AutoPromotion_trans.approved_count') }}</p>
                        <h3 class="card-title text-success">{{ $approvedCount }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="ti-check-box text-success font-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="card-text">{{ trans('AutoPromotion_trans.rejected_count') }}</p>
                        <h3 class="card-title text-danger">{{ $rejectedCount }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="ti-close text-danger font-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ===== End Statistics ===== --}}

    {{-- ===== Current Criteria Card ===== --}}
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title" style="font-family: Cairo">{{ trans('AutoPromotion_trans.current_criteria') }}</h5>
                <hr>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="info-box">
                            <p class="text-muted">{{ trans('AutoPromotion_trans.min_average_label') }}</p>
                            <h4>{{ $criteria['min_average'] }} / 100</h4>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="info-box">
                            <p class="text-muted">{{ trans('AutoPromotion_trans.max_failed_label') }}</p>
                            <h4>{{ $criteria['max_failed_subjects'] }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="info-box">
                            <p class="text-muted">{{ trans('AutoPromotion_trans.auto_notify_label') }}</p>
                            <h4>{{ $criteria['auto_notify_parents'] ? trans('AutoPromotion_trans.yes') : trans('AutoPromotion_trans.no') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Trigger Form ===== --}}
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title" style="font-family: Cairo; color: red">{{ trans('AutoPromotion_trans.old_stage') }}</h5><br>

                <form method="post" action="{{ route('auto_promotion.trigger') }}" id="triggerForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label>{{ trans('Students_trans.Grade') }}</label>
                            <select class="form-select" name="grade_id" id="grade_id">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>{{ trans('Students_trans.classrooms') }} : <span class="text-danger">*</span></label>
                            <select class="form-select" name="classroom_id" id="classroom_id"></select>
                        </div>
                        <div class="form-group col">
                            <label>{{ trans('Students_trans.section') }} : </label>
                            <select class="form-select" name="section_id" id="section_id"></select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.academic_year') }} : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="academic_year" value="{{ date('Y') . '/' . (date('Y') + 1) }}" placeholder="2025/2026">
                            </div>
                        </div>
                    </div>
                    <br>
                    <h5 class="card-title" style="font-family: Cairo; color: red">{{ trans('AutoPromotion_trans.new_stage') }}</h5><br>

                    <div class="form-row">
                        <div class="form-group col">
                            <label>{{ trans('Students_trans.Grade') }} <span class="text-danger">*</span></label>
                            <select class="form-select" name="to_grade_id" id="to_grade_id" required>
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>{{ trans('Students_trans.classrooms') }}: <span class="text-danger">*</span></label>
                            <select class="form-select" name="to_classroom_id" id="to_classroom_id" required></select>
                        </div>
                        <div class="form-group col">
                            <label>{{ trans('Students_trans.section') }}: </label>
                            <select class="form-select" name="to_section_id" id="to_section_id" required></select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.academic_year') }} : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="academic_year_new" value="{{ (date('Y') + 1) . '/' . (date('Y') + 2) }}" placeholder="2026/2027">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="card-title" style="font-family: Cairo">{{ trans('AutoPromotion_trans.override_criteria') }}</h5>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('AutoPromotion_trans.min_average_label') }}</label>
                                <input type="number" class="form-control" name="min_average" min="0" max="100" step="0.01" placeholder="{{ $criteria['min_average'] }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('AutoPromotion_trans.max_failed_label') }}</label>
                                <input type="number" class="form-control" name="max_failed_subjects" min="0" max="20" placeholder="{{ $criteria['max_failed_subjects'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" id="triggerBtn">
                            <i class="ti-control-play"></i> {{ trans('AutoPromotion_trans.trigger_promotion') }}
                        </button>
                        <button type="button" class="btn btn-info" id="previewBtn">
                            <i class="ti-eye"></i> {{ trans('AutoPromotion_trans.preview_candidates') }}
                        </button>
                        <a href="{{ route('auto_promotion.review') }}" class="btn btn-warning">
                            <i class="ti-list"></i> {{ trans('AutoPromotion_trans.review_pending') }}
                        </a>
                        <a href="{{ route('auto_promotion.logs') }}" class="btn btn-secondary">
                            <i class="ti-book"></i> {{ trans('AutoPromotion_trans.view_logs') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- ===== Preview Results (AJAX) ===== --}}
    <div class="col-md-12 mb-30" id="previewSection" style="display: none;">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title" style="font-family: Cairo">{{ trans('AutoPromotion_trans.preview_results') }}</h5>
                <hr>
                <div id="previewContent"></div>
            </div>
        </div>
    </div>

</div>
<!-- row closed -->
@endsection

@section('js')
@toastr_js
@toastr_render

<script>
$(document).ready(function() {

    // ===== Cascading Dropdowns: Old Stage =====
    $('#grade_id').on('change', function() {
        var gradeId = $(this).val();
        if (gradeId) {
            $.ajax({
                url: "{{ URL::to('Get_classrooms') }}/" + gradeId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#classroom_id').empty();
                    $('#classroom_id').append('<option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>');
                    $.each(data, function(key, value) {
                        $('#classroom_id').append('<option value="' + value.id + '">' + value.Name + '</option>');
                    });
                }
            });
        }
    });

    $('#classroom_id').on('change', function() {
        var classroomId = $(this).val();
        if (classroomId) {
            $.ajax({
                url: "{{ URL::to('Get_Sections') }}/" + classroomId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#section_id').empty();
                    $('#section_id').append('<option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>');
                    $.each(data, function(key, value) {
                        $('#section_id').append('<option value="' + value.id + '">' + value.Name + '</option>');
                    });
                }
            });
        }
    });

    // ===== Cascading Dropdowns: New Stage =====
    $('#to_grade_id').on('change', function() {
        var gradeId = $(this).val();
        if (gradeId) {
            $.ajax({
                url: "{{ URL::to('Get_classrooms') }}/" + gradeId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#to_classroom_id').empty();
                    $('#to_classroom_id').append('<option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>');
                    $.each(data, function(key, value) {
                        $('#to_classroom_id').append('<option value="' + value.id + '">' + value.Name + '</option>');
                    });
                }
            });
        }
    });

    $('#to_classroom_id').on('change', function() {
        var classroomId = $(this).val();
        if (classroomId) {
            $.ajax({
                url: "{{ URL::to('Get_Sections') }}/" + classroomId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#to_section_id').empty();
                    $('#to_section_id').append('<option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>');
                    $.each(data, function(key, value) {
                        $('#to_section_id').append('<option value="' + value.id + '">' + value.Name + '</option>');
                    });
                }
            });
        }
    });

    // ===== Preview Candidates (AJAX) =====
    $('#previewBtn').on('click', function(e) {
        e.preventDefault();
        var formData = $('#triggerForm').serialize();

        $.ajax({
            url: "{{ route('auto_promotion.findCandidates') }}",
            type: "GET",
            data: formData,
            dataType: "json",
            beforeSend: function() {
                $('#previewBtn').html('<i class="ti-reload"></i> {{ trans("AutoPromotion_trans.loading") }}...');
            },
            success: function(data) {
                $('#previewBtn').html('<i class="ti-eye"></i> {{ trans("AutoPromotion_trans.preview_candidates") }}');
                $('#previewSection').show();

                var html = '';

                // Summary
                html += '<div class="row mb-3">';
                html += '<div class="col-md-3"><div class="alert alert-info"><strong>{{ trans("AutoPromotion_trans.total_students") }}: </strong>' + data.total_students + '</div></div>';
                html += '<div class="col-md-3"><div class="alert alert-success"><strong>{{ trans("AutoPromotion_trans.eligible_count") }}: </strong>' + data.eligible_count + '</div></div>';
                html += '<div class="col-md-3"><div class="alert alert-danger"><strong>{{ trans("AutoPromotion_trans.not_eligible") }}: </strong>' + (data.total_students - data.eligible_count) + '</div></div>';
                html += '<div class="col-md-3"><div class="alert alert-secondary"><strong>{{ trans("AutoPromotion_trans.min_average_label") }}: </strong>' + data.criteria.min_average + '</div></div>';
                html += '</div>';

                // Eligible Candidates Table
                if (data.candidates.length > 0) {
                    html += '<h6 class="text-success mb-2">{{ trans("AutoPromotion_trans.eligible_students") }}</h6>';
                    html += '<div class="table-responsive">';
                    html += '<table class="table table-bordered table-striped">';
                    html += '<thead class="thead-dark"><tr>';
                    html += '<th>#</th><th>{{ trans("AutoPromotion_trans.student_name") }}</th><th>{{ trans("AutoPromotion_trans.average") }}</th><th>{{ trans("AutoPromotion_trans.failed_count") }}</th><th>{{ trans("AutoPromotion_trans.status") }}</th>';
                    html += '</tr></thead><tbody>';
                    $.each(data.candidates, function(i, item) {
                        html += '<tr class="table-success">';
                        html += '<td>' + (i + 1) + '</td>';
                        html += '<td>' + (item.student.name || '') + '</td>';
                        html += '<td>' + item.average + '</td>';
                        html += '<td>' + item.failed_count + '</td>';
                        html += '<td><span class="badge bg-success">' + item.reason + '</span></td>';
                        html += '</tr>';
                    });
                    html += '</tbody></table></div><br>';
                }

                // Non-Candidates Table
                if (data.non_candidates.length > 0) {
                    html += '<h6 class="text-danger mb-2">{{ trans("AutoPromotion_trans.not_eligible_students") }}</h6>';
                    html += '<div class="table-responsive">';
                    html += '<table class="table table-bordered table-striped">';
                    html += '<thead class="thead-dark"><tr>';
                    html += '<th>#</th><th>{{ trans("AutoPromotion_trans.student_name") }}</th><th>{{ trans("AutoPromotion_trans.average") }}</th><th>{{ trans("AutoPromotion_trans.failed_count") }}</th><th>{{ trans("AutoPromotion_trans.reason") }}</th>';
                    html += '</tr></thead><tbody>';
                    $.each(data.non_candidates, function(i, item) {
                        html += '<tr class="table-danger">';
                        html += '<td>' + (i + 1) + '</td>';
                        html += '<td>' + (item.student.name || '') + '</td>';
                        html += '<td>' + item.average + '</td>';
                        html += '<td>' + item.failed_count + '</td>';
                        html += '<td><span class="badge bg-danger">' + item.reason + '</span></td>';
                        html += '</tr>';
                    });
                    html += '</tbody></table></div>';
                }

                if (data.total_students === 0) {
                    html += '<div class="alert alert-warning text-center">{{ trans("AutoPromotion_trans.no_students_found") }}</div>';
                }

                $('#previewContent').html(html);
            },
            error: function() {
                $('#previewBtn').html('<i class="ti-eye"></i> {{ trans("AutoPromotion_trans.preview_candidates") }}');
                toastr.error('{{ trans("AutoPromotion_trans.error_preview") }}');
            }
        });
    });

});
</script>
@endsection
