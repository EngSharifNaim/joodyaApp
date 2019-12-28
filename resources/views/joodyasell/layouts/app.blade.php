<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152940688-1"></script>--}}
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-152940688-1');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
    <link href="{{url('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
{{--    <link href="{{url('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <link href="{{url('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <link href="{{url('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">--}}
    <link href="{{url('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/jquery.toast.min.css') }}">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script src="{{url('global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{url('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{url('assets/js/app.js')}}"></script>
    <title>JoodyaSell</title>

    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif,;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background-image: url(../nsite_assets/images/joodyasell.png);
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="pb-1">
        <h3 class="font-weight-semibold">
            @if(Auth::check())
                {{Auth::user()->first_name . ' ' . Auth::user()->last_name . ' ' . session('restaurant_id')}}
                @endif
        </h3>

        <div class="navbar navbar-expand-xl navbar-light navbar-component rounded-top mb-0">
            <div class="navbar-brand">
                <a href="index.html" class="d-inline-block">
                    <img src="{{url('images/logo.png')}}" alt="">
                </a>
            </div>

            <div class="d-xl-none">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-demo-light">
                    <i class="icon-menu"></i>
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-demo-light">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="{{url('joodyasell')}}" class="navbar-nav-link">
                            <i class="icon-home mr-2"></i>
                            الرئيسية
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{url('/joodyasell/restaurantProfile')}}" class="navbar-nav-link">
                            <i class="icon-profile mr-2"></i>
                            مطبخي
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{url('/joodyasell/logout')}}" class="navbar-nav-link">
                            <i class="icon-exit3 mr-2"></i>
                            خروج
                        </a>
                    </li>



                </ul>


            </div>
        </div>

        <div class="card card-body border-top-0 rounded-0 rounded-bottom tab-content">
            @yield('content')
        </div>
    </div>

</div>
</body>
</html>
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
                        document.getElementById('new_order').innerHTML = data;
                        // location.reload();

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
