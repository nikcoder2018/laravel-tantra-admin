<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopupFreebies extends Model
{
  //table name
  protected $table = "topup_freebies";

  protected $fillable = [
    'ItemIndex', 'ItemCount', 'isBundle', 'QtyPerBundle'
  ];
}
