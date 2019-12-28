@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ isset($restaurant->restaurant_name) ? 'تعديل: '. $restaurant->restaurant_name : 'إضافة مطبخ جديد' }}</h2>

            <a href="{{ URL::to('admin/dashboard') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> العودة</a>

        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/restaurants/addrestaurant'),'class'=>'form-horizontal padding-15','name'=>'category_form','id'=>'category_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <input type="hidden" name="id" value="{{ isset($restaurant->id) ? $restaurant->id : null }}">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">ماذ تقدم مأكولات ؟ </label>
                    <div class="col-sm-9">
                        @foreach($types as $i => $type)
                            @if(isset($restaurant->restaurant_type) && $restaurant->restaurant_type==$type->id)
                                <input type="checkbox" name="{{$type->type}}" value="$type-id" checked>{{'  ' . $type->type}}

                            @else
                                <input type="checkbox" name="{{$type->type}}"  value="{{$type->id}}">{{'  ' . $type->type}}
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">اسم المطبخ</label>
                    <div class="col-sm-9">
                        <input type="text" name="restaurant_name" value="{{ isset($restaurant->restaurant_name) ? $restaurant->restaurant_name : null }}" class="form-control">
                    </div>
                </div>

                <!--<div class="form-group">-->
                <!--    <div class="col-sm-9">-->
                <input type="text" style="display:none" name="restaurant_slug" value="{{ isset($restaurant->restaurant_slug) ? $restaurant->restaurant_slug : null }}" class="form-control">
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">المدينة</label>
                    <div class="col-sm-9">
                        <select id="city" name="city_id" class="selectpicker show-tick form-control" required>
                            <option value="">اختر المدينة</option>

                            @foreach($cities as $i => $city)

                                @if(isset($restaurant->city) && $restaurant->city==$city->id)
                                    <option value="{{$city->id}}" selected >{{$city->name}}</option>

                                @else
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">المنطقة</label>
                    <div class="col-sm-9">
                        <select name="area_id" id="area" class="form-control" class="selectpicker show-tick form-control">
                            <option value="">المنطقة</option>
                            @if(isset($restaurant->area))
                                <option value="{{$restaurant->area}}" selected >{{App\area::find($restaurant->area)->name}}</option>
                            @endif

                        </select>
                    </div>
                </div>

                <!--<div class="form-group">-->
                <!--    <label for="" class="col-sm-3 control-label">العنوان</label>-->
                <!--    <div class="col-sm-9">-->
            <!--        <textarea name="restaurant_address" id="restaurant_address" cols="60" rows="3" class="form-control">{{ isset($restaurant->restaurant_address) ? $restaurant->restaurant_address : null }}</textarea>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">عن المطبخ</label>
                    <div class="col-sm-9">
                        <textarea name="restaurant_description" id="restaurant_description" cols="30" rows="8" class="summernote">{{ isset($restaurant->restaurant_description) ? $restaurant->restaurant_description : null }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">شعار المطبخ</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($restaurant->restaurant_logo))

                                    <img src="{{ URL::asset('upload/restaurants/'.$restaurant->restaurant_logo.'-s.jpg') }}" width="100" alt="person">
                                @endif

                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="restaurant_logo" class="filestyle">
                            </div>
                        </div>

                    </div>
                </div>

                <h4>أوقات عامل</h4>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">السبت</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_saturday" value="{{ isset($restaurant->open_saturday) ? $restaurant->open_saturday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الأحد</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_sunday" value="{{ isset($restaurant->open_sunday) ? $restaurant->open_sunday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الإثنين</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_monday" value="{{ isset($restaurant->open_monday) ? $restaurant->open_monday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الثلاثاء</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_tuesday" value="{{ isset($restaurant->open_tuesday) ? $restaurant->open_tuesday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الأربعاء</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_wednesday" value="{{ isset($restaurant->open_wednesday) ? $restaurant->open_wednesday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الخميس</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_thursday" value="{{ isset($restaurant->open_thursday) ? $restaurant->open_thursday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الجمعة</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_friday" value="{{ isset($restaurant->open_friday) ? $restaurant->open_friday : null }}" class="form-control">
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ isset($restaurant->id) ? 'حفظ التعديلات ' : 'اضافة مطعم' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
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
