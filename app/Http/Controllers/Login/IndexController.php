<?php
/**
 * Created by 信.
 * User: 82050
 * Date: 2018/3/20
 * Time: 14:19
 */
namespace  App\Http\Controllers\Login;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class IndexController extends Controller{

    /**
     * 作用：前往后台登录页面
     * 作者：信
     * 时间：2018/3/20
     * 修改：暂无
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view("login.index");
    }


    /**
     * 作用：后台Ajax登陆
     * 作者：信
     * 时间：2018/3/22
     * 修改：暂无
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        if(!$request->ajax()){
            $return = ["code"=>0,"msg"=>"请求异常，请稍后再试!"];
            if(!$request->isMethod("POST")){
                return response()->json($return);
            }
            return response()->json($return);
        }
        $data           = $request->all();
        $admin_id       = $data["admin_id"];
        $password       = $data["password"];

        /*验证码比对*/
        $webCode        = strtolower($data["captcha"]);
        $sessionCode    = Session::get("captcha")['key'];
        if(!Hash::check($webCode,$sessionCode)){
            $return = ["code"=>0,"msg"=>"验证码不正确，请重新输入"];
            return response()->json($return);
        }

        /*验证账号是否存在或冻结*/
        $isset = Admin::query()->where("admin_id",$admin_id)->first();
        if($isset){
            if($isset["deleted_at"] != 0){
                $return = ["code"=>0,"msg"=>"无该账号，请确认账号信息是否正确"];
                return response()->json($return);
            }
            if($isset["admin_status"] == 1){
                $return = ["code"=>0,"msg"=>"此账号已被禁止登录，如需解除请联系管理员"];
                return response()->json($return);
            }
        }else{
            $return = ["code"=>0,"msg"=>"无该账号，请确认账号信息是否正确"];
            return response()->json($return);
        }

        /*验证账号密码是否匹配*/
        $res  = Auth::guard("admin")->attempt(["admin_id" => $admin_id,"password" => $password],true);
        if (!$res) {
            $return = ["code"=>0,"msg"=>"账号或密码不正确，请重新输入"];
            return response()->json($return);
        }

        $return = ["code"=>1,"msg"=>"恭喜您，登陆成功!"];
        return response()->json($return);
    }



}
