$(function() {
    $(document).on("panelbeforeload", ".panel#buyPanel", function() {
        //获取用户是否绑定地址
        var is_bind = isBind();
        if (!is_bind) {
            showPopupBind();
        } else {
            getGoodsInfo();
        }
    });
//    $(document).on("panelbeforeload", ".panel#main", function() {
//        panel_default();
//    });
//    $(document).on("panelbeforeload", ".panel#storemainPanel", function() {
//        panel_storemain_default();
//    });
});
function showPopupBind() {
    var popup = $.afui.popup({
        title: "<div style='font-size:14px;text-align:center'>绑定用户信息</div>",
        message: "<form id='bind_form'><input type='text' name='realname' placeholder='姓名'/><input type='text' name='mobile' placeholder='手机'/><input type='text' name='idcard' placeholder='身份证'/><div class='region'></div><input type='text' name='address' placeholder='地址' /></form><script>$(function(){$('.region').area();})</script>",
        cancelText: "取消",
        cancelCallback: function() {
            $.afui.goBack();
        },
        doneText: "确定",
        doneCallback: function(obj) {
            var jobj = $("#" + obj.id);
            var param = jobj.find("#bind_form").serialize();
            var url = "/wechat/ajax/bind_user";
            ajaxpost(url, param, function(data) { console.log(data);
                if (data.sta == 0) {
                    alert(data.msg);
                } else {
                    obj.hide();
                    loadUserInfo(data.data);
                    $.afui.loadContent("#buyPanel", false, false, 'slide');
                }
            });
        },
        cancelOnly: false,
        autoCloseDone: false
    });
}
function edit_user_info() {
    var url = "/wechat/ajax/get_user_info";
    var user_info = {};
    ajaxget(url, {}, function(data) {
        user_info = data.data;
    });
    var popup = $.afui.popup({
        title: "<div style='font-size:14px;text-align:center'>绑定用户信息</div>",
        message: "<form id='bind_form'><input type='text' value='" + user_info.realname + "' name='realname' placeholder='姓名'/><input type='text' value='" + user_info.mobile + "' name='mobile' placeholder='手机'/><input type='text' name='idcard' value='" + user_info.idcard + "' placeholder='身份证'/><div class='region'></div><input type='text' name='address' placeholder='地址' value='" + user_info.address + "' /></form><script>$(function(){$('.region').area({areacode:'" + user_info.area_code + "'});})</script>",
        cancelText: "取消",
        cancelCallback: function(obj) {
            obj.hide();
        },
        doneText: "确定",
        doneCallback: function(obj) {
            //console.log($(this).remove());
            var jobj = $("#" + obj.id);
            var param = jobj.find("#bind_form").serialize();
            var url = "/wechat/ajax/edit_bind_user";
            ajaxpost(url, param, function(data) {
                if (data.sta == 0) {
                    alert(data.msg);
                } else {
                    obj.hide();
                    loadUserInfo(data.data);
                    $.afui.loadContent("#buyPanel", true, false, 'slide');
                }
            });
        },
        cancelOnly: false,
        autoCloseDone: false
    });
}
/**
 * 判断用户是否绑定的地址
 * @returns {Number}
 */
function isBind() {
    var rtn = 0;
    var url = "/wechat/ajax/is_bind.html";
    ajaxpost(url, {}, function(data) {
        rtn = data.sta;
    });
    return rtn;
}
function ajaxpost(url, data, callback,async) {
    $.afui.showMask();
    $.afui.loadingText = '请稍后...';
    async = !async  ? false : async;
    $.ajax({
        type: "post",
        url: url,
        async: async,
        data: data,
        dataType: 'json',
        success: function(data) {
            $.afui.hideMask();
            callback(data);
        }, 
        complete: function(XMLHttpRequest, status) {
            if (status == 'timeout') {
                $.afui.hideMask();
                alert('网络连接失败');
            }
        }
    });
}
function ajaxget(url, data, callback,async) {
    $.afui.showMask('请稍后...');
    async = !async ? false : async;
    $.ajax({
        type: "get",
        url: url,
        async: async,
        data: data,
        dataType: 'json',
        success: function(data) {
            $.afui.hideMask();
            callback(data);
        }, 
        complete: function(XMLHttpRequest, status) {
            if (status == 'timeout') {
                $.afui.hideMask();
                alert('网络连接失败');
            }
        }
    });
}

