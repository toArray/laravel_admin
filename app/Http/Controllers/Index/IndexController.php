<?php
/**
 * Created by 信.
 * Date: 2018/3/22
 */
namespace  App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class IndexController extends Controller{

    /**
     * 作用：跳到后台主页
     * 作者：信
     * 时间：2018/3/23
     * 修改：暂无
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view("admin.index");
    }

    /**
     * 作用：后台注销
     * 作者：信
     * 时间：2018/3/23
     * 修改：暂无
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout(){
        Auth::guard("admin")->logout();
        return view("login.index");
    }

}