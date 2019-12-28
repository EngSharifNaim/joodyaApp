@extends("app")

@section('head_title', 'Restaurants' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

 <div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
    <div class="overlay">
      <div class="container">
        <h1>جميع الأسر</h1>
      </div>
    </div>
  </div>
<hr>
 <div class="restaurant_list_detail">
    <div class="container">
        <div class="shop-banner banner-adv line-scale zoom-image">
            <a href="#" class="adv-thumb-link"><img src="{{url('nsite_assets\images\shop\banner-list.jpg')}}" alt=""></a>
            <div class="banner-info">
                <h2 class="title30 color">قائمة المطابخ</h2>
                <div class="bread-crumb white"><a href="/" class="white">الرئيسية</a><span>الثائمة</span></div>
            </div>
        </div>
        <div class="content-shop">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <aside class="sidebar-left sidebar-shop">
                        <div class="widget widget-search">
                            <!--<form class="search-form">-->
                            <!--    <input onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="بحث ..." type="text">-->
                            <!--    <input type="submit" value="">-->
                            <!--</form>-->
                        </div>
                        <!-- End Widget -->
                        <div class="widget widget-category">
                        <!--    <h2 class="title18 title-widget font-bold">التصنيفات</h2>-->
                        <!--    <ul class="list-none wg-list-cat">-->
                        <!--        <li>-->
                        <!--            <label><a href="{{URL::to('restaurants/')}}">عرض الجميع</a></label>-->
                        <!--        </li>-->
                        <!--        @foreach(\App\Types::orderBy('type')->get() as $type)-->
                        <!--            <li>-->
                        <!--                <label><a href="{{URL::to('restaurants/type/'.$type->id)}}">{{$type->type}}</a></label>-->
                        <!--            </li>-->
                        <!--        @endforeach-->
                        <!--    </ul>-->
                        <img src="{{url('upload/images/res_side.jpg')}}">
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
                                        <!--    <select class="radius6">-->
                                        <!--        <option value="">المستحسن</option>-->
                                        <!--        <option value="">المدينة</option>-->
                                        <!--        <option value="">الاسم</option>-->
                                        <!--    </select>-->
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
                        <div class="product-loadmore">
                            <div class="row">

                                @foreach($restaurants as $restaurant)

                                    <div class="col-md-3" style="height: 100%">
                                        <div class="item-product item-product1 text-center border drop-shadow">
                                            <div class="product-thumb" style="background-color: #a3d7a5;border-radius: 300px">
                                                <a href="{{URL::to('restaurants/menu/'.$restaurant->restaurant_slug)}}" class="product-thumb-link rotate-thumb">
                                                  @if(isset($restaurant->restaurant_logo))
                                                    <img src="{{url('upload/restaurants/' . $restaurant->restaurant_logo . '-b.jpg')}}" alt="">
                                                    <img src="{{url('upload/restaurants/' . $restaurant->restaurant_logo . '-b.jpg')}}" alt="">
                                                    @else
                                                <img src="{{url('upload/res_logo.png')}}" alt="">
                                                <img src="images/product/fruit_23.jpg" alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="{{URL::to('restaurants/menu/'.$restaurant->restaurant_slug)}}">{{$restaurant->restaurant_name}} </a></h3>
                                               
                                                <div class="product-price">
                                                    <!--{{$restaurant->restaurant_address}}-->
                                                </div>
                                                <div>
                                                <a href="{{URL::to('restaurants/menu/'.$restaurant->restaurant_slug)}}" class="btn btn-danger btn-block">عرض قائمة الطعام</a>
                                                </div>
                                        
                                            </div>
                                            <br>
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
                                        </div>
                                    </div>

                            


                                @endforeach


                            </div>
                           
                    </div>
                </div>
            </div>
        </div>    </div>
  </div>

@endsection
