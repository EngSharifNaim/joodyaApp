<?php

namespace App\Providers;

use Auth;
use App\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $tempUser = rand(10,100);
//        Session::set('tempUser', $tempUser);

        if (Auth::check()) {
            view()->composer('*', function ($view)
            {
                $cart = Cart::where('user_id', Auth::user()->id)->orderBy('item_id')
                ->leftJoin('menu', 'cart.item_id', '=', 'menu.id')
                ->take(3)->get();

                //...with this variable
                $view->with('cart', $cart );
            });
        }
    }
}
