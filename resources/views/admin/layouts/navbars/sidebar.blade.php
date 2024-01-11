<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{!! route(env('CMS_HOMEPAGE_ROUTE')) !!}">
            {{--            <img src="{{ asset('cms') }}/img/brand/balex_logo.png" class="navbar-brand-img" alt="..."> --}}
            <img src="{{ asset('image/adminlogoblack.svg') }}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            {{-- <img alt="Image placeholder" src="{{ asset('cms') }}/img/theme/team-1-800x800.jpg"> --}}
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('app.Welcome!') }}</h6>
                    </div>
                    <a href="{{-- {{ route('profile.edit') }} --}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('app.My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('app.Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('app.Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('app.Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('app.Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{!! route(env('CMS_HOMEPAGE_ROUTE')) !!}">
                            <img src="{{ asset('cms') }}/img/brand/logo.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('app.Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">

                <!--<li class="nav-item">-->
                <!--    <a class="nav-link" href="{{ route('admin.languages.index') }}">-->
                <!--        <i class="ni ni-caps-small text-primary"></i> {{ __('app.Languages') }}-->
                <!--    </a>-->
                <!--</li>-->

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                        <i class="far fa-images text-primary"></i> {{ __('app.Sliders') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pages.index') }}">
                        <i class="ni ni-bullet-list-67 text-primary"></i> {{ __('app.Pages') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.news.index') }}">
                        <i class="ni ni-bullet-list-67 text-primary"></i> {{ __('app.News') }}
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('admin.service.index') }}">--}}
{{--                        <i class="ni ni-bullet-list-67 text-primary"></i> {{ __('app.Services') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.prices.index') }}">
                        <i class="ni ni-bullet-list-67 text-primary"></i> Prices
                    </a>
                </li>
                {{--                <li class="nav-item"> --}}
                {{--                    <a class="nav-link" href="{{ route('admin.corporate_donors.index') }}"> --}}
                {{--                        <i class="ni ni-bullet-list-67 text-primary"></i> {{ __('app.Partners') }} --}}
                {{--                    </a> --}}
                {{--                </li> --}}
                {{--                <li class="nav-item"> --}}
                {{--                    <a class="nav-link" href="{{ route('admin.events.index') }}"> --}}
                {{--                        <i class="ni ni-bullet-list-67 text-primary"></i> {{ __('app.Events') }} --}}
                {{--                    </a> --}}
                {{--                </li> --}}

                {{--                <li class="nav-item"> --}}
                {{--                    <a class="nav-link" href="{{ route('admin.faqs.index') }}"> --}}
                {{--                        <i class="fas fa-question text-primary"></i> {{ __('app.FAQ') }} --}}
                {{--                    </a> --}}
                {{--                </li> --}}


                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.messages.index') }}">
                        <i class="fas fa-envelope text-primary"></i> {{ __('app.Messages') }}

                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.queuing_message.index') }}">
                        <i class="fas fa-envelope text-primary"></i> Online applications
                        @if ($messages)
                            <div class="pointer">
                                <span>{{$messages}}</span>
                            </div>
                        @endif
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.time.index') }}">
                        <i class="fas fa-clock text-primary"></i> {{ __('app.Time Info') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.job.index') }}">
                        <i class="fas fa-briefcase-medical text-primary"></i>
                        {{ __('app.Career') }}
                    </a>
                </li>
            </ul>
            <hr class="my-3">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.information.edit', ['id' => 1]) }}">
                        <i class="fas fa-info-circle text-primary"></i> {{ __('app.Information') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.socials.index') }}">
                        <i class="fas fa-share-alt text-primary"></i> {{ __('app.Social networks') }}
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.notificationText.edit', ['id' => 1]) }}">
                        <i class="fa fa-bell text-primary" ></i> {{ __('app.Notifications text') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.queuing_statuses.index') }}">
                        <i class="fas fa-clipboard-check text-primary"></i> {{ __('app.Appointment status') }}
                    </a>
                </li>
                @if (auth()->user()->type == 0)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users text-primary"></i> {{ __('User Managment') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
