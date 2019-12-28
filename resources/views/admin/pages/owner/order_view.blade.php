@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		<h2>قائمة الطلبات</h2>
        <a href="{{ URL::to('admin/allorder') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> العودة للخلف</a>
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
        

                <div class="box box-info">
        
        <div class="box-body">

    
<div class="col-sm-3 col-xs-6 tital " > اسم المستخدم:</div><div class="col-sm-7 col-xs-6 ">{{ $user->getUserFullname($user->id) }}</div>
 <div class="clearfix"></div>
<div class="bot-border"></div>


<div class="col-sm-3 col-xs-6 tital " >الجوال:</div><div class="col-sm-7">{{ $user->mobile }}</div>

<div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-3 col-xs-6 tital " >الإيميل:</div><div class="col-sm-7">{{ $user->email }}</div>

<div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-3 col-xs-6 tital " >العنوان:</div><div class="col-sm-7">{{ $user->address }}</div>

<div class="clearfix"></div>
<div class="bot-border"></div>


        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
  
    </div>
</div>
<div class="panel panel-default panel-shadow">
    <div class="panel-body">
        <table id="order_data_table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>التاريخ</th>
                <th>الوجبة</th>
                <th>العدد</th>
                <th>سعر الوجبة</th>
                <th>السعر الكلي</th>
                <th>الحالة</th>                           
                <th class="text-center width-100">أدوات</th>


            </tr>
            </thead>


            <tbody>
            @foreach($order->items as $i => $order)
            @if(   $order->resturant->id == $restaurant_id )

            <tr>
                <td>{{ date('m-d-Y',$order->created_date)}}</td>
                <td>{{ $order->item_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{getcong('currency_symbol')}}{{ \App\Menu::getMenunfo($order->item_id)->price }}</td>
                <td>{{getcong('currency_symbol')}}{{ $order->item_price }}</td>
                <td>{{ $order->status }}</td>
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
            </td>
                
            </tr>
            @endif
           @endforeach
             
            </tbody>
        </table>
         <script type="text/javascript">
            $(document).ready(function() {
            
                $('#order_data_table').dataTable({
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "sProcessing":   "جارٍ التحميل...",
                        "sLengthMenu":   "أظهر _MENU_ مدخلات",
                        "sZeroRecords":  "لم يعثر على أية سجلات",
                        "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                        "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                        "sInfoPostFix":  "",
                        "sSearch":       "ابحث:",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "الأول",
                            "sPrevious": "السابق",
                            "sNext":     "التالي",
                            "sLast":     "الأخير"
                        }
                    }
                });

            } );
         </script>
    </div>
    <div class="clearfix"></div>
</div>

</div>

@endsection