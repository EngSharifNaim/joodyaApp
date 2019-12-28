<?php

namespace App\Http\Controllers;

use App\menucategory;
use App\Order;
use App\OrderItems;
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
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\visit;
class IndexController extends Controller
{


    public function index()
    {
        // return 'joodya.com';
        /*if(!$this->alreadyInstalled()) {
            return redirect('install');
        }*/

        $types=Types::orderBy('type')->get();



        $restaurants = DB::table('restaurants')
            ->leftJoin('restaurant_types', 'restaurants.restaurant_type', '=', 'restaurant_types.id')
            ->select('restaurants.*','restaurant_types.type')
            ->where('restaurants.review_avg', '>=', '4')
            ->orderBy('restaurants.review_avg', 'desc')
            ->take(6)
            ->get();

        // أخر الوجبات
        $mostrecent = Menu::orderBy('id', 'desc') ->take(24)->get() ;

        // أشهر الوجبات
        $moastOrdered = Menu::orderBy('ordered_count', 'desc')
            ->take(6)->get() ;

        // وجبات مميزة
        $featured = Menu::orderBy('ordered_count', 'desc')
            ->where('featured', '1')
            ->take(6)->get() ;

        // الوجبات الخاصة
        $special = Menu::orderBy('ordered_count', 'desc')
            ->where('special', '1')
            ->take(6)->get() ;

        $areas = area::orderBy('id', 'desc')
            ->get() ;

        $types = Types::orderBy('id', 'desc')
            ->take(8)->get() ;

        $cities = DB::table("cities")->pluck("name","id");

        /*$mostsales = model_name::find($id);
        return view('view')->with ('variable',$variable); */
        if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
        {
            return view('mobile.index',compact('restaurants','types','mostrecent','moastOrdered','featured','special','cities','areas'));

        }
        return view('pages.index',compact('restaurants','types','mostrecent','moastOrdered','featured','special','cities','areas'));
    }

    public function about_us()
    {
        $widgets = Widgets::first();
        return view('pages.about',compact('widgets') );
    }

    public function contact_us()
    {
        return view('pages.contact' );
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }

    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */

    public function login()
    {

        return view('pages.login');
    }

