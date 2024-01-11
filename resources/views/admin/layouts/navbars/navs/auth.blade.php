<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <div class="nav-links d-flex align-items-center">
            @if($job_applications)
                <div class="pointer">
                    <span>{{$job_applications}}</span>
                </div>
            @endif
            <a class="nav-link text-white "  href="{{ route('admin.applyJobs.index') }}">
                <i class="fas fa-user-md text-white"></i> {{ __('app.Job applications') }}
            </a>
            @if($messages)
                <div class="pointer">
                    <span>{{$messages}}</span>
                </div>
            @endif
            <a class="nav-link text-white" href="{{ route('admin.queuing_message.index') }}">
                <i class="fas fa-envelope text-white"></i> Online applications
            </a>
            @if($contact_messages)
                <div class="pointer">
                    <span>{{$contact_messages}}</span>
                </div>
            @endif
            <a class="nav-link text-white" href="{{ route('admin.messages.index') }}">
                <i class="fas fa-envelope text-white"></i> {{ __('app.Messages') }}
            </a>
        </div>
        <!-- Brand -->
        {{--<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{!! route(env('CMS_HOMEPAGE_ROUTE')) !!}">
            {{ __('app.Dashboard') }}
        </a>--}}
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
{{--            <div class="form-group mb-0">--}}
{{--                <div class="input-group input-group-alternative">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">--}}
{{--                            <i class="fas fa-search"></i>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                    <input class="form-control" placeholder="Search" type="text">--}}
{{--                </div>--}}
{{--            </div>--}}
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item ">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        {{--<span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('cms') }}/img/theme/team-4-800x800.jpg">
                        </span>--}}
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
            </li>
            <div class="nav-links d-flex">
                <a href="{{ route('admin.password.res') }}" class="nav-link text-white">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>{{ __('app.Settings') }}</span>
                </a>
                <a href="{{ route('logout') }}" class="nav-link text-white" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('app.Logout') }}</span>
                    </a>
            </div>
        </ul>
    </div>
</nav>
