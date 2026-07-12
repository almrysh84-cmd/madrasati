<!--=================================
header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}"><img
                src="{{ URL::asset('assets/images/logo-dark.png') }}" alt=""></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}"><img
                src="{{ URL::asset('assets/images/logo-icon-dark.png') }}" alt=""></a>


    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i
                    class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>
        <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value=""
                        name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li>
    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">

        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                @else
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                @endif
            </button>
            <div class="dropdown-menu">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown ">
            @php
                // الحصول على المستخدم المصادق عليه حسب الحارس النشط
                $notifUser = null;
                foreach (['web', 'student', 'teacher', 'parent'] as $guard) {
                    if (auth($guard)->check()) {
                        $notifUser = auth($guard)->user();
                        break;
                    }
                }
                $unreadNotifications = $notifUser ? $notifUser->unreadNotifications->take(5) : collect([]);
                $unreadCount = $notifUser ? $notifUser->unreadNotifications->count() : 0;
            @endphp
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti-bell"></i>
                @if($unreadCount > 0)
                <span class="badge badge-danger notification-status">{{ $unreadCount }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>{{ trans('Sidebar_trans.Notifications') }}</strong>
                    <span class="badge badge-pill badge-warning">{{ $unreadCount }}</span>
                </div>
                <div class="dropdown-divider"></div>
                @if($unreadNotifications->count() > 0)
                    @foreach($unreadNotifications as $notification)
                        @php $data = $notification->data; @endphp
                        <a href="{{ $data['url'] ?? '#' }}" class="dropdown-item notification-item" data-id="{{ $notification->id }}">
                            <i class="{{ $data['icon'] ?? 'fas fa-bell' }} text-{{ $data['color'] ?? 'info' }}"></i>
                            {{ $data['message'] ?? 'إشعار جديد' }}
                            <small class="float-right text-muted time">{{ $notification->created_at->diffForHumans() }}</small>
                        </a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    @php
                        // Determine the notifications route based on the active guard
                        $notifRoute = 'notifications.index'; // default (admin)
                        if (auth('student')->check()) {
                            $notifRoute = 'student.notifications.index';
                        } elseif (auth('teacher')->check()) {
                            $notifRoute = 'teacher.notifications.index';
                        } elseif (auth('parent')->check()) {
                            $notifRoute = 'parent.notifications.index';
                        }
                    @endphp
                    <a href="{{ route($notifRoute) }}" class="dropdown-item text-center text-primary">
                        <small>{{ trans('Sidebar_trans.View_all') ?? 'عرض الكل' }}</small>
                    </a>
                @else
                    <a href="#" class="dropdown-item text-center text-muted">
                        <small>لا توجد إشعارات جديدة</small>
                    </a>
                @endif
            </div>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big">
                <div class="dropdown-header">
                    <strong>Quick Links</strong>
                </div>
                <div class="dropdown-divider"></div>
                <div class="nav-grid">
                    <a href="#" class="nav-grid-item"><i class="ti-files text-primary"></i>
                        <h5>New Task</h5>
                    </a>
                    <a href="#" class="nav-grid-item"><i class="ti-check-box text-success"></i>
                        <h5>Assign Task</h5>
                    </a>
                </div>
                <div class="nav-grid">
                    <a href="#" class="nav-grid-item"><i class="ti-pencil-alt text-warning"></i>
                        <h5>Add Orders</h5>
                    </a>
                    <a href="#" class="nav-grid-item"><i class="ti-truck text-danger "></i>
                        <h5>New Orders</h5>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ URL::asset('assets/images/user_icon.jpg') }}" alt="avatar">


            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i>Activity</a>
                <a class="dropdown-item" href="#"><i class="text-success ti-email"></i>Messages</a>
                <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i>Profile</a>
                <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span
                        class="badge badge-info">6</span> </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a>
                @if (auth('student')->check())
                    <form method="GET" action="{{ route('logout', 'student') }}">
                    @elseif(auth('teacher')->check())
                        <form method="GET" action="{{ route('logout', 'teacher') }}">
                        @elseif(auth('parent')->check())
                            <form method="GET" action="{{ route('logout', 'parent') }}">
                            @else
                                <form method="GET" action="{{ route('logout', 'web') }}">
                @endif

                @csrf
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault();this.closest('form').submit();"><i class="bx bx-log-out"></i>تسجيل
                    الخروج</a>
                </form>
            </div>
        </li>
    </ul>
</nav>

<!--=================================
header End-->
