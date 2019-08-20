<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected $table='addresses';
  public $primaryKey='id';
  public $timestamps=true;
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
