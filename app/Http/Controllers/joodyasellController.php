<?php

namespace App\Http\Controllers;

use App\Order;
use Auth;
use App\User;
use App\Restaurants;
use App\Categories;
use App\Menu;
use App\Types;
use App\Review;
use App\Cart;
use App\area;
use App\city;
use App\Widgets;
use App\mobileorder;
use App\menucategory;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Session;
use Intervention\Image\Facades\Image;

class joodyasellController extends Controller
{
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {

            return $this->authenticated($request, Auth::user());
        }
        if(Auth::check() && Auth::user()->usertype == 'Admin'){

            $owner =  Auth::user()->id;
            session(['restaurant_id'=>$owner]);
//            return session('restaurant_id');
            $newOrders = Order::where('status', '=', 'الإنتظار' )
                ->orWhere('status','=','معلق')
                ->orderBy('created_at', 'DESC')
                ->get();
            $archiveOrders = Order::where('status', '<>', 'الإنتظار' )
                ->orderBy('created_at', 'DESC')
                ->get();
            $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
            $menus = Menu::where('restaurant_id',$restaurant)->get();
            $menuCategories = menucategory::all();

            return view('joodyasell.restaurantPage', compact('newOrders','archiveOrders','menus','menuCategories','owner'));

        }
        if(count(Restaurants::where('user_id',Auth::user()->id)->get())==0)
        {
            $menuCategories = menucategory::all();
            $menus = [];
            $newOrders=[];
            $archiveOrders=[];
            $owner =  Auth::user()->id;

            return view('joodyasell.createRestaurant',compact('newOrders','archiveOrders','menuCategories','menus','owner'));
        }
        $menuCategories = menucategory::all();
        $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
        $menus = Menu::where('restaurant_id',$restaurant)->get();
        $orders = [];
        $newOrders = Order::where('status', '=', 'الإنتظار' )
            ->where('restaurant_id',Restaurants::where('user_id',Auth::user()->id)->first()->id)
            ->get();
        $archiveOrders = Order::where('status', '<>', 'الإنتظار' )
            ->where('restaurant_id',Auth::user()->id)
            ->get();

//        if (count(Restaurants::where('user_id', '=', Auth::user()->id)->get()) > 0) {
//            $orders = mobileorder::where('restaurant_id', '=', Restaurants::where('user_id', '=', Auth::user()->id)->first()->id)
//                ->where('status', '=', 'الإنتظار')
//                ->orWhere('status', '=', 'hold')
//                ->orderBy('id', 'DESC')
//                ->get();
//        }
//        return $menus;
            return view('joodyasell/restaurantPage',compact('menuCategories','menus','newOrders','archiveOrders'));



    }

    public function register(){

        return view('joodyasell.register');
    }

    public function checkOrder($restaurant_id){
//        if ($restaurant_id <> 0) {
//            $orders = Order::where('status', 'الإنتظار')
//                ->where('restaurant_id', $restaurant_id)
//                ->get();
//        }
//        else
//        {
            $orders = Order::all();

//        }
       return $orders ;
    }
    public function createRestaurant(Request $request){

        return view('joodyasell.createRestaurant');
    }
    public function restaurantPage(Request $request){

        return view('joodyasell.restaurantPage');
    }
    public function orderArchive(){

        return view('joodyasell.orderArchive');
    }

    public function postLogin(Request $request)
    {

        //echo bcrypt('123456');
        //exit;
        $data = Request::except(array('_token'));


        $rule = array(


            'email' => 'required|max:75',
            'password' => 'required'
        );


        $validator = \Validator::make($data, $rule);

        $credentials = Request::only('email', 'password');

        if (Auth::attempt($credentials, true)) {

            if (Auth::user()->usertype == 'banned') {
                \Auth::logout();
                return array("errors" => 'You account has been banned!');
            }


            return $this->handleUserWasAuthenticated($request);
        }

        if (Auth::check()) {
                if (Auth::user()->usertype == 'Owner') {
                    $orders = mobileorder::where('status', '=', 'الإنتظار' )->get();
                    $newOrders = Order::where('status', '=', 'الإنتظار' )->get();
                    $archiveOrders = mobileorder::where('status', '<>', 'الإنتظار' )->get();

                    $types = Types::all();
                    $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
                    $menus = Menu::where('restaurant_id',$restaurant);
                    return view('joodyasell.restaurantPage', compact('restaurants', 'types', 'menus','newOrders','archiveOrders'));

                }

    }

        $action = 'بيانات الدخول غير صحيحة';
        return view('joodyasell.welcome',compact('action'));

    }
    public function logout()
    {
        Auth::logout();

        \Session::flash('flash_message', 'Logout successfully...');

        return redirect('/joodyasell/');
    }

    public function addToMenu(Request $request) {
        $rules = array (
            'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $menu = new Menu();
            $menu->menu_name = $request->name;
            $menu->price = $request->price;
            $menu->menu_cat = $request->cat;
            $menu->description = $request->description;
            $menu->restaurant_id = 1;
            $menu->save ();
            return response()->json($menu);
        }
    }

    public function register_user(Request $request)
    {
        $data =  Request::except(array('_token')) ;

        $inputs = Request::all();

        $rule=array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|max:75|unique:users',
        );



        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {

            return redirect()->back()->withErrors($validator->messages());
        }


        $user = new User;


        $user->usertype = 'Owner';
        $user->first_name = $inputs['first_name'];
        $user->last_name = $inputs['last_name'];
        $user->email = $inputs['email'];
        $user->password= bcrypt($inputs['password']);
