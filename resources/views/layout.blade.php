<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$page_title}} | {{$basic->sitename}}  </title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <!-- pe icon  -->
    <link rel="stylesheet" href="{{asset('assets/front/css/pe-icon-7-stroke.min.css')}}">
    <!-- fontawesome icon  -->
    <link rel="stylesheet" href="{{asset('assets/front/css/fontawesome-all.min.css')}}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{asset('assets/front/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front/css/sweetalert.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/toastr.min.css')}}" />
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
    @yield('css')
    <link rel="stylesheet"  href="{{asset('assets/front/css/style.php')}}?color={{ $basic->color }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Grenze&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,600i,700&display=swap" rel="stylesheet">
</head>
<style type="text/css">
    body{
        background: #F8F9FA;
        font-family: 'Raleway', sans-serif !important;
    }
    h1,h2,h3,h4,h5,h6{
        font-family: 'Raleway', sans-serif !important;
        font-weight: bold;
    }
</style>
<body>
{!! $basic->fb_comment !!}
<!-- top bar area start -->
<div class="topbar-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="topbar-inner"><!-- topbar inner start -->
                    <div class="topbar-left-content"><!-- topbar left content -->
                        <ul class="social-share">
                            @foreach($social as $data)
                                <li class="social-item">
                                    <a href="{!! $data->link !!}" class="social-link">
                                        {!! $data->code !!}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- /.topbar left content -->
                    <div class="topbar-right-content">
                        <span class="ex-text">@if(Auth::user())  Balance : {{round(Auth::user()->balance , $basic->decimal)}} {{$basic->currency}} @else {!! $basic->experience !!} @endif</span>
                    </div>
                    <!-- topbar right content end-->
                </div><!-- topbar inner end -->
            </div>
        </div> <!-- row end -->
    </div><!-- container end -->
</div>
<!-- tp bar area end -->

<!-- support bar area start  -->
<section class="support-bar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-3">
                <a href="{{url('/')}}" class="logo">
                    {{-- <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo" class="max-logo-img" style='max-width: 220px;'>--}}
                    <p style="font-size: 50px !important; font-weigth: bolder; font-family: 'Grenze', serif;">Genie<span style="color:#FBD161 !important;">Escrow</span></p>
                </a> 
            </div>
            <div class="col-lg-9 col-sm-12 col-md-9">
                <div class="support-bar-content"><!-- support bar content -->
                    <ul>
                        <li>
                            <div class="single-support-item"><!-- single support item -->
                                <div class="icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="content"><!-- content -->
                                    <h5>{!! $basic->phone !!}</h5>
                                    <a><span class="email">{!! $basic->email !!}</span></a>
                                </div><!-- /.content -->
                            </div><!-- /.single support item -->
                        </li>
                        <li>
                            {{-- <div class="single-support-item"><!-- single support item -->
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="content"><!-- content -->
                                    @php
                                        $split = explode(" ",  $basic->address);
                                    $lastSpacePosition = strrpos($basic->address," ");
                                    $textWithoutLastWord =substr($basic->address,0,$lastSpacePosition);
                                    @endphp

                                    <h5>{!! $textWithoutLastWord !!}</h5>
                                    <span class="loaction">{!! $split[count($split)-1] !!}</span>
                                </div><!-- /.content -->
                            </div><!-- /.single support item --> --}}
                        </li>
                    </ul>
                </div><!-- /.support bar content -->
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
<!-- support bar area end  -->

<!-- navbar area start -->
<nav class="navbar navbar-default navbar-area">
    <div class="container">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="nav-item  @if(request()->path() == '/') active @endif">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>

                @foreach($menus as $data)
                <li class="nav-item @if(request()->path() == 'menu/'.$data->slug) active @endif">
                    <a class="nav-link" href="{{route('menu',$data->slug)}}">{{$data->name}}</a>
                </li>
                @endforeach
                <li class="nav-item  @if(request()->path() == 'about-us') active @endif">
                    <a class="nav-link" href="{{route('about')}}">About</a>
                </li>
                {{-- <li class="nav-item @if(request()->path() == 'faqs') active @endif">
                    <a class="nav-link" href="{{route('faqs')}}">Faqs</a>
                </li> --}}
               <!--  <li class="nav-item @if(request()->path() == 'blog') active @endif">
                    <a class="nav-link" href="{{route('blog')}}">Blog</a>
                </li> -->
                <li class="nav-item @if(request()->path() == 'contact-us') active @endif">
                    <a class="nav-link" href="{{route('contact')}}">contact us</a>
                </li>


                @if(Auth::user())

                    <li class="nav-item dropdown
                        @if(request()->path() == 'user/edit-profile') active
                        @elseif(request()->path() == 'user/change-password') active
                        @endif">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false" href="">Hi {{ Auth::user()->username }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->email_verify != 0 && Auth::user()->phone_verify != 0)
                                @if(Auth::user()->status == 1)
                            <li class="@if(request()->path() == 'user/home') active @endif">
                                <a href="{{route('home')}}">Dashboard</a></li>
                            <li class="@if(request()->path() == 'user/edit-profile') active @endif">
                                <a href="{{route('edit-profile')}}">Edit Profile</a></li>

                            <li class="@if(request()->path() == 'user/change-password') active @endif">
                                <a href="{{route('user.change-password')}}">Change Password</a></li>
                                    @endif
                            @endif
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    @else

                    <li class="nav-item dropdown
                        @if(request()->path() == 'login') active
                        @elseif(request()->path() == 'register') active
                        @endif">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false" href="">Account
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="@if(request()->path() == 'login') active @endif">
                                <a href="{{route('login')}}">Sign In</a></li>
                            <li class="@if(request()->path() == 'register') active @endif">
                                <a href="{{route('register')}}">Sign Up</a></li>
                        </ul>
                    </li>
                @endif



            </ul>

        </div>
    </div>
    <div class="mobile-logo-wrapper disable-desktop">
        {{-- <a href="{{url('/')}}" class="logo">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo"  style='max-width: 220px;'> --}}
            <h3>Genie<span style="color:#FBD161 !important;">Escrow</span></h3>
            </a>
    </div>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1"
            aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
</nav>
<!-- navbar area end -->

@yield('content')

@include('partials.footer')

<!-- jquery -->
<script src="{{asset('assets/front/js/jquery.js')}}"></script>
<!-- bootstrap -->
<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<!-- owl carousel -->
<script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('assets/front/js/jquery.magnific-popup.js')}}"></script>
<!-- way poin js-->
<script src="{{asset('assets/front/js/waypoints.min.js')}}"></script>
<!-- wow js-->
<script src="{{asset('assets/front/js/wow.min.js')}}"></script>
<!-- counterup js-->
<script src="{{asset('assets/front/js/jquery.counterup.min.js')}}"></script>

<script src="{{asset('assets/front/js/sweetalert.js')}}" ></script>
<script src="{{asset('assets/front/js/toastr.min.js')}}" ></script>
@yield('script')
<!-- main -->
<script src="{{asset('assets/front/js/main.js')}}"></script>
@yield('js')
@if (session('success'))
<script>
    $(document).ready(function () {
        swal("Success!", "{{ session('success') }}", "success");
    });
</script>
@endif

@if (session('alert'))
<script>
    $(document).ready(function () {
        swal("Sorry!", "{{ session('alert') }}", "error");
    });
</script>
@endif
<script>
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