<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="{{url('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/jquery.toast.min.css') }}">

        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="{{url('global_assets/js/main/jquery.min.js')}}"></script>
        <script src="{{url('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="{{url('assets/js/app.js')}}"></script>
        <title>JoodyaSell</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-image: url(nsite_assets/images/joodyasell.png);
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">

                <form class="login-form" method="post" action="{{url('joodyasell/login')}}">
                    {{csrf_field()}}
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div>
                                    <img src="{{url('images/logo.png')}}" style="width: 100px">
                                </div>

                                <h5 class="mb-0">الدخول إلى لوحة المطابخ</h5>
                                <span class="d-block text-muted">اذا كنت مشترك معنا أدخل بيانات التسجيل</span>
                            </div>
                               @if(isset($action))
                                <div class="alert alert-danger border-0 alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                    <span class="font-weight-semibold">خطأ!</span> بيانات التسجيل خاظئة <a href="{{url('joodyasell/register')}}" >لست عضو؟</a>.
                                </div>                               </span>
                            @endif
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input required type="text" class="form-control" name="email" placeholder="الإيميل أو الجوال" dir="rtl">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input required type="password" name="password" class="form-control" placeholder="كلمة المرور" dir="rtl">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">دخول <i class="icon-circle-left2 ml-2"></i></button>
                                <button type="button" onclick="sendmail()" class="btn btn-danger btn-block">هل نسيت كلمة المرور؟ </button>
                                <a href="{{url('joodyasell/register')}}" class="btn btn-primary btn-block">لست مشترك معنا؟ إنشئ حسابك الآن </a>
                            </div>

                            <div class="text-center">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>
</html>
<script>
    function sendmail() {
        (async () => {

            const { value: email } = await Swal.fire({
                title: 'ادخل البريد الالكتروني المسجل لدينا',
                input: 'email',
                inputPlaceholder: 'البريد الالكتروني'
            })

            if (email) {
                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', token);
                    }
                });

                $.ajax({
                    url: '{{ route("sendPassword") }}',
                    method:'post',
                    data:  {email: email},
                     // dataType:'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.error) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<p>' + data.error[count] + '</p>';
                            }
                            $('#editresult').html('<div class="alert alert-danger">' + error_html + '</div>');
                        } else {
                            if (data.fail == '') {
                                Swal.fire('هذا الإيميل غير مدرج لدينا :  ' + email)
                            }
                            else {
                                Swal.fire('تم ارسال كلمة المرور الجديدة إلى العنوان: ' + email)
                            }

                        }
                    }
                })
            }
            else
            {
                return 'بريد الكتروني غير صحيح';
            }


        })()

    }
</script>
