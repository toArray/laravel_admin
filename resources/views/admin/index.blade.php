<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="/build/css/app.css" media="all">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_678404_99viq5xamza7nwmi.css" media="all">
</head>
<style>
    @font-face {
        font-family: 'layui-icon';  /* project id 678404 */
        src: url('//at.alicdn.com/t/font_678404_0awx8vou772satt9.eot');
        src: url('//at.alicdn.com/t/font_678404_0awx8vou772satt9.eot?#iefix') format('embedded-opentype'),
        url('//at.alicdn.com/t/font_678404_0awx8vou772satt9.woff') format('woff'),
        url('//at.alicdn.com/t/font_678404_0awx8vou772satt9.ttf') format('truetype'),
        url('//at.alicdn.com/t/font_678404_0awx8vou772satt9.svg#iconfont') format('svg');
    }
</style>
<body>
<div class="layui-layout layui-layout-admin kit-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">Laravel</div>
        <div class="layui-logo kit-logo-mobile"></div>
        <ul class="layui-nav layui-layout-left kit-nav" kit-one-level>
            <li class="layui-nav-item"><a href="javascript:;">控制台</a></li>
        </ul>
        <ul class="layui-nav layui-layout-right kit-nav" lay-filter="kitNavbar" kit-navbar>
            <li class="layui-nav-item">
                <a href="javascript:;">
                    {{ auth('admin')->user()->admin_name }}
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" data-url="{{ url('manager/secure') }}" data-icon="&#xe614;" data-title="安全设置" kit-target data-id='1'><span>安全设置</span></a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="{{ url('index/logout') }}"><i class="layui-icon" aria-hidden="true">&#xe60f;</i> 注销</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black kit-side">
        <div class="layui-side-scroll">
            <div class="kit-side-fold"><i class="layui-icon" aria-hidden="true">&#xe668;</i></div>
            {{-- 左侧菜单start--}}
            <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                @php
                    $menu = Request::get("menu");
                @endphp
                @foreach($menu as $key=>$value)
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon" aria-hidden="true">{{ $value['icon'] }}</i>
                            <span>{{$value['menu_name']}}</span>
                        </a>
                        <dl class="layui-nav-child">
                            @foreach($value["second_menu"] as $k=>$v)
                                <dd>
                                    <a href="javascript:;" data-url="{{$v["menu_url"]}}" data-icon="{{$v["icon"]}}" data-title="{{$v["menu_name"]}}" kit-target data-id='{{$v["id"]}}'>
                                        <i class="layui-icon">{{$v['icon']}}</i>
                                        <span>{{$v["menu_name"]}}</span>
                                    </a>
                                </dd>
                            @endforeach
                        </dl>
                    </li>
                @endforeach
            </ul>
            {{-- 左侧菜单end--}}
        </div>
    </div>
    <div class="layui-body" id="container">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">主体内容加载中,请稍等...</div>
    </div>
</div>
<script type="text/javascript">
</script>
<script src="/plugins/layui/layui.js"></script>
<script>
    /*左侧菜单切换*/
    // layui.use('element', function(){
    //     var element = layui.element;
    //
    // });

    var message;
    layui.config({
        base: '/build/js/'
    }).use(['app', 'message'], function() {
        var app = layui.app,
            $ = layui.jquery,
            layer = layui.layer;
        //将message设置为全局以便子页面调用
        message = layui.message;
        //主入口
        app.set({
            type: 'iframe',
            url: '/managermain',
        }).init();
        $('#pay').on('click', function() {
            layer.open({
                title: false,
                type: 1,
                content: '<img src="/build/images/pay.png" />',
                area: ['500px', '250px'],
                shadeClose: true
            });
        });
    });
</script>
</body>

</html>