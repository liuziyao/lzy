$(function () {
    $(".delete").on('click', function () {
        var url = $(this).attr('data-url');
        var re_url = $(this).attr('data-re-url');
        if (confirm('确定删除吗 ？')) {
            $.getJSON(url, '', function (data) {
                if (data.sta == 1) {
                    location.href = re_url;
                } else {
                    alert(data.msg);
                }
            });
        }
    });
    /**
     * 全选反选
     */
    $('#checkAll').click(function () {
        if ($(this).prop("checked")) {
            $("input[name='del']").each(function () {
                $(this).prop('checked', true);
            });
        } else {
            $("input[name='del']").each(function () {
                $(this).prop('checked', false);
            });
        }
    });
    /*只能输入数字或者小数点*/
    $(".PriceText").keyup(function () {
        $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    }).bind("paste", function () {  //CTR+V事件处理
        $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    }).css("ime-mode", "disabled"); //CSS设置输入法不可用
    /*JQuery 限制文本框只能输入数字*/
    $(".NumText").keyup(function () {
        $(this).val($(this).val().replace(/\D|^0/g, ''));
    }).bind("paste", function () {  //CTR+V事件处理
        $(this).val($(this).val().replace(/\D|^0/g, ''));
    }).css("ime-mode", "disabled"); //CSS设置输入法不可用
});
/**
 * 全部删除
 */
function delall() {
    if (!confirm('确定要删除？')) {
        return;
    }
    var my_id = '';
    $("input[name='del']").each(function (k, v) {
        if ($(v).prop('checked')) {
            my_id += $(this).val() + ',';
        }
    });
    $('#myids').val(my_id);
    $('#form1').submit();
}

$(function () {
    $(".user-info-username").bind('click', function () {
        $(this).parent('.user-info-user').toggleClass('active');
        //glyphicon-triangle-top
        if ($(this).find(".glyphicon").hasClass("glyphicon-triangle-bottom")) {
            $(this).find(".glyphicon").removeClass('glyphicon-triangle-bottom').addClass("glyphicon-triangle-top");
        } else {
            $(this).find(".glyphicon").removeClass('glyphicon-triangle-top').addClass("glyphicon-triangle-bottom");
        }
        $(".logout").css({
            width: $(this).css('width')
        });
    });
    $(".li_main").bind('click', function () {
        $(this).siblings('.li_main').removeClass('li_close').addClass('li_close');
        $(this).siblings('.li_main').next('ul').hide();
        $(this).toggleClass('li_close');
        $(this).next('ul').slideToggle('fast');
        if ($(this).find('.glyphicon').hasClass('glyphicon-triangle-bottom')) {
            $(this).find('.glyphicon-triangle-bottom').removeClass('glyphicon-triangle-bottom').addClass('glyphicon glyphicon-triangle-right');
        } else {
            $(this).find('.glyphicon-triangle-right').removeClass('glyphicon-triangle-right').addClass('glyphicon glyphicon-triangle-bottom');
        }
        $(".li_close").next("ul").hide();
    });
});


//公共标签添加或者取消 （推荐，置顶，精华）
function common_tab(id, table_name, key_value, type) {
    $.getJSON("/admin/index/commontab", {id: id, table_name: table_name, key_value: key_value, type: type}, function (data) {
        if (data.sta == 1) {
            location.reload();
        }
    });
}

function alert_msg(msg) {
    $("body").append('<div class="alert_success_msg alert_msg"></div>');
    $(".alert_success_msg").html(msg).slideDown('slow');
    setTimeout("alert_hide()", 3000);
}
function alert_warming_msg(msg) {
    $("body").append('<div class="alert_warming_msg alert_msg"></div>');
    $(".alert_warming_msg").html(msg).slideDown();
    setTimeout("alert_hide()", 3000);
}
function alert_hide() {
    $(".alert_msg").fadeOut('slow').remove();
}