    public function postLogin(Request $request)
    {

        //echo bcrypt('123456');
        //exit;
        $data =  Request::except(array('_token')) ;


        $rule=array(


            'email' => 'required|max:75',
            'password' => 'required'
        );


        $validator = \Validator::make($data,$rule);

        $credentials = Request::only('email', 'password');

        if (Auth::attempt($credentials, Request::has('remember'))) {

            if(Auth::user()->usertype=='banned'){
                \Auth::logout();
                return array("errors" => 'You account has been banned!');
            }

            return $this->handleUserWasAuthenticated($request);
        }

        // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
        if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
        {
            $restaurants = DB::table('restaurants')
                ->leftJoin('restaurant_types', 'restaurants.restaurant_type', '=', 'restaurant_types.id')
                ->select('restaurants.*','restaurant_types.type')
                ->where('restaurants.review_avg', '>=', '4')
                ->orderBy('restaurants.review_avg', 'desc')
                ->take(6)
                ->get();

            // أخر الوجبات
            $mostrecent = Menu::orderBy('id', 'desc') ->take(16)->get() ;

            // أشهر الوجبات
            $moastOrdered = Menu::orderBy('ordered_count', 'desc')
                ->take(6)->get() ;

            // وجبات مميزة
            $featured = Menu::orderBy('ordered_count', 'desc')
                ->where('featured', '1')
                ->take(6)->get() ;

            // الوجبات الخاصة
            $special = Menu::orderBy('ordered_count', 'desc')
                ->where('special', '1')
                ->take(6)->get() ;

            $areas = area::orderBy('id', 'desc')
                ->get() ;

            $types = Types::orderBy('id', 'desc')
                ->take(8)->get() ;

            $cities = DB::table("cities")->pluck("name","id");


        }
        if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
        {
            return view('mobile.index',compact('restaurants','types','mostrecent','moastOrdered','featured','special','cities','areas'));

        }

        return redirect('/login')->withErrors('بيانات تسجيل غير صحيحة.');

    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {
        $items = OrderItems::where('user_id',Session('localUser'))->get();
        foreach ($items as $item)
        {
            $item->user_id = Auth::user()->id;
            $item->save();
        }

        if (method_exists($this, 'authenticated')) {

            if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
            {
                return view('mobile.index',compact('restaurants','types','mostrecent','moastOrdered','featured','special','cities','areas'));

            }
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/');
    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        \Session::flash('flash_message', 'Logout successfully...');
        $restaurants = DB::table('restaurants')
            ->leftJoin('restaurant_types', 'restaurants.restaurant_type', '=', 'restaurant_types.id')
            ->select('restaurants.*','restaurant_types.type')
            ->where('restaurants.review_avg', '>=', '4')
            ->orderBy('restaurants.review_avg', 'desc')
            ->take(6)
            ->get();

        // أخر الوجبات
        $mostrecent = Menu::orderBy('id', 'desc') ->take(16)->get() ;

        // أشهر الوجبات
        $moastOrdered = Menu::orderBy('ordered_count', 'desc')
            ->take(6)->get() ;

        // وجبات مميزة
        $featured = Menu::orderBy('ordered_count', 'desc')
            ->where('featured', '1')
            ->take(6)->get() ;

        // الوجبات الخاصة
        $special = Menu::orderBy('ordered_count', 'desc')
            ->where('special', '1')
            ->take(6)->get() ;

        $areas = area::orderBy('id', 'desc')
            ->get() ;

        $types = Types::orderBy('id', 'desc')
            ->take(8)->get() ;

        $cities = DB::table("cities")->pluck("name","id");
        if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
        {
            return view('mobile.index',compact('restaurants','types','mostrecent','moastOrdered','featured','special','cities','areas'));

        }

        return redirect('/login');
    }


    public function register()
    {

        return view('pages.register');
    }

    public function register_user(Request $request)
    {
        $data =  Request::except(array('_token')) ;

        $inputs = Request::all();

        $rule=array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|max:75|unique:users',
            'mobile' => 'required'
        );



        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {

            return redirect()->back()->withErrors($validator->messages());
        }


        $user = new User;


        $user->usertype = $inputs['usertype'];
        $user->first_name = $inputs['first_name'];
        $user->last_name = $inputs['last_name'];
        $user->email = $inputs['email'];
        $user->password= bcrypt($inputs['password']);
        $user->mobile = $inputs['mobile'];


        $user->save();

        \Session::flash('flash_message', 'Logout successfully...');
        $this->postLogin($request);
        $restaurants = DB::table('restaurants')
            ->leftJoin('restaurant_types', 'restaurants.restaurant_type', '=', 'restaurant_types.id')
            ->select('restaurants.*','restaurant_types.type')
            ->where('restaurants.review_avg', '>=', '4')
            ->orderBy('restaurants.review_avg', 'desc')
            ->take(6)
            ->get();

        // أخر الوجبات
        $mostrecent = Menu::orderBy('id', 'desc') ->take(16)->get() ;

        // أشهر الوجبات
        $moastOrdered = Menu::orderBy('ordered_count', 'desc')
            ->take(6)->get() ;

        // وجبات مميزة
        $featured = Menu::orderBy('ordered_count', 'desc')
            ->where('featured', '1')
            ->take(6)->get() ;

        // الوجبات الخاصة
        $special = Menu::orderBy('ordered_count', 'desc')
            ->where('special', '1')
            ->take(6)->get() ;

        $areas = area::orderBy('id', 'desc')
            ->get() ;

        $types = Types::orderBy('id', 'desc')
            ->take(8)->get() ;

        $cities = DB::table("cities")->pluck("name","id");

        \Session::flash('flash_message', 'Register successfully...');

        if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
        {
            return view('mobile.index',compact('restaurants','types','mostrecent','moastOrdered','featured','special','cities','areas'));

        }


        return \Redirect::back();


    }

    public function profile()
    {
        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);

        return view('pages.profile',compact('user'));
    }


    public function editprofile(Request $request)
    {

        $data =  Request::except(array('_token')) ;

        $inputs = Request::all();


        $rule=array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:75',
            'mobile' => 'required',
            'city' => 'required',
            'address' => 'required'
        );


        $validator = \Validator::make($data,$rule);

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
        $user->address = $inputs['address'];


        $user->save();


        \Session::flash('flash_message', 'تم حفظ البيانات بنجاح');

