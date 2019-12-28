@extends('mobile.layouts.owner_app')
@section('content')
    @if(count($myrestaurat)>0)
    <div id="main">
        <div class="page-header">
            <h2> {{ isset($myrestaurat->restaurant_name) ? 'تعديل: '. $myrestaurat->restaurant_name : 'إضافة مطبخ جديد' }}</h2>

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
                <input type="hidden" name="id" value="{{ isset($myrestaurat->id) ? $myrestaurat->id : null }}">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">ماذ تقدم مأكولات ؟ </label>
                    <div class="col-sm-9">
                        @foreach($types as $i => $type)
                            @if(isset($myrestaurat->restaurant_type) && $myrestaurat->restaurant_type==$type->id)
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
                        <input type="text" name="restaurant_name" value="{{ isset($myrestaurat->restaurant_name) ? $myrestaurat->restaurant_name : null }}" class="form-control">
                    </div>
                </div>

                <!--<div class="form-group">-->
                <!--    <div class="col-sm-9">-->
                <input type="text" style="display:none" name="restaurant_slug" value="{{ isset($myrestaurat->restaurant_slug) ? $myrestaurat->restaurant_slug : null }}" class="form-control">
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">المدينة</label>
                    <div class="col-sm-9">
                        <select id="city" name="city_id" class="selectpicker show-tick form-control" required>
                            <option value="">اختر المدينة</option>

                            @foreach($cities as $i => $city)

                                @if(isset($myrestaurat->city) && $myrestaurat->city==$city->id)
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
                            @if(isset($myrestaurat->area))
                                <option value="{{$myrestaurat->area}}" selected >{{App\area::find($myrestaurat->area)->name}}</option>
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
                        <textarea name="restaurant_description" id="restaurant_description" cols="30" rows="8" class="summernote">{{ isset($myrestaurat->restaurant_description) ? $myrestaurat->restaurant_description : null }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">شعار المطبخ</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($myrestaurat->restaurant_logo))

                                    <img src="{{ URL::asset('upload/restaurants/'.$myrestaurat->restaurant_logo.'-s.jpg') }}" width="100" alt="person">
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
                        <input type="text" name="open_saturday" value="{{ isset($myrestaurat->open_saturday) ? $myrestaurat->open_saturday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الأحد</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_sunday" value="{{ isset($myrestaurat->open_sunday) ? $myrestaurat->open_sunday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الإثنين</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_monday" value="{{ isset($myrestaurat->open_monday) ? $myrestaurat->open_monday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الثلاثاء</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_tuesday" value="{{ isset($myrestaurat->open_tuesday) ? $myrestaurat->open_tuesday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الأربعاء</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_wednesday" value="{{ isset($myrestaurat->open_wednesday) ? $myrestaurat->open_wednesday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الخميس</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_thursday" value="{{ isset($myrestaurat->open_thursday) ? $myrestaurat->open_thursday : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الجمعة</label>
                    <div class="col-sm-9">
                        <input type="text" name="open_friday" value="{{ isset($myrestaurat->open_friday) ? $myrestaurat->open_friday : null }}" class="form-control">
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ isset($myrestaurat->id) ? 'حفظ التعديلات ' : 'اضافة مطعم' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>
        @else
        <div id="main">
            <div class="page-header">
                <h2> {{ isset($myrestaurat->restaurant_name) ? 'تعديل: '. $myrestaurat->restaurant_name : 'إضافة مطبخ جديد' }}</h2>

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
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">ماذ تقدم مأكولات ؟ </label>
                        <div class="col-sm-9">
                            @foreach($types as $type)

                                    <input type="checkbox" name="{{$type->type}}"  value="{{$type->id}}">{{'  ' . $type->type}}
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">اسم المطبخ</label>
                        <div class="col-sm-9">
                            <input type="text" name="restaurant_name" value="" class="form-control">
                        </div>
                    </div>

                    <!--<div class="form-group">-->
                    <!--    <div class="col-sm-9">-->
                    <input type="text" style="display:none" name="restaurant_slug" value="" class="form-control">
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">المدينة</label>
                        <div class="col-sm-9">
                            <select id="city" name="city_id" class="selectpicker show-tick form-control" required>
                                <option value="">اختر المدينة</option>

                                @foreach($cities as $city)


                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">المنطقة</label>
                        <div class="col-sm-9">
                            <select name="area_id" id="area" class="form-control" class="selectpicker show-tick form-control">
                                <option value="">المنطقة</option>

                            </select>
                        </div>
                    </div>

                    <!--<div class="form-group">-->
                    <!--    <label for="" class="col-sm-3 control-label">العنوان</label>-->
                    <!--    <div class="col-sm-9">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">عن المطبخ</label>
                        <div class="col-sm-9">
                            <textarea name="restaurant_description" id="restaurant_description" cols="30" rows="8" class="summernote"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="col-sm-3 control-label">شعار المطبخ</label>
                        <div class="col-sm-9">
                            <div class="media">
                                <div class="media-left">

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
                            <input type="text" name="open_saturday" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">الأحد</label>
                        <div class="col-sm-9">
                            <input type="text" name="open_sunday" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">الإثنين</label>
                        <div class="col-sm-9">
                            <input type="text" name="open_monday" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">الثلاثاء</label>
                        <div class="col-sm-9">
                            <input type="text" name="open_tuesday" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">الأربعاء</label>
                        <div class="col-sm-9">
                            <input type="text" name="open_wednesday" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">الخميس</label>
                        <div class="col-sm-9">
                            <input type="text" name="open_thursday" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">الجمعة</label>
                        <div class="col-sm-9">
                            <input type="text" name="open_friday" value="" class="form-control">
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">اضافة مطعم</button>

                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>


        </div>

    @endif
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
