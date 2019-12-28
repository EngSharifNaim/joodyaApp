<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Order;
use App\OrderItems;
use App\Categories;
use App\Restaurants;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;


class OrderController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		parent::__construct();

    }
    public function orderlist($id)    {


        $order_list = Order::where("restaurant_id", $id)->get();

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        $restaurant_id=$id;

        return view('admin.pages.order_list',compact('order_list','restaurant_id'));
    }




    public function orderView($id)    {
        $order = Order::findOrFail($id);
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect('admin/dashboard');
        }

        $user = User::getUserInfo($order->user_id) ;


        return view('admin.pages.order_view',compact('order','user'));
    }

    public function owner_orderView($id)    {

        $user_id=Auth::User()->id;
        $restaurant= Restaurants::where('user_id',$user_id)->first();
        $restaurant_id=$restaurant['id'];

        $order = Order::findOrFail($id);
        if(Auth::User()->usertype!="Owner"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect('admin/dashboard');
        }

        $user = User::getUserInfo($order->user_id) ;

        return view('admin.pages.owner.order_view',compact('order','user','restaurant_id'));
    }


    public function owner_orderlist_cheack_new()    {



        $user_id=Auth::User()->id;

        $restaurant= Restaurants::where('user_id',$user_id)->first();

        $restaurant_id=$restaurant->id;
        if(Auth::User()->usertype == 'Admin')
        {
            $order_count = Order::where('status', 'الإنتظار' )->count();
        }
        else
        {
            $order_count = Order::where(['restaurant_id' => $restaurant_id ,  'status' => 'الإنتظار'  ])->count();
        }

        return $order_count ;

//
//       if(Auth::User()->usertype!="Owner"){
//        exit  ;
//       }


   }




    public function admin_orderlist()    {


        $order_list = Order::orderBy('id','desc')->orderBy('created_date','desc')->get();

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        return view('admin.pages.order_list',compact('order_list'));
    }

    public function alluser_order()    {


        $order_list = Order::orderBy('id','desc')->orderBy('created_at','desc')->get();

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.order_list_for_all',compact('order_list'));
    }

    public function order_status($order_id,$status)
    {

        $item = OrderItems::findOrFail($order_id);

        $item->status = $status;

        $item->save();

            \Session::flash('flash_message', 'تم تحديث الحالة');

            return \Redirect::back();

    }

    public function delete($item_id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $item = OrderItems::findOrFail($item_id);

        $order_id = $item->order_id ;
        $count  = OrderItems::where("order_id", $order_id)->count() ;


        $item->delete();
        if($count == 1 ){
            $Order = Order::findOrFail($order_id);
            $Order->delete();

            \Session::flash('flash_message', 'تم حذف الطلب بنجاح');

            return redirect('admin/allorder');
        }

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


    public function owner_orderlist()    {

         $user_id=Auth::User()->id;

         $restaurant= Restaurants::where('user_id',$user_id)->first();


       // echo json_encode($restaurant->orders) ;
         //exit ;


         $restaurant_id=$restaurant['id'];

        //$order_list = Order::Join('restaurant_order', 'orders.id', '=', 'restaurant_order.order_id')->where(['restaurant_id' => $restaurant_id])->orderBy('orders.created_at')->get();

       // $order_list = Order::with('items')->orderBy('id','desc')->orderBy('created_date','desc')->get();


        $order_list = Order::with(array('items' =>
        function($query) { $query->where('restaurant_id',  1 );
             $query->orderBy('created_at', 'DESC'); })) ->orderBy('orders.created_at') ->get();


             $order_list = $restaurant->orders ;
             //echo json_encode($restaurant->orders) ;
             //exit ;
             //$restaurant->orders ;



        //$order_list = $order_list->resturantOrders($restaurant_id) ;
        if(Auth::User()->usertype!="Owner"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }
        return view('admin.pages.owner.order_list',compact('order_list','restaurant_id'));
    }

    public function owner_order_status($order_id,$status)
    {

        $order = Order::findOrFail($order_id);

        $order->status = $status;

        $order->save();

        \Session::flash('flash_message', 'تم تحديث الحالة');

        return \Redirect::back();

    }

    public function owner_delete($order_id)
    {
        if(Auth::User()->usertype!="Owner"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $order = Order::findOrFail($order_id);
        $order->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();
    }

}
