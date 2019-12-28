@extends("app")

@section('head_title', 'Restaurants' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

    <div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
        <div class="overlay">
            <div class="container">
                <h1>قائمة الطعام</h1>
            </div>
        </div>
    </div>

    <div class="restaurant_list_detail">
        <div class="container">
            <div class="shop-banner banner-adv line-scale zoom-image">
                <a href="#" class="adv-thumb-link"><img src="{{url('nsite_assets\images\shop\banner-list.jpg')}}" alt=""></a>
                <div class="banner-info">
                    <h2 class="title30 color">{{$restaurant->restaurant_name}}</h2>
                    <div class="bread-crumb white"><a href="{{url('/')}}" class="white">الرئيسية</a><a href="{{url('/restaurants')}}"><span>المطاعم</span></a><span>القائمة</span></div>
                </div>
            </div>
            <hr>
            <div class="content-shop">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <aside class="sidebar-left sidebar-shop">
                            <div class="widget widget-search">
                                <!--<form class="search-form">-->
                                <!--  <input onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="بحث ..." type="text">-->
                                <!--  <input type="submit" value="">-->
                                <!--</form>-->
                            </div>
                            <!-- End Widget -->
                            <div class="widget widget-category">
                                <h2 class="title18 title-widget font-bold">تصنيفات الطعام</h2>
                                <ul class="list-none wg-list-cat">

                                    @foreach(\App\menucategory::all() as $n=>$cat)
                                        <li>
                                            <label>{{$cat->name}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- ENd Widget -->

                            <!-- End WIdget -->
                        </aside>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="main-content-shop">
                            <div class="shop-pagibar clearfix">
                                <p class="desc silver pull-left"></p>
                                <ul class="wrap-sort-view list-inline-block pull-right">
                                    <li>
                                        <div class="sort-bar">
                                            <!--<span class="inline-block">ترتيب:</span>-->
                                            <!--<div class="select-box border radius6 inline-block">-->
                                            <!--  <select class="radius6">-->
                                            <!--    <option value="">المستحسن</option>-->
                                            <!--    <option value="">المدينة</option>-->
                                            <!--    <option value="">الاسم</option>-->
                                            <!--  </select>-->
                                            <!--</div>-->
                                        </div>
                                    </li>
                                    <li>
                                        <div class="view-bar">
                                            <!--<a class="grid-view" href="grid.html"></a>-->
                                            <!--<a class="list-view active" href="list.html"></a>-->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-list-view">
                                <h2>قائمة الطعام</h2>
                                @foreach(\App\menucategory::all() as $n=>$cat)
                                    @if(count(\App\Menu::where('menu_cat',$cat->id)->orderBy('menu_name')->get())>0)
                                        <h3 id="{{$cat->category_name}}" class="nomargin_top">{{$cat->name}}</h3>
                                        <hr>
                                        @foreach($menus as $menu_item)
                                            @if($menu_item->menu_cat == $cat->id)
                                                <div class="item-product item-product-list">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-5 col-xs-5">
                                                            <div class="product-thumb" border-radius: 500px>
                                                                <a href="detail.html" class="product-thumb-link zoomout-thumb">
                                                                    @if($menu_item->menu_image)
                                                                        <img src="{{ URL::asset('../../upload/menu/'.$menu_item->menu_image.'-s.jpg') }}" />
                                                                        <img src="{{ URL::asset('../../upload/menu/'.$menu_item->menu_image.'-s.jpg') }}" />
                                                                    @else
                                                                        <img src="{{ URL::asset('../..//menu_img_s.png') }}" />
                                                                        <img src="{{ URL::asset('../../upload/menu_img_s.png') }}" />
                                                                    @endif
                                                                </a>
                                                                <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-sm-7 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="product-title">{{$menu_item->menu_name}}</h3>
                                                                <div class="product-price">
                                                                    <ins class="color"><span>
                                {{getcong('currency_symbol')}}
                                                                            @if($menu_item->price!= '')
                                                                                {{$menu_item->price}}
                                                                            @else
                                                                                {{$menu_item->small_price .' - ' . $menu_item->big_price}}
                                                                            @endif
                            </span></ins>
                                                                </div>
                                                                <div class="type"> {{$restaurant->type}} </div>

                                                                <div class="rating">
                                                                    @for($x = 0; $x < 5; $x++)

                                                                        @if($x < $restaurant->review_avg)
                                                                            <i class="fa fa-star"></i>
                                                                        @else
                                                                            <i class="fa fa-star fa fa-star-o"></i>
                                                                        @endif

                                                                    @endfor
                                                                    (<small><a href="{{URL::to('restaurants/'.$restaurant->restaurant_slug)}}">قرائة {{\App\Review::getTotalReview($restaurant->id)}} تقييم</a></small>)
                                                                </div>
                                                                <div class="desc">{{$menu_item->description}}</div>
                                                                <div class="product-extra-link">

                                                                    @if(Auth::check())
                                                                        <a href="{{URL::to('add_item/'.$menu_item->id)}}" class="addcart-link addtocart" data-item="{{ json_encode($menu_item)}}"  data-features="{{ json_encode($menu_item->features)}}"   >إضافة إلى السلة</a>
                                                                    @else
                                                                        <a href="{{URL::to('login')}}"><i class="fa fa-plus-square-o"></i></a>
                                                                @endif

                                                                <!--<a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>-->
                                                                    <!--<a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>    </div>
    </div>

@endsection
