@extends("mobile.layouts.app")

@section('head_title', 'Restaurants' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
    <style>
        .quantity {
            display: inline-block; }

        .quantity .input-text.qty {
            width: 35px;
            height: 39px;
            padding: 0 5px;
            text-align: center;
            background-color: transparent;
            border: 1px solid #efefef;
        }

        .quantity.buttons_added {
            text-align: left;
            position: relative;
            white-space: nowrap;
            vertical-align: top; }

        .quantity.buttons_added input {
            display: inline-block;
            margin: 0;
            vertical-align: top;
            box-shadow: none;
        }

        .quantity.buttons_added .minus,
        .quantity.buttons_added .plus {
            padding: 7px 10px 8px;
            height: 41px;
            background-color: #ffffff;
            border: 1px solid #efefef;
            cursor:pointer;}

        .quantity.buttons_added .minus {
            border-right: 0; }

        .quantity.buttons_added .plus {
            border-left: 0; }

        .quantity.buttons_added .minus:hover,
        .quantity.buttons_added .plus:hover {
            background: #eeeeee; }

        .quantity input::-webkit-outer-spin-button,
        .quantity input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0; }

        .quantity.buttons_added .minus:focus,
        .quantity.buttons_added .plus:focus {
            outline: none; }
    </style>
<br>
    <br>
{{--    <div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">--}}
{{--        <div class="overlay">--}}
{{--            <div class="container">--}}
{{--                @if(isset($restaurant))--}}
{{--                    <h1>القائمة الرئيسية - {{$restaurant->restaurant_name}}</h1>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="restaurant_list_detail">
            <div class="row">
                @foreach($menues as $offer)
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body" style="padding: 0px; margin: 0px">
                            <div class="card-img" style="padding: 0px; margin: 0px">
                                <a href="#">
                                    <img src="{{ URL::asset('upload/menu/'.$offer->menu_image.'-b.jpg') }}" class="card-img" width="100" alt="">
                                    <span class="card-img-actions-overlay card-img">
													<i class="icon-plus3 icon-2x"></i>
												</span>
                                </a>
                            </div>
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

                        </div>
                    </div>
                </div>
                    @endforeach

            </div>
    </div>
    <script type="text/javascript">
        //add Item to basket

        //end add Item to basket
        $('.addtocart').on('click', function () {
            var link = $(this).attr('href');
            var quantity = $(this).closest('.card-footer').find('.qty').val();
            var final_link = link + '/' + quantity;
            window.location.href = final_link;
            window.location.replace(final_link);
            return false;
        });
        $('#city').change(function(){
            var cityID = $(this).val();
            if(cityID){
                $.ajax({
                    type:"GET",
                    url:"{{url('getArea/')}}?city_id=" + cityID,
                    success:function(res){
                        if(res){

                            $("#area").empty();
                            $("#area").append('<option>اختر المنطقة</option>');
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
                            $("#type").append('<option>اختر الفئة</option>');
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
    <script>
        function wcqib_refresh_quantity_increments() {
            jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
                var c = jQuery(b);
                c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
            })
        }
        String.prototype.getDecimals || (String.prototype.getDecimals = function() {
            var a = this,
                b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
        }), jQuery(document).ready(function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("updated_wc_div", function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("click", ".plus, .minus", function() {
            var a = jQuery(this).closest(".quantity").find(".qty"),
                b = parseFloat(a.val()),
                c = parseFloat(a.attr("max")),
                d = parseFloat(a.attr("min")),
                e = a.attr("step");
            b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
        });



    </script>
@endsection
