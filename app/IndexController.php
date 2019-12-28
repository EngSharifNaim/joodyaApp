<?php

namespace App\Http\Controllers;

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

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{


    public function index()
    {
    	/*if(!$this->alreadyInstalled()) {
            return redirect('install');
        }*/

         $types=Types::orderBy('type')->get();
        $useragent=$_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

            header('Location: https://joodya.com/mobile');

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

        /*$mostsales = model_name::find($id);
        return view('view')->with ('variable',$variable); */

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

      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

         if (Auth::attempt($credentials, $request->has('remember'))) {

            if(Auth::user()->usertype=='banned'){
                \Auth::logout();
                return array("errors" => 'You account has been banned!');
            }

            return $this->handleUserWasAuthenticated($request);
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/login')->withErrors('The email or the password is invalid. Please try again.');

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

        if (method_exists($this, 'authenticated')) {
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

        return redirect('/login');
    }


    public function register()
    {

        return view('pages.register');
    }

    public function register_user(Request $request)
    {
        $data = $request->except(['_token']);
//        $data =  Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|max:75|unique:users',
                'password' => 'required|min:3|confirmed',
            'mobile'
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



            \Session::flash('flash_message', 'Register successfully...');

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
        $user->postal_code = $inputs['postal_code'];
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

        $inputs = $request->all();

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

            \Session::flash('flash_message', 'Password has been changed...');

            return \Redirect::back();


    }


    public function contact_send(Request $request)
    {

        $data =  Request::except(array('_token')) ;

        $inputs = $request->all();

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


            \Session::flash('flash_message', 'Thank You. Your Message has been Submitted.');

            return \Redirect::back();


    }
        public function showMobile()
    {
        $restaurants = Restaurants::all();
        $areas = area::orderBy('id', 'desc')
            ->get() ;

        $types = Types::orderBy('id', 'desc')
            ->take(8)->get() ;

        $cities = DB::table("cities")->pluck("name","id");
        $page = 'main';
        return view('mobile.index',compact('restaurants','types','cities','areas','page'));
    }
    public function mobileRestaurants($id)
    {
        $restaurant = Restaurants::find($id);
        return view('mobile.restaurant',compact('restaurant'));
    }

    public function policy(){
        return view('page.policy');
    }

}
