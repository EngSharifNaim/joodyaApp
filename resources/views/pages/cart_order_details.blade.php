@extends("app")

@section('head_title', 'Order Details' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 
<div class="container">
				<div class="shop-banner banner-adv line-scale zoom-image">
					<a href="#" class="adv-thumb-link"><img src="{{ URL::asset('nsite_assets/images/page/about.jpg') }}" alt=""></a>
					<div class="banner-info">
						<h2 class="title30 color">الدفع</h2>
						<div class="bread-crumb white"><a href="#" class="white">الرئيسية</a><span>الدفع</span></div>
					</div>
				</div>
				<!-- ENd Banner -->
				<div class="content-cart-checkout woocommerce">
          <h2 class="title30 font-bold text-uppercase text-center">الدفع</h2>
          <h2 class="title30 font-bold text-uppercase text-center">تفاصيل طلب الشراء</h2>

          
					<div class="row">
                         
          {!! Form::open(array('url' => 'order_details','class'=>'','id'=>'order_details','role'=>'form')) !!} 

          <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-ms-12">
									<div class="check-billing">
                 
                 

                      <div class="message"> 
                                  <!--{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}-->
                                  @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                    
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                              
                      </div>
                      @if(Session::has('flash_message'))
                      <div class="alert alert-success">             
                          {{ Session::get('flash_message') }}
                      </div>
                      @endif
											<h2 class="title title18 rale-font font-bold text-uppercase">معلومات الدفع</h2>
											<p class="clearfix box-col2">
												<input name="first_name" type="text" value="{{ $user->first_name ?? 'الاسم *' }}" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
												<input  name="last_name"  type="text" value=" {{ $user->last_name ?? 'العائلة *' }}" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
											</p>
											<p class="clearfix box-col2">
												<input  name="email" type="text" value=" {{ $user->email ?? 'الإيميل *' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
												<input  name="mobile"  type="text" value=" {{ $user->mobile ?? 'الجوال *' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
											</p>
	
											<p class="clearfix box-col2" ><input name="address" type="text" value=" {{ $user->address ?? 'العنوان *' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''"></p>
                  
                      <p class="clearfix box-col2">
                      <input name="postal_code" type="text" value=" {{ $user->postal_code ?? ' الرمز البريدي' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">

                      <input name="city"  type="text" value=" {{ $user->city ?? 'المدينة / الحي' }}  *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">

                      </p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-ms-12">
									<div class="check-address">
										<form class="form-my-account">
											<p class="ship-address  ">
												<input name="if_alter_adress"  name="" type="checkbox" id="address"> <label for="address">التوصيل إلى عنوان اخر</label>
											</p>
											<p>
												<textarea  name="alter_adress" cols="74" rows="5" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">ملاحظات و العنوان الأخر </textarea>
											</p>
										</form>
									</div>		
								</div>
							</div>
							<h3 class="order_review_heading bg-color">محتويات السلة </h3>
            
              <div class="table-responsive">
							<table class="shop_table cart table">
								<thead>
									<tr>
										<th class="product-remove">&nbsp;</th>
										<th class="product-thumbnail">&nbsp;</th>
										<th class="product-name">المنتج</th>
										<th class="product-price">السعر</th>
										<th class="product-quantity">العدد</th>
										<th class="product-quantity">الحجم</th>
										<th class="product-quantity">الإضافات</th>
										<th class="product-subtotal">المجموع</th>
									</tr>
								</thead>
								<tbody>
                  
                
                @foreach(\App\Cart::where('user_id', Auth::user()->id)->orderBy('item_id')
                ->leftJoin('menu', 'cart.item_id', '=', 'menu.id')->select(
                  'cart.id',
                  'menu.menu_image',
                  'menu.menu_name',
                  'cart.item_price',
                  'cart.item_size',
                  'cart.item_features',
                  'cart.quantity'
          )->get() as $n=>$cart_item)
                                   
                              
                  <tr class="cart_item">
										<td class="product-remove">
											<a class="remove" href="{{URL::to('delete_item/'.$cart_item->id)}}"><i class="fa fa-times"></i></a>
										</td>
										<td class="product-thumbnail">
                      
                      
                      @if($cart_item->menu_image)
                        <a href="{{ URL::asset('upload/menu/'.$cart_item->menu_image.'-b.jpg') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                      @else
                        <a href="{{ URL::asset('upload/menu_img_s.png') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>

                      @endif
            

										</td>
										<td class="product-name" data-title="Product">
											<a href="#">{{$cart_item->menu_name}}</a>					
										</td>
										<td class="product-price" data-title="Price">
											<span class="amount">{{getcong('currency_symbol').'-'}} {{$cart_item->item_price}}</span>					
										</td>
										<td class="product-quantity" data-title="Quantity">
												<span class="qty-val">{{$cart_item->quantity}}</span>
										</td>
                    <td  >
												<span class="qty-val">{{$cart_item->item_size}}</span>
										</td>

										<td >
                              @if($cart_item->features)

                             <ul>
                                foreach (json_decode($cart_item->features, true) as $feature){
                                    <li> {{$feature->name.' - '.$feature->price.' - ' }}{{getcong('currency_symbol').'-'}}  </li>
                                }

                             </ul>

                              @else
                              <span class="qty-val">لا يوجد</span>
                              @endif
										</td>

										<td class="product-subtotal" data-title="Total">
											<span class="amount">{{getcong('currency_symbol').'-' }}{{$cart_item->item_price *$cart_item->quantity }}</span>					
										</td>
                  </tr>
                  
                              
                                  @endforeach


                  

									<tr>
										<td class="actions" colspan="8">
											<div class="coupon">
                        <input type="submit" value="تأكيد الطلب" class=" button bg-color "></button>

                      </div>
          


										</td>
									</tr>
								</tbody>
							</table>
						</div>
            {!! Form::close() !!} 
        </div>
      </div>	
    </div>
</div>







<!--

<div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
    <div class="overlay">
      <div class="container">
        <h1>تفاصيل طلب الشراء</h1>
      </div>
    </div>
  </div>

 <div class="restaurant_list_detail">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-7 col-xs-12">
          <div class="box_style_2" id="order_process">
          <h2 class="inner">تفاصيل طلب الشراء</h2>
          {!! Form::open(array('url' => 'order_details','class'=>'','id'=>'order_details','role'=>'form')) !!} 

            <div class="message"> -->
                        <!--{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}-->
                            <!--        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                          
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                                    
        </div>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">             
                {{ Session::get('flash_message') }}
            </div>
        @endif

          <div class="form-group">
            <label>الاسم</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}" placeholder="First name">
          </div>
          <div class="form-group">
            <label>العائلة</label>
            <input type="text" class="form-control" id="last_name" value="{{$user->last_name}}" name="last_name" placeholder="Last name">
          </div>
          <div class="form-group">
            <label>الهاتف/الجوال</label>
            <input type="text" id="mobile" name="mobile" value="{{$user->mobile}}" class="form-control" placeholder="Telephone/mobile">
          </div>
          <div class="form-group">
            <label>الإيميل</label>
            <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Your email">
          </div>           
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label>المدينة</label>
                <input type="text" id="city" name="city" value="{{$user->city}}" class="form-control" placeholder="Your city">
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label>صندوق بريد</label>
                <input type="text" id="postal_code" name="postal_code" value="{{$user->postal_code}}" class="form-control" placeholder=" Your postal code">
              </div>
            </div>
          </div>
           
          <hr>
          <div class="row">
            <div class="col-md-12">
              <label>العنوان بالكامل</label>
              <textarea class="form-control" style="height:150px" placeholder="Address" name="address" id="address">{{$user->address}}</textarea>
            </div>
          </div>
             
      
        </div> -->
        <!-- End box_style_1 --> 
        <!--  </div>
    <div class="col-md-3 col-sm-5 col-xs-12 side-bar">   
    <div id="cart_box">
          <h3>طلب الشراء <i class="icon_cart_alt pull-right"></i></h3>
          
          <table class="table table_summary">
            <tbody>
              @foreach(\App\Cart::where('user_id',Auth::id())->orderBy('id')->get() as $n=>$cart_item)
              <tr>
                <td><a href="{{URL::to('delete_item/'.$cart_item->id)}}" class="remove_item"><i class="fa fa-minus-circle"></i></a> <strong>{{$cart_item->quantity}}x</strong> {{$cart_item->item_name}} </td>
                <td><strong class="pull-right">{{getcong('currency_symbol')}}{{$cart_item->item_price}}</strong></td>
              </tr>
              @endforeach
               
            </tbody>
          </table>
            --> 
          <!-- Edn options 2 -->
       <!--   
          <hr>
          @if(DB::table('cart')->where('user_id', Auth::id())->sum('item_price')>0)
          <table class="table table_summary">
            <tbody>
              
              <tr>
                <td class="total"> المجموع <span class="pull-right">{{getcong('currency_symbol')}}{{$price = DB::table('cart')
                ->where('user_id', Auth::id())
                ->sum('item_price')}}</span></td>
              </tr>
            </tbody>
          </table>
          <hr>
           
          <button type="submit" class="btn_full">تأكيد الطلب</button>
        </div>

          {!! Form::close() !!} 
          @else
            <a class="btn_full" href="#">السلة فارغة</a> </div>
          @endif-->
        <!-- End cart_box -->                                                                               
   <!-- <div id="help" class="box_style_2"> 
      <i class="fa fa-life-bouy"></i>
        <h4>{{getcong_widgets('need_help_title')}}</h4>
        <a href="tel://{{getcong_widgets('need_help_phone')}}" class="phone">{{getcong_widgets('need_help_phone')}}</a> <small>{{getcong_widgets('need_help_time')}}</small> 
      </div>
        </div>
                
      </div>
    </div>
  </div>

-->  

@endsection