function dialog(html, title, extract) {
    extract = extract == undefined ? {} : extract;
    title = title == undefined ? '搜景观' : title;
    extract.title = title;
    $("#dialog").html(html);
    $("#dialog").dialog(extract);
    $("#dialog").dialog("open");
}

function calcSelectedKw(change_obj) {
    var html = "";
    $(".query-list label").removeClass('checked');
    $(".query-tag input[type='checkbox']:checked").each(function (k, v) {
        var text = $("label[for='" + $(v).attr('id') + "']").find('a').text();
        html += "<a href=\"javascript:removeKw('" + $(v).attr('id') + "')\">" + text + "×</a>";
        $("label[for='" + $(v).attr('id') + "']").addClass('checked');
    });
    if (change_obj != undefined) {
        var is_all = change_obj.val().indexOf('all') > -1 ? true : false;
        if (is_all) {
            change_obj.siblings("input[type='checkbox']").prop('checked', false);
        } else {
            change_obj.parent('.two-tag').find("input[type='checkbox']:first").prop('checked', false);
        }
    }
    var data = new Array();
    $(".two-tag input[type='checkbox']:checked").each(function (k, v) {
        var two_tag_id = $(v).parents(".two-tag").attr("id");
        var tow_tag_type = $(v).parents(".two-tag").attr("data-type");
        var text = $("label[for='cb_" + two_tag_id + "']").find('a').text();
        html += "<a href='javascript:removeSub(\"" + two_tag_id + "\")'>" + text + "×</a>:";
        var text = $("label[for='" + $(v).attr('id') + "']").find('a').text();
        html += "<a href=\"javascript:removeKw('" + $(v).attr('id') + "')\">" + text + "×</a>";
        $("label[for='" + $(v).attr('id') + "']").addClass('checked');
        $("label[for='cb_" + $(v).parent('.two-tag').attr('id') + "']").addClass('checked');
    });
    $(".kw-checked").html(html);
}
function removeKw(id) {
    $("#" + id).prop('checked', false);
    calcSelectedKw();
}
function removeSub(id) {
    $("#" + id).find("input[type='checkbox']").prop('checked', false);
    calcSelectedKw();
}
$(function () {
    $(document).on('click', ".query-list .more", function () {
        if ($(this).siblings(".query-tag").hasClass('height_auto')) {
            $(this).text('更多');
        } else {
            $(this).text('收起');
        }
        $(this).siblings(".query-tag").toggleClass("height_auto");
        $(this).toggleClass("more-up");
    });
    $(document).on('click', ".query-list .more-change", function () {
        if ($(this).hasClass("blue_btn_min")) {
            $(this).siblings(".query-tag").find(".check_box").hide();
            $(this).siblings(".query-tag").removeClass("height_auto");
            $(this).removeClass("blue_btn_min");
            $(this).siblings(".query-tag").find(".q_box").show();

        } else {
            $(this).siblings(".query-tag").find(".check_box").show();
            $(this).siblings(".query-tag").addClass("height_auto");
            $(this).addClass("blue_btn_min");
            $(this).siblings(".query-tag").find(".q_box").show();
        }
    });
    $(document).on('click', ".more_up", function () {
        if ($('.more_detail').hasClass('height_auto')) {
            $(this).text('展开全部 》');
        } else {
            $(this).text('收起 》');

        }
        $('.more_detail').toggleClass('height_auto');
    });
    $(document).on('change', ".checkboxs", function () {
        calcSelectedKw($(this));
    });
});
function getsub(id) {
    $("#" + id).siblings('.two-tag').hide();
    $("#" + id).toggle();
}

$(function () {
    $(document).on('change', '#checkAll', function () {
        $(".checkbox_item").prop('checked', $(this).prop('checked'));
    });
    $(document).on('click', '#deleteAll', function () {
        var param = $(".checkbox_item:checkbox").serialize();
        if (window.confirm('您确定删除所选吗？')) {
            $.get($(this).attr('data-url'), param, function (data) {
                window.location.reload();
            }, 'json');
        }
    });
});
