<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <a class="navbar-brand justify-content-center" href="{!! route(env('CMS_HOMEPAGE_ROUTE')) !!}">
                <b class="logo-icon p-l-10">
                    <img style="width: 80px" src="{{ aSite('images/logo.png') }}" alt="homepage" class="light-logo"/>
                </b>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto d-flex" style="align-items: center;">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0);" data-sidebartype="mini-sidebar">
                        <i class="mdi mdi-menu font-24"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav float-left mr-auto d-flex">
                {{--<li class="mr-3" style="font-size: 13px;">
                    <a style="box-shadow: 0 0 5px white;padding: 5px 15px; color: white; position: relative" href="{{ route('admin.messages.main') }}">
                        {{ t('Admin header.Letters') }}
                    </a>
                </li>--}}
                {{--<li class="mr-3" style="font-size: 13px;">
                    <a style="box-shadow: 0 0 5px white;padding: 5px 15px; color: white; position: relative" href="{{ route('admin.users.index') }}">
                        {{ t('Admin header.Site users') }}
                        @if(!empty($new_users_count))
                            <span style="padding:13px;position: absolute;right: -13px;top:-13px; background: grey; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; color: white;border-radius: 50%">
                              {{ $new_users_count }}
                            </span>
                        @endif
                    </a>
                </li>--}}
                {{--<li class="mr-3" style="font-size: 13px; display: none">
                    <a style="box-shadow: 0 0 5px white;padding: 5px 15px; color: white; position: relative" href="--}}{{--{{ route('admin.user-messages.main') }}--}}{{--javascript:void(0)">
                        {{ t('Admin header.Letters') }}
                    </a>
                </li>
                <li class="mr-3" style="font-size: 13px;">
                    <a style="box-shadow: 0 0 5px white;padding: 5px 15px; color: white; position: relative" href="{{ route('admin.items.index') }}">
                        {{ t('Admin header.Items') }}
                        @if(!empty($new_items_count_for_top))
                            <span style="padding:13px;position: absolute;right: -13px;top:-13px; background: grey; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; color: white;border-radius: 50%">
                                    {{ $new_items_count_for_top }}
                                </span>
                        @endif
                    </a>
                </li>
                <li class="mr-3" style="font-size: 13px;display: none">
                    <a style="box-shadow: 0 0 5px white;padding: 5px 15px; color: white; position: relative"
                       href="--}}{{--{{ route('admin.users.statistics') }}--}}{{--javascript:void(0)">
                        {{ t('Admin header.Statistics') }}
                    </a>
                </li>--}}
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{!! aAdmin('images/avatar.jpg') !!}" alt="user" class="rounded-circle" style="width:50px; height:50px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated p-b-0" style="height: auto !important;">
                        <a class="dropdown-item" href="{!! route('admin.profile.main') !!}">
                            <i class="fas fa-cog m-r-5 m-l-5"></i>
                            {{ t('Admin header.Profile settings') }}
                        </a>
                        <a class="dropdown-item" href="{!! route('page') !!}" target="_blank">
                            <i class="fa fa-home m-r-5 m-l-5"></i>
                            {{ t('Admin header.Show page') }}
                        </a>
                        <form action="{!! route('admin.logout') !!}" enctype="multipart/form-data" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit" id="logout-user1">
                                <i class="fa fa-power-off m-r-5 m-l-5"></i>
                                {{ t('Admin header.Logout') }}
                            </button>
                        </form>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
