@extends('joodyasell.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-body" style="background-image: url('upload/mobile.jpg');">
                    <br>
                    <br>
                    <br>
                    <div class="row"></div>
                    <div class="row" style="color: #ffffff">

                        ابحث عن مطبخك المفضل, في جميع مناطق قطاع غزة

                    </div>
                    <div class="row">
                            <form action="mobile/restaurants/search" method="post" class="search_form" style="width:100%; border-style: solid;border-collapse: collapse;background-color: #fff; border-radius: 10px">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col col-sm-12">
                                        <select id="city" name="city_id" class="form-control" style="height: 100%;border-style: none" required>
                                            <option value="0" selected>اختر المدينة</option>
                                            @foreach($cities as $key => $city)
                                                <option value="{{$key}}"> {{$city}}</option>
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

        <div class="col-12 col-lg-12">
            <div class="card card-body">

                    <img src="{{url('upload/adv.jpg')}}" width="100%">


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
