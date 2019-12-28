@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ isset($menu->menu_name) ? 'تحديث: '. $menu->menu_name : 'إضافة' }}</h2>
		
		<a href="{{ URL::to('admin/menu') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> العودة</a>
	  
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
                {!! Form::open(array('url' => array('admin/menu/addmenu'),'class'=>'form-horizontal padding-15','name'=>'menu_form','id'=>'menu_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                
                <input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
                <input type="hidden" name="id" value="{{ isset($menu->id) ? $menu->id : null }}">
                <input type="hidden"  id="fixed_price_filed" value="{{ isset($menu->fixed_price) ? $menu->fixed_price : null }}">

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">تصنيف الوجبة</label>
                    <div class="col-sm-4">
                        <select id="basic" name="menu_cat" class="selectpicker show-tick form-control" >
                            <option value="">إختر التصنيف</option>
                            
                            @foreach($categories as $i => $category)    
                                @if(isset($menu->menu_cat) && $menu->menu_cat==$category->id)  
                                    <option value="{{$category->id}}" selected >{{$category->category_name}}</option>
                                     
                                @else
                                <option value="{{$category->id}}">{{$category->category_name}}</option> 
                                @endif                          
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">إسم الوجبة</label>
                      <div class="col-sm-9">
                        <input type="text" name="menu_name" value="{{ isset($menu->menu_name) ? $menu->menu_name : null }}" class="form-control" required="required" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">الوصف</label>
                      <div class="col-sm-9">
                        <input type="text" name="description" value="{{ isset($menu->description) ? $menu->description : null }}" class="form-control" required="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">الصورة</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($menu->menu_image))
                                 
                                    <img src="{{ URL::asset('upload/menu/'.$menu->menu_image.'-s.jpg') }}" width="100" alt="person">
                                @endif
                                                                
                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="menu_image" class="filestyle"  {{ isset($menu->menu_name) ? '' : 'required="required"' }}   > 
                            </div>
                        </div>
    
                    </div>
                </div>  

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">كيفية التسعير</label>
                    <div class="col-sm-4">
                        <select id="fixed_price" name="fixed_price" class="selectpicker show-tick form-control" >
                                <option value="">كيفية التسعير</option>
                                <option value="1">أحجام</option> 
                                <option value="0">سعر ثابت</option> 
                        </select>
                    </div>
                </div>


                <div class="form-group price_div " >
                    <label for="" class="col-sm-3 control-label">السعر</label>
                      <div class="col-sm-2">
                         
                        <input id="price" data-toggle="touch-spin" data-min="-1000000" data-max="1000000" data-prefix="$" data-step="1" type="text" value="{{ isset($menu->price) ? $menu->price : null }}" name="price" class="form-control"  />
                    </div>
                </div>


                <div class="form-group size_div"   >
                    <label for="avatar" class="col-sm-3 control-label">الأحجام</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <div class="col-lg-2">
                                <div class="checkbox checkbox-success">
                                    <input id="small"  name="small" type="checkbox"  {{ (isset($menu->small) &&  $menu->small == 1 )   ? 'Checked' : '' }}  >
                                        <label for="small">
                                            صغير
                                        </label>
                                </div>
                            </div><!-- /.col-lg-2 -->
                            <div class="col-lg-3">
                                <input type="text" data-toggle="touch-spin" data-min="-1000000" data-max="1000000" data-prefix="$" data-step="1" id="small_price" name="small_price" class="form-control" placeholder="السعر" value="{{ isset($menu->small_price) ? $menu->small_price : null }}" disabled="disabled"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <div class="checkbox checkbox-success">
                                    <input id="mid" name="mid" type="checkbox" {{ (isset($menu->med) &&  $menu->med == 1 )   ? 'Checked' : '' }} >
                                        <label for="mid">
                                            وسط
                                        </label>
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3">
                                <input type="text" id="mid_price" name="mid_price" data-toggle="touch-spin" data-min="-1000000" data-max="1000000" data-prefix="$" data-step="1" class="form-control" placeholder="السعر" value="{{ isset($menu->mid_price) ? $menu->mid_price : null }}"  disabled="disabled" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <div class="checkbox checkbox-success">
                                    <input id="big"  name="big" type="checkbox" {{ (isset($menu->big) &&  $menu->big == 1 )   ? 'Checked' : '' }} >
                                        <label for="big">
                                            كبير
                                        </label>
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3">
                                <input type="text" id="big_price" name="big_price" data-toggle="touch-spin" data-min="-1000000" data-max="1000000" data-prefix="$" data-step="1" class="form-control" placeholder="السعر" value="{{ isset($menu->big_price) ? $menu->big_price : null }}" disabled="disabled" >
                            </div>
                        </div>
                </div>  
                </div>  
                <div class="form-group">
                  <label for="avatar" class="col-sm-3 control-label">الإضافات</label>
                    <div class="col-sm-9">
    
                        <div class="input-group control-group after-add-more">
                        <div class="row">
                             <div class="input-group-btn"> 
                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> إضافات جديدة</button>
                                </div>
                        </div>
                        </div>
                        @if(isset($menu->features) )
                                    @foreach(  $menu->features as $feature)
                                   
                                    <div class="control-group input-group" style="margin-top:10px">
                                    
                                        <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                            <label for="small">اسم الإضافة</label>
                                            <input type="text" value="{{$feature->name}}" name="menu_feature_name[]" class="form-control" aria-label="...">
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->

                                        <div class="col-lg-3 price_div">
                                            <div class="input-group">
                                            <label for="small">السعر</label>
                                            <input type="text"  value="{{$feature->fixed_price}}" name="add_fixed_price[]" class="form-control" aria-label="..."  >
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->



                                        <div class="col-lg-3 size_div">
                                            <div class="input-group">
                                            <label for="small">سعر الصغير</label>
                                            <input type="text"  value="{{$feature->small_price}}" name="small_add_price[]" class="form-control" aria-label="..."  >
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                        <div class="col-lg-3 size_div">
                                            <div class="input-group">
                                            <label for="small">الوسط</label>
                                            <input type="text" value="{{$feature->mid_price}}"  name="mid_add_price[]" class=" form-control" aria-label="..."  >
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                        <div class="col-lg-3 size_div">
                                            <div class="input-group">
                                            <label for="small">الكبير</label>
                                            <input type="text" value="{{$feature->big_price}}"  name="big_add_price[]" class="form-control" aria-label="..."  >
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                        </div><!-- /.row -->

                                        <label for="small"></label>

                                        <div class="input-group-btn"> 
                                        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>حذف</button>
                                        </div>
                                     </div>
                                   
                                    @endforeach
                        @endif
                    
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button id="add_menu_btn" type="submit" class="btn btn-primary pull-left">{{ isset($menu->id) ? 'تحديث ' : 'إضافة' }}</button>
                         
                    </div>
                </div>
                
                {!! Form::close() !!} 
            </div>
        </div>

                 <!-- Copy Fields -->
                 <div class="copy hide">
                    <div class="control-group input-group" style="margin-top:10px">
                        <div class="row">
                        <div class="col-lg-3">
                            <div class="input-group">
                            <label for="small">اسم الإضافة</label>
                            <input type="text"  name="menu_feature_name[]" class="form-control" aria-label="...">
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->

                        <div class="col-lg-3 price_div">
                                            <div class="input-group">
                                            <label for="small">السعر</label>
                                            <input type="text"  name="add_fixed_price[]" class="form-control" aria-label="..."  >
                                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->

                        <div class="col-lg-3 size_div">
                            <div class="input-group">
                            <label for="small">سعر الصغير</label>
                            <input type="text" name="small_add_price[]" class="small_add_price form-control" aria-label="..." disabled="disabled">
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-3 size_div">
                            <div class="input-group">
                            <label for="small">الوسط</label>
                            <input type="text" name="mid_add_price[]" class="mid_add_price form-control" aria-label="..." disabled="disabled">
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-3 size_div">
                            <div class="input-group">
                            <label for="small">الكبير</label>
                            <input type="text" name="big_add_price[]" class="big_add_price form-control" aria-label="..." disabled="disabled">
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->

                        <label for="small"></label>

                        <div class="input-group-btn"> 
                        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> حذف</button>
                        </div>
                    </div>
                 
                </div>


<script type="text/javascript">


    $(document).ready(function() {



    });


</script>

@endsection