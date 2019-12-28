@extends("app")
@section("content")


    <!--
-->
    <!-- Content ================================================== -->

    <section id="content">
        <div class="jumbotron" style="background-image: url('../../upload/jumb_bg.jpg'); height: 500px;z-index:1;padding-bottom: 0px">

            <div class="container">
                <br>
                <br>
                <br>
                <div class="row"></div>
                <div class="row">
                    <div class="col col-md-3"></div>
                    <div class="col col-md-6"><h3 class="display-4" style="color: #1a1a1d;">ابحث عن مطبخك المفضل, في جميع مناطق قطاع غزة</h3></div>
                    <div class="col col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col col-md-3"></div>
                    <div class="col col-md-6">
                        <form action="restaurants/search" method="post" class="search_form" style="border-style: solid;border-collapse: collapse;background-color: #fff; border-radius: 10px">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col col-md-3">
                                    <select id="city" name="city_id" class="form-control" style="height: 100%;border-style: none" required>
                                        <option value="0" selected disabled>اختر المدينة</option>
                                        @foreach($cities as $key => $city)
                                            <option value="{{$key}}"> {{$city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-md-3">
                                    <select name="area_id" id="area" class="form-control" style="height: 100%;border-style: none">
                                        <option value="0">المنطقة</option>
                                    </select>
                                </div>


                                <div class="col col-md-3">
                                    <select name="type_id" id="type" class="form-control" style="height: 100%;width: 100%;border-style: none">
                                        <option value="0">الغئة</option>

                                    </select>
                                </div>
                                <div class="col col-md-3">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" role="button">اعرض لي </button>

                                </div>

                            </div>


                        </form>

                    </div>
                    <div class="col col-md-3"></div>
                </div>
                <div class="row">

                    <div class="col col-md-3"></div>
                    <div class="col col-md-6">
                        <div style="background-color: #d23d3d; height: 40px; text-align: center;color: #ffffff;align-items: center">
                            <h4>الموقع مخصص لطلب الأكل المنزلي .. لذى في أغلب الأحيان يستوجب الطلب المسبق قبل فترة كافية</h3>
                        </div>

                    </div>

                    <div class="col col-md-3"></div>

                </div>


            </div>
        </div>


        <div style="background-color: #f3f3f3;margin: 0px;">
            <div class="container shadow-sm p-3" style="direction: rtl;">
                <div class="list-service1" style="margin: 0px;padding: 0px">
                    <div class="row" style="margin: 0px;padding: 0px">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="item-service1 table">
                                <div class="service-icon">
                                    <a href="#"><i class="fa fa-user-tie"></i></a>
                                </div>
                                <div class="service-info">
                                    <h3 class="title18"><a href="#" class="black">اصحاب الاعمال</a></h3>
                                    <p class="desc">مع جوديا ستصل الى زيائن جدد و تحقيق افضل مبيعات</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="item-service1 table">
                                <div class="service-icon">
                                    <a href="#"><i class="fa fa-shopping-basket"></i></a>
                                </div>
                                <div class="service-info">
                                    <h3 class="title18"><a href="#" class="black">الزبائن</a></h3>
                                    <p class="desc">تصل من خلالنا الى افضل المطابخ و تحصل على طلبك بكل سهولة </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="item-service1 table">
                                <div class="service-icon">
                                    <a href="#"><i class="fa fa-trademark"></i></a>
                                </div>
                                <div class="service-info">
                                    <h3 class="title18"><a href="#" class="black">الموردين</a></h3>
                                    <p class="desc">الوصول الى جميع الزبائن لمنتجاتك من اصحاب الاعمل</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner -->
        <div class="container">
            <div class="row" style="text-align: center">
            </div>
            <div class="product-bestsale best-sale6">
                <h2 class="title30 font-bold title-box1 text-center">الوجبات الأكثر مبيعا</h2>
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
                                            <div class="product-thumb">
                                                <a href="#menu_{{$menu_item->id}}" class="product-thumb-link rotate-thumb">
                                                    @if($menu_item->menu_image)
                                                        <img style="border-radius: 300px;width: 80%;" src="{{ URL::asset('../../upload/menu/'.$menu_item->menu_image.'-s.jpg') }}" />
                                                        <img style="border-radius: 300px;width: 80%;" src="{{ URL::asset('../../upload/menu/'.$menu_item->menu_image.'-s.jpg') }}" />
                                                    @else
                                                        <img style="border-radius: 300px;width: 80%;" src="{{ URL::asset('../../upload/menu_img_s.png') }}" />
                                                        <img style="border-radius: 300px;width: 80%;" src="{{ URL::asset('../../upload/menu_img_s.png') }}" />
                                                    @endif
                                                </a>
                                                @if($menu_item->menu_image)
                                                    <a href="{{ URL::asset('../../upload/menu/'.$menu_item->menu_image.'-b.jpg') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                @else
                                                    <a href="{{ URL::asset('../../upload/menu_img_s.png') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>

                                                @endif
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="#menu_{{$menu_item->id}}">{{$menu_item->menu_name}} </a></h3>

                                                <div class="product-price">
                                                    <ins class="color">
                                                        <span>
                                            @if($menu_item->getRestaurantsInfo($menu_item->restaurant_id))
                                                                {{$menu_item->getRestaurantsInfo($menu_item->restaurant_id)->restaurant_name}}
                                                            @endif

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
                                                <div class="product-rate">
                                                    <div class="product-rating" style="width:100%"></div>
                                                </div>
                                                <div class="product-extra-link">
                                                    @if(Auth::check())
                                                        <a href="javascript:add_to_cart({{$menu_item->id . ',' . $menu_item->restaurant_id}})" >إضافة إلى السلة
                                                            @if(App\OrderItems::where('item_id',$menu_item->id)->where('user_id',Auth::user()->id)->where('status',0)->first())
                                                               ( {{App\OrderItems::where('item_id',$menu_item->id)->where('user_id',Auth::user()->id)->where('status',0)->first()->quantity}})
                                                            @else
                                                                0
                                                            @endif
                                                        </a>
                                                    @else
                                                        <a href="javascript:add_to_cart({{$menu_item->id . ',' . $menu_item->restaurant_id}})" > إضافة إلى السلة
                                                            @if(App\OrderItems::where('item_id',$menu_item->id)->where('user_id',Session('localUser'))->where('status',0)->first())
                                                               ( {{App\OrderItems::where('item_id',$menu_item->id)->where('user_id',Session('localUser'))->where('status',0)->first()->quantity}})
                                                            @else
                                                                0
                                                            @endif
                                                        </a>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                @endforeach


                            </div>
                            <div class="text-center">
                                <a href="{{url('moremenu')}}" class="btn-arrow color text-uppercase loadmore-link">عرض المزيد</a>
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
                                <a href="{{url('moremenu')}}" class="btn-arrow color text-uppercase loadmore-link">عرض المزيد</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Tab -->
                </div>
            </div>
            <!-- End Product Best Sale -->
        </div>
        <div class="brands">
            <div class="container">
                <div class="box-brand2">
                    <h2 class="color2 title30 text-center title-box2">أحدث نقاط البيع</h2>
                    <div class="list-brand2">
                        <div class="row">
                            @foreach(App\Restaurants::take(6)->get() as $restaurant)
                                {{$restaurant->restaurant_name}}

                                <div class="col col-sm-2">
                                    <div class="item-brand2">
                                        <a href="{{URL::to('restaurants/menu/'.$restaurant->restaurant_slug)}}" class="border">
                                            @if(isset($restaurant->restaurant_logo))
                                                <img class=" wobble-horizontal" src="{{ url('../../upload/restaurants/' . $restaurant->restaurant_logo . '-b.jpg') }}" alt="">
                                            @else
                                                <img class=" wobble-horizontal" src="{{ url('../../upload/res_logo.jpg') }}" alt="">
                                            @endif
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <!-- End Brand -->


                <!-- End Photo -->
            </div>
        </div>
        <!-- End Featured -->
        <!-- End From BLog -->
        <!-- End Client Review -->
        <!-- End Product Type -->

        <!-- End List Brand -->
        <div class="newsletter-box bg-color">
            <div class="container">
                <ul class="inner-newsletter white list-inline-block">
                    <li><h2 class="title30"><i class="fa fa-envelope-open"></i>النشرة البريدية</h2></li>
                    <li><p>اشترك ليصلك منا ألذ و أشهى الوصفات المزلية من مطبخ الجود</p></li>
                    <li>
                        <form class="email-form">
                            <input onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="الإيميل" type="text">
                            <input type="submit" value="اشترك الان" />
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Newsletter -->
    </section>

    <script type="text/javascript">
        //add Item to basket
        function add_to_cart(item_id,restaurant){
            // alert(item_id);
            // return;

            Swal.fire({
                title: 'هل تريد فعلاً اضافة هذه الأكلة للسلة',
                type: 'تأكيد',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'الغاء',
                confirmButtonText: 'نعم أريد'
            }).then((result) => {
                if (result.value) {
                    var rout = "../../mobile/add_to_cart/" + item_id + '/' + restaurant;
                    $.ajax({
                        url: rout,
                        // method:'get',
                        dataType:'json',
                        // contentType: false,
                        // cache: false,
                        // processData:false,
                        beforeSend:function(){
                            $('#add_to_cart').attr('disabled','disabled');
                        },
                        success:function(data) {
                            if (data.error) {
                                var error_html = '';
                                for (var count = 0; count < data.error.length; count++) {
                                    error_html += '<p>' + data.error[count] + '</p>';
                                }
                            }
                            else {
                                if (data.fail == '') {
                                    Swal.fire(
                                        'تمت الاضافة!',
                                        'تمت اضافة الاكلة بنجاح.',
                                        'اضافة اكلة'
                                    )
                                }
                                else
                                {
                                    Swal.fire(
                                        'لم يتم الحذف!',
                                        'هناك خلل في عملية الحذف.',
                                        'حذف فاشل'
                                    )                            }
                            }
                            $('#add_to_cart').attr('disabled', false);
                            document.getElementById('add_to_cart' + item_id).innerHTML = parseInt(document.getElementById('add_to_cart' + item_id).innerHTML) + 1;
                            document.getElementById('cart_count').innerHTML = parseInt(document.getElementById('cart_count').innerHTML) + 1;
                            document.getElementById('cart_count').innerHTML = parseInt(document.getElementById('cart_count').innerHTML) + 1;

                        }

                    });


                }
            })
        }

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

        <!-- End Content -->
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

@endsection
