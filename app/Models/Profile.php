<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //ブラックリスト方式
    protected $guarded = ['id'];
}

