@extends('layouts.master')

@section('PageTitle', trans('main_trans.Main_title') . ' - الإشعارات')

@section('page-header')
<div class="page-header">
    <div class="page-title">
        <h3>الإشعارات</h3>
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
                        <h4 class="mb-0"><i class="fas fa-bell"></i> جميع الإشعارات</h4>
                        <div>
                            @if($unreadCount > 0)
                            <a href="#" id="markAllNotificationsRead" class="btn btn-success btn-sm">
                                <i class="fas fa-check-double"></i> تحديد الكل كمقروء
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="list-group">
                            @foreach($notifications as $notification)
                                @php $data = $notification->data; @endphp
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ is_null($notification->read_at) ? 'bg-light' : '' }}">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="{{ $data['icon'] ?? 'fas fa-bell' }} fa-lg text-{{ $data['color'] ?? 'info' }}"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $data['title'] ?? 'إشعار' }}</h6>
                                            <p class="mb-1 text-muted">{{ $data['message'] ?? '' }}</p>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if(is_null($notification->read_at))
                                            <span class="badge badge-danger mr-2">جديد</span>
                                            <button class="btn btn-outline-success btn-sm mark-single" data-id="{{ $notification->id }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                        <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm ml-2 delete-notif" data-id="{{ $notification->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">لا توجد إشعارات</h5>
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
    // تحديد إشعار واحد كمقروء
    $('.mark-single').on('click', function() {
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url: '{{ route("notifications.markAsRead", "__ID__") }}'.replace('__ID__', id),
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function() {
                btn.closest('.list-group-item').removeClass('bg-light');
                btn.siblings('.badge').remove();
                btn.remove();
            }
        });
    });

    // حذف إشعار
    $('.delete-notif').on('click', function() {
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url: '{{ route("notifications.destroy", "__ID__") }}'.replace('__ID__', id),
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
            success: function() {
                btn.closest('.list-group-item').fadeOut(400, function() {
                    $(this).remove();
                });
            }
        });
    });
});
</script>
@endpush
