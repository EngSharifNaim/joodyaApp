@extends('mobile.layouts.app')
@section('content')

    <br>
    <br>
    <div class="container">
        <h4 class="title30 font-bold text-uppercase text-center">تفاصيل طلب الشراء</h4>

        @if(count(App\mobileorder::where('status',0)->where('user_id',$user_id)->select('restaurant_id')->distinct()->get()) > 0)
        <div id="cart_content">
            <form method="post" id="send_cart_form">
                @csrf
                <input name="_method" value="POST" hidden>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">بيانات المرسل</label>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="user_name" id="user_name" required value="@if(Auth::check()){{Auth::user()->first_name . ' ' . Auth::user()->last_name}}@endif" class="form-control form-control-lg" placeholder="الاسم...">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="number" name="user_mobile" id="user_mobile" required value="@if(Auth::check()){{Auth::user()->mobile}}@endif" class="form-control form-control-lg" placeholder="رقم الجوال">
                                    <div class="form-control-feedback">
                                        <i class="icon-mobile"></i>
                                    </div>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="address" id="address" required value="@if(Auth::check()){{Auth::user()->city . ' - ' . Auth::user()->area}}@endif" class="form-control form-control-sm" placeholder="المدينة , المنطقة">
                                    <div class="form-control-feedback form-control-feedback-sm">
                                        <i class="icon-pin-alt"></i>
                                    </div>
                                </div>
{{--                                <div class="form-group form-group-feedback form-group-feedback-left">--}}
{{--                                    <textarea name="details" placeholder="ملاحظات اضافية..." class="form-control"></textarea>--}}
{{--                                    <div class="form-control-feedback form-control-feedback-sm">--}}
{{--                                        <i class="icon-comment-discussion"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                        </div>
                    </div>
                </div>
                @foreach(App\mobileorder::where('status',0)->where('user_id',$user_id)->select('restaurant_id')->distinct()->get() as $restaurant)

                <div class="card">
                    <div class="card-header">
                        <div class="media">
                            <div class="mr-3 align-self-center" dir="rtl">
                                    <img style="width:30px;border-radius: 300px" src="{{url('upload/restaurants/' . App\Restaurants::where('id',$restaurant->restaurant_id)->first()->restaurant_logo . '-b.jpg')}}" alt="">
                            </div>
                                <div class="media-body text-right" dir="rtl">
                                <a href="{{url('mobile/restaurantMenue/' . $restaurant->restaurant_id)}}" dir="rtl">
                                    <h5 class=" mb-0" dir="rtl" style="text-align: right">{{App\Restaurants::where('id',$restaurant->restaurant_id)->first()->restaurant_name}}</h5>
                                </a>
                            </div>
                        </div>
                        <div dir="rtl">
                        </div>
                    </div>
                    <div class="table-responsive" dir="rtl">
                        <table class="table">
                            <thead>
                            <tr class="bg-green-600">
                                <th><i class=" icon icon-database-remove"></i></th>
                                <th>صنف</th>
                                <th>كمية</th>
                                <th>سعر</th>
                                {{--                        <th>Username</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @if(Auth::check())
                            @foreach(App\mobileorder::where('user_id','=',$user_id)->where('status',0)->where('restaurant_id',$restaurant->restaurant_id)->get() as $item)

                                <tr>
                                    <td><a href="{{url('mobile/delete_from_cart/' . $item->item_id)}}"><i class=" icon icon-database-remove"></i></a></td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->item_price}}</td>
                                    {{--                        <td>@Kopyov</td>--}}
                                </tr>
                            @endforeach
                                @else
                                @foreach(App\mobileorder::where('user_id','=',Session('localUser'))->where('status',0)->where('restaurant_id',$restaurant->restaurant_id)->get() as $item)

                                    <tr>
                                        <td><a href="{{url('mobile/delete_from_cart/' . $item->item_id)}}"><i class=" icon icon-database-remove"></i></a></td>

                                        <td>{{$item->item_name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->item_price}}</td>
                                        {{--                        <td>@Kopyov</td>--}}
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <button type="submit" name="send_cart" value="{{$restaurant->restaurant_id}}" id="send_cart{{$restaurant->restaurant_id}}" href="" class="btn btn-success btn-block">
                            ارسال الطلب الآن
                            @if(Auth::check())
                            <span class="badge bg-danger-400 badge-pill border-2 border-white">{{App\OrderItems::where('restaurant_id',$restaurant->restaurant_id)->where('status',0)->where('user_id',Auth::user()->id)->sum('total_price') . ' ' . 'شيكل'}}</span>
                                @else
                                <span class="badge bg-danger-400 badge-pill border-2 border-white">{{App\OrderItems::where('restaurant_id',$restaurant->restaurant_id)->where('status',0)->where('user_id',Session('localUser'))->sum('total_price') . ' ' . 'شيكل'}}</span>

                            @endif

                        </button>
                    </div>
                </div>
                    @endforeach
                <button type="submit" name="send_cart" id="send_cart" value="all" href="" class="btn btn-primary btn-block">
                    ارسال جميع الطلبات
                    @if(Auth::check())
                        <span class="badge bg-danger-400 badge-pill border-2 border-white">{{App\OrderItems::where('user_id',Auth::user()->id)->where('status',0)->sum('total_price') . ' ' . 'شيكل'}}</span>
                    @else
                        <span class="badge bg-danger-400 badge-pill border-2 border-white">{{App\OrderItems::where('user_id',Session('localUser'))->where('status',0)->sum('total_price') . ' ' . 'شيكل'}}</span>

                    @endif

                </button>
                <br>
                <br>

            </form>
        </div>
            @else
            <div style="text-align: center">
            <img src="{{url('upload/empty.png')}}" style="width: 150px">
                <h6>سلتك فارغة ... أضف منتجاتك المفضلة للتمكن من الطلب</h6>
            </div>
            @endif
    </div>
    <script>
        $(document).ready(function(){

            $('#send_cart_form').on('submit', function(event){
                event.preventDefault();
                let data = new FormData(this);
                // alert(data);
                $.ajax({
                    type :'POST',
                    url:'{{ url('send_order/') }}',
                    data:  data,
                    // dataType:'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend:function(){
                        $('#save').attr('disabled','disabled');
                    },
                    success:function(data)
                    {
                        if(data.error)
                        {
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++)
                            {
                                error_html += '<p>'+data.error[count]+'</p>';
                            }
                            $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                        }
                        else
                        {
                            if(data.fail == '')
                            {
                                Swal.fire({
                                    // position: 'top-end',
                                    type: 'success',
                                    title: 'تم ارسال الطلبية بنجاح',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                document.getElementById('cart_content').innerHTML = 'محتويات السلة فارغة';

                            }
                            else
                            {
                                Swal.fire({
                                    // position: 'top-end',
                                    type: 'success',
                                    title: 'هناك خلل في البيانات',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }


                        }
                    }
                })
            });

        });

    </script>
@endsection
