<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Http\Requests;
use App\OrderItems;
use App\Restaurants;
use Illuminate\Http\Request;
use App\DynamicField;
use Illuminate\Support\Facades\Auth;
use Validator;
use Intervention\Image\Facades\Image;


class ajaxController extends Controller
{
    function index()
    {
        return view('joodyasell.ajax');
    }

    function addMenu(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'name.*' => 'required',
                'cat.*' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $name = $request->name;
            $cat = $request->category;
            $price = $request->price;
            $desc = $request->description;
            $img = '';
            $menu_image = $request->file('menuImage');
//            dd($menu_image);

            if ($menu_image) {
                $res = '';
                $hardPath = 'defaultmenu';
                $imgtype = $menu_image->getClientOriginalExtension();
                if( $imgtype == 'jpg' || $imgtype == 'gif' || $imgtype == 'png' ) {
                    $inputs = $request->all();

                    $tmpFilePath = 'upload/menu/';

                    $hardPath = rand(11111, 99999) . '-' . time();

                    $img = Image::make($menu_image);
//                dd($hardPath, $tmpFilePath);
                    $img->save($tmpFilePath . $hardPath . '-b.' . $menu_image->getClientOriginalExtension());
                    $img->fit(100, 100)->save($tmpFilePath . $hardPath . '-s.' . $menu_image->getClientOriginalExtension());

                }
                else
                {
                    return response()->json([
                        'fail' => 'مواصفات الصورة غير مناسبة',
                        'success' => ''

                    ]);
                }

            }
            else
            {
                return response()->json([
                    'fail' => 'يجب ارفاق صورة الأكلة',
                    'success' => ''
                ]);

            }
            if(Auth::User()->usertype == 'Admin'){
                $restaurant = $request->restaurant;
                $offer = 1;
            }
            else
            {
                $restaurant = Restaurants::where('user_id', Auth::user()->id)->first()->id;
                $offer = 0;
            }
            $data = array(
                'menu_name' => $name,
                'price' => $price,
                'restaurant_id' => $restaurant,
                'description' => $desc,
                'menu_cat' => $cat,
                'menu_image' => $hardPath,
                'offer' => $offer
            );
            $insert_data[] = $data;


            Menu::insert($insert_data);


            return response()->json([
                'success' => 'تمت إضافة الأكلة بنجاح',
                'fail' => ''
            ]);
        }
    }
    function editMenu(Request $request)
    {
//        return response()->json([
//            'success' => $request->menuImage,
//            'fail' => ''
//        ]);

            $id = $request->id;
            $name = $request->name;
            $cat = $request->category;
            $price = $request->price;
            $desc = $request->description;
//            $img = '';
//            $menu_image = $request->menu_image;
//            dd($menu_image);
        $menu_image = $request->file('menuImage');

            if ($menu_image) {
                $res = '';
                $hardPath = 'defaultmenu';
                $imgtype = $menu_image->getClientOriginalExtension();
                if( $imgtype == 'jpg' || $imgtype == 'gif' || $imgtype == 'png' ) {
                    $inputs = $request->all();

                    $tmpFilePath = 'upload/menu/';

                    $hardPath = rand(11111, 99999) . '-' . time();

                    $img = Image::make($menu_image);
//                dd($hardPath, $tmpFilePath);
                    $img->save($tmpFilePath . $hardPath . '-b.' . $menu_image->getClientOriginalExtension());
                    $img->fit(100, 100)->save($tmpFilePath . $hardPath . '-s.' . $menu_image->getClientOriginalExtension());

                }
                else
                {
                    return response()->json([
                        'fail' => 'مواصفات الصورة غير مناسبة',
                        'success' => ''

                    ]);
                }

            }


            $mymenu = Menu::where('id',$id)->first();
            $mymenu->menu_name = $name;
            $mymenu->price = $price;
            $mymenu->description = $desc;
            $mymenu->restaurant_id = Restaurants::where('user_id', Auth::user()->id)->first()->id;
            $mymenu->menu_cat = $cat;
            if(isset($hardPath)) {
                $mymenu->menu_image = $hardPath;
            }
            $mymenu->save();

            return response()->json([
                'success' => 'تمت التعديل بنجاح',
                'fail' => ''
            ]);
        }

        public function deleteItem($id){

       Menu::where('id',$id)->delete();
            return response()->json([
                'success' =>$id,
                'fail' => ''
            ]);
        }

    public function add_to_cart($id){

        $item = Menu::find($id);
        $order_item = OrderItems::where('item_id',$id)->first();
        if($order_item)
        {
            $order_item->quantity = $order_item->quantity + 1;
            $order_item->save();
        }
        else
        {
            $order_item->user_id = Auth::user()->id;
            $order_item->item_id = $id;
            $order_item->qusntity = 1;
            $order_item->item_price = $item->price;
            $order_item->item_name = $item->menu_name;
        }

        return response()->json([
            'success' =>$id,
            'fail' => ''
        ]);
    }

}
