@php
    if(empty($id)) $id = 'bylang_' . random_int(1,9999);
@endphp

@foreach($languages as $language)
    @php
        $active = $loop->first ? ' active' : '';
        $prefix = '_' . $language['iso'];
    @endphp

    @section('bylang_tabs')
        <li class="nav-item px-0">
            <a class="nav-link mb-sm-3 mb-md-0{!! $active !!}"
               data-toggle="tab"
               href="#{!! $id.$prefix !!}"
               id="tabs-icons-text-1-tab"
               role="tab"
               aria-controls="tabs-icons-text-1"
               aria-selected="true">
                {!! $language['title'] !!}
            </a>
        </li>

    @if($loop->first) @overwrite @else @append @endif

    @section('bylang_content')
        <div class="tab-pane{!! $active !!} {{ $tp_classes ?? 'normal-p' }}" id="{!! $id.$prefix !!}" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
            {!! ${'bylang'.$prefix} !!}
        </div>

    @if($loop->first) @overwrite @else @append @endif

@endforeach

<div class="nav-wrapper px-2">
    <div class="py-2 {{ $class ?? '' }}">
        <div class="{!! !empty($title) ? 'has-title' : null !!}">{{ $title ?? '' }}</div>
    </div>
    <ul class="nav nav-pills flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        @yield('bylang_tabs')
    </ul>
</div>
<div class="card-body">
    <div class="tab-content" id="myTabContent">
        @yield('bylang_content')
    </div>
</div>
