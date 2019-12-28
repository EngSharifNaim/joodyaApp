@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		
		<div class="pull-left">
			<a href="{{URL::to('admin/restaurants/view/'.$restaurant_id.'/categories/addcategory')}}" class="btn btn-primary">إضافة <i class="fa fa-plus"></i></a>
		</div>
		<h2>أصناف</h2>
        <a href="{{ URL::to('admin/restaurants/view/'.$restaurant_id) }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> العودة إلى المطابخ</a>
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
                <th>الإسم</th>                           
                <th class="text-center width-100">أدوات</th>
            </tr>
            </thead>

            <tbody>
            @foreach($categories as $i => $category)
            <tr>
                <td>{{ $category->category_name }}</td>                
                <td class="text-center">
                <a href="{{ url('admin/restaurants/view/'.$restaurant_id.'/categories/addcategory/'.$category->id) }}" class="btn btn-default btn-rounded"><i class="md md-edit"></i></a>
                <a href="{{ url('admin/restaurants/view/'.$restaurant_id.'/categories/delete/'.$category->id) }}" class="btn btn-default btn-rounded" onclick="return confirm('ها تمن متأكد ؟ لن تستطيع إستعادة البانات .')"><i class="md md-delete"></i></a>
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