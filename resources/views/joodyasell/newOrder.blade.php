@if(count($newOrders) == 0)
    لا يوجد طلبات جديدة
@endif
@foreach($newOrders as $order)

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
                    <a class="list-icons-item">
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
                        <th>سعر</th>
{{--                        <th>Username</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(App\mobileorder::where('order_id','=',$order->id)->get() as $item)

                        <tr>
                        <td>{{$item->item_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->item_price}}</td>
{{--                        <td>@Kopyov</td>--}}
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="nav nav-pills nav-pills-bordered nav-pills-toolbar nav-justified">
                    <li class="nav-item"><a id="hold_order" href="javascript:hold_order({{$order->id}})" class="nav-link">تعليق</a></li>
                    <li class="nav-item"><a href="{{url('joodyasell/cancel_order' . '/' . $order->id)}}" class="nav-link">الغاء</a></li>
                    <li class="nav-item"><a href="{{url('joodyasell/apol_order' . '/' . $order->id)}}" class="nav-link">اعتذار</a></li>
                    <li class="nav-item"><a href="{{url('joodyasell/endOrder' . '/' . $order->id)}}" class="nav-link">تسليم</a></li>
                </ul>
{{--                <a href="{{url('joodyasell/endOrder' . '/' . $order->id)}}" class="btn btn-success btn-block">إنهاء و ارسال للأرشيف</a>--}}
            </div>
        </div>

    </div>
@endforeach
<script type="text/javascript">
    function hold_order(order_id){

        var rout = "../../joodyasell/hold_order/" + order_id;
        $.ajax({
            url: rout,
            // method:'get',
            dataType:'json',
            // contentType: false,
            // cache: false,
            // processData:false,
            beforeSend:function(){
                $('#hold_order').attr('disabled','disabled');
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
                            'تعليق',
                            'تم تعليق الطلب',
                            'success'
                        )

                    }
                    else {
                        Swal.fire(
                            'Good job!',
                            'You clicked the button!',
                            'success'
                        )
                    }
                }
                $('#hold_order').attr('disabled', false);

            }

        });
    }

</script>
