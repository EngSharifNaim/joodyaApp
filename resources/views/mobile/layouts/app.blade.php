<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>جوديا - joodya</title>

    <!-- Global stylesheets -->
{{--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
    <link href="{{url('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
{{--    <link href="{{url('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">--}}
    <link href="{{url('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/jquery.toast.min.css') }}">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{url('js/ohsnap.js')}}"></script>

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
<div class="navbar navbar-expand-md navbar-dark fixed-bottom">
    <div class="navbar-brand">
        <a href="{{url('/mobile')}}">
            <img src="{{url('global_assets/images/logo_light.png')}}" alt="">
        </a>

    </div>
    <div>
        <a href="{{URL::to('mobile/cartDetails')}}" class="nav-link @if(isset($page) && $page=='cart') active @endif">عرض السلة <i class="icon-basket mr-2"></i>
                @if(Auth::check())
                    (<span id="cart_count">{{$count = DB::table('restaurant_order')->where('user_id', Auth::id())->where('status',0)->count('item_price')}}</span>)
                @else
                        (<span id="cart_count">{{$count = DB::table('restaurant_order')->where('user_id', Session('localUser'))->where('status',0)->count('item_price')}}</span>)

                @endif
            </a>

    </div>
    <div>

    </div>
    <div class="d-md-none">
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            @if(Auth::check())
                {{Auth::user()->first_name . ' ' .  Auth::user()->last_name}}
                @else
                دخول
            @endif
            <i class="icon-user-tie"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-git-compare"></i>
                    <span class="d-md-none ml-2">Git updates</span>
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">9</span>
                </a>

                <div class="dropdown-menu dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Git updates</span>
                        <a href="#" class="text-default"><i class="icon-sync"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>
                                </div>

                                <div class="media-body">
                                    Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                    <div class="text-muted font-size-sm">4 minutes ago</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-transparent border-warning text-warning rounded-round border-2 btn-icon"><i class="icon-git-commit"></i></a>
                                </div>

                                <div class="media-body">
                                    Add full font overrides for popovers and tooltips
                                    <div class="text-muted font-size-sm">36 minutes ago</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-transparent border-info text-info rounded-round border-2 btn-icon"><i class="icon-git-branch"></i></a>
                                </div>

                                <div class="media-body">
                                    <a href="#">Chris Arney</a> created a new <span class="font-weight-semibold">Design</span> branch
                                    <div class="text-muted font-size-sm">2 hours ago</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-transparent border-success text-success rounded-round border-2 btn-icon"><i class="icon-git-merge"></i></a>
                                </div>

                                <div class="media-body">
                                    <a href="#">Eugene Kopyov</a> merged <span class="font-weight-semibold">Master</span> and <span class="font-weight-semibold">Dev</span> branches
                                    <div class="text-muted font-size-sm">Dec 18, 18:36</div>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>
                                </div>

                                <div class="media-body">
                                    Have Carousel ignore keyboard events
                                    <div class="text-muted font-size-sm">Dec 12, 05:46</div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer bg-light">
                        <a href="#" class="text-grey mr-auto">All updates</a>
                        <div>
                            <a href="#" class="text-grey" data-popup="tooltip" title="Mark all as read"><i class="icon-radio-unchecked"></i></a>
                            <a href="#" class="text-grey ml-2" data-popup="tooltip" title="Bug tracker"><i class="icon-bug2"></i></a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-people"></i>
                    <span class="d-md-none ml-2">Users</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-300">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Users online</span>
                        <a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{url('global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Jordana Ansley</a>
                                    <span class="d-block text-muted font-size-sm">Lead web developer</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{url('global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Will Brason</a>
                                    <span class="d-block text-muted font-size-sm">Marketing manager</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-danger"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{url('global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Hanna Walden</a>
                                    <span class="d-block text-muted font-size-sm">Project manager</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{url('global_assets/images/placeholders/placeholder.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Dori Laperriere</a>
                                    <span class="d-block text-muted font-size-sm">Business developer</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-warning-300"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Vanessa Aurelius</a>
                                    <span class="d-block text-muted font-size-sm">UX expert</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-grey-400"></span></div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer bg-light">
                        <a href="#" class="text-grey mr-auto">All users</a>
                        <a href="#" class="text-grey"><i class="icon-gear"></i></a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="d-md-none ml-2">Messages</span>
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">2</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Messages</span>
                        <a href="#" class="text-default"><i class="icon-compose"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3 position-relative">
                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">James Alexander</span>
                                            <span class="text-muted float-right font-size-sm">04:58</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3 position-relative">
                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold"></span>
                                            <span class="text-muted float-right font-size-sm">12:16</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">That was something he was unable to do because...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Jeremy Victorino</span>
                                            <span class="text-muted float-right font-size-sm">22:48</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">But that would be extremely strained and suspicious...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Beatrix Diaz</span>
                                            <span class="text-muted float-right font-size-sm">Tue</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Richard Vango</span>
                                            <span class="text-muted float-right font-size-sm">Mon</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer justify-content-center p-0">
                        <a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Load more"><i class="icon-menu7 d-block top-0"></i></a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
                    <span></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
                    <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-blue ml-auto">58</span></a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
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

{{--                    <li class="nav-item nav-item-submenu">--}}
{{--                        <a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span> ادارة الطلبات</span></a>--}}

{{--                        <ul class="nav nav-group-sub" data-submenu-title="Themes">--}}
{{--                            <li class="nav-item"><a href="{{url('mobile/restaurantNewOrders')}}" class="nav-link">طلبات جديدة</a></li>--}}
{{--                            <li class="nav-item"><a href="{{url('mobile/orderArchive')}}" class="nav-link">ارشيف الطلبات</a></li>--}}
{{--                            <!--<li class="nav-item"><a href="#" class="nav-link">طلبات جديدة</a></li>-->--}}
{{--                            <!--<li class="nav-item"><a href="#" class="nav-link">ارشيف الطلبات</a></li>-->--}}


{{--                        </ul>--}}
{{--                    </li>--}}
                        @else
                        <div class="row">
                            <div class="container">
                            <form method="post" action="{{url('login')}}">
                                {{csrf_field()}}
                                <div class="row" style="padding-bottom: 2px">
                                    <div class="col col-md-12"><input class="form-control" type="text" required name="email" id="login_email" placeholder="الايميل"></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-12" style="padding-bottom: 2px"><input class="form-control" type="password" required name="password" id="login_password" placeholder="كلمة المرور"></div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-12"><button type="submit" class="btn btn-success btn-block">دخول</button></div>
                                </div>



                            </form>
                                <hr>
{{--                                register new customer form--}}
                                <h5>لست عضو, انضم الآن...</h5>
                                <form method="post" action="{{url('register')}}" id="myProfile" role="form">
                                    {{csrf_field()}}
                                    @if(Session::has('flash_message'))
                                    <div>

                                            <div class="alert alert-success fade in">

                                                {{ Session::get('flash_message') }}
                                            </div>

                                    </div>
                                    @endif
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="first_name" id="first_name" placeholder="الاسم الاول"></div>
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="last_name" id="last_name" placeholder="اسم العائلة"></div>

                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="email" id="register_email" placeholder="الايمل"></div>

                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12"><input class="form-control" type="text" required name="mobile" id="mobile" placeholder="الجوال"></div>

                                    </div>
                                    <div class="row" style="padding-bottom: 2px">
                                        <div class="col col-md-12">
                                            <input required type="password" id="register_password" name="password" value="" class="form-control" placeholder="كلمة مرور">
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
                                                <input type="text" name="usertype" hidden value="User">


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
            <div class="nav-tabs-responsive mb-3 fixed-top" style="direction: rtl; background-color: #fff">
                <ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
                    <li class="nav-item"><a href="{{url('/mobile')}}" class="nav-link @if(isset($page) && $page=='main') active @endif"><i class="icon-display4 mr-2"></i> الرئيسية</a></li>
                    <li class="nav-item"><a href="{{url('/mobile/restaurants')}}" class="nav-link @if(isset($page) && $page=='restaurants') active @endif"><i class="icon-people mr-2"></i> مطابخ</a></li>
                    <li class="nav-item"><a href="{{url('/mobile/offers')}}" class="nav-link @if(isset($page) && $page=='offers') active @endif"><i class="icon-image2 mr-2"></i> عروض</a></li>
{{--                    @if(Auth::check())--}}

{{--                        @else--}}
{{--                        <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket mr-2"></i>({{$count = DB::table('cart')->where('user_id', Auth::id())->count('item_price')}}) </a></li>--}}
{{--                    @endif--}}
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
<script type="text/javascript">
    function add_to_cart(item_id,restaurant){
        quantity = $('#qty'+item_id).val();

        var rout = "../../mobile/add_to_cart/" + item_id + '/' + restaurant + '/' + quantity;
        $.ajax({
            url: rout,
            // method:'get',
            dataType:'json',
            // contentType: false,
            // cache: false,
            // processData:false,
            beforeSend:function(){
                console.log('success');
                $('#add_to_cart').attr('disabled','disabled');
            },
            success:function(data) {
                console.log('sucess');
                if (data.error) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                }
                else {
                    if (data.fail == '') {
                        console.log('success');
                        document.getElementById('add_to_cart' + item_id).innerHTML = data.success;
                        document.getElementById('cart_count').innerHTML = parseInt(document.getElementById('cart_count').innerHTML) + 1;

                        Swal.fire({
                            // position: 'top-end',
                            type: 'success',
                            title: 'تمت اضافة المنتج بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                    else {
                        console.log('faild')
                    }
                }
                $('#add_to_cart').attr('disabled', false);



            }

        });
    }

    function like_item(item_id){

        var rout = "../../mobile/like_item/" + item_id;
        $.ajax({
            url: rout,
            // method:'get',
            dataType:'json',
            // contentType: false,
            // cache: false,
            // processData:false,
            beforeSend:function(){
                $('#like_item').attr('disabled','disabled');
            },
            success:function(data) {
                if (data.error) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                }
                else {
                    if (data.fail == '') {
                        document.getElementById('like_item'+ item_id).innerHTML = 'معجب به'
                        document.getElementById('like_item'+ item_id).setAttribute('href', "javascript:;");

                    }
                    else {
                        console.log('error')

                    }
                }
                $('#like_item' + item_id).attr('disabled', false);

            }

        });
    }
    function h_price(item_id){

        var rout = "../../mobile/h_price/" + item_id;
        $.ajax({
            url: rout,
            // method:'get',
            dataType:'json',
            // contentType: false,
            // cache: false,
            // processData:false,
            beforeSend:function(){
                $('#h_price').attr('disabled','disabled');
            },
            success:function(data) {
                if (data.error) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                }
                else {
                    if (data.fail == '') {
                        document.getElementById('h_price'+ item_id).innerHTML = 'سعر مرتفع';
                        document.getElementById('h_price'+ item_id).setAttribute('href', "javascript:;");


                    }
                    else {
                        console.log('error')

                    }
                }
                $('#h_price' + item_id).attr('disabled', false);

            }

        });
    }
    function not_clear(item_id){

        var rout = "../../mobile/not_clear/" + item_id;
        $.ajax({
            url: rout,
            // method:'get',
            dataType:'json',
            // contentType: false,
            // cache: false,
            // processData:false,
            beforeSend:function(){
                $('#not_clear').attr('disabled','disabled');
            },
            success:function(data) {
                if (data.error) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                }
                else {
                    if (data.fail == '') {
                        document.getElementById('not_clear'+ item_id).innerHTML = 'غير واضح';
                        document.getElementById('not_clear'+ item_id).setAttribute('href', "javascript:;");


                    }
                    else {
                        console.log('error')

                    }
                }
                $('#not_clear' + item_id).attr('disabled', false);

            }

        });
    }

</script>
