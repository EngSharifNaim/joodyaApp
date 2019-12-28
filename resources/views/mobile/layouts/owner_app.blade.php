<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{url('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/jquery.toast.min.css') }}">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{url('global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{url('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{url('assets/js/app.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="{{url('/mobile')}}">
            <img src="{{url('global_assets/images/logo_light.png')}}" alt="">
        </a>

    </div>
    <div>
        @if(Auth::check())
            أهلا بك : {{Auth::user()->first_name . ' ' .  Auth::user()->last_name}}
        @endif
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>

        </ul>


        <ul class="navbar-nav">



        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-right8"></i>
            </a>
            @if(Auth::check())

                <a href="{{url('logout')}}" class="">
                    <i class="icon icon-exit"></i>
                </a>
            @endif

        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#"><img src="{{url('global_assets/images/placeholders/user.png')}}" width="38" height="38" class="rounded-circle" alt=""></a>
                        </div>

                        <div class="media-body">
                            <div class="media-title font-weight-semibold">
                                @if(Auth::check())
                                    <h4>{{Auth::user()->first_name . ' ' . Auth::user()->last_name}}</h4>

                                @else
                                    زائر
                                @endif
                            </div>
                            <div class="font-size-xs opacity-50">
                                {{--                                <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA--}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <!-- Main -->
                    @if(Auth::check())

                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span> ادارة الطلبات</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Themes">
                                <li class="nav-item"><a href="{{url('mobile/restaurantNewOrders')}}" class="nav-link">طلبات جديدة</a></li>
                                <li class="nav-item"><a href="{{url('mobile/orderArchive')}}" class="nav-link">ارشيف الطلبات</a></li>
                                {{--                            <li class="nav-item"><a href="#" class="nav-link">طلبات جديدة</a></li>--}}
                                {{--                            <li class="nav-item"><a href="#" class="nav-link">ارشيف الطلبات</a></li>--}}


                            </ul>
                        </li>
                    @else
                        <div class="row">
                            <div class="container">
                                <form method="post" action="{{url('login')}}">
                                    {{csrf_field()}}
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="email" id="email" placeholder="الايميل"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-12" style="padding-bottom: 2px"><input class="form-control" type="password" required name="password" id="password" placeholder="كلمة المرور"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-12"><button type="submit" class="btn btn-success btn-block">دخول</button></div>
                                    </div>



                                </form>
                                <hr>
                                <h5>لست عضو, انضم الآن...</h5>
                                <form method="post" action="{{url('register')}}" id="myProfile" role="form">
                                    {{csrf_field()}}
                                    <div>
                                        @if(Session::has('flash_message'))
                                            <div class="alert alert-success fade in">

                                                {{ Session::get('flash_message') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="first_name" id="first_name" placeholder="الاسم الاول"></div>
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="last_name" id="last_name" placeholder="اسم العائلة"></div>

                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="email" id="email" placeholder="الايمل"></div>

                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="mobile" id="mobile" placeholder="الجوال"></div>

                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12">
                                            <input required type="password" id="password" name="password" value="" class="form-control" placeholder="كلمة مرور">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12">
                                            <input required type="password" id="password_confirmation" name="password_confirmation" value="" class="form-control" placeholder="تأكيد كلمة المرور">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12">
                                            <div class="form-group">
                                                <select class="form-control" name="usertype" id="usertype">
                                                    <option value="User">زبون</option>
                                                    <option value="Owner">أسرة منتجة</option>
                                                    <option value="supplyer">مورد</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-12"><button type="submit" class="btn btn-success btn-block">تسجيل</button></div>
                                    </div>



                                </form>
                            </div>
                        </div>
                @endif

                <!-- /main -->

                    <!-- /forms -->

                    <!-- Components -->

                    <!-- Layout -->

                    <!-- /data visualization -->

                    <!-- /extensions -->

                    <!-- /tables -->

                    <!-- /page kits -->

                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->

        <!-- /page header -->


        <!-- Content area -->
        <div class="content">

            <!-- Search field -->
            <!-- /search field -->


            <!-- Tabs -->
            <div class="nav-tabs-responsive mb-3" style="direction: rtl">
                <ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
                    <li class="nav-item"><a href="{{url('/mobile')}}" class="nav-link @if(isset($page) && $page=='main') active @endif"><i class="icon-display4 mr-2"></i> الرئيسية</a></li>
                    <li class="nav-item"><a href="{{url('/mobile/myRestaurant')}}" class="nav-link @if(isset($page) && $page=='restaurants') active @endif"><i class="icon-people mr-2"></i> مطبخي</a></li>
                    <li class="nav-item"><a href="{{url('/mobile/offers')}}" class="nav-link @if(isset($page) && $page=='offers') active @endif"><i class="icon-image2 mr-2"></i> وجباتي</a></li>
                    @if(Auth::check())
                        <li class="nav-item"><a href="{{URL::to('mobile/cartDetails')}}" class="nav-link @if(isset($page) && $page=='cart') active @endif"><i class="icon-basket mr-2"></i>({{$count = DB::table('cart')->where('user_id', Auth::id())->count('item_price')}}) </a></li>
                    @else
                        <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket mr-2"></i>({{$count = DB::table('cart')->where('user_id', Auth::id())->count('item_price')}}) </a></li>
                    @endif
                </ul>
            </div>
            <!-- /tabs -->


            <!-- Search results -->
        @yield('content')
        <!-- /search results -->

        </div>
        <!-- /content area -->


        <!-- Footer -->
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->
</body>
</html>
<script src="{{ URL::asset('admin_assets/js/jquery.toast.min.js') }}"></script>
@if(Auth::check())
    @if( \Auth::user()->usertype=='Owner')

        <script>

            $( document ).ready(function() {

                var base_url = window.location.origin;
                function fn60sec() {

                    $.ajax({
                        url: base_url+'/admin/orderlist/cheack',
                        dataType: 'json',
                        type: 'get',
                        contentType: 'application/json',
                        success: function( data, textStatus, jQxhr ){
                            //	$('#response pre').html( JSON.stringify( data ) );
                            console.log( data );

                            if(data > 0 ){
                                var audio = new Audio('https://www.joodya.com/beep.mp3');
                                audio.play();

                                $.toast({
                                    heading: 'طلبات غير مكتملة',
                                    text: 'يوجد طلبات لم تكتمل بعد  : <a href="'+base_url+'/mobile/restaurantNewOrders'+'"> القائمة </a>',
                                    showHideTransition: 'fade',
                                    icon: 'info',
                                    hideAfter: 5000
                                })
                            }
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                        }
                    });




                }
                fn60sec();
                setInterval(fn60sec, 15*1000);
            });

        </script>
    @endif
@endif
