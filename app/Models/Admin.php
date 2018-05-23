<?php
/**
 * Created by 信.
 * Date: 2018/3/22
 */
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable //继承从Model改成 Auth这个
{
    protected $table = 'admin';
    protected $fillable = [
        'admin_id','password'
    ];
    protected $hidden = [
        'password'
    ];
}