<!DOCTYPE HTML>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="description" content="@yield('head_description', getcong('site_description'))" />
	<meta name="keywords" content="Fruit,7uptheme" />
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content='1 days' />

	<meta property="og:type" content="article" />
	<meta property="og:title" content="@yield('head_title',  getcong('site_name'))" />
	<meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
	<meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
	<meta property="og:url" content="@yield('head_url', url('/'))" />

	<link rel="shortcut icon" href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" type="image/x-icon">



	<title>@yield('head_title', getcong('site_name'))</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/font-awesome.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/ionicons.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/bootstrap.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/bootstrap-theme.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/jquery.fancybox.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/jquery-ui.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/owl.carousel.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/owl.transitions.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/jquery.mCustomScrollbar.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/owl.theme.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/sweetalert2.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/animate.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/libs/hover.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/color6.css') }}"  media="all"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/theme.css') }}"  media="all"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/responsive.css') }}"  media="all"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/browser.css') }}"  media="all"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('nsite_assets/css/rtl.css') }}"  media="all"/> 


	


	{!!getcong('site_header_code')!!}

</head>
<body class="preload">

<div class="wrap">

	@include("_particles.header")  
	
	@yield("content")


	@include("_particles.add_to_cart_modal")
	@include("_particles.footer")
<!--
  <div class="rights">
    <div class="container">
      <p class="font-montserrat">
      		@if(getcong('site_copyright'))
						
				{{getcong('site_copyright')}}
			
			@else
			
				Copyright © {{date('Y')}} {{getcong('site_name')}}. All rights reserved.

			@endif
	  </p>
    </div>
  </div>
-->


  <a href="#" class="scroll-top round"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
	<div id="loading">
		<div id="loading-center">
			<div id="loading-center-absolute">
				<div class="object" id="object_four"></div>
				<div class="object" id="object_three"></div>
				<div class="object" id="object_two"></div>
				<div class="object" id="object_one"></div>
			</div>
		</div>
	</div>




  </div>

<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/jquery.fancybox.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/jquery.jcarousellite.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/jquery.mCustomScrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/slick.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/popup.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/timecircles.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/wow.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/libs/sweetalert2.min.js') }}"></script>


<script type="text/javascript" src="{{ URL::asset('nsite_assets/js/theme.js') }}"></script>

</div>
</body>
</html>