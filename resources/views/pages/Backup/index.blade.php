@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('PageTitle', trans('main_trans.Main_title') . ' - النسخ الاحتياطي')

@section('page-header')
<div class="page-header">
    <div class="page-title">
        <h3>النسخ الاحتياطي</h3>
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
                        <h4 class="mb-0"><i class="fas fa-database"></i> النسخ الاحتياطي</h4>
                        <div>
                            <form method="POST" action="{{ route('backup.create') }}" style="display:inline;" onsubmit="return confirm('هل تريد إنشاء نسخة احتياطية جديدة؟ قد يستغرق ذلك بضع ثوانٍ.');">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus-circle"></i> إنشاء نسخة احتياطية
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    {{-- معلومات --}}
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        يتم إنشاء النسخ الاحتياطية لقاعدة البيانات فقط. تُحفظ النسخ تلقائياً يومياً عند الساعة 2:00 صباحاً، ويتم تنظيف النسخ القديمة أسبوعياً يوم الأحد.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @if(count($backups) > 0)
                    {{-- الحجم الإجمالي --}}
                    <div class="mb-3">
                        <span class="badge badge-info badge-lg" style="font-size: 14px; padding: 8px 15px;">
                            <i class="fas fa-hdd"></i> الحجم الإجمالي: {{ $totalSizeFormatted }}
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الملف</th>
                                    <th>الحجم</th>
                                    <th>التاريخ</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($backups as $index => $backup)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <i class="fas fa-file-archive text-warning"></i>
                                        {{ $backup['name'] }}
                                    </td>
                                    <td><span class="badge badge-secondary">{{ $backup['size'] }}</span></td>
                                    <td>{{ $backup['date'] }}</td>
                                    <td>
                                        <a href="{{ route('backup.download', $backup['name']) }}" class="btn btn-success btn-sm" title="تنزيل">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <button class="btn btn-outline-danger btn-sm delete-backup" data-name="{{ $backup['name'] }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-database fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">لا توجد نسخ احتياطية بعد</h5>
                        <p class="text-muted">يمكنك إنشاء نسخة احتياطية جديدة بالضغط على زر "إنشاء نسخة احتياطية" أعلاه</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    @toastr_js
    @toastr_render

    <script>
    $(document).ready(function() {
        $('.delete-backup').on('click', function() {
            var btn = $(this);
            var name = btn.data('name');

            if (!confirm('هل أنت متأكد من حذف هذه النسخة الاحتياطية؟')) {
                return;
            }

            $.ajax({
                url: '{{ route("backup.delete", "__NAME__") }}'.replace('__NAME__', name),
                type: 'POST',
                data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
                success: function(response) {
                    if (response.success) {
                        btn.closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('حدث خطأ أثناء الحذف');
                }
            });
        });
    });
    </script>
@endsection