        return \Redirect::back();


    }

    public function change_password()
    {

        return view('pages.change_password');
    }


    public function edit_password(Request $request)
    {

        $data = Request::except(array('_token')) ;

        $inputs = Request::all();

        $rule=array(
            'password' => 'required|min:3|confirmed'
        );



        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }


        $user_id=Auth::user()->id;

        $user = User::findOrFail($user_id);

        $user->password= bcrypt($inputs['password']);


        $user->save();

        \Session::flash('flash_message', 'تم تحديث كلمة المرور بنجاح ...');

        return \Redirect::back();


    }


    public function contact_send(Request $request)
    {

        $data =  Request::except(array('_token')) ;

        $inputs = Request::all();

        $rule=array(
            'name' => 'required',
            'email' => 'required|email|max:75'
        );



        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $data = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'subject' => $inputs['subject'],
            'user_message' => $inputs['message'],
        );

        $subject=$inputs['subject'];

        \Mail::send('emails.contact', $data, function ($message) use ($subject){

            $message->from(getcong('site_email'), getcong('site_name'));

            $message->to(getcong('site_email'))->subject($subject);

        });


        \Session::flash('flash_message', 'نشكرك على اهتمامك و تواصلك معنا . سبتم التواصل معك في أسرع وقت...');

        return \Redirect::back();


    }
    public function showMobile()
    {
        $visit = new visit();
        $visit->ip = $_SERVER['REMOTE_ADDR'];
        $visit->save();

        $restaurants = Restaurants::all()->random();
        $areas = area::orderBy('id', 'desc')
            ->get() ;

        $types = Types::orderBy('id', 'desc')
            ->take(8)->get() ;

        $cities = DB::table("cities")->pluck("name","id");
        $page = 'main';
        if(Session::has('localUser'))
        {}
        else
        {
            session(['localUser'=>rand(10,10000000)]);
        }

//        return session('localUser');
        return view('mobile.index',compact('restaurants','types','cities','areas','page'));

    }
    public function joodyasell()
    {

        $page = 'main';

        if(Auth::check() && Auth::user()->usertype == 'Admin'){

            $owner =  Auth::user()->id;
            $newOrders = Order::where('status', '=', 'الإنتظار' )
                ->orWhere('status','=','معلق')
                ->orderBy('created_at', 'DESC')
                ->get();
            $archiveOrders = Order::where('status', '<>', 'الإنتظار' )
                ->orderBy('created_at', 'DESC')
                ->get();
            $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
            $menus = Menu::where('offer',1)->get();
            $menuCategories = menucategory::all();

            return view('joodyasell.restaurantPage', compact('newOrders','archiveOrders','menus','menuCategories','owner'));

        }

        if(Auth::check() && Auth::user()->usertype == 'Owner'){
            if(count(Restaurants::where('user_id',Auth::user()->id)->get())==0)
            {
                $owner =  Auth::user()->id;
                $newOrders = Order::where('status', '=', 'الإنتظار' )
                    ->orWhere('status','=','معلق')
                    ->where('restaurant_id',Restaurants::where('user_id',Auth::user()->id)->first()->id)
                    ->orderBy('created_at', 'DESC')

                    ->get();
                $archiveOrders = Order::where('status', '<>', 'الإنتظار' )
                    ->where('restaurant_id',Restaurants::where('user_id',Auth::user()->id)->first()->id)
                    ->orderBy('created_at', 'DESC')
                    ->get();
                $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
                $menus = Menu::where('restaurant_id',$restaurant)->get();
                $menuCategories = menucategory::all();

                return view('joodyasell.restaurantPage', compact('newOrders','archiveOrders','menus','menuCategories','owner'));

            }
            else
            {
                $newOrders = Order::where('status', '=', 'الإنتظار' )
                    ->where('restaurant_id',Restaurants::where('user_id',Auth::user()->id)->first()->id)
                    ->get();
                $archiveOrders = Order::where('status', '<>', 'الإنتظار' )
                    ->where('restaurant_id',Restaurants::where('user_id',Auth::user()->id)->first()->id)
                    ->orderBy('created_at', 'DESC')
                    ->get();
                $restaurant = Restaurants::where('user_id',Auth::user()->id)->first()->id;
                $menus = Menu::where('restaurant_id',$restaurant)->get();
                $menuCategories = menucategory::all();

                return view('joodyasell.restaurantPage', compact('newOrders','archiveOrders','menus','menuCategories'));
            }
        }
        else
        {
            return view('joodyasell.welcome');

        }

    }
    public function mobileRestaurants($id)
    {
        $restaurant = Restaurants::find($id);
        return view('mobile.restaurant',compact('restaurant'));
    }

    public function policy(){
        return view('pages.policy');
    }

}
