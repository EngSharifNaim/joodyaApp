@extends("mobile.layouts.app")

@section('head_title', 'Restaurants' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

    <div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
        <div class="overlay">
            <div class="container">
                <h1>المطاعم</h1>
            </div>
        </div>
    </div>

    <div class="restaurant_list_detail">
        <div class="container">

            <div class="content-shop">
                <div class="row">
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <div class="main-content-shop">
                            <div class="product-list-view">
                                @foreach($restaurants as $i => $restaurant)
                                    <div class="card" style="text-align: center; padding: 30px">
                                        @if(isset($restaurant->restaurant_logo))
                                            <img style="width:100%;border-radius: 300px" src="{{url('upload/restaurants/' . $restaurant->restaurant_logo . '-b.jpg')}}" alt="">
                                        @else
                                            <img style="border-radius: 300px" src="{{url('upload/res_logo.png')}}" alt="">
                                        @endif

                                        <div class="card-body">
                                            <h5 class="card-title">{{$restaurant->restaurant_name}}</h5>
                                            <p class="card-text">{{$restaurant->restaurant_address}}</p>
                                        </div>

                                        <div style="text-align: center" class="card-footer d-flex justify-content-between">
                                            <a href="{{url('mobile/restaurantMenue/' . $restaurant->id)}}" class="btn btn-danger btn-block" style="display: block">عرض قائمة الطعام</a>
                                            <span>
								</span>
                                        </div>
                                    </div>                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>    </div>
    </div>

@endsection
