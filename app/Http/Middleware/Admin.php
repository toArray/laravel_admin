<?php
/**
 * Created by 信.
 * Date: 2018/3/23
 */
namespace  App\Http\Middleware;
use App\Models\MenuAdmin;
use Illuminate\Support\Facades\Auth;
class Admin{
    /**
     * 作用：判断后台用户是否通过验证，否则跳回登陆页
     * 作者：信
     * 时间：2018/3/23
     * 修改：暂无
     * @param $request
     * @param \Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request,\Closure $next){
        $res = Auth::guard("admin")->check();
        if(!$res){
            return redirect("login/index");
        }
        $menu = $this->getMenu();
        $request->attributes->set("menu", $menu);
        return $next($request);
    }


    /**
     * 作用：权限菜单数据
     * 作者：信
     * 时间：2018/5/23
     * 修改：暂无
     * @return array
     */
    function getMenu(){
        $admin_id = auth('admin')->user()->id;
        $first_menu_where["menu.parent_id"]         = 0;
        $first_menu_where["menu_admin.admin_id"]    = $admin_id;
        $menu_data = MenuAdmin::query()
                    ->Join("menu","menu_id","=","menu.id")
                    ->where($first_menu_where)
                    ->orderBy("sort","desc")
                    ->get();

        foreach ($menu_data as $key=>$value){
            $first_menu_where["menu.parent_id"]         = $value["id"];
            $first_menu_where["menu_admin.admin_id"]    = $admin_id;
            $second_menu_data = MenuAdmin::query()
                            ->Join("menu","menu_id","=","menu.id")
                            ->where($first_menu_where)
                            ->orderBy("sort","desc")
                            ->get();
            $menu_data[$key]["second_menu"] = $second_menu_data;
        }

        return $menu_data;
    }

}