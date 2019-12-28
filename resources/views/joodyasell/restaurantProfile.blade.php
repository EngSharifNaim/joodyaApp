@extends('joodyasell.layouts.app')
@section('content')


        <div class="card card-body">

            <form method="post" id="dynamic_form" enctype="multipart/form-data">
                @CSRF
                <div class="text-center mb-3">
                    <a href="#" class="d-inline-block mt-1 mb-3">
                        @if($restaurant->restaurant_logo)
                            <div class="box-img">
                                <img src="{{url('/upload/restaurants/' .$restaurant->restaurant_logo .'-b.jpg')}}" class="rounded-circle img-fluid" width="120" height="120" alt="اختر صورة">
                                <div class="form-group">
                                    <label></label>
                                    <div class="uniform-uploader">
                                        <input type="file" id="in-img" name="restaurant_logo" class="form-input-styled" data-fouc="">
                                        <span class="filename" style="user-select: none;">لا يوجد ملف</span>
                                        <span class="action btn bg-pink-400" style="user-select: none; block-size: border-box">اختر ملف من جهازك</span>
                                    </div>
                                    <span class="form-text text-muted" dir="rtl">الصيغ المقبولة : gif, png, jpg. Max file size 2Mb</span>
                                </div>
                                <a href="#" title="Remover" class="bt-remove">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>

                                <div class="box-loading">
                                    <div class="fade"></div>
                                    <div class="label">

                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="box-img">
                                <img src="{{url('/upload/restaurants/mtbkh_1568627270-b.jpg')}}" class="rounded-circle img-fluid" width="120" height="120" alt="">
                                <input type="file" id="in-img" class="form-control" name="restaurant_logo">

                                <a href="#" title="Remover" class="bt-remove">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>

                                <div class="box-loading">
                                    <div class="fade"></div>
                                    <div class="label">

                                    </div>
                                </div>
                            </div>
                        @endif
                    </a>

                    <h5 class="mb-0">{{$restaurant->restaurant_name}}</h5>
                    <div class="text-muted"></div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" name="id" class="form-control" value="{{$restaurant->id}}" hidden>
                    <input type="text" name="name" class="form-control" value="{{$restaurant->restaurant_name}}" placeholder="" dir="rtl">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <textarea type="text" name="description" class="form-control" placeholder="وصف مختصر للمطبخ..."  dir="rtl">{{$restaurant->restaurant_description}}</textarea>
                    <div class="form-control-feedback">
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" name="city" class="form-control" value="{{$restaurant->city}}"  dir="rtl">
                    <div class="form-control-feedback">
                        <i class="icon-location4 text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" name="area" class="form-control" value="{{$restaurant->area}}" dir="rtl">
                    <div class="form-control-feedback">
                        <i class="icon-location3 text-muted"></i>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <button type="submit" id="save" class="btn btn-primary ml-auto btn-block">حفظ التعديلات <i class="icon-user-plus ml-2"></i></button>
                </div>
                <br>
                <div class="d-flex align-items-center">

                <a href="{{url('joodyasell')}}" class="btn btn-warning  ml-auto btn-block">عودة للرئيسية <i class="icon-user-plus ml-2"></i></a>
                </div>
            </form>
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

            $(document).ready(function(){

                $('#dynamic_form').on('submit', function(event){
                    event.preventDefault();
                    $.ajax({
                        url:'{{ route("saveRestaurantChange") }}',
                        method:'post',
                        data:  new FormData(this),
                        // dataType:'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend:function(){
                            $('#save').attr('disabled','disabled');
                        },
                        success:function(data)
                        {
                            if(data.error)
                            {
                                var error_html = '';
                                for(var count = 0; count < data.error.length; count++)
                                {
                                    error_html += '<p>'+data.error[count]+'</p>';
                                }
                                $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                            }
                            else
                            {
                                if(data.fail == '')
                                {
                                    Swal.fire({
                                        // position: 'top-end',
                                        type: 'success',
                                        title: 'تم حفظ التعديلات',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                }
                                else
                                {
                                    Swal.fire({
                                        // position: 'top-end',
                                        type: 'success',
                                        title: 'هناك خلل في البيانات',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            }
                            $('#save').attr('disabled', false);
                        }
                    })
                });
                $('.menu_form').on('submit', function (event) {
                    event.preventDefault();
                    // var menu_id = $( this ).serializeArray()[1].value;
                    // var menu_name = $( this ).serializeArray()[2].value;
                    // var menu_price = $( this ).serializeArray()[3].value;
                    // var menu_category = $( this ).serializeArray()[4].value;
                    // var menu_image = $( this ).serializeArray()[5].value;
                    // var token = $( this ).serializeArray()[0].value;
                    // var menu_description = $( this ).serializeArray()[6].value;

                    // alert(menu_image)
                    // return
                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': token
                    //     }
                    // });
                    // alert(token);
                    // return;

                    $.ajax({
                        url: '{{ route("editMenu") }}',
                        method:'post',
                        data:  new FormData(this),
                        // dataType:'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function () {
                            $('#edit').attr('disabled', 'disabled');
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
                                    Swal.fire({
                                        // position: 'top-end',
                                        type: 'success',
                                        title: 'تم التعديل على البيانات بنجاح',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })                            } else {
                                    Swal.fire({
                                        // position: 'top-end',
                                        type: 'success',
                                        title: 'هناك خلل في تعديل البيانات',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })                            }

                            }
                            $('#edit').attr('disabled', false);
                            $('modal_iconified' + $( this ).serializeArray()[1].value).hidden;
                        }
                    })
                });


            });

        </script>

@endsection
