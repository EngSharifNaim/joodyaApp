<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Menu;
class menucategory extends Model
{
    public function menu(){
        return $this->hasMany('Menu');
    }
}
