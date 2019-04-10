<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
  public function recipe()
  {
    return $this->belongsTo('App\Recipe');
  }
}
