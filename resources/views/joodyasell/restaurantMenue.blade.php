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

    <div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
        <div class="overlay">
            <div class="container">
                <h1>قائمة الوجبات</h1>
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
                                @foreach($menues as $i => $menue)
                                    <div class="card" style="text-align: center; padding: 30px">
                                        @if($menue->menu_image)
                                            <img style="width:100%;border-radius: 200px" src="{{ URL::asset('upload/menu/'.$menue->menu_image.'-s.jpg') }}" />
                                        @else
                                            <img src="{{ URL::asset('upload/menu_img_s.png') }}" />
                                        @endif

                                        <div class="card-body">
                                            <h5 class="card-title">{{$menue->menu_name}}</h5>
                                            @if($menue->price!= '')
                                                {{$menue->price}}
                                            @else
                                                {{$menue->small_price .' - ' . $menue->big_price}}
                                            @endif
                                            {{getcong('currency_symbol')}}                                        </div>

                                        <div style="text-align: center" class="card-footer d-flex justify-content-between">
                                            @if(Auth::check())

                                                    <div class="quantity buttons_added">
                                                        <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" id="quantity" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                                                    </div>

                                                    <div class="col col-sm-12"><a href="{{URL::to('add_item/' . $menue->id )}}" class=" btn btn-danger btn-block addcart-link addtocart" data-item="{{ json_encode($menue)}}"  data-features="{{ json_encode($menue->features)}}"   >إضافة إلى السلة</a></div>




                                            @else
                                                <a href="#" class=" btn btn-danger btn-block addcart-link addtocart sidebar-mobile-main-toggle" data-item="{{ json_encode($menue)}}"  data-features="{{ json_encode($menue->features)}}"   >للطلب, سجل دخول</a>
                                            @endif                                            <span>
								</span>
                                        </div>
                                    </div>                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>    </div>
    </div>
    <script type="text/javascript">
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
