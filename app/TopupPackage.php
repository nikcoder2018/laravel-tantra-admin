<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopupPackage extends Model
{
  //table name
  protected $table = "topup_package";

  protected $fillable = [
    'name', 'description', 'freebie_package', 'price', 'taney', 'cover'
  ];

}
