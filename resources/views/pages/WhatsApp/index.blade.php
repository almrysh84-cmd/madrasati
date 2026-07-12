@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('WhatsApp_trans.title') }}
@endsection
@section('PageTitle')
    {{ trans('WhatsApp_trans.title') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                {{-- ===== Service Status Banner ===== --}}
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h5 class="card-title" style="font-family: Cairo">
                        <i class="fab fa-whatsapp text-success"></i> {{ trans('WhatsApp_trans.bulk_send') }}
                    </h5>
                    <div>
                        @if($isEnabled)
                            <span class="badge bg-success p-2">
                                <i class="fas fa-check-circle"></i> {{ trans('WhatsApp_trans.service_enabled') }}
                            </span>
                        @else
                            <span class="badge bg-danger p-2">
                                <i class="fas fa-times-circle"></i> {{ trans('WhatsApp_trans.service_disabled') }}
                            </span>
                        @endif
                        <a href="{{ route('whatsapp.settings') }}" class="btn btn-outline-secondary btn-sm ms-2">
                            <i class="fas fa-cog"></i> {{ trans('WhatsApp_trans.settings') }}
                        </a>
                        <a href="{{ route('whatsapp.logs') }}" class="btn btn-outline-info btn-sm ms-1">
                            <i class="fas fa-history"></i> {{ trans('WhatsApp_trans.logs') }}
                        </a>
                    </div>
                </div>

                @if(!$isEnabled)
                    <div class="alert alert-warning" style="font-family: Cairo">
                        <i class="fas fa-exclamation-triangle"></i> {{ trans('WhatsApp_trans.enable_service_note') }}
                    </div>
                @endif

                <hr>

                {{-- ===== Bulk Send Form ===== --}}
                <form method="POST" action="{{ route('whatsapp.sendBulk') }}" id="whatsappBulkForm">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-users"></i> {{ trans('WhatsApp_trans.target_type') }}
                            </label>
                            <select name="target_type" id="target_type" class="form-control" required>
                                <option value="" disabled selected>{{ trans('WhatsApp_trans.target_type') }}...</option>
                                <option value="all_parents">{{ trans('WhatsApp_trans.all_parents') }}</option>
                                <option value="grade_parents">{{ trans('WhatsApp_trans.grade_parents') }}</option>
                                <option value="classroom_parents">{{ trans('WhatsApp_trans.classroom_parents') }}</option>
                                <option value="custom">{{ trans('WhatsApp_trans.custom_recipients') }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Grade + Classroom dropdowns (shown for grade_parents and classroom_parents) --}}
                    <div class="row mb-3" id="gradeClassroomBlock" style="display:none;">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-school"></i> {{ trans('WhatsApp_trans.select_grade') }}
                            </label>
                            <select name="grade_id" id="grade_id_select" class="form-control">
                                <option value="" disabled selected>{{ trans('WhatsApp_trans.select_grade') }}...</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4" id="classroomCol" style="display:none;">
                            <label class="form-label fw-bold">
                                <i class="fa fa-building"></i> {{ trans('WhatsApp_trans.select_classroom') }}
                            </label>
                            <select name="classroom_id" id="classroom_id_select" class="form-control">
                                <option value="" disabled selected>{{ trans('WhatsApp_trans.select_classroom') }}...</option>
                            </select>
                        </div>
                    </div>

                    {{-- Custom phones textarea (shown for custom) --}}
                    <div class="row mb-3" id="customPhonesBlock" style="display:none;">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-phone"></i> {{ trans('WhatsApp_trans.custom_phones') }}
                            </label>
                            <textarea name="custom_phones" id="custom_phones" class="form-control" rows="3"
                                placeholder="{{ trans('WhatsApp_trans.custom_phones_placeholder') }}"></textarea>
                        </div>
                    </div>

                    {{-- Message text --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-comment"></i> {{ trans('WhatsApp_trans.message_text') }}
                            </label>
                            <textarea name="message" class="form-control" rows="5" required
                                placeholder="{{ trans('WhatsApp_trans.message_placeholder') }}"></textarea>
                            <small class="text-muted">5 - 1000 {{ trans('WhatsApp_trans.message_text') }}</small>
                        </div>
                    </div>

                    {{-- Preview recipients + Send --}}
                    <div class="row">
                        <div class="col-md-12 d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-info btn-sm" id="previewRecipientsBtn">
                                <i class="fas fa-eye"></i> {{ trans('WhatsApp_trans.preview_recipients') }}
                            </button>
                            <button type="submit" class="btn btn-success btn-sm" @if(!$isEnabled) disabled @endif>
                                <i class="fab fa-whatsapp"></i> {{ trans('WhatsApp_trans.send') }}
                            </button>
                        </div>
                    </div>
                </form>

                {{-- ===== Preview Result Area ===== --}}
                <div id="previewResult" class="mt-3" style="display:none;">
                    <div class="alert alert-info">
                        <strong><i class="fas fa-users"></i> {{ trans('WhatsApp_trans.recipient_count') }}: </strong>
                        <span id="recipientCount">0</span>
                        <hr>
                        <small>{{ trans('WhatsApp_trans.preview_recipients') }} ({{ trans('WhatsApp_trans.custom_phones') }}):</small>
                        <ul id="previewPhones" class="mb-0"></ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @toastr_js
    @toastr_render

    {{-- Show/hide grade+classroom or custom phones based on target_type --}}
    <script>
    $(document).ready(function() {
        $('#target_type').on('change', function() {
            var val = $(this).val();
            if (val === 'grade_parents' || val === 'classroom_parents') {
                $('#gradeClassroomBlock').show();
                if (val === 'classroom_parents') {
                    $('#classroomCol').show();
                } else {
                    $('#classroomCol').hide();
                }
            } else {
                $('#gradeClassroomBlock').hide();
            }
            if (val === 'custom') {
                $('#customPhonesBlock').show();
            } else {
                $('#customPhonesBlock').hide();
            }
        });

        {{-- Cascading dropdown: Grade -> Classrooms --}}
        $('#grade_id_select').on('change', function() {
            var gradeId = $(this).val();
            if (gradeId) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + gradeId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#classroom_id_select').empty();
                        $('#classroom_id_select').append(
                            '<option value="" disabled selected>{{ trans('WhatsApp_trans.select_classroom') }}...</option>'
                        );
                        $.each(data, function(key, value) {
                            $('#classroom_id_select').append(
                                '<option value="' + key + '">' + value + '</option>'
                            );
                        });
                    },
                });
            }
        });

        {{-- Preview recipients via AJAX --}}
        $('#previewRecipientsBtn').on('click', function() {
            var data = {
                target_type: $('#target_type').val(),
                grade_id: $('#grade_id_select').val(),
                classroom_id: $('#classroom_id_select').val(),
                custom_phones: $('#custom_phones').val()
            };

            if (!data.target_type) {
                toastr.error("{{ trans('WhatsApp_trans.target_type') }}");
                return;
            }

            $.ajax({
                url: "{{ route('whatsapp.previewRecipients') }}",
                type: "GET",
                data: data,
                dataType: "json",
                success: function(res) {
                    $('#recipientCount').text(res.count);
                    $('#previewPhones').empty();
                    $.each(res.phones, function(i, phone) {
                        $('#previewPhones').append('<li>' + phone + '</li>');
                    });
                    $('#previewResult').show();
                    toastr.success("{{ trans('WhatsApp_trans.recipient_count') }}: " + res.count);
                },
                error: function() {
                    toastr.error("{{ trans('WhatsApp_trans.send_failed') }}");
                }
            });
        });
    });
    </script>
@endsection
