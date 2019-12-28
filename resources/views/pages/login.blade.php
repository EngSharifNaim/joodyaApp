@extends("app")

@section('head_title', 'Login' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

	<div class="content-page">
		<div class="container">
			<div class="shop-banner banner-adv line-scale zoom-image">
				<a href="#" class="adv-thumb-link"><img src="{{ URL::asset('nsite_assets/images/page/about.jpg') }}" alt="" /></a>
				<div class="banner-info">
					<h2 class="title30 color">تسجيل الدخول</h2>
					<div class="bread-crumb white"><a href="{{ URL::to('/') }}" class="white">الرئيسية</a><span>دخول</span></div>

				</div>
			</div>
			<!-- ENd Banner -->
			<div class="register-content-box">
				<h2 class="title30 font-bold text-uppercase text-center">تسجيل الدخول</h2>
				<div class="row">
					<div class="col-md-3"> </div>

					<div class="col-md-6 col-sm-6 col-ms-12">
						<div class="form-my-account">

							{!! Form::open(array('url' => 'login','class'=>'block-login','id'=>'login','role'=>'form')) !!}
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



							<p>
								<label>اسم المستخدم <span class="required">*</span></label>
								<input type="text" placeholder=" الإيميل أو الجوال ..." class="form-control" value="" name="email" id="email">
							</p>
							<p>
								<label>كلمة المرور <span class="required">*</span></label>
								<input type="password" placeholder="كلمة المرور" class="form-control" value="" name="password" id="password">
							</p>
							<p>
								<input type="submit" class="register-button" name="login" value="دخول">
							</p>
							<div class="table create-account">
								<div class="text-left">
									<p>
										<input type="checkbox"  id="remember" /> <label for="remember"> تذكرني </label>
									</p>
								</div>
								<div class="text-right">
									<a href="#" class="color">هل نسيت كلمة المرور ؟</a>
								</div>
								<div class="text-right">
									<a href="register" class="color">انشاء حساب جديد</a>
								</div>
							</div>

							{!! Form::close() !!}

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- End Content Pages -->



@endsection
