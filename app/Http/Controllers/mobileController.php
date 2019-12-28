<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use App\Restaurants;
use App\city;
use App\area;
use App\Types;
use App\User;
use App\Cart;
use App\Order;
use App\OrderItems;
use App\mobileorder;
use App\emotion;
use App\Http\Requests;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;
class mobileController extends Controller
{
    public function restaurantsSearch(Request $request){
        $inputs = $request->all();


        $city = $inputs['city_id'];
        $area = $inputs['area_id'];
        $type = $inputs['type_id'];
//        return $city . '/' . $area . '/' . $type;
        if($city <> 0 && $area <> 0 && $type <>0)
        {
            $restaurants = Restaurants::where('restaurant_type','=',$type)
                ->where('area','=',$area)
                ->where('city','=',$city)
                ->get();
            $total_res=count($restaurants);

            return view('mobile.restaurants_search',compact('restaurants','total_res'));

        }
        if($city <> 0 && $area <> 0)
        {
            $restaurants = Restaurants::where('area','=',$area)
                ->where('city','=',$city)
                ->get();
            $total_res=count($restaurants);

            return view('mobile.restaurants_search',compact('restaurants','total_res'));

        }

        if($city != '0')
        {
            $restaurants = Restaurants::where('city','=',$city)
                ->get();
            $total_res=count($restaurants);
            $page = 'restaurants';

            return view('mobile.restaurants_search',compact('restaurants','total_res','page'));

        }

        $restaurants = Restaurants::all();
        $total_res=count($restaurants);

        return view('mobile.restaurants_search',compact('restaurants','total_res'));




    }
    public function restaurantsShow(){
        $restaurants = Restaurants::inRandomOrder()->get();
        $total_res=count($restaurants);
        $page = 'restaurants';
        return view('mobile.restaurants_search',compact('restaurants','total_res','page'));
    }

    public function restaurantMenue($id){
        $menues = Menu::where('restaurant_id','=',$id)->get();
        $restaurant = Restaurants::find($id);
        return view('mobile.restaurantMenue',compact('menues','id','restaurant'));

    }

    public function cartDetails(){
        if(Auth::check()){
            $user_id=Auth::user()->id;

        }
        else
        {
            $user_id = Session('localUser');
            $user = 'زائر';
        }

        $page = 'cart';
        return view('mobile.cattOrderDetails',compact('user','page','user_id'));
    }

    public function confirm_order_details(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();


        $rule=array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:75',
            'mobile' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'address' => 'required'
        );


        $validator = \Validator::make($inputs,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $user_id=Auth::user()->id;

        $user = User::findOrFail($user_id);



        $user->first_name = $inputs['first_name'];
        $user->last_name = $inputs['last_name'];
        $user->email = $inputs['email'];
        $user->mobile = $inputs['mobile'];
        $user->city = $inputs['city'];
        $user->postal_code = $inputs['postal_code'];
        $user->address = $inputs['address'];
        $user->save();

        $cart_res=Cart::where('user_id',$user_id)->orderBy('id')->get();

        $order = new Order;
        $order->user_id = $user_id;
        $order->status= 'الإنتظار';


        $total = 0 ;

        $order->save();
        $orderId = $order->id  ;

        foreach ($cart_res as $n => $cart_item) {

            $OrderItem = new OrderItems;
            $OrderItem->order_id = $orderId;
            $OrderItem->user_id = $user_id;
            $OrderItem->restaurant_id =$cart_item->restaurant_id;
            $OrderItem->item_id = $cart_item->item_id;
            $OrderItem->item_name = $cart_item->item_name;
            $OrderItem->item_price = $cart_item->item_price;
            $OrderItem->item_size = $cart_item->item_size;
            $OrderItem->item_features = $cart_item->item_features;
            $OrderItem->quantity=$cart_item->quantity ;
            $OrderItem->created_at= strtotime(date('Y-m-d'));
            $OrderItem->status= 'الإنتظار';
            $OrderItem->save();
            $total+=  $cart_item->quantity *  $cart_item->item_price ;

        }

        $order->total_price = $total  ;
        $order->save();

        //$order_list = Order::where(array('user_id'=>$user_id,'status'=>'Pending'))->orderBy('item_name','desc')->get();
        $order_list = Cart::where('user_id',$user_id)->orderBy('id')->get();

        $data = array(
            'name' => $inputs['first_name'],
            'order_list' => $order_list

        );

        $subject=getcong('site_name').' Order Confirmed';

        $user_order_email=$inputs['email'];

        //User Email

        \Mail::send('emails.order_item', $data, function ($message) use ($subject,$user_order_email){

            $message->from(getcong('site_email'), getcong('site_name'));

            $message->to($user_order_email)->subject($subject);

        });

        //Admin/Owner Email

        $subject2='New Order Placed';



        $owner_admin_order_email=[getcong('site_email')];

        \Mail::send('emails.order_item_owner_admin', $data, function ($message) use ($subject2,$owner_admin_order_email){

            $message->from(getcong('site_email'), getcong('site_name'));

            $message->to($owner_admin_order_email)->subject($subject2);

        });


        /*$cart = Cart::findOrFail($cart_item->id);

        $cart->delete();*/

        /*   $cart =  Cart::where('user_id',Auth::id())->orderBy('item_id')
           ->leftJoin('menu', 'cart.item_id', '=', 'menu.id')
           ->take(3)->get();*/

        Cart::where('user_id',$user_id)->delete();
        // $cart->delete();
        return view('mobile.cart_order_confirm_details' , compact('order_list'));
    }

