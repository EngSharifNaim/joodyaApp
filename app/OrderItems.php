<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'restaurant_order';

    protected $fillable = ['item_name', 'item_price','quantity','created_date','restaurant_id','user_id','order_id'];

    public $timestamps = true;


    public function resturant(){
        return $this->belongsTo('App\Restaurants','restaurant_id');
    }

    public function order(){
        return $this->belongsTo('order','order_id');
    }
}
