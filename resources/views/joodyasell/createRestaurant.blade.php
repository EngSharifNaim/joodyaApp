@extends('joodyasell.layouts.app')
@section('content')

    <div class="flex-center position-ref full-height">
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Registration form -->
            <form action="{{url('joodyasell/addRestaurant')}}" method="post" class="flex-fill" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div>
                                        <img src="{{url('images/logo.png')}}" style="width: 50px">
                                    </div>                                <h5 class="mb-0">انشاء مطبخ</h5>
                                    <span class="d-block text-muted">جميع الحقول مطلوبة</span>
                                </div>
                                <div class="form-group">
                                    <label class="d-block font-weight-semibold">ماذا تقدم طعام</label>
                                    @foreach(App\Types::all() as $type)
                                    <div class="form-check form-check-inline" dir="rtl">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" dir="rtl">
                                            {{$type->type}}
                                        </label>
                                    </div>
                                        @endforeach
                                </div>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" name="user_id" value="{{$owner}}" hidden>
                                    <input type="text" name="id" value="" hidden>
                                    <input type="text" name="restaurant_slug" value="" hidden>
                                    <input type="text" required name="name" class="form-control" placeholder="اسم المطبخ" dir="rtl">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-plus text-muted"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-right">
                                            <input type="text" required name="city" class="form-control" placeholder="المدينة" dir="rtl">
                                            <div class="form-control-feedback">
                                                <i class="icon-location4 text-muted"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-right">
                                            <input type="text" required name="area" class="form-control" placeholder="المنطقة" dir="rtl">
                                            <div class="form-control-feedback">
                                                <i class="icon-location3 text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-feedback form-group-feedback-right">

{{--                                        <div class="uniform-uploader">--}}
{{--                                            <input required type="file" name="restaurant_logo" class="form-control-uniform" data-fouc="">--}}
{{--                                            <span class="filename" style="user-select: none;">صورة شعال المطبخ</span>--}}
{{--                                            <span class="action btn btn-light" style="user-select: none;">اختر صورة</span>--}}
{{--                                        </div>--}}

                                            <div class="box-img">
                                                <img src="{{url('/upload/restaurants/mtbkh_1568627270-b.jpg')}}" width="150" height="150">
                                                <input type="file" id="in-img" name="restaurant_logo">

                                                <a href="#" title="Remover" class="bt-remove">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>

                                                <div class="box-loading">
                                                    <div class="fade"></div>
                                                    <div class="label">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-block">التالي <i class="icon-circle-left2 ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /registration form -->

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>

    <script type="text/javascript">

        /* BOX-IMG BOTÃO QUE RETORNA A IMAGEM PADRÃO - REMOVER IMAGEM CARREGADA */
        $('div.box-img a.bt-remove').click(function( e ){
            e.preventDefault();
            $(this).siblings('img').prop('src', '../img/default.png');
            $(this).hide();
        });

        /* MUDANDO O MODO DE TRABALHO DO LINK DA BOX-IMG PARA ATIVAR O INPUT FILE */
        $('div.box-img a.bt-load').click(function( e ){
            e.preventDefault();
            showHideLoadingBox( true );
            $(this).siblings('input[type=file]').trigger('click');
        });

        /* OUVINDO MUDANÇAS DE VALOR NO INPUT FILE */
        $('div.box-img input[type=file]').change(function(){
            var $handle = $(this);
            var reader = new FileReader();

            showHideLoadingBox( false );
            reader.onload = function(e){
                /* VERIFICA SE FOI REALMENTE UMA IMAGEM CARREGADA, CASO NÃO, ABORTE O PROCESSAMENTO */
                if( e.target.result.indexOf('data:image/') == -1 ){
                    $handle.siblings('a.bt-remove').trigger('click'); /* VOLTA COM A IMAGEM PADRÃO */
                    return;
                }

                loadImageSrc( e.target.result );
            };
            reader.readAsDataURL(this.files[0]);
        });


        function showHideLoadingBox( status ){
            if( status ){
                $('div.box-loading').stop().show('fast');
            }
            else{
                $('div.box-loading').stop().hide('fast');
            }
        }

        function loadImageSrc( imagePath ){
            /* UMA IMAGEM FOI ESCOLHIDA, COLOQUE-A NA TAG IMG DO FORMULÁRIO */
            $('div.box-img img').prop('src', imagePath);
            $('div.box-img a.bt-remove').show();
        }
    </script>

@endsection
