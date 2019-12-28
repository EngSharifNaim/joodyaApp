 <header id="header">
	 <div class="header">
		 <div class="top-header">
			 <div class="container">
				 <div class="row">
					 <div class="col-md-4 col-sm-4 hidden-xs">

					 </div>
					 <div class="col-md-8 col-sm-8 col-xs-12">
						 <ul class="info-account list-inline-block pull-right">
							 @if(Auth::check())
								 <li><a href="{{ URL::to('logout') }}"><span class="color"><i class="fa fa-key"></i></span>تسجيل خروج</a></li>
                                 @if (Auth::user()->usertype !='User')
								 <li><a href="{{ URL::to('admin/dashboard') }}"><span class="color"><i class="fa fa-user"></i></span>لوحة التحكم</a></li>

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
		 <div class="main-header">
			 <div class="container">
				 <div class="row">
					 <div class="col-md-5 col-sm-5 col-xs-12">
					 </div>
					 <div class="col-md-2 col-sm-2 col-xs-12">
						 <div class="logo logo1">
							 <h1 class="hidden">Fruit Shop</h1>
							 <a href="index.html"><img src="{{ URL::asset('nsite_assets/images/home/home6/logo.png') }}" alt=""></a>
						 </div>
					 </div>
                         <div class="col-md-5 col-sm-5 col-xs-12">
                             <div class="mini-cart-box mini-cart1 pull-right">


                                 @if(Auth::check())

                                     <a class="mini-cart-link" href="{{URL::to('order_details')}}">
									<span class="mini-cart-icon title18 color"><i class="fa fa-shopping-basket"></i>
								</span>
                                         <span class="mini-cart-number"> {{$count = DB::table('cart')->where('user_id', Auth::id())->count('item_price')}} طلب
									</span>
                                         <span class="color">{{getcong('currency_symbol')}}{{$price = DB::table('cart')->where('user_id', Auth::id())->sum('item_price')}}</span>
                                     </a>
                                 @else
                                     <a class="mini-cart-link" href="{{URL::to('login')}}">
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
		 </div>
		 <!-- End Main Header -->
		 <div class="nav-header bg-white header-ontop">
			 <div class="container">
				 <nav class="main-nav main-nav1">
					 <ul>
						 <li class="current-menu-item ">
							 <a href="{{url('/')}}">الرئيسية</a>
						 </li>
						 <li class="menu-item-has-children ">
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
						 </li>
						 <li class="{{ request()->is('/restaurants') ? 'current-menu-item' : '' }}" ><a href="{{URL::to('restaurants')}}">جميع الأسر</a></li>
						 <li><a href="{{url('offers')}}">العروض</a></li>
						 <li><a href="{{url('moremenu')}}">الأكثر مبيعا</a></li>
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

	<!-- End Header -->


