<div class="card" style="width: 100%">
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
            @foreach($menuCategories as $category)
                <div class="row">
                    <button type="button" class="btn btn-light btn-block" data-toggle="modal" data-target="#modal_default{{$category->id}}" style="text-align: right">
                        {{$category->name}}
                        <span class="badge bg-danger-400 badge-pill border-2 border-white">
                            @if(Auth::User()->usertype == 'Admin')
                                {{count(\App\Menu::where('offer',1)->where('menu_cat',$category->id)->get())}}

                            @else
                        {{count(\App\Menu::where('restaurant_id',App\Restaurants::where('user_id',Auth::user()->id)->first()->id)->where('menu_cat',$category->id)->get())}}
                                @endif
                        </span>
                        <i class="icon-list ml-2"></i></button>
                </div>
            <br>
{{--            <li class="nav-item"><a href="#colored-rounded-tab{{$category->id}}" class="nav-link" data-toggle="tab">{{$category->name}}</a></li>--}}
            <div id="modal_default{{$category->id}}" class="modal fade show" tabindex="-1" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" dir="rtl">
                            <h5 class="modal-title">{{$category->name}}</h5>
                            <span class="badge bg-danger-400 badge-pill border-2 border-white">
                                @if(Auth::User()->usertype == 'Admin')
                                    {{count(\App\Menu::where('offer',1)->where('menu_cat',$category->id)->get())}}

                                @else
                                {{count(\App\Menu::where('restaurant_id',App\Restaurants::where('user_id',Auth::user()->id)->first()->id)->where('menu_cat',$category->id)->get())}}
                                    @endif
                        </span>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <div class="header-elements">
                                        <div class="list-icons">
                                            <a class="list-icons-item" data-action="collapse"></a>
                                            <a class="list-icons-item" data-action="reload"></a>
                                            <a class="list-icons-item" data-action="remove"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pb-0">
                                    @foreach($menus as $menu)
                                        @if($menu->menu_cat == $category->id)

                                            <div class="row">
                                                <div class="col-xl-12" dir="rtl">
                                                    <div class="media flex-column flex-sm-row mt-0 mb-3">
                                                        <div class="mr-sm-3 mb-2 mb-sm-0">
                                                            <div class="card-img-actions">
                                                                <a href="#">
                                                                    @if($menu->menu_image)
                                                                        <img style="width:100%;border-radius: 200px" src="{{ URL::asset('upload/menu/'.$menu->menu_image.'-s.jpg') }}" />
                                                                    @else
                                                                        <img src="{{ URL::asset('upload/menu_img_s.png') }}" />
                                                                    @endif                                                                    <span class="card-img-actions-overlay card-img"><i class="icon-coin-dollar icon-2x"></i></span>
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
                                                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_editMenu{{$menu->id}}">تعديل <i class="icon-database-edit2 ml-2"></i></button>
                                                                </li>

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

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">اغلاق</button>
                            <a href="" class="nav-link btn btn-danger" data-toggle="modal" data-target="#modal_addItem"><i class="icon-database-add"></i>اضافة أكلة</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <a href="" class="nav-link btn btn-danger" data-toggle="modal" data-target="#modal_addItem"><i class="icon-database-add"></i>اضافة أكلة</a>
            @include('joodyasell.modals.addItem')
                @include('joodyasell.modals.editMenu')


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
