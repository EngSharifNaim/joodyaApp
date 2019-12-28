@extends("app")

@section('head_title', 'Order Confirmed' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 

<div class="container">
			<div class="content-page">
				<div class="shop-banner banner-adv line-scale zoom-image">
					<a href="#" class="adv-thumb-link"><img src="{{ URL::asset('nsite_assets/images/page/about.jpg') }}" alt=""></a>
					<div class="banner-info">
						<h2 class="title30 color">تأكيد الطلب</h2>
						<div class="bread-crumb white"><a href="#" class="white">الرئيسية</a><span>تأكيد الطلب</span></div>
					</div>
				</div>
				<!-- ENd Banner -->
				<div class="content-cart-checkout woocommerce">
          <h2 class="title30 font-bold text-uppercase">تم تأكيد الطلب</h2>
          <h2 class="title30 font-bold text-uppercase">نشكر لكم ثقتكم بنا</h2>
					<form method="post">
						<div class="table-responsive">
							<table class="shop_table cart table">
								<thead>
									<tr>
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

                  @foreach(\App\Cart::where('user_id',Auth::id())->orderBy('id')->get() as $n=>$order_item)
             
                
                <tr class="cart_item">
						
										<td class="product-thumbnail">

                    @if($order_item->menu_image)
                        <a href="{{ URL::asset('upload/menu/'.$order_item->menu_image.'-s.jpg') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                      @else
                        <a href="{{ URL::asset('upload/menu_img_s.png') }}" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>

                      @endif
            


										</td>
										<td class="product-name" data-title="Product">
											<a href="#">{{$order_item->item_name}}</a>					
										</td>
										<td class="product-price" data-title="Price">
											<span class="amount">{{getcong('currency_symbol')}}{{$order_item->item_price}} </span>					
										</td>
										<td class="product-quantity" data-title="Quantity">
											
												<span class="qty-val">{{$order_item->quantity}}</span>
											
										</td>



										<td  >
												<span class="qty-val">{{$order_item->item_size}}</span>
										</td>

										<td >
                              @if($order_item->features)

                             <ul>
                                foreach (json_decode($order_item->features, true) as $feature){
                                    <li> {{$feature->name.' - '.$feature->price.' - ' }}{{getcong('currency_symbol').'-'}}  </li>
                                }

                             </ul>

                              @else
                              <span class="qty-val">لا يوجد</span>
                              @endif
										</td>

										<td class="product-subtotal" data-title="Total">
											<span class="amount">{{getcong('currency_symbol').'-' }}{{$order_item->item_price *$order_item->quantity }}</span>					
										</td>
									</tr>
                     
                @endforeach

						
									  <tr class="cart-subtotal">
                      <td  colspan="5"></td>
											<th  >المجموع</th>
											<td><strong class="amount">{{getcong('currency_symbol')}}{{$price = DB::table('cart')
                ->where('user_id', Auth::id())
                ->sum('item_price')}}</strong></td>
										</tr>
										</td>
									</tr>
								</tbody>
							</table>
            </div>
            <div class="wc-proceed-to-checkout">
								<a class="checkout-button button alt wc-forward bg-color" href="{{URL::to('myorder')}}" >قائمة طلباتي</a>
							</div>
					</form>
				</div>	
			</div>
		</div>


 



@endsection
