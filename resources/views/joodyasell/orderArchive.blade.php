@if(count($archiveOrders) == 0)
    لا يوجد طلبات جديدة
@endif
@foreach($archiveOrders as $order)

    <div class="card card-collapsed">
        <div class="card-header header-elements-inline" dir="rtl">
            <div class="row">
                <h8 class="card-title"><i class="icon-user"></i>{{$order->user_name}}</h8>
            </div>
            <div class="row">
                <h8 class="card-title"><i class="icon-sort-time-asc"></i> {{$order->created_at->diffForHumans()}}</h8>
            </div>

            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" >
                        @if(Auth::User()->usertype == 'Admin')
                            {{App\Restaurants::where('id',$order->restaurant_id)->first()->restaurant_name}}
                        @endif

                    </a>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div dir="rtl">
                    <h8 class="card-title"><i class="icon-mobile"></i> <a href="tel: {{$order->user_mobile}}">اتصل بالزبون الآن</a></h8>
                </div>
                <div dir="rtl">
                    اجمالي الطلبية ({{$order->total_price}})
                </div>
                @if($order->details <> '')
                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="font-weight-semibold mb-0">ملاحظات اضافية</h3>
                                <span class="text-uppercase font-size-sm text-muted">{{$order->details}}</span>
                            </div>

                            <div class="ml-3 align-self-center">
                                <i class="icon-bubbles4 icon-3x text-blue-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                    @endif
            </div>
            <div class="table-responsive" dir="rtl">
                <table class="table">
                    <thead>
                    <tr class="bg-blue">
                        <th>صنف</th>
                        <th>كمية</th>
                        {{--                        <th>Last Name</th>--}}
                        {{--                        <th>Username</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(App\mobileorder::where('order_id','=',$order->id)->get() as $item)

                        <tr>
                            <td>{{$item->item_name}}</td>
                            <td>{{$item->quantity}}</td>
                            {{--                        <td>Kopyov</td>--}}
                            {{--                        <td>@Kopyov</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div style="background-color: #ece5e5; text-align: center">
        <h7>{{$order->status}}</h7>
            @if (Auth::User()->usertype=='Admin')
            <a class="btn btn-warning btn-block" href="{{url('joodyasell/delete_order' . '/' . $order->id)}}">حذف</a>
                @endif
        </div>
    </div>
@endforeach

