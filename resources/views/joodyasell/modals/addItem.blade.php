<div id="modal_addItem" class="modal fade show" tabindex="-1" style="display: none;">
    <div class="modal-dialog" dir="rtl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">أكلة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <form method="post" id="dynamic_form" enctype="multipart/form-data">
                            @CSRF
                            @if(Auth::User()->usertype == 'Admin')
                                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <select required name="restaurant" id="restaurant" class="form-control" dir="rtl">
                                            <option value="0">اختر المطبخ</option>
                                            @foreach(App\Restaurants::where('id','<>',121)->get() as $restaurant)
                                                <option value="{{$restaurant->id}}">{{$restaurant->restaurant_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            @endif
                            <div class="form-group">
                                <input type="text" required="الإسم مطلوب" name="name" id="name" class="form-control" placeholder="اسم الوجبة" dir="rtl">
                            </div>

                            <div class="form-group">
                                <input type="number" required name="price" id="price" class="form-control" placeholder="سعر الوجبة" dir="rtl">
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-10">
                                    <select required name="category" id="category" class="form-control" dir="rtl">
                                        @foreach($menuCategories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
{{--                                <div class="uniform-uploader" style="width: 100%">--}}
{{--                                    <input required="حقل مطلوب" type="file" name="menuImage" class="filestyle" dir="rtl">--}}
{{--                                    <span class="filename" style="user-select: none;"></span>--}}
{{--                                    <span class="action btn bg-pink-400" style="user-select: none;">صورة</span>--}}
                                <div class="box-img" style="text-align: center">
                                    <img src="{{url('/upload/restaurants/mtbkh_1568627270-b.jpg')}}" class="rounded-circle" height="150">
                                    <input type="file" id="in-img" name="menuImage">

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
                                <span class="form-text text-muted" dir="rtl">مواصفات الصورة: gif, png, jpg. اقصى حجم 2Mb</span>


                            <div class="form-group">
                                <textarea name="description" id="description" rows="5" cols="5" class="form-control" placeholder="مكونات الأكلة" dir="rtl"></textarea>
                            </div>

                            <div class="text-right" dir="rtl">
                                <button type="button" class="btn btn-link" data-dismiss="modal">اغلاق</button>

                                <button type="submit" name="save" id="save" class="btn btn-primary">إضافة للمنيو <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">

</script>

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
