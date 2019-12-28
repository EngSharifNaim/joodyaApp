<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $table = 'menu_features';

    protected $fillable = [
	'menu_id', 
	'name', 
	'small_price', 
	'mid_price', 
	'bigprise',
	'fixed_price'];

	public $timestamps = false;
}
