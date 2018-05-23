<?php
/**
 * Created by 信.
 * Date: 2018/3/22
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MenuAdmin extends Model
{
    protected $table = 'menu_admin';
    public $timestamps = false;

    public function menu(){
        return $this->hasOne("App\Models\Menu","id","menu_id");
    }
}