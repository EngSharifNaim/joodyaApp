
<header id="header">
    <div class="header">
        <div class="top-header">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <ul class="info-account list-inline-block pull-right">
                            @if(Auth::check())
                                <li><a href="{{ URL::to('logout') }}"><span class="color"><i class="fa fa-key"></i></span>تسجيل خروج</a></li>


                                @if (Auth::user()->usertype=='User')
                                    <li><a href="{{URL::to('myorder')}}"><span class="color"><i class="fa fa-check-circle-o"></i></span>الدفع</a></li>
                                @endif

                            @else
                                <li><a href="{{ URL::to('login') }}"><span class="color"><i class="fa fa-user-o"></i></span>دخول</a></li>
                                <li><a href="{{ URL::to('register') }}"><span class="color"><i class="fa fa-key"></i></span>تسجيل جديد</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Header -->
        <div class="main-header bg-color2">
            <div class="container">
                <div class="row main-header-row" >
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <form class="search-form pull-left">
                            <input onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="البحث في الموقع" type="text">
                            <input type="submit" value="" />
                        </form>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="logo logo1 logo6">
                            <h1 class="hidden">الجود</h1>
                            <a href="index.html"><img src="{{ URL::asset('nsite_assets/images/home/home6/logo.png') }}" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="mini-cart-box mini-cart1 pull-right">

                            @if(DB::table('cart')->where('user_id', Auth::id())->sum('item_price')>0)

                                <a class="mini-cart-link" href="{{URL::to('order_details')}}">
									<span class="mini-cart-icon title18 color"><i class="fa fa-shopping-basket"></i>
								</span>
                                    <span class="mini-cart-number"> {{$count = DB::table('cart')->where('user_id', Auth::id())->count('item_price')}} طلب
									</span>
                                    <span class="color">{{getcong('currency_symbol')}}{{$price = DB::table('cart')->where('user_id', Auth::id())->sum('item_price')}}</span>
                                </a>
                            @else
                                <a class="mini-cart-link" href="{{URL::to('order_details')}}">
                                    <span class="mini-cart-icon title18 color"><i class="fa fa-shopping-basket"></i></span>
                                    <span class="mini-cart-number">0 طلب - <span class="color">$ 0.000</span></span>
                                </a>
                            @endif
                            @if(DB::table('cart')->where('user_id', Auth::id())->sum('item_price')>0)

                                <div class="mini-cart-content text-left">
                                    <h2 class="title18 color">( {{DB::table('cart')->where('user_id', Auth::id())->sum('item_price')}} ) محتويات سلتي</h2>
                                    <div class="list-mini-cart-item">

                                    @foreach(\App\Cart::where('user_id', Auth::user()->id)->orderBy('item_id')
                                       ->leftJoin('menu', 'cart.item_id', '=', 'menu.id')
                                       ->take(3)->get() as $n=>$cart_item)

                                        <!--
			 	<tr>
                <td><a href="{{URL::to('delete_item/'.$cart_item->id)}}" class="remove_item"><i class="fa fa-minus-circle"></i></a> <strong>{{$cart_item->quantity}}x</strong> {{$cart_item->item_name}} </td>
                <td><strong class="pull-right">{{getcong('currency_symbol')}}{{$cart_item->item_price}}</strong></td>
			  </tr>
			-->

                                            <div class="product-mini-cart table">
                                                <div class="product-thumb">
                                                    <a href="detail.html" class="product-thumb-link">
                                                        @if($cart_item->menu_image)
                                                            <img src="{{ URL::asset('upload/menu/'.$cart_item->menu_image.'-s.jpg') }}" />
                                                        @else
                                                            <img src="{{ URL::asset('upload/menu_img_s.png') }}" />
                                                        @endif

                                                    </a>

                                                    @if($cart_item->menu_image)
                                                        <a href="{{ URL::asset('upload/menu/'.$cart_item->menu_image.'-s.jpg') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="{{ URL::asset('upload/menu_img_s.png') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>

                                                    @endif


                                                </div>
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="#">{{$cart_item->item_name}}</a></h3>
                                                    <div class="product-price">
                                                        <ins><span>{{getcong('currency_symbol')}}{{$cart_item->item_price}}</span></ins>
                                                        <!--<del><span>$520.00</span></del>	-->
                                                    </div>
                                                    <div class="product-rate">
                                                        <div class="product-rating" style="width:100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach



                                        <div class="mini-cart-total  clearfix">
                                            <strong class="pull-left title18">المجموع</strong>
                                            <span class="pull-right color title18">{{getcong('currency_symbol')}}{{$price = DB::table('cart')->where('user_id', Auth::id())->sum('item_price')}}</span>
                                        </div>
                                        <div class="mini-cart-button">
                                            <a class="mini-cart-view shop-button" href="{{URL::to('order_details')}}">محتويات السلة </a>
                                            <a class="mini-cart-checkout shop-button" href="{{URL::to('order_details')}}">الدفع</a>
                                        </div>
                                    </div>

                                    @endif

                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Header -->
            <div class="nav-header bg-white header-ontop">
                <div class="container">
                    <nav class="main-nav main-nav1">
                        <ul>
                            <li class="{{ request()->is('/') ? 'current-menu-item' : '' }}">
                            @if(Auth::check() and Auth::user()->usertype=='User')
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">حسابي</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ URL::to('profile') }}">تعديل بياناتي</a></li>
                                        <li><a href="{{ URL::to('change_pass') }}">تغيير كلمة المرور</a></li>
                                        <li><a href="{{URL::to('myorder')}}">عرض الطلبات</a></li>
                                        <li><a href="{{ URL::to('logout') }}">تسجيل خروج</a></li>
                                    </ul>
                                </li>

                            @elseif(Auth::check() and  (Auth::user()->usertype=='Owner' or  Auth::user()->usertype=='Driver' ) )
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">حسابي</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ URL::to('admin/dashboard') }}">لوحة التحكم</a></li>
                                        <li><a href="{{ URL::to('logout') }}">تسجيل خروج</a></li>
                                    </ul>
                                </li>
                            @elseif(Auth::check() and Auth::user()->usertype=='Admin')

                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">حسابي</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ URL::to('admin/dashboard') }}">لوحة التحكم</a></li>
                                        <li><a href="{{ URL::to('logout') }}">تسجيل خروج</a></li>
                                    </ul>
                                </li>

                            @else
                                <li><a href="{{ URL::to('login') }}">دخول</a></li>
                                <li><a href="{{ URL::to('register') }}">تسجيل جديد</a></li>
                            @endif

                            <li class="{{ request()->is('/restaurants') ? 'current-menu-item' : '' }}" ><a href="{{URL::to('restaurants')}}">جميع المطاعم</a></li>
                            <li><a href="#">العروض</a></li>
                            <li><a href="#">الأكثر مبيعا</a></li>
                            <li class="{{ request()->is('about') ? 'current-menu-item' : ' aaaa' }}" ><a href="{{ URL::to('about') }}">من نحن</a></li>
                            <li class="{{ request()->is('contact') ? 'current-menu-item' : 'aaaa' }}" ><a href="{{ URL::to('contact') }}">اتصل بنا</a></li>
                        </ul>
                        <a href="#" class="toggle-mobile-menu"><span></span></a>
                    </nav>
                </div>
            </div>
            <!-- End Nav Header -->
        </div>
</header>
<div class="register-content-box">
    <h2 class="title30 font-bold text-uppercase text-center">Login/Register</h2>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-ms-12">
            <div class="check-billing">
                <div class="form-my-account">
                    <form class="block-login">
                        <h2 class="title24 title-form-account">Login</h2>
                        <p>
                            <label>Username or email address <span class="required">*</span></label>
                            <input type="text" name="username">
                        </p>
                        <p>
                            <label>Password <span class="required">*</span></label>
                            <input type="text" name="password">
                        </p>
                        <p>
                            <input type="submit" class="register-button" name="login" value="Login">
                        </p>
                        <div class="table create-account">
                            <div class="text-left">
                                <p>
                                    <input type="checkbox" id="remember"> <label for="remember">Remember me</label>
                                </p>
                            </div>
                            <div class="text-right">
                                <a href="#" class="color">Lost your password?</a>
                            </div>
                        </div>
                        <h2 class="title18 social-login-title">Or login with</h2>
                        <div class="social-login-block table text-center">
                            <div class="social-login-btn">
                                <a href="#" class="login-fb-link">Facebook</a>
                            </div>
                            <div class="social-login-btn">
                                <a href="#" class="login-goo-link">Google</a>
                            </div>
                        </div>
                    </form>
                    <form class="block-register">
                        <h2 class="title24 title-form-account">REGISTER</h2>
                        <p>
                            <label>Username <span class="required">*</span></label>
                            <input type="text" name="username">
                        </p>
                        <p>
                            <label>Email address <span class="required">*</span></label>
                            <input type="text" name="password">
                        </p>
                        <p>
                            <label>Password <span class="required">*</span></label>
                            <input type="text" name="password">
                        </p>
                        <p>
                            <input type="submit" class="register-button" name="register" value="Register">
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-ms-12">
            <div class="check-address">
                <div class="form-my-account check-register text-center">
                    <h2 class="title24 title-form-account">Register</h2>
                    <p class="desc">Registering for this site allows you to access your order status and history. Just fill in the fields below, and we’ll get a new account set up for you in no time. We will only ask you for information necessary to make the purchase process faster and easier.</p>
                    <a href="#" class="shop-button bg-color login-to-register" data-login="Login" data-register="Register">Register</a>
                    <p class="desc title12 silver"><i>Click to switch Register/Login</i></p>
                </div>
            </div>
        </div>
    </div>
</div>