<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthInformation extends Model
{
    //テーブル名を変更したい
    protected $table = 'auth_information';

    //ブラックリスト方式
    protected $guarded = ['id'];
}
