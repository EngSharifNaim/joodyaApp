<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['created_date'];

	public $timestamps = true;
 
    public function items()
    {
        return $this->hasMany('App\OrderItems');
    }

    public function resturantOrders($id)
    {
        return $this->belongsto('App\Restaurants');
    }

}