<!DOCTYPE html>
<html lang="en">
<head>

    <title>{{$basic->sitename}} | {{$page_title}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('assets/images/logo/favicon.png')}}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <!-- Main CSS-->
    <link href="{{asset('assets/admin/css/main.css')}}" rel="stylesheet" >
    <!-- Font-icon css-->
    <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/fontawesome-iconpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/bootstrap-fileinput.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/table.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet">
    @yield('css')
    <link href="{{asset('assets/admin/css/sweetalert.css')}}"  rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/NicEdit/0.93/nicEdit.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/NicEdit/0.93/nicEditorIcons.gif">
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="{{url('/')}}">{{$basic->sitename}}</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="{{route('admin.changePass')}}"><i class="fa fa-cog fa-lg"></i> Password Settings</a></li>
                <li><a class="dropdown-item" href="{{route('admin.profile')}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" class="img-circle" src="{{asset('assets/admin/img/'.Auth::guard('admin')->user()->image)}}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::guard('admin')->user()->name }} </p>
            <p class="app-sidebar__user-designation">{{ Auth::guard('admin')->user()->username }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item @if(request()->path() == 'admin/dashboard') active @endif" href="{{route('admin.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        @php
        $newReportCount = \App\Report::where('is_read',0)->where('report_from', '!=',0)->count();
        @endphp
        <li>
            <a class="app-menu__item @if(request()->path() == 'admin/reports') active @endif" href="{{route('admin.reports')}}">
                <i class="app-menu__icon fa fa-flag"></i><span class="app-menu__label">Manage Reports</span>
                @if($newReportCount>0)<span class="badge badge-danger">{{$newReportCount}} new</span>@endif
            </a>
        </li>



        <li class="treeview @if(request()->path() == 'admin/post-category') is-expanded
                @elseif(request()->path() == 'admin/blog') is-expanded
                @endif ">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Manage Blog</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/post-category') active @endif" href="{{route('admin.cat')}}"><i class="icon fa fa-pencil"></i>  Category</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/blog') active @endif" href="{{route('admin.blog')}}"><i class="icon fa fa-newspaper-o"></i> All Blog</a></li>
            </ul>
        </li>

        <li class="treeview  @if(request()->path() == 'admin/users')  is-expanded
                @elseif(request()->path() == 'admin/user-banned')  is-expanded
                @elseif(request()->path() == 'admin/user/{user}')  is-expanded
                        @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Manage User</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/users') active @endif" href="{{route('users')}}"><i class="icon fa fa-user"></i> Users</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/user-banned') active @endif" href="{{route('user.ban')}}" rel="noopener"><i class="icon fa fa-ban"></i> Banned User</a></li>
            </ul>
        </li>


        <li class="treeview @if(request()->path() == 'admin/deposits') is-expanded
                @elseif(request()->path() == 'admin/gateway') is-expanded
                @endif ">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-credit-card"></i><span class="app-menu__label">Manage Deposit</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/deposits') active @endif" href="{{route('deposits')}}"><i class="icon fa fa-credit-card"></i> Deposit Log</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/gateway') active @endif" href="{{route('gateway')}}"><i class="icon fa fa-credit-card"></i> Deposit Method</a></li>
            </ul>
        </li>
        <li class="treeview ">
            <a class="app-menu__item" href="{{route('cards.index')}}" ><i class="app-menu__icon fa fa-credit-card"></i><span class="app-menu__label">Credit Cards</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            
        </li>

        <li class="treeview @if(request()->path() == 'admin/withdraw') is-expanded
                @elseif(request()->path() == 'admin/withdraw/requests') is-expanded
                @elseif(request()->path() == 'admin/withdraw/approved') is-expanded
                @elseif(request()->path() == 'admin/withdraw/refunded') is-expanded
                @endif ">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-money"></i>
                <span class="app-menu__label">Manage Withdraw </span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/withdraw/requests') active @endif" href="{{route('withdraw.requests')}}"><i class="icon fa fa-money"></i> Withdraw Request</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/withdraw/approved') active @endif" href="{{route('withdraw.approved')}}"><i class="icon fa fa-money"></i> Withdraw Approved</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/withdraw/refunded') active @endif" href="{{route('withdraw.refunded')}}"><i class="icon fa fa-money"></i> Withdraw Refunded</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/withdraw') active @endif" href="{{route('withdraw')}}"><i class="icon fa fa-money"></i> Withdraw Method</a></li>
            </ul>
        </li>
        <li><a class="app-menu__item @if(request()->path() == 'admin/subscribers') active @endif" href="{{route('manage.subscribers')}}"><i class="app-menu__icon fa fa-thumbs-up"></i><span class="app-menu__label">All Subscribers</span></a></li>

        <li class="treeview @if(request()->path() == 'admin/general-settings') is-expanded
                                @elseif(request()->path() == 'admin/template') is-expanded
                                @elseif(request()->path() == 'admin/sms-api') is-expanded
                                @elseif(request()->path() == 'admin/contact-setting') is-expanded
                            @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bars"></i><span class="app-menu__label">Website Control</span><i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/general-settings') active @endif" href="{{route('admin.GenSetting')}}"><i class="icon fa fa-cogs"></i> General Setting </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/template') active @endif" href="{{route('email.template')}}"><i class="icon fa fa-envelope"></i> Email Setting</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/sms-api') active @endif" href="{{route('sms.api')}}"><i class="icon fa fa-mobile"></i> SMS Setting</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/contact-setting') active @endif" href="{{route('contact-setting')}}"><i class="icon fa fa-phone"></i> Contact Setting </a></li>
            </ul>
        </li>


        <li class="treeview     @if(request()->path() == 'admin/manage-logo') is-expanded
                                @elseif(request()->path() == 'admin/manage-text') is-expanded
                                @elseif(request()->path() == 'admin/manage-social') is-expanded
                                @elseif(request()->path() == 'admin/menu-control') is-expanded
                                @elseif(request()->path() == 'admin/manage-about') is-expanded
                                @elseif(request()->path() == 'admin/manage-terms') is-expanded
                                @elseif(request()->path() == 'admin/manage-privacy') is-expanded
                                @elseif(request()->path() == 'admin/advertisement') is-expanded
                                @elseif(request()->path() == 'admin/faqs-create') is-expanded
                                @elseif(request()->path() == 'admin/faqs-all') is-expanded
                            @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-desktop"></i><span class="app-menu__label">Interface Control</span><i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/manage-logo') active @endif" href="{{route('manage-logo')}}"><i class="icon fa fa-photo"></i> Logo & favicon </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/manage-text') active @endif" href="{{route('manage-footer')}}"><i class="icon fa fa-file-text"></i> Manage  Text </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/manage-social') active @endif" href="{{route('manage-social')}}"><i class="icon fa fa-share-alt-square"></i> Manage Social </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/menu-control') active @endif" href="{{route('menu-control')}}"><i class="icon fa fa-desktop"></i> Menu Control </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/advertisement') active @endif" href="{{url('admin/advertisement')}}"><i class="icon fa fa-image"></i> Manage Advertisement </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/manage-about') active @endif" href="{{route('manage-about')}}"><i class="icon fa fa-info-circle"></i> Manage About </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/faqs-create') active @endif" href="{{route('faqs-create')}}"><i class="icon fa fa-plus"></i> New Faq </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/faqs-all') active @endif" href="{{route('faqs-all')}}"><i class="icon fa fa-photo"></i> Manage Faqs </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/our-client') active @endif" href="{{route('our.client')}}"><i class="icon fa fa-photo"></i> Our Client </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/our-team') active @endif" href="{{route('team')}}"><i class="icon fa fa-photo"></i> Our Team </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/slider') active @endif" href="{{route('slider')}}"><i class="icon fa fa-photo"></i> Manage Slider </a></li>
            </ul>
        </li>



    </ul>
</aside>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        </ul>
    </div>
    @yield('body')



</main>
<!-- Essential javascripts for application to work-->
<script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap-fileinput.js')}}" ></script>
<script src="{{asset('assets/admin/js/fontawesome-iconpicker.min.js')}}" ></script>
<script src="{{asset('assets/admin/js/toastr.min.js')}}" ></script>
<script src="{{asset('assets/admin/js/sweetalert.js')}}"></script>
<script src="{{asset('assets/admin/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('assets/admin/js/pace.min.js')}}"></script>
<!-- Page specific javascripts-->
@yield('script')
@if (session('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            swal("Success!", "{{ session('success') }}", "success");
        });
    </script>
@endif

@if (session('alert'))
    <script type="text/javascript">
        $(document).ready(function () {
            swal("Sorry!", "{{ session('alert') }}", "error");
        });
    </script>
@endif
<script type="text/javascript">
            @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
    @endif
</script>



</body>
</html>