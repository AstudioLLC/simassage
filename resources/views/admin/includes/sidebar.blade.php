@alink(['url' => route('admin.pages.main'), 'icon' => 'mdi mdi-receipt', 'title' => t('Admin Sidebar.Pages')])@endalink

@alink(['icon' => 'fas fa-users', 'title' => '*Пользователи*'])
    @alink(['url' => route('admin.retail-users.index'), 'title' => '*Розничные пользователи*']) @endalink
    @alink(['url' => route('admin.wholesale-users.index'), 'title' => '*Оптовики*']) @endalink
@endalink

{{--
@alink(['url' => route('admin.brands.main'), 'icon' => 'fab fa-bootstrap', 'title' => t('Admin Sidebar.Brands')])@endalink
@alink(['url' => route('admin.categories.index'), 'icon' => 'fas fa-list-alt', 'title' => t('Admin Sidebar.Categories')])@endalink
@alink(['url' => route('admin.collections.main'), 'icon' => 'fas fa-list-alt', 'title' => t('Admin Sidebar.Collections')])@endalink
@alink(['url' => route('admin.videos.main'), 'icon' => 'fab fa-youtube', 'title' => t('Admin Sidebar.Videos')])@endalink
@alink(['url' => route('admin.main_slider.main'), 'icon' => 'fas fa-image', 'title' => t('Admin Sidebar.Slider')])@endalink
@alink(['url' => route('admin.home_banner.main'), 'icon' => 'fas fa-image', 'title' => t('Admin Sidebar.HomeBanner')])@endalink
@alink(['url' => route('admin.news.main'), 'icon' => 'fas fa-newspaper', 'title' => t('Admin Sidebar.News')])@endalink
@alink(['url' => route('admin.services.main'), 'icon' => 'fas fa-newspaper', 'title' => t('Admin Sidebar.Services')])@endalink

@alink(['icon' => 'fas fa-paperclip', 'title' => t('Admin Sidebar.Orders'), 'counter' => ($new_orders_count) + ($pending_orders_count) + $done_orders_count + $declined_orders_count])
@alink(['url' => route('admin.orders.new'), 'icon' => 'fas fa-plus-circle', 'title' => t('Admin Sidebar.Orders new'), 'counter' => ($new_orders_count)])@endalink
@alink(['url' => route('admin.orders.pending'), 'icon' => 'fas fa-tasks', 'title' => t('Admin Sidebar.Orders pending'), 'counter' => ($pending_orders_count)])@endalink
@alink(['url' => route('admin.orders.done'), 'icon' => 'fas fa-check-circle', 'title' => t('Admin Sidebar.Orders done'), 'counter' => ($done_orders_count)])@endalink
@alink(['url' => route('admin.orders.declined'), 'icon' => 'fas fa-times-circle', 'title' => t('Admin Sidebar.Orders declined'), 'counter' => ($declined_orders_count)])@endalink
@endalink

@alink(['url' => route('admin.filters.list'), 'icon' => 'fas fa-filter', 'title' => t('Admin Sidebar.Filters')])@endalink
--}}

{{--@alink(['icon' => 'fas fa-percent', 'title' => t('Admin Sidebar.Discounts')])
--}}{{--@alink(['url' => '', 'title' => 'Для оптовиков']) @endalink
@alink(['url' => '', 'title' => 'Розничные покупатели']) @endalink--}}{{--
@alink(['url' => route('admin.discountForUser.main'), 'icon' => 'fas fa-handshake', 'title'=> t('Admin Sidebar.Discounts for users')])@endalink
@endalink--}}

{{--
@alink(['url' => route('admin.delivery_regions.main'), 'icon' => 'fas fa-globe-europe', 'title' => t('Admin Sidebar.Delivery and prices')])@endalink
@alink(['url' => route('admin.banners', ['page' => 'info']), 'icon' => 'fas fa-info-circle', 'title' => t('Admin Sidebar.Information')])@endalink
@alink(['url' => route('admin.addresses.main'), 'icon' => 'fas fa-map-marker-alt', 'title' => t('Admin Sidebar.Addresses')])@endalink
--}}
@alink(['url' => route('admin.languages.main'), 'icon' => 'mdi mdi-translate', 'title' => t('Admin Sidebar.Languages')])@endalink
