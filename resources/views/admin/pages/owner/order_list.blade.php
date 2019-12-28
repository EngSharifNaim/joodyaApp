@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		
		
		<h2>قائمة الطلبات</h2>
         
	</div>
	@if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif
     
<div class="panel panel-default panel-shadow">
    <div class="panel-body">
         
        <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                 <th>التاريخ</th>
                <th>المستخدم</th>
                <th>المحتويات</th>                           
                <th>التفاصيل</th>
            </tr>
            </thead>

            <tbody>
            @foreach($order_list as $i => $order)
            <tr>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>{{ \App\User::getUserFullname($order->user_id) }}</td>
      

                <?php /*
          <!--  <td>{{ \App\User::getUserInfo($order->user_id)->mobile }}</td>
                <td>{{ \App\User::getUserInfo($order->user_id)->email }}</td>
                <td>{{ \App\User::getUserInfo($order->user_id)->address }}</td>
                <td><a href="{{ url('admin/restaurants/view/'.$order->restaurant_id) }}" class="text-regular">{{ \App\Restaurants::getRestaurantsInfo($order->restaurant_id)->restaurant_name }}</a></td>
                <td>{{ $order->item_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{getcong('currency_symbol')}}{{ \App\Menu::getMenunfo($order->item_id)->price }}</td>
                <td>{{getcong('currency_symbol')}}{{ $order->item_price }}</td> -->  */?>
                <td>
                <ul>
                @foreach($order->items as $i => $item)
                 
                    @if(  $item->resturant->id == $restaurant_id )
                          <li>{{   $item->item_name .'  { '.$item->status.' }' }} </li>

                    @endif
                @endforeach
                </ul>
                </td>
                <td>


        <a class="btn" href="{{ url('admin/order/view/'.$order->id) }}" ><i class="fa fa-search"></i></a>

        </td>
               <!-- </td>
                <td class="text-center">
                <div class="btn-group">
                                <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    أدوات <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/الإنتظار') }}"><i class="md md-lock"></i> الإنتظار</a></li>
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/جاري الإعداد') }}"><i class="md md-loop"></i> جاري الإعداد</a></li>
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/اكتمال') }}"><i class="md md-done"></i> اكتمال</a></li>
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/إلغاء') }}"><i class="md md-cancel"></i> إلغاء</a></li>
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id) }}"><i class="md md-delete"></i> حذف</a></li>
                                </ul>
                            </div> 
            </td> -->
            </tr>
           @endforeach
                          
            </tbody>
        </table>
         
    </div>
    <div class="clearfix"></div>
</div>

</div>

@endsection