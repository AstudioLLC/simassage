<ul class="bread-crumbs">
    <li class="bread-crumbs__item"><a class="bread-crumbs__link" href="/">{{t('Page home.General')}}</a></li>
    {{-- @foreach($breadcrumbs as $item)
        <li class="bread-crumbs__item" aria-current="page"><a href="@if(isset($item['url']) && $item['url'] == url('about')) / @else{{ $item['url'] ?? '' }}@endif" class="bread-crumbs__link bread-crumbs__link_active">{{ $item['title'] }}</a>
        </li>
    @endforeach --}}
    @foreach($breadcrumbs as $index => $breadcrumb)
    <li class="bread-crumbs__item" aria-current="{{ $index === (count($breadcrumbs) - 1) ? 'page' : '' }}">
        @if($index === (count($breadcrumbs) - 2) && $breadcrumb['url'] !== url(app()->getLocale().'/about') && $breadcrumb['url'] !== url('/about') )
            <a href="{{ $breadcrumb['url'] }}" class="bread-crumbs__link bread-crumbs__link_active">{{ $breadcrumb['title'] }}</a>
        @else
            <span class="bread-crumbs__link">{{ $breadcrumb['title'] }}</span>
        @endif
    </li>
@endforeach
</ul>
