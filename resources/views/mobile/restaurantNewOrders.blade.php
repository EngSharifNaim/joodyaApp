@extends('mobile.layouts.app')
@section('content')
    <div class="container">
        <div class="content-page">

            <!-- ENd Banner -->
            <div class="content-cart-checkout woocommerce">
                <h2 class="title30 font-bold text-uppercase" style="text-align: center">{{$pageTitle}}</h2>
                <hr>
                @foreach($orders as $order)
                  الاسم :   {{App\User::where('id','=',$order->user_id)->first()->first_name . ' ' . App\User::where('id','=',$order->user_id)->first()->last_name}}
                <br>
                  الجوال :   {{App\User::where('id','=',$order->user_id)->first()->mobile}}
                <br>
                  الوقت :   {{App\User::where('id','=',$order->user_id)->first()->created_at}}
                <div style="background-color: #9c9c9c">
                    @if(count(App\Restaurants::where('id','=',$order->restaurant_id)->get())>0)
                    المطبخ:{{App\Restaurants::where('id','=',$order->restaurant_id)->first()->restaurant_name}}
                        @endif
                </div>
                <div style="background-color: #f8efc0">
                    <div class="row">
                        <div class="col col-sm-3">الصنف</div>
                        <div class="col col-sm-3">السعر</div>
                        <div class="col col-sm-3">الكمية</div>
                        <div class="col col-sm-3">الاجمالي</div>
                    </div>
                    <div style="display: none">
                        {{$i = 0}}
                    </div>

                    @foreach(App\mobileorder::where('order_id','=',$order->order_id)->get() as $item)
                        <div class="row" style="border: #2a3140;">
                            <div class="col col-sm-3">{{$item->item_name}}</div>
                            <div class="col col-sm-3">{{$item->item_price}}</div>
                            <div class="col col-sm-3">{{$item->quantity}}</div>
                            <div class="col col-sm-3">{{$item->item_price * $item->quantity}}</div>
                        </div>
                        <div style="display: none">
                        {{$i = $i + $item->item_price * $item->quantity}}
                        </div>
                        @endforeach
                    <div class="row">
                        <div class="col col-sm-3"></div>
                        <div class="col col-sm-3"></div>
                        <div class="col col-sm-3">ألمجموع</div>
                        <div class="col col-sm-3">{{$i}}</div>
                    </div>
                    @if(Auth::user()->usertype != 'User')
                    @if($action == 'new')
                    <div class="row">
                        <div class="col col-sm-3">
                            <a href="{{url('mobile/endOrder' . '/' . $order->id)}}" class="btn btn-success btn-sm">تم التسليم</a>
                        </div>
                        <div class="col col-sm-3">
                            <a href="{{url('mobile/cancelOrder' . '/' . $order->id)}}" class="btn btn-danger btn-sm">الغاء</a>

                        </div>
                        <div class="col col-sm-3">
                            <a href="{{url('mobile/soryOrder' . '/' . $order->id)}}" class="btn btn-primary btn-sm">اعتذار</a>
                        </div>
                        <div class="col col-sm-3">
                            @if($order->status != 'hold')
                            <a href="{{url('mobile/holdOrder' . '/' . $order->id)}}" class="btn btn-dark btn-sm">تعليق</a>
                                @else
                                <a href="#" class="btn btn-outline-dark btn-sm">معلق</a>

                            @endif

                        </div>


                    </div>
                    @else
                        <div class="row">
                            @if($order->status == 'end')
                            <div class="col col-sm-12">
                                <a class="btn btn-success btn-block">مكتمل</a>
                            </div>
                            @endif
                                @if($order->status == 'cancel')

                                    <div class="col col-sm-12">
                                <a class="btn btn-danger btn-block">تم الغاءه</a>

                            </div>
                                @endif
                                @if($order->status == 'sory')
                                <div class="col col-sm-12">
                                <a class="btn btn-primary btn-block">تم الاعتذار</a>
                            </div>
                                @endif

                        </div>
                    @endif
                    @endif

                </div>

                    <hr>
                @endforeach

            </div>
        </div>
    </div>

@endsection
