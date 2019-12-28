<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\area;
class city extends Model
{
    protected $table = 'cities';
    public function area(){
        return $this->hasMany('area','city_id');
    }
}
