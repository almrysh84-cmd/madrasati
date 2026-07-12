@extends('layouts.master')

@section('PageTitle', trans('main_trans.Main_title') . ' - سجل النشاطات')

@section('page-header')
<div class="page-header">
    <div class="page-title">
        <h3>سجل النشاطات</h3>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <div class="card-heading d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-history"></i> سجل النشاطات</h4>
                        <div>
                            <form method="POST" action="{{ route('activitylog.clearAll') }}" style="display:inline;" onsubmit="return confirm('هل أنت متأكد من حذف جميع السجلات؟');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> حذف الكل
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- فلتر --}}
                    <form method="GET" action="{{ route('activitylog.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="بحث في الوصف..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="event" class="form-control form-control-sm">
                                    <option value="">-- كل الأحداث --</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event }}" {{ request('event') == $event ? 'selected' : '' }}>{{ $event }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="log_name" class="form-control form-control-sm">
                                    <option value="">-- كل الأقسام --</option>
                                    @foreach($logNames as $logName)
                                        <option value="{{ $logName }}" {{ request('log_name') == $logName ? 'selected' : '' }}>{{ $logName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> تصفية</button>
                                <a href="{{ route('activitylog.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i></a>
                            </div>
                        </div>
                    </form>

                    @if($activities->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>الوصف</th>
                                    <th>الحدث</th>
                                    <th>المستخدم</th>
                                    <th>النموذج</th>
                                    <th>التاريخ</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>
                                        @if($activity->event == 'created')
                                            <span class="badge badge-success">إنشاء</span>
                                        @elseif($activity->event == 'updated')
                                            <span class="badge badge-warning">تعديل</span>
                                        @elseif($activity->event == 'deleted')
                                            <span class="badge badge-danger">حذف</span>
                                        @else
                                            <span class="badge badge-info">{{ $activity->event ?? '—' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($activity->causer)
                                            {{ $activity->causer->name ?? $activity->causer->Name_Father ?? $activity->causer->email }}
                                        @else
                                            <span class="text-muted">النظام</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($activity->subject_type)
                                            {{ class_basename($activity->subject_type) }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger btn-sm delete-activity" data-id="{{ $activity->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $activities->links() }}
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">لا توجد سجلات نشاط</h5>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
$(document).ready(function() {
    $('.delete-activity').on('click', function() {
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url: '{{ route("activitylog.destroy", "__ID__") }}'.replace('__ID__', id),
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
            success: function() {
                btn.closest('tr').fadeOut(400, function() {
                    $(this).remove();
                });
            }
        });
    });
});
</script>
@endpush
