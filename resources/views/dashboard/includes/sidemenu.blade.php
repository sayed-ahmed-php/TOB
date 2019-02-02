@php
$items = array(
  [
    'route' => 'admin.home',
    'icon'  => 'home',
    'title' => __('dashboard.DASHBOARD')
  ],
  [
    'route' => 'admin.admins.index',
    'icon'  => 'user-secret',
    'title' => __('dashboard.ADMINS')
  ],
  [
    'route' => 'admin.users.index',
    'icon'  => 'users',
    'title' => __('dashboard.USERS')
  ],
  //[
  //  'route' => 'admin.banners.index',
  //  'icon'  => 'buysellads',
  // 'title' => __('dashboard.BANNERS')
  //],
  [
    'route' => 'admin.conditions.index',
    'icon'  => 'list-alt',
    'title' => __('dashboard.CONDITIONS')
  ],
  [
    'route' => 'admin.departments.index',
    'icon'  => 'list-alt',
    'title' => __('dashboard.DEPARTMENTS')
  ],
  [
    'route' => 'admin.products.index',
    'icon'  => 'product-hunt',
    'title' => __('dashboard.PRODUCTS')
  ],
  [
    'route' => 'admin.orders.index',
    'icon'  => 'shopping-cart',
    'title' => __('dashboard.ORDERS')
  ],
  [
    'route' => 'admin.settings.index',
    'icon'  => 'cogs',
    'title' => __('dashboard.SETTINGS')
  ],
);
@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      @foreach ($items as $item)
        <li>
          <a href=" {{ $item['route'] == NULL ? '#' : route($item['route'], App::getLocale()) }} ">
            <i class="fa fa-{{$item['icon']}}"></i>
            <span>{{ $item['title'] }}</span>
          </a>
        </li>
      @endforeach

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
