layui.define(['layer', 'form', 'element', 'table', 'laydate'], function(exports) {
    var layer   = layui.layer,
        element = layui.element,
        table   = layui.table,
        laydate = layui.laydate,
        form    = layui.form,
        $       = layui.$;

    var lea = {
        msg: function(msg) {
            var _msg = '';
            if (typeof msg === 'object') {
                $.each(msg, function(i, val) {
                    _msg += '<li style="text-align:left;list-syle-type:square">' + val + '</li>';
                });
            } else {
                _msg = msg;
            }
            return _msg;
        }
    };


    //输出test接口
    exports('lea', lea);
});