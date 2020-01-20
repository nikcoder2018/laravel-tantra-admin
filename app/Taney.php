<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taney extends Model
{
    protected $connection = 'billcrux';

    protected $table = 'tblUserInfo';

}
