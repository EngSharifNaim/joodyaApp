

<!-- Modal: modalPoll -->
<div class="modal fade right" id="add-to-cart-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">إضافة إلى السلة</h4>
      </div>
      <!--Body-->
      <div class="modal-body">
	  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

         <div class="product-detail">
							<div class="row">
								<div class="col-md-6 col-sm-5 col-xs-12">
									<div >
										<div class="mid">
                   						 <img  class="modal-meal-image" src="{{ URL::asset('nsite_assets/images/product/fruit_24.jpg') }}" alt="">
                  						</div>
									</div>
									<!-- End Gallery -->
								</div>
								<div class="col-md-6 col-sm-7 col-xs-12">
									<div class="detail-info">
										<h2 class="title30 font-bold modal-meal-name">Fresh Meal Kit</h2>
										<div class="product-price">
											<ins class="color"><span class="modal-meal-sympole">{{getcong('currency_symbol')}}</span> <span class="modal-meal-price"  >450.000</span></ins>
										</div>
										<!--<div class="product-rate">
												<div class="product-rating" style="width:100%"></div>
											</div>  -->
										<p class="desc modal-meal-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
										<ul class="list-inline-block wrap-qty-extra">
											<li>
												<div class="detail-qty-modal">
													<a href="#" class="qty-down silver"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>
													<span class="qty-val">1</span>
													<a href="#" class="qty-up silver"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>
												</div>
											</li>
											<li>
												
													<p class="desc info-extra item-size-modal" id="item-size-modal">
															<ul class="list-none" id="item-size-modal-ul">
																<li id="small_modal_li" >
																	<input type="radio" class="shipping_method size_price" checked="checked"  id="small_modal_radio" data-index="صغير" name="size_price[]">
																	<label for="small_modal_radio">صغير</label> <span class="price"  id="small_modal_radio_price" > </span>$  
																</li>
																<li id="mid_modal_li" >
																	<input type="radio" class="shipping_method size_price" id="mid_modal_radio" data-index="وسط"  name="size_price[]">
																	<label for="mid_modal_radio">متوسط</label> <span  class="price" id="mid_modal_radio_price"  > </span>R 
																</li>
																<li id="big_modal_li" >
																	<input type="radio" class="shipping_method size_price" id="big_modal_radio" data-index="كبير"   name="size_price[]">
																	<label for="big_modal_radio">كبير</label> <span class="price" id="big_modal_radio_price"  > </span>$ 
																</li>
															</ul>
												</p>


											</li>
										</ul>
	
										
									</div>			
								</div>




							</div>

							<div class="row  features-row">
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div >
										<div class="mid">
										<label>الإضافات:</label>
											<p class="desc info-extra item-features-modal">
											
												
											</p>
	
										</div>
									</div>
									<!-- End Gallery -->
								</div>
							</div>
						</div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-primary addcart-link   addtocart_send ">إضافة إلى السلة
          <i class="fa fa-paper-plane ml-1"></i>
		</a>
		

        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">إلغاء</a> 
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalPoll -->