//        $user->mobile = $inputs['mobile'];


        $user->save();

//        \Session::flash('flash_message', 'Logout successfully...');
//        $restaurants = DB::table('restaurants')
//            ->leftJoin('restaurant_types', 'restaurants.restaurant_type', '=', 'restaurant_types.id')
//            ->select('restaurants.*','restaurant_types.type')
//            ->where('restaurants.review_avg', '>=', '4')
//            ->orderBy('restaurants.review_avg', 'desc')
//            ->take(6)
//            ->get();

        // أخر الوجبات
//        $mostrecent = Menu::orderBy('id', 'desc') ->take(16)->get() ;
//
//        // أشهر الوجبات
//        $moastOrdered = Menu::orderBy('ordered_count', 'desc')
//            ->take(6)->get() ;
//
//        // وجبات مميزة
//        $featured = Menu::orderBy('ordered_count', 'desc')
//            ->where('featured', '1')
//            ->take(6)->get() ;
//
//        // الوجبات الخاصة
//        $special = Menu::orderBy('ordered_count', 'desc')
//            ->where('special', '1')
//            ->take(6)->get() ;
//
//        $areas = area::orderBy('id', 'desc')
//            ->get() ;
//
//        $types = Types::orderBy('id', 'desc')
//            ->take(8)->get() ;
//
//        $cities = DB::table("cities")->pluck("name","id");

        \Session::flash('flash_message', 'Register successfully...');

//        if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
//        {
//            return view('mobile.index',compact('restaurants','types','mostrecent','moastOrdered','featured','special','cities','areas'));
//
//        }
        $credentials = Request::only('email', 'password');

        if (Auth::attempt($credentials, Request::has('remember'))) {
            $owner =  $user->id;
            return view('joodyasell.createRestaurant',compact('owner'));
        }
        if (Auth::check()) {
            if (Auth::user()->usertype == 'Owner') {
                $types = Types::all();
                $restaurant = Restaurants::where('user_id', Auth::user()->id)->first()->id;
                $menus = Menu::where('restaurant_id', $restaurant);
                return view('joodyasell.restaurantPage', compact('restaurants', 'types', 'menus'));

            }

        }
