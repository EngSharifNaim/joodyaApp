@extends("app")

@section('head_title', 'Login' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

	<div class="content-page">
		<div class="container">
			<div class="shop-banner banner-adv line-scale zoom-image">
				<a href="#" class="adv-thumb-link"><img src="{{ URL::asset('nsite_assets/images/page/about.jpg') }}" alt="" /></a>
				<div class="banner-info">
					<h2 class="title30 color">تسجيل عضو جديد</h2>
					<div class="bread-crumb white"><a href="{{ URL::to('/') }}" class="white">الرئيسية</a><span>دخول</span></div>

				</div>
			</div>
			<!-- ENd Banner -->
			<div class="white_for_login">
				<div class="container margin_60">

					<div class="row">

						<div class="col-md-3">

						</div>
						<div class="col-md-6">
							<div class="box_style_2" id="order_process">
								<h2 class="inner">تسجبل عضو جديد</h2>
								<hr>
								{!! Form::open(array('url' => 'register','class'=>'','id'=>'myProfile','role'=>'form')) !!}

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
									<div class="alert alert-success fade in">

										{{ Session::get('flash_message') }}
									</div>
								@endif

								<div class="form-group">
									<label>الاسم الاول</label>
									<input required type="text" class="form-control" id="first_name" name="first_name" value="" placeholder="الاسم الاول">
								</div>
								<div class="form-group">
									<label>اسم العائلة</label>
									<input required type="text" class="form-control" id="last_name" value="" name="last_name" placeholder="اسم العائلة">
								</div>
								<div class="form-group">
									<label>اسم المستخدم</label>
									<input required type="text" id="email" name="email" value="" class="form-control" placeholder="الايميل أو الجوال ...">
								</div>
									<div class="form-group">
									<label>الجوال</label>
									<input required type="text" id="mobile" name="mobile" value="" class="form-control" placeholder="الجوال">
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>كلمة مرور</label>
											<input required type="password" id="password" name="password" value="" class="form-control" placeholder="كلمة مرور">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>تأكيد كلمة المرور</label>
											<input required type="password" id="password_confirmation" name="password_confirmation" value="" class="form-control" placeholder="تأكيد كلمة المرور">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>نوع الحساب</label>
									<select class="form-control" name="usertype" id="usertype">
										<option value="User">زبون</option>
										<option value="Owner">أسرة منتجة</option>
										<option value="supplyer">مورد</option>
									</select>

								</div>
								<hr>

								<button type="submit" class="btn btn-submit">تسجيل</button>

							</div>
							<!-- End box_style_1 -->
							<hr>
						</div>
						<!-- End col-md-6 -->


					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- End Content Pages -->



@endsection
