<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    //table name
    protected $table = "topup";

    protected $fillable = [
      'package_id', 'account_id', 'payment_method', 'amount'
    ];

}
