@foreach($menus as $menu)
    {{--Menu Edit MOdals--}}
    <div id="modal_editMenu{{$menu->id}}" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                @if($menu->menu_image)
                                    <img style="width:100%;border-radius: 200px" src="{{ URL::asset('upload/menu/'.$menu->menu_image.'-s.jpg') }}" />
                                @else
                                    <img src="{{ URL::asset('upload/menu_img_s.png') }}" />
                                @endif                               </a>

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
