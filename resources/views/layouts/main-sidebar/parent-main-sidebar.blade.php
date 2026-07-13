<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard.parents') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

        <!-- الابناء -->
        <li>
            <a href="{{route('sons.index')}}"><i class="fas fa-children"></i><span class="right-nav-text">الابناء</span></a>
        </li>

        <!-- التقديرات والدرجات -->
        <li>
            <a href="{{ route('dashboard.parents') }}"><i class="fas fa-chart-bar"></i><span class="right-nav-text">التقديرات والدرجات</span></a>
        </li>

        <!-- تقرير الحضور والغياب -->
        <li>
            <a href="{{route('sons.attendances')}}"><i class="fas fa-calendar-check"></i><span class="right-nav-text">تقرير الحضور والغياب</span></a>
        </li>

        <!-- تقرير المالي -->
        <li>
            <a href="{{route('sons.fees')}}"><i class="fas fa-money-bill"></i><span class="right-nav-text">تقرير المالية</span></a>
        </li>

        <!-- مراسلة المعلمين -->
        <li>
            <a href="{{route('parent.messages.index')}}"><i class="fas fa-comments"></i><span class="right-nav-text">مراسلة المعلمين</span></a>
        </li>

        <!-- الملف الشخصي -->
        <li>
            <a href="{{route('profile.show.parent')}}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">الملف الشخصي</span></a>
        </li>

        <!-- لوحة الإعلانات -->
        <li>
            <a href="{{route('parent.announcements')}}"><i class="fas fa-bullhorn"></i><span class="right-nav-text">لوحة الإعلانات</span></a>
        </li>

        <!-- الإشعارات -->
        <li>
            <a href="{{route('parent.notifications.index')}}"><i class="fas fa-bell"></i><span class="right-nav-text">الإشعارات</span></a>
        </li>

    </ul>
</div>
