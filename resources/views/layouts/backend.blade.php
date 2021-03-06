<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{url('/backend')}}/images/favicon.png">
    <!-- Page Title  -->
    <title>Sloofi Dashboard</title>
    <!-- StyleSheets  -->
    @yield('css')
    <link rel="stylesheet" href="{{url('/backend')}}/assets/css/dashlite.css?ver=2.9.0">
    <link id="skin-default" rel="stylesheet" href="{{url('/backend')}}/assets/css/theme.css?ver=2.9.0">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
            <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-sidebar-brand">
                    <a href="/" class="logo-link nk-sidebar-logo">
                        <img class="logo-light logo-img" src="{{url('/backend')}}/images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                        <img class="logo-dark logo-img" src="{{url('/backend')}}/images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                        <img class="logo-small logo-img logo-img-small" src="{{url('/backend')}}/images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="logo-small">
                    </a>
                </div>
                <div class="nk-menu-trigger mr-n2">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
            </div><!-- .nk-sidebar-element -->
            <div class="nk-sidebar-element">
                <div class="nk-sidebar-content">
                    <div class="nk-sidebar-menu" data-simplebar>
                        <ul class="nk-menu">
                            <li class="nk-menu-item">
                                <a href="{{route('dashboard')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                    <span class="nk-menu-text">Dashboard</span>
                                </a>
                            </li>
                            @can('view_roles')
                            <li class="nk-menu-item">
                                <a href="{{route('role.all')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                    <span class="nk-menu-text">Roles</span>
                                </a>
                            </li>
                            @endcan
                            @can('view_permissions')
                            <li class="nk-menu-item">
                                <a href="{{route('permission.all')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                    <span class="nk-menu-text">Permissions</span>
                                </a>
                            </li>
                            @endcan
                            @can('view_users')
                                <li class="nk-menu-item">
                                    <a href="{{route('user.all')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">Users</span>
                                    </a>
                                </li>
                            @endcan
                            @can('Wallet')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Wallet</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item {{ Request::is('user/deposit') ? 'active' : '' }}">
                                            <a href="{{ route('user.deposit') }}" class="nk-menu-link"><span class="">Deposit Amount</span></a>
                                        </li>
                                        <li class="nk-menu-item {{ Request::is('user') ? 'active' : '' }}">
                                            <a href="{{route('user.my-wallet')}}" class="nk-menu-link"><span class="">My Wallet</span></a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            @can('view_categories')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Categories</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @can('add_category')

                                        <li class="nk-menu-item {{ Request::is('category/create') ? 'active' : '' }}">
                                            <a href="{{ route('category.create') }}" class="nk-menu-link"><span class="">Add Category</span></a>
                                        </li>
                                        @endcan
                                        <li class="nk-menu-item {{ Request::is('category') ? 'active' : '' }}">
                                            <a href="{{route('category.all')}}" class="nk-menu-link"><span class="">All Categories</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endcan
                            @can('view_third_paty_api')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Third Party Api</span>
                                    </a>
                                    @if($tp_apis = get_tp_api())
                                        <ul class="nk-menu-sub">
                                            @foreach($tp_apis as $api)
                                                <li class="nk-menu-item {{ Request::is('thirdpartyapi.categories') ? 'active' : '' }}">
                                                    <a href="{{route('thirdpartyapi.categories',[$api['Id'], $api['Name']] )}}" class="nk-menu-link"><span class="">{{$api['Name']}}</span></a>
                                                </li>
                                            @endforeach
                                        </ul><!-- .nk-menu-sub -->
                                    @endif
                                </li><!-- .nk-menu-item -->
                            @endcan
                            @can('view_warehouses')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Warehouses</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @can('add_warehouse')
                                        <li class="nk-menu-item {{ Request::is('warehouse/create') ? 'active' : '' }}">
                                            <a href="{{ route('warehouse.create') }}" class="nk-menu-link"><span class="">Add Warehouse</span></a>
                                        </li>
                                        @endcan
                                        <li class="nk-menu-item {{ Request::is('warehouse') ? 'active' : '' }}">
                                            <a href="{{route('warehouse.all')}}" class="nk-menu-link"><span class="">All Warehouses</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endcan
                            @can('view_packages')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Packages</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @can('add_package')
                                            <li class="nk-menu-item {{ Request::is('package/create') ? 'active' : '' }}">
                                                <a href="{{ route('package.create') }}" class="nk-menu-link"><span class="">Add Package</span></a>
                                            </li>
                                        @endcan
                                        <li class="nk-menu-item {{ Request::is('package') ? 'active' : '' }}">
                                            <a href="{{route('package.all')}}" class="nk-menu-link"><span class="">All Packages</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endcan
                            @can('view_products')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Products</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @can('view_sections')
                                            <li class="nk-menu-item {{ Request::is('section') ? 'active' : '' }}">
                                                <a href="{{route('section.all')}}" class="nk-menu-link"><span class="">All Frontend Sections</span></a>
                                            </li>
                                        @endcan
                                            @can('add_product')
                                            <li class="nk-menu-item {{ Request::is('product/create') ? 'active' : '' }}">
                                                <a href="{{ route('product.create') }}" class="nk-menu-link"><span class="">Add Product</span></a>
                                            </li>
                                        @endcan
                                            <li class="nk-menu-item {{ Request::is('product') ? 'active' : '' }}">
                                                <a href="{{route('product.all')}}" class="nk-menu-link"><span class="">All Products</span></a>
                                            </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endcan
                             @can('view_woocommerces')
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                    <span class="nk-menu-text">Woocommerce</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @can('add_woocommerce')
                                    <li class="nk-menu-item {{ Request::is('woocommerce/create') ? 'active' : '' }}">
                                        <a href="{{ route('woocommerce.create') }}" class="nk-menu-link"><span class="">Add Woocommerce Store</span></a>
                                    </li>
                                    @endcan
                                    <li class="nk-menu-item {{ Request::is('woocommerce') ? 'active' : '' }}">
                                        <a href="{{route('woocommerce.all')}}" class="nk-menu-link"><span class="">All Woocommerce Stores</span></a>
                                    </li>
                                    @can('my_woocommerces_products')
                                        <li class="nk-menu-item {{ Request::is('woocommerce') ? 'active' : '' }}">
                                            <a href="{{route('my.woocommerce.products')}}" class="nk-menu-link"><span class="">My Woocommerces Products</span></a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('view_shopifies')
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                    <span class="nk-menu-text">Shopify</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    @can('add_shopify')
                                    <li class="nk-menu-item {{ Request::is('shopify/create') ? 'active' : '' }}">
                                        <a href="{{ route('shopify.create') }}" class="nk-menu-link"><span class="">Add Shopify Store</span></a>
                                    </li>
                                    @endcan
                                    <li class="nk-menu-item {{ Request::is('shopify') ? 'active' : '' }}">
                                        <a href="{{route('shopify.all')}}" class="nk-menu-link"><span class="">All Shopify Stores</span></a>
                                    </li>
                                        @can('my_shopify_products')
                                    <li class="nk-menu-item {{ Request::is('shopify') ? 'active' : '' }}">
                                        <a href="{{route('my.shopify.products')}}" class="nk-menu-link"><span class="">My All Shopify Products</span></a>
                                    </li>
                                        @endcan
                                </ul><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            @endcan
                            @can('view_order')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Orders</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @can('view_all_orders')
                                            <li class="nk-menu-item {{ Request::is('order/all') ? 'active' : '' }}">
                                                <a href="{{ route('order.all') }}" class="nk-menu-link"><span class="">My buy Orders</span></a>
                                            </li>
                                        @endcan
                                        @can('view_sloofi_orders')
                                        <li class="nk-menu-item {{ Request::is('order') ? 'active' : '' }}">
                                            <a href="{{route('order.sloofi')}}" class="nk-menu-link"><span class="">Sloofi Orders</span></a>
                                        </li>
                                        @endcan
                                        @can('view_vendor_internal_orders')
                                        <li class="nk-menu-item {{ Request::is('order') ? 'active' : '' }}">
                                            <a href="{{route('order.internal')}}" class="nk-menu-link"><span class="">Vendor Internal Sell Orders</span></a>
                                        </li>
                                        @endcan
                                        @can('view_vendor_external_orders')
                                        <li class="nk-menu-item {{ Request::is('order') ? 'active' : '' }}">
                                            <a href="{{route('order.external')}}" class="nk-menu-link"><span class="">Vendor External Sell Orders</span></a>
                                        </li>
                                        @endcan

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endcan
                            @can('deposit_approve')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">All Deposit Requests</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item {{ Request::is('deposit/request') ? 'active' : '' }}">
                                            <a href="{{route('user.deposit.all')}}" class="nk-menu-link"><span class="">All Request</span></a>
                                        </li>

                                        <li class="nk-menu-item {{ Request::is('deposit/request') ? 'active' : '' }}">
                                            <a href="{{route('user.deposit.pending')}}" class="nk-menu-link"><span class="">All pending Request</span></a>
                                        </li>

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endcan
                            @can('product_list')
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                        <span class="nk-menu-text">Product List</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item {{ Request::is('product/list') ? 'active' : '' }}">
                                            <a href="{{route('product.list')}}" class="nk-menu-link"><span class="">Product List</span></a>
                                        </li>

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endcan


