@extends('mobile.layouts.app')
@section('content')

    <div class="container">
    <div class="content-cart-checkout woocommerce">
        <h4 class="title30 font-bold text-uppercase text-center">تفاصيل طلب الشراء</h4>


        <div class="row">

            {!! Form::open(array('url' => 'mobile/orderDetails','class'=>'','id'=>'order_details','role'=>'form')) !!}

            <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-ms-12">
                        <div class="check-billing">



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
                                <div class="alert alert-success">
                                    {{ Session::get('flash_message') }}
                                </div>
                            @endif
                            <p class="clearfix box-col2">
                                <input name="first_name" type="text" value="{{ $user->first_name ?? 'الاسم *' }}" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
                                <input  name="last_name"  type="text" value=" {{ $user->last_name ?? 'العائلة *' }}" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
                            </p>
                            <p class="clearfix box-col2">
                                <input  name="email" type="text" value=" {{ $user->email ?? 'الإيميل *' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
                                <input  name="mobile"  type="text" value=" {{ $user->mobile ?? 'الجوال *' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">
                            </p>

                            <p class="clearfix box-col2" ><input name="address" type="text" value=" {{ $user->address ?? 'العنوان *' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''"></p>

                            <p class="clearfix box-col2">
                                <input name="postal_code" type="text" value=" {{ $user->postal_code ?? ' الرمز البريدي' }} " onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">

                                <input name="city"  type="text" value=" {{ $user->city ?? 'المدينة / الحي' }}  *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">

                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-ms-12">
                        <div class="check-address">
                            <form class="form-my-account">
                                <p class="ship-address  ">
                                    <input name="if_alter_adress"  name="" type="checkbox" id="address"> <label for="address">التوصيل إلى عنوان اخر</label>
                                </p>
                                <p>
                                    <textarea  name="alter_adress" cols="55" rows="5" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">ملاحظات و العنوان الأخر </textarea>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <h4>محتويات السلة </h4>

                <div class="table-responsive">
                    <table class="shop_table cart table">
                        <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-name">المنتج</th>
                            <th class="product-price">السعر</th>
                            <th class="product-quantity">العدد</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach(\App\Cart::where('user_id', Auth::user()->id)->orderBy('item_id')
                        ->leftJoin('menu', 'cart.item_id', '=', 'menu.id')->select(
                          'cart.id',
                          'menu.menu_image',
                          'menu.menu_name',
                          'cart.item_price',
                          'cart.item_size',
                          'cart.item_features',
                          'cart.quantity'
                  )->get() as $n=>$cart_item)


                            <tr class="cart_item">
                                <td class="product-remove">
                                    <a class="remove" href="{{URL::to('delete_item/'.$cart_item->id)}}">X</a>
                                </td>
                                <td class="product-name" data-title="Product">
                                    <a href="#">{{$cart_item->menu_name}}</a>
                                </td>
                                <td class="product-price" data-title="Price">
                                    <span class="amount"> {{$cart_item->item_price  / $cart_item->quantity}}</span>
                                </td>
                                <td class="product-quantity" data-title="Quantity">
                                    <span class="qty-val">{{$cart_item->quantity}}</span>
                                </td>

                            </tr>


                        @endforeach




                        <tr>
                            <td class="actions" colspan="8">
                                <div class="coupon">
                                    <button type="submit" class="btn btn-danger btn-block">ارسال الطلب</button>

                                </div>



                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
