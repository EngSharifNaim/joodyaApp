<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\city;
class area extends Model
{
    protected $table = 'areas';
    public function city(){
        return $this->belongsTo('city','city_id');
    }
    public function getCity($id)
    {
        $city = city::find($id);
        return $city->name;
    }
}