{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="html/ecommerce/orders.html" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-bag-fill"></em></span>--}}
{{--                                    <span class="nk-menu-text">Orders</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="html/ecommerce/products.html" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-package-fill"></em></span>--}}
{{--                                    <span class="nk-menu-text">Products</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="html/ecommerce/customers.html" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>--}}
{{--                                    <span class="nk-menu-text">Customers</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="html/ecommerce/supports.html" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-chat-fill"></em></span>--}}
{{--                                    <span class="nk-menu-text">Supports</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="html/ecommerce/settings.html" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-opt-alt-fill"></em></span>--}}
{{--                                    <span class="nk-menu-text">Settings</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="html/ecommerce/integration.html" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-server-fill"></em></span>--}}
{{--                                    <span class="nk-menu-text">Integration</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-heading">--}}
{{--                                <h6 class="overline-title text-primary-alt">Return to</h6>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="/" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-dashlite-alt"></em></span>--}}
{{--                                    <span class="nk-menu-text">Main Dashboard</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="html/components.html" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>--}}
{{--                                    <span class="nk-menu-text">All Components</span>--}}
{{--                                </a>--}}
{{--                            </li><!-- .nk-menu-item -->--}}
                        </ul><!-- .nk-menu -->
                    </div><!-- .nk-sidebar-menu -->
                </div><!-- .nk-sidebar-content -->
            </div><!-- .nk-sidebar-element -->
        </div>
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand d-xl-none">
                            <a href="/" class="logo-link">
                                <img class="logo-light logo-img" src="{{url('/backend')}}/images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="{{url('/backend')}}/images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-search ml-3 ml-xl-0">
                            @if(!in_array('vendor',Auth::user()->getRoleNames()->toArray()) && !in_array('super_admin',Auth::user()->getRoleNames()->toArray()))
                            <a href="{{route('user.become_a_vendor')}}"><button type="submit" class="btn btn-primary">Become a Vendor</button></a>
                            @endif
                                @if(!in_array('dropshipper',Auth::user()->getRoleNames()->toArray()) && !in_array('super_admin',Auth::user()->getRoleNames()->toArray()))
                                    <a href="{{route('user.become-a-dropshipper')}}"><button type="submit" class="btn btn-primary mx-2">Become a Dropshipper</button></a>
                                @endif

{{--                            <em class="icon ni ni-search"></em>--}}
{{--                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">--}}
                        </div><!-- .nk-header-news -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
{{--                                <li class="dropdown chats-dropdown hide-mb-xs">--}}
{{--                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">--}}
{{--                                        <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">--}}
{{--                                        <div class="dropdown-head">--}}
{{--                                            <span class="sub-title nk-dropdown-title">Recent Chats</span>--}}
{{--                                            <a href="#">Setting</a>--}}
{{--                                        </div>--}}
{{--                                        <div class="dropdown-body">--}}
{{--                                            <ul class="chat-list">--}}
{{--                                                <li class="chat-item">--}}
{{--                                                    <a class="chat-link" href="html/apps-chats.html">--}}
{{--                                                        <div class="chat-media user-avatar">--}}
{{--                                                            <span>IH</span>--}}
{{--                                                            <span class="status dot dot-lg dot-gray"></span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="chat-info">--}}
{{--                                                            <div class="chat-from">--}}
{{--                                                                <div class="name">Iliash Hossain</div>--}}
{{--                                                                <span class="time">Now</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="chat-context">--}}
{{--                                                                <div class="text">You: Please confrim if you got my last messages.</div>--}}
{{--                                                                <div class="status delivered">--}}
{{--                                                                    <em class="icon ni ni-check-circle-fill"></em>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                </li><!-- .chat-item -->--}}
{{--                                                <li class="chat-item is-unread">--}}
{{--                                                    <a class="chat-link" href="html/apps-chats.html">--}}
{{--                                                        <div class="chat-media user-avatar bg-pink">--}}
{{--                                                            <span>AB</span>--}}
{{--                                                            <span class="status dot dot-lg dot-success"></span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="chat-info">--}}
{{--                                                            <div class="chat-from">--}}
{{--                                                                <div class="name">{{Auth::user()->name}}</div>--}}
{{--                                                                <span class="time">4:49 AM</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="chat-context">--}}
{{--                                                                <div class="text">Hi, I am Ishtiyak, can you help me with this problem ?</div>--}}
{{--                                                                <div class="status unread">--}}
{{--                                                                    <em class="icon ni ni-bullet-fill"></em>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                </li><!-- .chat-item -->--}}
{{--                                                <li class="chat-item">--}}
{{--                                                    <a class="chat-link" href="html/apps-chats.html">--}}
{{--                                                        <div class="chat-media user-avatar">--}}
{{--                                                            <img src="{{url('/backend')}}/images/avatar/b-sm.jpg" alt="">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="chat-info">--}}
{{--                                                            <div class="chat-from">--}}
{{--                                                                <div class="name">George Philips</div>--}}
{{--                                                                <span class="time">6 Apr</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="chat-context">--}}
{{--                                                                <div class="text">Have you seens the claim from Rose?</div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                </li><!-- .chat-item -->--}}
{{--                                                <li class="chat-item">--}}
{{--                                                    <a class="chat-link" href="html/apps-chats.html">--}}
{{--                                                        <div class="chat-media user-avatar user-avatar-multiple">--}}
{{--                                                            <div class="user-avatar">--}}
{{--                                                                <img src="{{url('/backend')}}/images/avatar/c-sm.jpg" alt="">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="user-avatar">--}}
{{--                                                                <span>AB</span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="chat-info">--}}
{{--                                                            <div class="chat-from">--}}
{{--                                                                <div class="name">Softnio Group</div>--}}
{{--                                                                <span class="time">27 Mar</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="chat-context">--}}
{{--                                                                <div class="text">You: I just bought a new computer but i am having some problem</div>--}}
{{--                                                                <div class="status sent">--}}
{{--                                                                    <em class="icon ni ni-check-circle"></em>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                </li><!-- .chat-item -->--}}
{{--                                                <li class="chat-item">--}}
{{--                                                    <a class="chat-link" href="html/apps-chats.html">--}}
{{--                                                        <div class="chat-media user-avatar">--}}
{{--                                                            <img src="{{url('/backend')}}/images/avatar/a-sm.jpg" alt="">--}}
{{--                                                            <span class="status dot dot-lg dot-success"></span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="chat-info">--}}
{{--                                                            <div class="chat-from">--}}
{{--                                                                <div class="name">Larry Hughes</div>--}}
{{--                                                                <span class="time">3 Apr</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="chat-context">--}}
{{--                                                                <div class="text">Hi Frank! How is you doing?</div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                </li><!-- .chat-item -->--}}
{{--                                                <li class="chat-item">--}}
{{--                                                    <a class="chat-link" href="html/apps-chats.html">--}}
{{--                                                        <div class="chat-media user-avatar bg-purple">--}}
{{--                                                            <span>TW</span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="chat-info">--}}
{{--                                                            <div class="chat-from">--}}
{{--                                                                <div class="name">Tammy Wilson</div>--}}
{{--                                                                <span class="time">27 Mar</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="chat-context">--}}
{{--                                                                <div class="text">You: I just bought a new computer but i am having some problem</div>--}}
{{--                                                                <div class="status sent">--}}
{{--                                                                    <em class="icon ni ni-check-circle"></em>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}
{{--                                                </li><!-- .chat-item -->--}}
{{--                                            </ul><!-- .chat-list -->--}}
{{--                                        </div><!-- .nk-dropdown-body -->--}}
{{--                                        <div class="dropdown-foot center">--}}
{{--                                            <a href="html/apps-chats.html">View All</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="dropdown notification-dropdown">--}}
{{--                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">--}}
{{--                                        <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">--}}
{{--                                        <div class="dropdown-head">--}}
{{--                                            <span class="sub-title nk-dropdown-title">Notifications</span>--}}
{{--                                            <a href="#">Mark All as Read</a>--}}
{{--                                        </div>--}}
{{--                                        <div class="dropdown-body">--}}
{{--                                            <div class="nk-notification">--}}
{{--                                                <div class="nk-notification-item dropdown-inner">--}}
{{--                                                    <div class="nk-notification-icon">--}}
{{--                                                        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="nk-notification-content">--}}
{{--                                                        <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>--}}
{{--                                                        <div class="nk-notification-time">2 hrs ago</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="nk-notification-item dropdown-inner">--}}
{{--                                                    <div class="nk-notification-icon">--}}
{{--                                                        <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="nk-notification-content">--}}
{{--                                                        <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>--}}
{{--                                                        <div class="nk-notification-time">2 hrs ago</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="nk-notification-item dropdown-inner">--}}
{{--                                                    <div class="nk-notification-icon">--}}
{{--                                                        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="nk-notification-content">--}}
{{--                                                        <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>--}}
{{--                                                        <div class="nk-notification-time">2 hrs ago</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="nk-notification-item dropdown-inner">--}}
{{--                                                    <div class="nk-notification-icon">--}}
{{--                                                        <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="nk-notification-content">--}}
{{--                                                        <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>--}}
{{--                                                        <div class="nk-notification-time">2 hrs ago</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="nk-notification-item dropdown-inner">--}}
{{--                                                    <div class="nk-notification-icon">--}}
{{--                                                        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="nk-notification-content">--}}
{{--                                                        <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>--}}
{{--                                                        <div class="nk-notification-time">2 hrs ago</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="nk-notification-item dropdown-inner">--}}
{{--                                                    <div class="nk-notification-icon">--}}
{{--                                                        <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="nk-notification-content">--}}
{{--                                                        <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>--}}
{{--                                                        <div class="nk-notification-time">2 hrs ago</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div><!-- .nk-notification -->--}}
{{--                                        </div><!-- .nk-dropdown-body -->--}}
{{--                                        <div class="dropdown-foot center">--}}
{{--                                            <a href="#">View All</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info d-none d-xl-block">
                                                @php
                                                $roles=Auth::user()->getRoleNames()->toArray();
                                                @endphp
                                                <div class="user-status user-status-active">@foreach($roles as $key=>$role) {{str_replace('_',' ',$role)}} @if($key+1!=count($roles)) ,@endif @endforeach</div>
                                                <div class="user-name dropdown-indicator">{{Auth::user()->name}}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>AB</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{Auth::user()->name}}</span>
                                                    <span class="sub-text">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
{{--                                                <li><a href="html/ecommerce/user-profile.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>--}}
{{--                                                <li><a href="html/ecommerce/user-profile.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>--}}
                                                <li><a href="{{route('user.profile')}}"><em class="icon ni ni-activity-alt"></em><span>Profile</span></a></li>
                                                <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="javascript:void(0)" onclick="$('#logout-form').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                            </ul>
                                        </div>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="col-lg-12">
                                @if(session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; 2021 DashLite. Template by <a href="https://softnio.com" target="_blank">Softnio</a>
                        </div>
                        <div class="nk-footer-links">
                            <ul class="nav nav-sm">
                                <li class="nav-item dropup">
                                    <a herf="#" class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="language-list">
                                            <li>
                                                <a href="#" class="language-item">
                                                    <span class="language-name">English</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="language-item">
                                                    <span class="language-name">Espa??ol</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="language-item">
                                                    <span class="language-name">Fran??ais</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="language-item">
                                                    <span class="language-name">T??rk??e</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="#" data-toggle="modal" data-target="#region" class="nav-link"><em class="icon ni ni-globe"></em><span class="ml-1">Select Region</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{url('/backend')}}/assets/js/bundle.js?ver=2.9.0"></script>
<script src="{{url('/backend')}}/assets/js/scripts.js?ver=2.9.0"></script>
<script src="{{url('/backend')}}/assets/js/charts/chart-ecommerce.js?ver=2.9.0"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@yield('script')
</body>

</html>