    public function offers(){
        $menues = Menu::inRandomOrder()->orderBy('id','DESC')->take(10)->get();
        $page = 'offers';
        return view('mobile.offers',compact('menues','page'));


    }

    public function restaurantNewOrders(){
        if(Auth::user()->usertype =='Admin')
        {
            $orders = mobileorder::where('status','=','الإنتظار')
                ->orWhere('status','=','hold')
                ->orderBy('id','DESC')
                ->get();
        }
        if(Auth::user()->usertype == 'Owner')
        {
            $orders = mobileorder::where('restaurant_id','=',Restaurants::where('user_id','=',Auth::user()->id)->first()->id)
                ->where('status','=','الإنتظار')
                ->orWhere('status','=','hold')
                ->orderBy('id','DESC')
                ->get();
        }

        if(Auth::user()->usertype == 'User')
        {
            $orders = mobileorder::where('user_id','=',Auth::user()->id)
                ->where('status','=','الإنتظار')
                ->orWhere('status','=','hold')
                ->orderBy('id','DESC')
                ->get();
        }

        $pageTitle = 'طلبات جديدة';
        $action = 'new';
        return view('mobile.restaurantNewOrders',compact('orders','pageTitle','action'));
    }

    public function orderArchive(){
        if(Auth::user()->usertype=='Admin')
        {
            $orders = mobileorder::where('status','<>','الإنتظار')
                ->orderBy('id','DESC')
                ->get();
        }
        if(Auth::user()->usertype=='Owner'){
            $orders = mobileorder::where('restaurant_id','=',Restaurants::where('user_id','=',Auth::user()->id)->first()->id)
                ->where('status','<>','الإنتظار')
                ->orderBy('id','DESC')
                ->get();
        }
        if(Auth::user()->usertype=='User'){
            $orders = mobileorder::where('user_id','=',Auth::user()->id)
                ->where('status','<>','الإنتظار')
                ->orderBy('id','DESC')
                ->get();
        }

        $pageTitle = 'ارشيف الطلبات';
        $action = 'archive';
        return view('mobile.restaurantNewOrders',compact('orders','pageTitle','action'));
    }

    public function holdOrder($id){
        $order = mobileorder::find($id);
        $order->status = 'hold';
        $order->save();
        return back();
    }
    public function endOrder($id){
        $order = mobileorder::find($id);
        $order->status = 'end';
        $order->save();
        return back();
    }
    public function cancelOrder($id){
        $order = mobileorder::find($id);
        $order->status = 'cancel';
        $order->save();
        return back();
    }
    public function soryOrder($id){
        $order = mobileorder::find($id);
        $order->status = 'sory';
        $order->save();
        return back();
    }

    public function add_to_cart($id,$restaurant,$quantity){
//        return Session::get('tempUser');
//        return Auth::user()->id;

        $item = Menu::where('id',$id)->first();
        if(!Auth::check())
        {
            $order_item = OrderItems::where('item_id',$id)
                ->where('status',0)
                ->where('user_id',Session('localUser'))->first();

            if($order_item)
            {
                $order_item->quantity = $quantity;
                $order_item->total_price = $order_item->quantity  * $order_item->item_price;
                $order_item->save();
            }
            else
            {
                $order_item = new OrderItems();
                $order_item->item_id = $id;
                $order_item->item_id = $id;
                $order_item->user_id = Session('localUser');
                $order_item->quantity = $quantity;
                $order_item->item_price = $item->price;
                $order_item->total_price = $quantity  * $order_item->item_price;

                $order_item->item_name = $item->menu_name;
                $order_item->status = 0;
                $order_item->restaurant_id = $restaurant;
                $order_item->save();

            }

        }
        else
        {
            $order_item = OrderItems::where('item_id',$id)->where('user_id',Auth::user()->id)->where('status',0)->first();

            if($order_item)
            {
                $order_item->quantity = $order_item->quantity + 1;
                $order_item->total_price = $order_item->quantity  * $order_item->item_price;
                $order_item->save();
            }
            else
            {
                $order_item = new OrderItems();
                $order_item->item_id = $id;
                $order_item->user_id = Auth::user()->id;
                $order_item->quantity = $quantity;
                $order_item->item_price = $item->price;
                $order_item->total_price = $order_item->quantity  * $order_item->item_price;
                $order_item->item_name = $item->menu_name;
                $order_item->status = 0;
                $order_item->restaurant_id = $restaurant;
                $order_item->save();

            }
        }
        return response()->json([
            'success' => $order_item->quantity,
            'fail' => ''
        ])->setStatusCode(202);
    }

