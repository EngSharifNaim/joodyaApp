<!-- Sidebar right -->
<div class="sidebar right-side" id="sidebar-right">

    <!-- Wrapper Reqired by Nicescroll (start scroll from here) -->
    <div class="nicescroll">
        <div class="wrapper" style="margin-bottom:90px">
            <ul class="nav nav-sidebar" id="sidebar-menu" style="font-family: Tahoma">

                @if(Auth::user()->usertype=='Admin')

                    <li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i>الرئيسية</a></li>

                    <li class="{{classActivePath('types')}}"><a href="{{ URL::to('admin/types') }}"><i class="fa fa-tags"></i>أصناف المطابخ</a></li>
                    <li class="{{classActivePath('types')}}"><a href="#"><i class="fa fa-tags"></i>أقسام المنيو</a></li>
                    >

                    <li class="{{classActivePath('restaurants')}}"><a href="{{ URL::to('admin/restaurants') }}"><i class="fa fa-cutlery"></i>المطابخ</a></li>

                    <li class="{{classActivePath('allorder')}}"><a href="{{ URL::to('admin/allorder') }}"><i class="fa fa-cart-plus"></i>الطلبيات</a></li>

                    <li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}"><i class="fa fa-user"></i>المستخدمين</a></li>
                    <li class="{{classActivePath('owners')}}"><a href="{{ URL::to('admin/owners') }}"><i class="fa fa-user"></i>طباخين</a></li>
                    <li class="{{classActivePath('suppliers')}}"><a href="{{ URL::to('admin/suppliers') }}"><i class="fa fa-user"></i>موردين</a></li>
                    <li class="{{classActivePath('drivers')}}"><a href="{{ URL::to('admin/drivers') }}"><i class="fa fa-user-secret"></i>السائقين</a></li>

                    <li class="{{classActivePath('widgets')}}"><a href="{{ URL::to('admin/widgets') }}"><i class="fa fa-plus"></i>أقسام الموقع</a></li>

                    <li class="{{classActivePath('settings')}}"><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i>الإعدادات</a></li>

                @else

                    <li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i>الرئيسية</a></li>


                    <li class="{{classActivePath('restaurants')}}"><a href="{{ URL::to('admin/myrestaurants') }}"><i class="fa fa-cutlery"></i>مطابخي</a></li>

                    @if(count(App\restaurants::where('user_id','=',Auth::user()->id)->get())>0)

                        <li class="{{classActivePath('menu')}}"><a href="{{ URL::to('admin/menu') }}"><i class="fa fa-folder"></i>الوجبات</a></li>

                        <li class="{{classActivePath('orderlist')}}"><a href="{{ URL::to('admin/orderlist') }}"><i class="fa fa-cart-plus"></i>الطلبيات</a></li>
                        <li class="{{classActivePath('reviews')}}"><a href="{{ URL::to('admin/reviews') }}"><i class="md-rate-review"></i>التقييمات</a></li>
                    @endif


                @endif


            </ul>


        </div>
    </div>
</div>
<!-- // Sidebar -->

<!-- Sidebar Right -->
<div class="sidebar left-side" id="sidebar-left">
    <!-- Wrapper Reqired by Nicescroll -->
    <div class="nicescroll">
        <div class="wrapper">
            <div class="block-primary">
                <div class="media">
                    <div class="media-right media-middle">
                        <a href="#">
                            @if(Auth::user()->image_icon)

                                <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="60" alt="person" class="img-circle border-white">

                            @else

                                <img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle border-white" width="60"/>

                            @endif
                        </a>
                    </div>
                    <div class="media-body media-middle">
                        <a href="{{ URL::to('admin/profile') }}" class="h4">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                        <a href="{{ URL::to('admin/logout') }}" class="logout pull-right"><i class="md md-exit-to-app"></i></a>
                    </div>
                </div>
            </div>
            <ul class="nav nav-sidebar" id="sidebar-menu">
                <li><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> الحساب</a></li>

                @if(Auth::user()->usertype=='Admin')

                    <li><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i> الإعدادات</a></li>

                @endif

                <li><a href="{{ URL::to('admin/logout') }}"><i class="md md-exit-to-app"></i> تسجيل خروج</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- // Sidebar -->
