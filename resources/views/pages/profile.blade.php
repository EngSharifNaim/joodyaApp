@extends("app")

@section('head_title', 'Edit Profile' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 
 

<!-- Content ================================================== --> 
 <div class="container margin_60">
   
  <div class="row">
    <div class="col-md-3">

    </div>  
    <div class="col-md-6">
        <div class="box_style_2" id="order_process">
          <h2 class="inner">تحديث بياناتي</h2>
          {!! Form::open(array('url' => 'profile','class'=>'','id'=>'myProfile','role'=>'form')) !!} 

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

          <div class="form-group">
            <label>الاسم الأول</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}" placeholder="First name">
          </div>
          <div class="form-group">
            <label>اسم العائلة</label>
            <input type="text" class="form-control" id="last_name" value="{{$user->last_name}}" name="last_name" placeholder="Last name">
          </div>
          <div class="form-group">
            <label>جوال</label>
            <input type="text" id="mobile" name="mobile" value="{{$user->mobile}}" class="form-control" placeholder="Telephone/mobile">
          </div>
          <div class="form-group">
            <label>ايميل</label>
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
              
            </div>
          </div>
           
          <hr>
          <div class="row">
            <div class="col-md-12">
              <label>العنوان بالتفصيل</label>
              <textarea class="form-control" style="height:150px" placeholder="Address" name="address" id="address">{{$user->address}}</textarea>
            </div>
          </div>
          <br>
            <button type="submit" class="btn btn-submit">حفظ التعديلات</button>
            <br>
      {!! Form::close() !!} 
        </div>
        <br>
        <!-- End box_style_1 --> 
      </div>
      <!-- End col-md-6 -->


     
        
  </div>
  <!-- End row -->   
</div>
<!-- End white_bg -->

 

 
<!-- End section --> 
<!-- End Content =============================================== --> 

@endsection
