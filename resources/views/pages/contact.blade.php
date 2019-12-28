@extends("app")

@section('head_title', 'Contact Us | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 

	<!-- End Header -->
	<section id="content">
		<div class="container">
			<div class="content-page">
				<div class="mapouter"><div class="gmap_canvas"><iframe width="1170" height="380" id="gmap_canvas" src="https://maps.google.com/maps?q=Aljondy%20Almajhool%20Park&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">visual composer theme</a></div><style>.mapouter{position:relative;text-align:right;height:380px;width:1170px;}.gmap_canvas {overflow:hidden;background:none!important;height:380px;width:1170px;}</style></div>
				<div class="contact-info-page">
					<div class="list-contact-info">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="item-contact-info text-center">
									<a class="contact-icon color wobble-horizontal" href="#"><i class="fa fa-mobile"></i></a>
									<h2 class="title18 text-upperrcase font-bold">الأرضي: <a href="#">{{getcong_widgets('footer_widget3_phone')}}</a></h2>
                </div>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="item-contact-info text-center">
									<a class="contact-icon color wobble-horizontal" href="#"><i class="fa fa-phone"></i></a>
									<h2 class="title18 text-upperrcase font-bold">الجوال: <a href="#">{{getcong_widgets('footer_widget3_phone')}}</a></h2>
								</div>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="item-contact-info text-center">
									<a class="contact-icon color wobble-horizontal" href="mailto:{{getcong_widgets('footer_widget3_email')}}"><i class="fa fa-envelope"></i></a>
									<h2 class="title18 text-upperrcase font-bold"><a href="mailto:{{getcong_widgets('footer_widget3_email')}}">{{getcong_widgets('footer_widget3_email')}}</a></h2>
								</div>
							</div>
						</div>
					</div>
					<p class="desc">لا تتردد بالاتصال بنا.</p>
				</div>
				<div class="contact-form-page">
					<h2 class="title30 text-uppercase font-bold">راسلنا </h2>
					<div class="form-contact">
              
              {!! Form::open(array('url' => 'contact_send','class'=>'','id'=>'contact_form','role'=>'form')) !!} 
              <div class="message">
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
             <div class="alert alert-success fade in">
                {{ Session::get('flash_message') }}
              </div>
           @endif      


							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input name="name" value="الاسم *" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input name="email" value="الايميل *" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input name="website" value="الموقع الالكتروني" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
									<input name="phone" value="الهاتف" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
                </div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input name="subject" value="عنوان الرسالة" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
                </div>
                
								<div class="col-md-12 col-sm-12 col-xs-12">
									<textarea name="message" cols="30" rows="8" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue"></textarea>
									<input class="shop-button" value="أرسل" type="submit">
								</div>
							</div>
              {!! Form::close() !!}
					</div>
				</div>
			</div>	
			<!-- End Content Page -->
		</div>
	</section>
	<!-- End Content -->





<!--

 <div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
    <div class="overlay">
      <div class="container">
        <h1>Contact Us</h1>
      </div>
    </div>
  </div>

   
<div class="what-we-do">
  <div class="container contact_block">
    <div class="contact-form">
      <div class="col-sm-6">                
         
         {!! Form::open(array('url' => 'contact_send','class'=>'','id'=>'contact_form','role'=>'form')) !!} 
          
          <div class="message">
                         
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

          <div class="alert alert-success fade in">
              
             {{ Session::get('flash_message') }}
           </div>

             
        @endif      

          <ul class="row">
            <li class="col-sm-6">
              <label class="font-montserrat">Your Name <span class="required">*</span>
                <input type="text" class="form-control" name="name" id="name" placeholder="">
              </label>
            </li>
            <li class="col-sm-6">
              <label class="font-montserrat">Your Email <span class="required">*</span>
                <input type="text" class="form-control" name="email" id="email" placeholder="">
              </label>
            </li>
            <li class="col-sm-6">
              <label class="font-montserrat">Phone 
                <input type="text" class="form-control" name="phone" id="phone" placeholder="">
              </label>
            </li>
            <li class="col-sm-6">
              <label class="font-montserrat">Subject
                <input type="text" class="form-control" name="subject" id="subject" placeholder="">
              </label>
            </li>
            <li class="col-sm-12">
              <label class="font-montserrat">Message
                <textarea class="form-control" name="message" id="message" rows="5" placeholder=""></textarea>
              </label>
            </li>
            
            <li class="col-sm-8">
              <button type="submit" value="submit" class="btn font-montserrat" id="btn_submit" onClick="proceed();">Submit</button>
            </li>
          </ul>
        {!! Form::close() !!}
      </div>
    <div class="col-sm-6">
      <h5>Contact Info</h5>          
          <div class="loc-info">
            <p><i class="fa fa-map-marker"></i>{{getcong_widgets('footer_widget3_address')}}</p>
            <p><i class="fa fa-phone"></i> {{getcong_widgets('footer_widget3_phone')}}</p>
             
            <p><i class="fa fa-envelope-o"></i><a href="mailto:{{getcong_widgets('footer_widget3_email')}}">{{getcong_widgets('footer_widget3_email')}}</a></p>
          </div>
      </div>
      </div>
    </div>    
  </div>
 -->
   
 
@endsection
