<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">
        </h6>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-solid bg-slate border-0 nav-tabs-component rounded" dir="rtl">
            @foreach($menuCategories as $category)
            <li class="nav-item"><a href="#colored-rounded-tab{{$category->id}}" class="nav-link" data-toggle="tab">{{$category->name}}</a></li>
            @endforeach
            <li class="nav-item"><a href="#colored-rounded-tab10" class="nav-link btn btn-danger" data-toggle="tab"><i class="icon-database-add"></i>اضافة أكلة</a></li>

        </ul>

        <div class="tab-content">
            @foreach($menuCategories as $category)
            <div class="tab-pane fade" id="colored-rounded-tab{{$category->id}}">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">{{$category->name}}</h6>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pb-0" style="">
                        @foreach($menus as $menu)
                        @if($menu->menu_cat == $category->id)

                        <div class="row">
                            <div class="col-xl-12" dir="rtl">
                                <div class="media flex-column flex-sm-row mt-0 mb-3">
                                    <div class="mr-sm-3 mb-2 mb-sm-0">
                                        <div class="card-img-actions">
                                            <a href="#">
                                                <img src="{{url('/images/menu/menu.jpg')}}" class="img-fluid img-preview rounded" alt="">
                                                <span class="card-img-actions-overlay card-img"><i class="icon-coin-dollar icon-2x"></i></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="media-title"><a href="#">
                                                {{$menu->menu_name}}
                                            </a></h6>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item" dir="rtl"> {{$menu->description}}</li>

                                        </ul>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item" dir="rtl"><i class="icon-coin-dollar mr-2"></i> {{$menu->price}}شيكل</li>
                                        </ul>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item" dir="rtl">
                                                <a href="javascript:delete_item({{$menu->id}})" id="delete_item" class="btn bg-teal-400"><i class="icon-database-remove mr-2"></i> حذف</a>
                                            </li>
                                            <li class="list-inline-item" dir="rtl">
                                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_iconified{{$menu->id}}">تعديل <i class="icon-database-edit2 ml-2"></i></button>                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>

                        @endif
                        @endforeach

                    </div>
                </div>

            </div>
            @endforeach
            {{--            edit menu modals--}}
            @foreach($menus as $menu)

            <div id="modal_iconified{{$menu->id}}" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span id="editresult"></span>

                        </div>

                        <div class="modal-body">
                            <form class="menu_form" data-menuid="{{$menu->id}}" enctype="multipart/form-data">
                                @CSRF
                                <input type="text" value="{{$menu->id}}" hidden>
                                <div class="text-center mb-3">
                                    <a href="#" class="d-inline-block mt-1 mb-3">
                                        <img src="{{url('/images/menu/menu.jpg')}}" class="rounded-circle img-fluid" width="120" height="120" alt="">
                                    </a>

                                    <h5 class="mb-0">{{$menu->menu_name}}</h5>
                                </div>
                                <div class="form-group">
                                    <div class="uniform-uploader" style="text-align: center">
                                        <input type="file" name="menuImage" class="filestyle" dir="rtl" style="width: 80%">

                                        <span class="filename" style="user-select: none;"></span>
                                        <span class="action btn bg-pink-400" style="user-select: none;">صورة</span>
                                    </div>
                                    <span class="form-text text-muted" dir="rtl">مواصفات الصورة: gif, png, jpg. اقصى حجم 2Mb</span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="id" hidden value="{{$menu->id}}">
                                    <input type="text" required="الإسم مطلوب" name="name" id="name" value="{{$menu->menu_name}}" class="form-control" placeholder="اسم الوجبة" dir="rtl">
                                </div>

                                <div class="form-group">
                                    <input type="number" required name="price" value="{{$menu->price}}" id="price" class="form-control" placeholder="سعر الوجبة" dir="rtl">
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <select required name="category" id="category" class="form-control" dir="rtl">
                                            @foreach($menuCategories as $category)
                                            @if($menu->menu_cat == $category->id)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea name="description" id="description" rows="5" cols="5" class="form-control" placeholder="مكونات الأكلة" dir="rtl">{{$menu->description}}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> اغلاق</button>
                                    <button type="submit" name="edit" id="edit" class="btn btn-primary">حفظ التعديلات <i class="icon-paperplane ml-2"></i></button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            @endforeach

            <div class="tab-pane fade" id="colored-rounded-tab10">
                <div class="card">
                    <div class="card-header">
                        <span id="result"></span>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="header-elements-inline">
                                    <h5 class="card-title">جميع الحقول مطلوبة</h5>
                                    <div class="header-elements">
                                        <div class="list-icons">
                                            <a class="list-icons-item" data-action="collapse"></a>
                                            <a class="list-icons-item" data-action="reload"></a>
                                            <a class="list-icons-item" data-action="remove"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <form method="post" id="dynamic_form" enctype="multipart/form-data">
                                    @CSRF
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
                                        <div class="uniform-uploader" style="width: 100%">
                                            <input required="حقل مطلوب" type="file" name="menuImage" class="filestyle" dir="rtl">
                                            <span class="filename" style="user-select: none;"></span>
                                            <span class="action btn bg-pink-400" style="user-select: none;">صورة</span>
                                        </div>
                                        <span class="form-text text-muted" dir="rtl">مواصفات الصورة: gif, png, jpg. اقصى حجم 2Mb</span>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="description" id="description" rows="5" cols="5" class="form-control" placeholder="مكونات الأكلة" dir="rtl"></textarea>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" name="save" id="save" class="btn btn-primary">إضافة للمنيو <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function delete_item(item_id){
        // alert(item_id);
        // return;

        Swal.fire({
            title: 'هل أنت متأكد من عملية الحذف?',
            text: "لن تستطيع ارجاع المنتج بعد ذلك!",
            type: 'تحذير',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'نعم, احذف الآن!'
        }).then((result) => {
            if (result.value) {
                var rout = "deleteItem/" + item_id;
                $.ajax({
                    url: rout,
                    // method:'get',
                    dataType:'json',
                    // contentType: false,
                    // cache: false,
                    // processData:false,
                    beforeSend:function(){
                        $('#delete_item').attr('disabled','disabled');
                    },
                    success:function(data) {
                        if (data.error) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<p>' + data.error[count] + '</p>';
                            }
                        }
                        else {
                            if (data.fail == '') {
                                Swal.fire(
                                    'تم الحذف!',
                                    'تم حذف الصنف بنجاح.',
                                    'حذف ناجح'
                                )
                            }
                            else
                            {
                                Swal.fire(
                                    'لم يتم الحذف!',
                                    'هناك خلل في عملية الحذف.',
                                    'حذف فاشل'
                                )                            }
                        }
                        $('#delete_item').attr('disabled', false);
                    }

                });


            }
        })
    }
    $(document).ready(function(){

        $('#dynamic_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'{{ route("addMenu") }}',
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
                                title: 'تمت اضافة المنتج بنجاح',
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

                        document.getElementById('name').value = '';
                        document.getElementById('price').value = '';
                        document.getElementById('description').value = '';
                        document.getElementById('category').value = '';

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
