<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/css/admin/style.css" media="all">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_599584_0a77dxsha5vu0udi.css">
</head>

<body>
    <div class="login layui-anim-up">
        <div class="login-main">
            <div class="login-box login-header">
                <h2>Laravel后台搭建</h2>
                <p>后台管理系统</p>
            </div>
            <div class="login-box login-body">
                <form method="post" action="" class=" layui-form" onsubmit="return false">
                    {!! csrf_field() !!}
                    <div class="layui-form-item">
                        <label class="login-icon layui-icon layui-icon-username iconfont icon-yonghu" for="admin_id"></label>
                        <input type="text" name="admin_id" id="admin_id" maxlength="32" lay-verify="required|admin_id" placeholder="用户名" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <label class="login-icon layui-icon layui-icon-password iconfont icon-suo" for="password"></label>
                        <input type="password" name="password" id="password" maxlength="16" minlength="6" lay-verify="required" placeholder="密码" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs7">
                                <label class="login-icon layui-icon layui-icon-vercode iconfont icon-baohu" for="captcha"></label>
                                <input type="text" name="captcha" maxlength="4" minlength="4" id="captcha" lay-verify="required" placeholder="图形验证码" class="layui-input">
                            </div>
                            <div class="layui-col-xs5">
                                <div style="margin-left: 10px;">
                                    <img src="" class="login-codeimg" id="vercode">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="layui-form-item" style="margin-bottom: 20px;">
                        <input type="checkbox" name="remember" value="1" lay-skin="primary" title="记住密码">
                    </div>
                    <div class="layui-form-item">
                        <button id="login" class="layui-btn layui-btn-fluid" lay-submit lay-filter="layform">登 入</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="login-footer">
        <hr>
        <p><span>信。</span></p>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/plugins/layui/layui.js"></script>
    <script type="text/javascript">
        layui.config({
            base: '/js/admin/'
        }).use('lea');

        $(document).ready(function() {
            /*获取meata头部的CSRF信息，避免CSRF攻击*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            /*切换验证码*/
            $('#vercode').click(function() {
                var src = "{{ captcha_src('flat') }}";
                $(this).attr('src', src + '?' + Math.random());
            });
            $('#vercode').click();


            /**
             * 作用：后台点击Ajax登陆验证
             * 作者：信
             * 时间：2018/3/22
             * 修改：暂无
             */
            $(document).on("click","#login",function () {
                layer.load(1);
                var $admin_id = $("#admin_id").val().replace(/(^\s*)|(\s*$)/g,"");
                var $password = $("#password").val().replace(/(^\s*)|(\s*$)/g,"");
                var $captcha  = $("#captcha").val().replace(/(^\s*)|(\s*$)/g,"");
                if(!$admin_id || !$password || !$captcha){
                    setTimeout(function(){
                        layer.closeAll('loading');
                    });
                    return false;
                }
                $.ajax({
                    type:"post",
                    url:"/login/login",
                    data:{"admin_id":$admin_id,"password":$password,"captcha":$captcha},
                    success:function (res){
                        if(!res.code){
                            setTimeout(function(){
                                layer.closeAll('loading');
                            });
                            layer.msg(res.msg,{icon: 2});
                            return false;
                        }
                        window.location.href = "/index/index";
                    },
                    error:function (err) {
                        layer.msg("系统异常，请稍后再试");
                        setTimeout(function(){
                            layer.closeAll('loading');
                        });
                    }
                })
            });


            /**
             * 作用：禁止前进和后退
             * 作者：信
             * 时间：2018/3/23
             * 修改：暂无
             */
            noBack();
            function noBack() {
                history.pushState(null, null, document.URL);
                window.addEventListener('popstate', function () {
                    history.pushState(null, null, document.URL);
                });
            }


        });
    </script>
</body>

</html>