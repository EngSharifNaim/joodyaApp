@extends("app")

@section('head_title', getcong_widgets('about_title') .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

    <div class="container">
    <div class="product-bestsale best-sale6">
        <h2 class="title30 font-bold title-box1 text-center">{{$title}}</h2>
      {{--        <ul class="text-center title-tab1 list-inline-block">--}}
{{--            <li class="active"><a href="#tab1" data-toggle="tab">الكل</a></li>--}}
{{--            @foreach($types as $type)--}}
{{--                <li><a href="#" data-toggle="tab">{{$type->type}}</a></li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
        <div class="tab-content">
            <div id="tab1" class="tab-pane active">
                <div class="product-loadmore">
                    <div class="row">

                        @foreach($mostrecent as $menu_item)

                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="item-product item-product1 text-center border drop-shadow">
                                    <div class="product-thumb" style="background-color: #a3d7a5;border-radius: 300px">
                                        <a href="#menu_{{$menu_item->id}}" class="product-thumb-link rotate-thumb">
                                            @if($menu_item->menu_image)
                                                <img src="{{ URL::asset('upload/menu/'.$menu_item->menu_image.'-s.jpg') }}" />
                                                <img src="{{ URL::asset('upload/menu/'.$menu_item->menu_image.'-s.jpg') }}" />
                                            @else
                                                <img src="{{ URL::asset('upload/menu_img_s.png') }}" />
                                                <img src="{{ URL::asset('upload/menu_img_s.png') }}" />
                                            @endif
                                        </a>
                                        @if($menu_item->menu_image)
                                            <a href="{{ URL::asset('upload/menu/'.$menu_item->menu_image.'-s.jpg') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        @else
                                            <a href="{{ URL::asset('upload/menu_img_s.png') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>

                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="#menu_{{$menu_item->id}}">{{$menu_item->menu_name}} </a></h3>
                                    
                                            <div class="product-price">
                                                <ins class="color"><span style="font-size: 14px">
                                            {{$menu_item->getRestaurantsInfo($menu_item->restaurant_id)->restaurant_name}}

                            </span></ins>
                                            </div>
                                        
                                        <div class="product-price">
                                            <ins class="color"><span>

                                                    @if($menu_item->price!= '')
                                                        {{$menu_item->price}}
                                                    @else
                                                        {{$menu_item->small_price .' - ' . $menu_item->big_price}}
                                                    @endif
                                                        {{getcong('currency_symbol')}}
                            </span></ins>
                                        </div>
                                        <!--<div class="product-rate">-->
                                        <!--    <div class="product-rating" style="width:100%"></div>-->
                                        <!--</div>-->
                                        <div class="product-extra-link">

                                            @if(Auth::check())
						<a href="{{URL::to('add_item/'.$menu_item->id)}}" class="addcart-link addtocart" data-item="{{ json_encode($menu_item)}}"  data-features="{{ json_encode($menu_item->features)}}"   >إضافة إلى السلة</a>
						@else
						<a href="{{URL::to('login')}}" class="addcart-link addtocart">إضافة إلى السلة</a>
						@endif 

                                        </div>
                                    </div>
                                </div>
                            </div>




                        @endforeach


                    </div>
                   
                </div>
            </div>
            <!-- End Tab -->
            <div id="tab2" class="tab-pane">
                <div class="product-loadmore">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="item-product item-product1 text-center border drop-shadow">
                                <div class="product-thumb">
                                    <a href="detail.html" class="product-thumb-link rotate-thumb">
                                        <img src="{{ URL::asset('nsite_assets/images/product/fruit_01.jpg') }}" alt="">
                                        <img src="{{ URL::asset('nsite_assets/images/product/fruit_02.jpg') }}" alt="">
                                    </a>
                                    <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title"><a href="detail.html">Fresh Meal Kit</a></h3>
                                    <div class="product-price">
                                        <ins class="color"><span>€30.000</span></ins>
                                    </div>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width:100%"></div>
                                    </div>
                                    <div class="product-extra-link">
                                        <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>المفضلة</span></a>
                                        <a href="#" class="addcart-link">إضافة إلى السلة</a>
                                        <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>مقارنة</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="item-product item-product1 text-center border drop-shadow">
                                <div class="product-thumb">
                                    <a href="detail.html" class="product-thumb-link rotate-thumb">
                                        <img src="{{ URL::asset('nsite_assets/images/product/fruit_04.jpg') }}" alt="">
                                        <img src="{{ URL::asset('nsite_assets/images/product/fruit_01.jpg') }}" alt="">
                                    </a>
                                    <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title"><a href="detail.html">Fresh Meal Kit</a></h3>
                                    <div class="product-price">
                                        <del class="silver"><span>€630.00</span></del>
                                        <ins class="color"><span>€170.000</span></ins>
                                    </div>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width:100%"></div>
                                    </div>
                                    <div class="product-extra-link">
                                        <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>المفضلة</span></a>
                                        <a href="#" class="addcart-link">إضافة إلى السلة</a>
                                        <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>مقارنة</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Item -->
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn-arrow color text-uppercase loadmore-link">عرض المزيد</a>
                    </div>
                </div>
            </div>
            <!-- End Tab -->
        </div>
    </div>
    <!-- End Product Best Sale -->
</div>
@endsection
