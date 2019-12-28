<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{getcong('site_name')}} Admin</title>

	<link rel="stylesheet" type="text/css" href="//www.fontstatic.com/f=bein-normal" />
	<link href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" href="{{ URL::asset('admin_assets/css/style.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/jquery.toast.min.css') }}">


	<script src="{{ URL::asset('admin_assets/js/jquery.js') }}"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body class="sidebar-push  sticky-footer">
     
     	<!-- BEGIN TOPBAR -->
         
         @include("admin.topbar")
         
        <!-- END TOPBAR -->

	      <!-- BEGIN SIDEBAR -->
	       
	       @include("admin.sidebar")
	      
	      <!-- END SIDEBAR -->
  		<div class="container-fluid">
  		
 		   @yield("content")
 		   
	 		<div class="footer">
				<a href="{{ URL::to('admin/dashboard') }}" class="brand">
					{{getcong('site_name')}}
				</a>
				<ul>
					 
				</ul>
			</div>
  		</div>


  <div class="overlay-disabled"></div>


  <!-- Plugins -->
  <script src="{{ URL::asset('admin_assets/js/plugins.min.js') }}"></script>

  
  <!-- Loaded only in index.html for demographic vector map-->
  <script src="{{ URL::asset('admin_assets/js/jvectormap.js') }}"></script>
  
  <!-- App Scripts -->
  <script src="{{ URL::asset('admin_assets/js/scripts.js') }}"></script>


  <script src="{{ URL::asset('admin_assets/js/jquery.toast.min.js') }}"></script>

		@if( \Auth::user()->usertype=='Owner')

		<script>



	



				$( document ).ready(function() {

					var base_url = window.location.origin;
					function fn60sec() {

						$.ajax({
							url: base_url+'/admin/orderlist/cheack', 
							dataType: 'json',
							type: 'get',
							contentType: 'application/json',
							success: function( data, textStatus, jQxhr ){
							//	$('#response pre').html( JSON.stringify( data ) );
								console.log( data );
								
								if(data > 0 ){
									$.toast({
										heading: 'طلبات غير مكتملة',
										text: 'يوجد طلبات لم تكتمل بعد  : <a href="'+base_url+'/admin/orderlist'+'"> القائمة </a>',
										showHideTransition: 'fade',
										icon: 'info',
										hideAfter: 5000
									})
								}
							},
							error: function( jqXhr, textStatus, errorThrown ){
								console.log( errorThrown );
							}
						});




					}
					fn60sec();
					setInterval(fn60sec, 15*1000);
				});
 
    </script>




		@endif




</body>
 
</html>   
     		   
     		    