//        return \Redirect::back();


    }

    public function addRestaurant(Request $request)
    {


        $rule=array(
            'name' => 'required',
            'logo' => 'mimes:jpg,jpeg,gif,png'
        );

//        $validator = \Validator::make($request->all(),$rule);

//        if ($validator->fails())
//        {
//            return redirect()->back()->withErrors($validator->messages());
//        }
        $inputs = Request::all();

        if(!empty($inputs['id'])){

            $restaurant_obj = Restaurants::findOrFail($inputs['id']);

        }else{

            $restaurant_obj = new Restaurants;

        }


        //Slug

        if($inputs['restaurant_slug']=="")
        {
            $restaurant_slug = str_slug($inputs['name'], "-");
        }
        else
        {
            $restaurant_slug =str_slug($inputs['restaurant_slug'], "-");
        }

        //Logo image

        $restaurant_logo = Request::file('restaurant_logo');
        if($restaurant_logo){

            \File::delete(public_path() .'/upload/restaurants/'.$restaurant_obj->restaurant_logo.'-b.jpg');
            \File::delete(public_path() .'/upload/restaurants/'.$restaurant_obj->restaurant_logo.'-s.jpg');

            $tmpFilePath = 'upload/restaurants/';

            $hardPath = substr($restaurant_slug,0,100).'_'.time();

            $img = Image::make($restaurant_logo);

            $img->fit(120, 120)->save($tmpFilePath.$hardPath.'-b.jpg');

            $restaurant_obj->restaurant_logo = $hardPath;

        }

        $user_id=Auth::User()->id;

        $restaurant_obj->user_id = $user_id;
//        $restaurant_obj->restaurant_type = $inputs['restaurant_type'];
        $restaurant_obj->restaurant_name = $inputs['name'];
        $restaurant_obj->city = $inputs['city'];
        $restaurant_obj->area = $inputs['area'];
        $restaurant_obj->restaurant_slug = $restaurant_slug;
//        $restaurant_obj->restaurant_description = $inputs['restaurant_description'];
        $restaurant_obj->demo = 1;



//        $restaurant_obj->open_monday = $inputs['open_monday'];
//        $restaurant_obj->open_tuesday = $inputs['open_tuesday'];
//        $restaurant_obj->open_wednesday = $inputs['open_wednesday'];
//        $restaurant_obj->open_thursday = $inputs['open_thursday'];
//        $restaurant_obj->open_friday = $inputs['open_friday'];
//        $restaurant_obj->open_saturday = $inputs['open_saturday'];
//        $restaurant_obj->open_sunday = $inputs['open_sunday'];



        $restaurant_obj->save();

//        $rescat = new restaurantcategory();
//        $rescat->restaurant_id = $restaurant_obj->id;
//        $restaurantcategory = new restaurantcategory();
//        $restaurantcategory->restaurant_id = $restaurant_obj->id;

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'تم حفظ البيانات بنجاح');

            $types = Types::all();
            $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
            $menus = Menu::where('restaurant_id',$restaurant);
            return view('joodyasell.restaurantPage', compact('restaurants', 'types', 'menus'));
        }
        else
            {

            \Session::flash('flash_message', 'تمت الإضافة بنجاح');

            $types = Types::all();
            $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
            $menus = Menu::where('restaurant_id',$restaurant);
            $menuCategories = menucategory::all();
            $newOrders = [];
            $archiveOrders = [];

                return view('joodyasell.restaurantPage', compact( 'types', 'menus','menuCategories','newOrders','archiveOrders'));

        }


    }
public function restaurantProfile(){
        $restaurant = Restaurants::where('user_id',Auth::user()->id)->first();
        return view('joodyasell.restaurantProfile',compact('restaurant'));
}
public function endOrder($id){
    $items = Order::where('id',$id)->get();
//    return $items;
    foreach ($items as $item)
    {
        $item->status = 'تم التسليم';
        $item->save();
    }
    return back();
}
public function cancel_order($id){
    $items = Order::where('id',$id)->get();
//    return $items;
    foreach ($items as $item)
    {
        $item->status = 'تم الالغاء';
        $item->save();
    }
    return back();
}
public function delete_order($id){
    DB::table('orders')->delete($id);
    return back();
}
public function apol_order($id){
    $items = Order::where('id',$id)->get();
//    return $items;
    foreach ($items as $item)
    {
        $item->status = 'تم الاعتذار';
        $item->save();
    }
    return back();
}

public function hold_order($id){
    $items = Order::where('id',$id)->get();
//    return $items;
    foreach ($items as $item)
    {
        $item->status = 'معلق';
        $item->save();
    }
    return response()->json([
        'success' =>$item->status,
        'fail' => ''
    ]);

}

public function saveRestaurantChange(Request $request){
        $input = Request::all();
        $restaurant = Restaurants::find($input['id']);
        $restaurant->restaurant_name = $input['name'];
        $restaurant->city = $input['city'];
        $restaurant->area = $input['area'];
        $restaurant->restaurant_description = $input['description'];

        $restaurant_logo = Request::file('restaurant_logo');
        if($restaurant_logo){

            \File::delete(public_path() .'/upload/restaurants/'.$restaurant->restaurant_logo.'-b.jpg');
            \File::delete(public_path() .'/upload/restaurants/'.$restaurant->restaurant_logo.'-s.jpg');

            $tmpFilePath = 'upload/restaurants/';

            $hardPath = substr($restaurant->restaurant_slug,0,100).'_'.time();

            $img = Image::make($restaurant_logo);

            $img->fit(120, 120)->save($tmpFilePath.$hardPath.'-b.jpg');

            $restaurant->restaurant_logo = $hardPath;

        }

        $restaurant->save();
    return response()->json([
        'success' =>$restaurant,
        'fail' => ''
    ]);
}

public function sendPassword(Request $request)
{
//    $input = Request::all();
    if (User::where('email', $request->email)->get()) {
        return response()->json([
            'success' => $request,
            'fail' => ''
        ]);

    }
    else
    {
        return response()->json([
            'success' =>'',
            'fail' => $request
        ]);

    }

}


}
