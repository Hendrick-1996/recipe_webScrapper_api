<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    public function ingredients()
    {
      return $this->hasMany('App\Ingredient');
    }

    public function instructions()
    {
      return $this->hasMany('App\Instruction');
    }
}