    public function like_item($id){
        $emotion = new emotion();

        $emotion->item_id = $id;
        $MAC = exec('getmac');
        $emotion->mac = strtok($MAC, ' ');
        $emotion->ip = $_SERVER['REMOTE_ADDR'];
        if(!Auth::check()){
            $emotion->user_id = session('localUser');
        }
        else
        {
            $emotion->user_id = Auth::User()->id;

        }
        $emotion->emotion = 'like';

        $emotion->save();
        return response()->json([
            'success' =>$emotion,
            'fail' => ''
        ])->setStatusCode(202);
    }
    public function h_price($id){
        $emotion = new emotion();

        $emotion->item_id = $id;
        $emotion->ip = $_SERVER['REMOTE_ADDR'];

        if(!Auth::check()){
            $emotion->user_id = session('localUser');
        }
        else
        {
            $emotion->user_id = Auth::User()->id;

        }
        $emotion->emotion = 'h_price';

        $emotion->save();
        return response()->json([
            'success' =>$emotion,
            'fail' => ''
        ]);
    }
    public function not_clear($id){
        $emotion = new emotion();

        $emotion->item_id = $id;
        $emotion->ip = $_SERVER['REMOTE_ADDR'];

        if(!Auth::check()){
            $emotion->user_id = session('localUser');
        }
        else
        {
            $emotion->user_id = Auth::User()->id;

        }
        $emotion->emotion = 'not_clear';

        $emotion->save();
        return response()->json([
            'success' =>$emotion,
            'fail' => ''
        ]);
    }

    public function send_order(Request $request)
    {
        if(Auth::check()) {
            $restaurants = OrderItems::where('user_id',Auth::user()->id)
                ->where('status',0)
                ->select('restaurant_id')->distinct()->get();

//            dd($restaurants);
            foreach ($restaurants as $restaurant) {
                $order = new Order();
                $total_price = DB::table('restaurant_order')->where('user_id', Auth::user()->id)
                    ->where('restaurant_id',$restaurant->restaurant_id)
                    ->select(DB::raw('sum(restaurant_order.item_price*restaurant_order.quantity) AS total_price'))
                    ->first()->total_price;
//            sum('restaurant_order.item_price * restaurant_order.quantity');
                $order->restaurant_id = $restaurant->restaurant_id;
                $order->total_price = $total_price;
                $order->user_id = Auth::user()->id;
                $order->status = 'الإنتظار';
//                $order->details = $request->details;
                $order->user_name = $request->user_name;
                $order->user_mobile = $request->user_mobile;
                $order->user_address = $request->address;

                $order->save();

                foreach (OrderItems::where('user_id',Auth::user()->id)->where('status',0)->where('restaurant_id',$restaurant->restaurant_id)->get() as $item)
                {
                    $item->order_id = $order->id;
                    $item->status = 1;
                    $item->save();
                }


            }
        }
        else {
            $restaurants = OrderItems::where('user_id',Session('localUser'))
                ->where('status',0)
                ->select('restaurant_id')->distinct()->get();

//            dd($restaurants);
            foreach ($restaurants as $restaurant) {
                $order = new Order();
                $total_price = DB::table('restaurant_order')->where('user_id', Session('localUser'))
                    ->where('restaurant_id',$restaurant->restaurant_id)
                    ->select(DB::raw('sum(restaurant_order.item_price*restaurant_order.quantity) AS total_price'))
                    ->first()->total_price;
//            sum('restaurant_order.item_price * restaurant_order.quantity');
                $order->restaurant_id = $restaurant->restaurant_id;
                $order->total_price = $total_price;
                $order->user_id = Session('localUser');
                $order->status = 'الإنتظار';
                $order->user_name = $request->user_name;
                $order->user_mobile = $request->user_mobile;
                $order->user_address = $request->address;

                $order->save();

                foreach (OrderItems::where('user_id',Session('localUser'))->where('status',0)->where('restaurant_id',$restaurant->restaurant_id)->get() as $item)
                {
                    $item->order_id = $order->id;
                    $item->status = 1;
                    $item->save();
                }


            }

        }
        return response()->json([
            'success' =>$request->input('send_cart'),
            'fail' => ''
        ]);

    }

    public function delete_from_cart($id){

        if(Auth::check()){
//            DB::table('restaurant_order')->where('item_id', $id)->delete();

            OrderItems::where('item_id',$id)->where('user_id',Auth::user()->id)->delete();
            $user_id = Auth::user()->id;
        }
        else{
            OrderItems::where('item_id',$id)->where('user_id',Session('localUser'))->delete();
            $user_id = Session('localUser');

        }

        return view('mobile.cattOrderDetails',compact('user_id'));
    }

}
