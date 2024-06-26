@extends('templates/base_clean')

@section('body')
    <!-- app-Header -->
    <div class="app-header header sticky">
        <div class="container-fluid main-container">
            <div class="d-flex">
{{--                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>--}}
                <!-- sidebar-toggle-->

                <div class="d-flex order-lg-2 ms-auto header-right-icons">
                    <div class="navbar navbar-collapse responsive-navbar p-0">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                            <div class="d-flex order-lg-2">
                                <div class="dropdown d-lg-none d-flex">
                                    <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                        <i class="fe fe-search"></i>
                                    </a>
                                    <div class="dropdown-menu header-search dropdown-menu-start">
                                        <div class="input-group w-100 p-2">
                                            <input type="text" class="form-control" placeholder="Search....">
                                            <div class="input-group-text btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown  d-flex notifications">
                                    <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span class=" pulse"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <div class="drop-heading border-bottom">
                                            <div class="d-flex">
                                                <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications</h6>
                                            </div>
                                        </div>
                                        <div class="notifications-menu">
                                            @php($notifications = Auth::user()->userNotifications()->limit(5)->orderByDesc('created_at')->get())

                                            @if(count($notifications) > 0)
                                                @foreach($notifications as $notification)
                                                    <a class="dropdown-item d-flex" href="{{ route('traps.show', $notification->trap_id) }}">
                                                        <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                            <i class="fe fe-mail"></i>
                                                        </div>
                                                        <div class="mt-1 wd-80p">
                                                            <h5 class="notification-label mb-1">{{ $notification->text }}</h5>
                                                            <span class="notification-subtext">{{ $notification->ago() }}</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @else
                                                <div class="dropdown-item">
                                                    No notifications yet
                                                </div>
                                            @endif
                                        </div>
                                        <div class="dropdown-divider m-0"></div>
                                        <a href="{{ route('notifications') }}" class="dropdown-item text-center p-3 text-muted">Go to notification settings</a>
                                    </div>
                                </div>
                                <!-- SIDE-MENU -->
                                <div class="dropdown d-flex profile-1">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                        <span class="avatar avatar-md brround me-3 text-black align-self-center cover-image">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <div class="drop-heading">
                                            <div class="text-center">
                                                <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ Auth::user()->name }}</h5>
                                                <small class="text-muted">{{ Auth::user()->email }}</small>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{ route('auth.logout') }}">
                                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /app-Header -->

    <!--APP-SIDEBAR-->
    <div class="sticky">
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <div class="app-sidebar">
            <div class="side-header">
                <a class="header-brand1" href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/images/logo_only.png') }}" height="50" class="header-brand-img p-1" alt="logo">
                </a>
                <!-- LOGO -->
            </div>
            <div class="main-sidemenu">
                <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
                <ul class="side-menu">
                    <hr>
                    <li class="sub-category">
                        <h3>Main</h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('dashboard') }}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                    </li>
                    <hr>
                    <li class="sub-category">
                        <h3>General</h3>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{ route('traps.index') }}"><i class="side-menu__icon fe fe-wifi"></i><span class="side-menu__label">Traps</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{ route('locations.index') }}"><i class="side-menu__icon fe fe-map-pin"></i><span class="side-menu__label">Locations</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">More</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">More</a></li>
                            <li><a href="{{ route('notifications') }}" class="slide-item">Notifications</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
            </div>
        </div>
        <!--/APP-SIDEBAR-->
    </div>

    <div class="main-content app-content mt-0">
        @yield('content')
    </div>
@endsection
