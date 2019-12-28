@extends('mobile.layouts.app')
@section('content')
    <br>
    <br>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-body" style="background-image: url('../../upload/mobile.jpg');">
                    <br>
                    <br>
                    <br>
                    <div class="row"></div>
                    <div class="row" style="color: #ffffff">

                        ابحث عن مطبخك المفضل, في جميع مناطق قطاع غزة

                    </div>
                    <div class="row">
                            <form action="{{url('restaurants/search')}}" method="post" class="search_form" style="width:100%; border-style: solid;border-collapse: collapse;background-color: #fff; border-radius: 10px">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col col-sm-12">
                                        <select id="city" name="city_id" class="form-control" style="height: 100%;border-style: none" required>
                                            <option value="0" selected>اختر المدينة</option>
                                            @foreach($cities as $key => $city)
                                                <option value="{{$city}}"> {{$city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-12">
                                        <select name="area_id" id="area" class="form-control" style="height: 100%;border-style: none">
                                            <option value="0">المنطقة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-12">
                                        <select name="type_id" id="type" class="form-control" style="height: 100%;width: 100%;border-style: none">
                                            <option value="0">الفئة</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-12">
                                        <button type="submit" class="btn btn-success btn-lg btn-block" role="button">اعرض لي </button>

                                    </div>
                                </div>
                            </form>

                    </div>
        </div>
            <h5>أحدث العروض</h5>
            <div class="restaurant_list_detail">
                <div class="row">
                    @foreach(App\Menu::inRandomOrder()->where('offer',1)->take(5)->get() as $offer)
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body text-center">
                                        <a href="#">
                                            <img src="{{ URL::asset('upload/menu/'.$offer->menu_image.'-s.jpg') }}" class="rounded-circle" width="100" height="100" alt="">
                                            <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                        </a>
                                    <div>
                                        <a id="like_item{{$offer->id}}" class="btn btn-sm" href="javascript:like_item({{$offer->id}})">

                                            أعجبني

                                        </a> |
                                        <a id="h_price{{$offer->id}}" class="btn btn-sm" href="javascript:h_price({{$offer->id}})">
                                            السعر مرتفع

                                        </a> |
                                        <a id="not_clear{{$offer->id}}" class="btn btn-sm" href="javascript:not_clear({{$offer->id}})">
                                            عرض غير واضح

                                        </a>
                                    </div>
                                </div>

                                <div class="card-body bg-light text-center">
                                    <div class="mb-2">
                                        <h6 class="font-weight-semibold mb-0">
                                            <a href="#" class="text-default" style="text-align: right">{{$offer->menu_name}}</a>
                                        </h6>

                                        <a href="#" class="text-muted">{{App\Restaurants::where('id',$offer->restaurant_id)->first()->restaurant_name}}</a>
                                        <br>
                                        <a href="#" class="text-muted">{{$offer->description}}</a>
                                        <h3 class="mb-0 font-weight-semibold"> {{$offer->price}} شيكل </h3>

                                    </div>


                                    <div>
                                        <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                        <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                        <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                        <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                        <i class="icon-star-full2 font-size-base text-warning-300"></i>
                                    </div>

                                    <div class="text-muted mb-3"> تم الطلب{{' ' . App\mobileorder::where('item_id',$offer->id)->count() . ' '}} مرة</div>
                                    <div class="row">
                                        <div class="col col-lg-2">
                                            <div class="form-group">
                                                <select id="qty{{$offer->id}}" class="form-control form-control-select2" >
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-lg-11">
                                            <a id="add_to_cart" class="btn btn-sm btn-primary btn-block" href="javascript:add_to_cart({{$offer->id . ',' . $offer->restaurant_id}})">
                                                أضف الى السلة
                                                <span id="add_to_cart{{$offer->id}}" class="badge bg-danger-400 badge-pill border-2 border-white">
                                                    @if (Auth::check())

                                                        @if(App\OrderItems::where('item_id',$offer->id)->where('user_id',Auth::user()->id)->where('status',0)->first())
                                                            {{App\OrderItems::where('item_id',$offer->id)->where('user_id',Auth::user()->id)->where('status',0)->first()->quantity}}
                                                        @else
                                                            0
                                                        @endif
                                                    @else
                                                        @if(App\OrderItems::where('item_id',$offer->id)->where('user_id',Session('localUser'))->where('status',0)->first())
                                                            {{App\OrderItems::where('item_id',$offer->id)->where('user_id',Session('localUser'))->where('status',0)->first()->quantity}}
                                                        @else
                                                            0
                                                        @endif
                                                    @endif
                                                </span>

                                            </a>

                                        </div>
                                    </div>

{{--                                    <a id="add_to_cart" class="btn btn-sm btn-primary btn-block" href="javascript:add_to_cart({{$offer->id . ',' . $offer->restaurant_id}})">--}}
{{--                                        أضل إلى السلة--}}
{{--                                        <span id="add_to_cart{{$offer->id}}" class="badge bg-danger-400 badge-pill border-2 border-white">--}}
{{--                                                    @if (Auth::check())--}}

{{--                                                @if(App\OrderItems::where('item_id',$offer->id)->where('user_id',Auth::user()->id)->where('status',0)->first())--}}
{{--                                                    {{App\OrderItems::where('item_id',$offer->id)->where('user_id',Auth::user()->id)->where('status',0)->first()->quantity}}--}}
{{--                                                @else--}}
{{--                                                    0--}}
{{--                                                @endif--}}
{{--                                            @else--}}
{{--                                                @if(App\OrderItems::where('item_id',$offer->id)->where('user_id',Session('localUser'))->where('status',0)->first())--}}
{{--                                                    {{App\OrderItems::where('item_id',$offer->id)->where('user_id',Session('localUser'))->where('status',0)->first()->quantity}}--}}
{{--                                                @else--}}
{{--                                                    0--}}
{{--                                                @endif--}}
{{--                                            @endif--}}
{{--                                                </span>--}}

{{--                                    </a>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

    </div>
        <script type="text/javascript">

            $('#city').change(function(){
                var cityID = $(this).val();
                if(cityID){
                    $.ajax({
                        type:"GET",
                        url:"{{url('getArea/')}}?city_id=" + cityID,
                        success:function(res){
                            if(res){

                                $("#area").empty();
                                $("#area").append('<option value="0">اختر المنطقة</option>');
                                $.each(res,function(key,value){
                                    $("#area").append('<option value="'+key+'">'+value+'</option>');
                                });
                                $('#area').dropdown;

                            }else{
                                $("#area").empty();
                            }
                        }
                    });
                }else{
                    $("#area").empty();
                    $("#city").empty();
                }
            });

            $('#area').change(function(){
                var areaID = $(this).val();
                if(areaID){
                    $.ajax({
                        type:"GET",
                        url:"{{url('getType/')}}?area_id=" + areaID,
                        success:function(res){
                            if(res){

                                $("#type").empty();
                                $("#type").append('<option value="0">اختر الفئة</option>');
                                $.each(res,function(key,value){
                                    $("#type").append('<option value="'+key+'">'+value+'</option>');
                                });


                            }else{
                                $("#type").empty();
                            }
                        }
                    });
                }else{
                    $("#area").empty();
                    $("#city").empty();
                }
            });
            {{--$('#area').on('change',function(){--}}
            {{--    var stateID = $(this).val();--}}
            {{--    if(stateID){--}}
            {{--        $.ajax({--}}
            {{--            type:"GET",--}}
            {{--            url:"{{url('get-city-list')}}?state_id="+stateID,--}}
            {{--            success:function(res){--}}
            {{--                if(res){--}}
            {{--                    $("#city").empty();--}}
            {{--                    $.each(res,function(key,value){--}}
            {{--                        $("#city").append('<option value="'+key+'">'+value+'</option>');--}}
            {{--                    });--}}

            {{--                }else{--}}
            {{--                    $("#city").empty();--}}
            {{--                }--}}
            {{--            }--}}
            {{--        });--}}
            {{--    }else{--}}
            {{--        $("#city").empty();--}}
            {{--    }--}}

            {{--});--}}
        </script>

@endsection
