@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		
		<div class="pull-left">
			<a href="{{URL::to('admin/restaurants/addrestaurant')}}" class="btn btn-primary">إضافة مطبخ جديد <i class="fa fa-plus"></i></a>
		</div>
		<h2>المطابخ</h2>
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
                <th>الاسم</th>
                                <th>الجوال</th>

                <th>أصناف القوائم</th>
                <th>عدد الوجبات</th>
                <th>الطلبات</th>                         
                <th class="text-center width-100">أدوات</th>
            </tr>
            </thead>

            <tbody>
            @foreach($restaurants as $i => $restaurant)
            <tr>
                <td><a href="{{ url('admin/restaurants/view/'.$restaurant->id) }}" class="text-regular">{{ $restaurant->restaurant_name}}</a>
                    <a href="{{ url('admin/restaurants/view/'.$restaurant->id) }}" class="text-muted"><i class="md md-local-restaurant"></i></a></td>  
                    <td>{{App\User::where('id','=',$restaurant->user_id)->first()->mobile}}</td>
                <td>{{App\Restaurants::getMenuCategories($restaurant->id)}}</td>
                <td>{{App\Restaurants::getMenuItems($restaurant->id)}}</td>
                <td>{{App\Restaurants::getOrders($restaurant->id)}}</td>                          
                <td class="text-center">
                <a href="{{ url('admin/restaurants/view/'.$restaurant->id) }}" class="btn btn-default btn-rounded"><i class="md md-settings-display"></i></a>
                <a href="{{ url('admin/restaurants/addrestaurant/'.$restaurant->id) }}" class="btn btn-default btn-rounded"><i class="md md-edit"></i></a>
                <a href="{{ url('admin/restaurants/delete/'.$restaurant->id) }}" class="btn btn-default btn-rounded" onclick="return confirm('ها تمن متأكد ؟ لن تستطيع إستعادة البانات .')"><i class="md md-delete"></i></a>
            </td>
                
            </tr>
           @endforeach
             
            </tbody>
        </table>
         
    </div>
    <div class="clearfix"></div>
</div>

</div>

@endsection