<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>


<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>



@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif

<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="Classroom_id"]').empty();
                        $('select[name="Classroom_id"]').append(
                            '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                            );
                        $.each(data, function(key, value) {
                            $('select[name="Classroom_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('select[name="Classroom_id"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('select[name="Grade_id_new"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="Classroom_id_new"]').empty();
                        $('select[name="Classroom_id_new"]').append(
                            '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                            );
                        $.each(data, function(key, value) {
                            $('select[name="Classroom_id_new"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('select[name="Classroom_id_new"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id_new"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id_new"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

{{-- ===== Notification Mark-as-Read Handler (Phase 2) ===== --}}
<script>
    $(document).ready(function() {
        // تحديد إشعار كمقروء عند النقر عليه
        $(document).on('click', '.notification-item', function(e) {
            var notifId = $(this).data('id');
            if (notifId) {
                $.ajax({
                    url: '{{ route("notifications.markAsRead", "__ID__") }}'.replace('__ID__', notifId),
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        // تحديث عدد الإشعارات غير المقروءة
                        var badge = $('.notification-status');
                        var count = parseInt(badge.text()) || 0;
                        if (count > 0) {
                            count--;
                            if (count === 0) {
                                badge.remove();
                            } else {
                                badge.text(count);
                            }
                        }
                    }
                });
            }
        });

        // زر تحديد جميع الإشعارات كمقروءة
        $(document).on('click', '#markAllNotificationsRead', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("notifications.markAllAsRead") }}',
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function() {
                    $('.notification-status').remove();
                    location.reload();
                }
            });
        });
    });
</script>
{{-- ===== End Notification Handler ===== --}}

{{-- ===== Real-Time Notifications via Pusher (Feature 4) ===== --}}
@if(config('broadcasting.default') === 'pusher')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        @php
            // تحديد المستخدم المصادق عليه والحارس النشط
            $rtGuard = null;
            $rtUser = null;
            foreach (['web', 'student', 'teacher', 'parent'] as $guard) {
                if (auth($guard)->check()) {
                    $rtGuard = $guard;
                    $rtUser = auth($guard)->user();
                    break;
                }
            }
            $rtModelType = $rtUser ? class_basename(get_class($rtUser)) : null;
            $rtUserId = $rtUser ? $rtUser->id : null;
        @endphp

        @if($rtUser && $rtUserId)
        var pusherKey = '{{ config('broadcasting.connections.pusher.key') }}';
        var pusherCluster = '{{ config('broadcasting.connections.pusher.options.cluster', env('PUSHER_APP_CLUSTER', 'mt1')) }}';
        var pusherHost = '{{ config('broadcasting.connections.pusher.options.host', '') }}';

        // تهيئة Pusher
        var pusherOptions = {
            cluster: pusherCluster,
            encrypted: true
        };
        if (pusherHost) {
            pusherOptions.wsHost = pusherHost.replace('api-', '').replace('.pusher.com', '');
        }

        if (typeof Pusher !== 'undefined' && pusherKey) {
            var pusher = new Pusher(pusherKey, pusherOptions);

            // الاشتراك في القناة الخاصة بالمستخدم
            var channelName = 'private-App.Models.{{ $rtModelType }}.{{ $rtUserId }}';
            var channel = pusher.subscribe(channelName);

            // دالة تحديث عداد الإشعارات وزيادته بواحد
            function incrementNotificationBadge(data) {
                var badge = $('.notification-status');

                if (badge.length === 0) {
                    // إنشاء الشارة إذا لم تكن موجودة
                    $('.top-nav .ti-bell').after('<span class="badge badge-danger notification-status">1</span>');
                } else {
                    var currentCount = parseInt(badge.text()) || 0;
                    badge.text(currentCount + 1);
                }

                // إظهار إشعار toastr
                if (typeof toastr !== 'undefined') {
                    var messageType = (data.color === 'danger') ? 'error' :
                                      (data.color === 'success') ? 'success' :
                                      (data.color === 'warning') ? 'warning' : 'info';
                    toastr[messageType](data.message || 'إشعار جديد', data.title || '', {
                        timeOut: 5000,
                        extendedTimeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-top-left',
                        rtl: true
                    });
                }

                // تشغيل صوت إشعار
                try {
                    var audio = new Audio('{{ URL::asset("assets/sounds/notification.mp3") }}');
                    audio.volume = 0.3;
                    audio.play().catch(function(){});
                } catch(e) {}

                // إضافة الإشعار إلى القائمة المنسدلة
                var dropdown = $('.dropdown-notifications .dropdown-divider').first();
                if (dropdown.length) {
                    var newNotif = '<a href="' + (data.url || '#') + '" class="dropdown-item notification-item" style="background:#fff3cd;">' +
                        '<i class="' + (data.icon || 'fas fa-bell') + ' text-' + (data.color || 'info') + '"></i> ' +
                        (data.message || 'إشعار جديد') +
                        '<small class="float-right text-muted time">الآن</small>' +
                        '</a>';
                    dropdown.before(newNotif);
                }
            }

            // الاستماع لحدث درجة جديدة
            channel.bind('NewGrade', function(data) {
                incrementNotificationBadge(data);
            });

            // الاستماع لحدث اختبار جديد
            channel.bind('NewQuiz', function(data) {
                incrementNotificationBadge(data);
            });

            // الاستماع لحدث رسالة جديدة
            channel.bind('NewMessage', function(data) {
                incrementNotificationBadge(data);
            });

            // الاستماع لإشعارات البث العامة (Illuminate\\Notifications\\Events\\BroadcastNotificationCreated)
            channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
                incrementNotificationBadge(data);
            });

            // معالجة أخطاء الاتصال
            pusher.connection.bind('error', function(err) {
                console.warn('Pusher connection error:', err);
            });
        }
        @endif
    });
</script>
@endif
{{-- ===== End Real-Time Notifications ===== --}}

{{-- ===== PWA Service Worker Registration (Feature 5) ===== --}}
<script>
    window.addEventListener('load', function() {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('{{ URL::asset("service-worker.js") }}', {
                scope: '/'
            }).then(function(registration) {
                console.log('SW: Registered with scope:', registration.scope);

                // Check for updates
                registration.addEventListener('updatefound', function() {
                    var newWorker = registration.installing;
                    if (newWorker) {
                        newWorker.addEventListener('statechange', function() {
                            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                // New update available
                                if (typeof toastr !== 'undefined') {
                                    toastr.info('يتوفر تحديث جديد. يرجى إعادة تحميل الصفحة.', 'تحديث متوفر', {
                                        timeOut: 8000,
                                        extendedTimeOut: 2000,
                                        closeButton: true,
                                        positionClass: 'toast-top-left',
                                        rtl: true,
                                        onclick: function() { window.location.reload(); }
                                    });
                                }
                            }
                        });
                    }
                });
            }).catch(function(error) {
                console.warn('SW: Registration failed:', error);
            });

            // Listen for controller change (new SW took over)
            navigator.serviceWorker.addEventListener('controllerchange', function() {
                // Optionally auto-reload, or let user decide
            });
        }
    });
</script>
{{-- ===== End PWA Service Worker ===== --}}
