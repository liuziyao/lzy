var common = {
    popShow: function (id) {
        $(".pop").hide();
        $(".grey_bg").show();
        $("#" + id).show();
    },
    popHide: function (id) {
        $(".grey_bg").hide();
        $("#" + id).hide();

    }


};
$(function () {
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

    $(".btn-type-2 ul li").click(function () {
        $(this).parents(".btn-type-2").find(".select_text").text($(this).text());
    });

    $(".query-list .more").click(function () {
        if ($(this).siblings(".query-tag").hasClass('height_auto')) {
            $(this).text('更多');
            $(this).parent('li').find(".two-tag").hide();
        } else {
            $(this).parent('li').siblings("li").find(".query-tag").removeClass('height_auto');
            $(this).parent('li').siblings("li").find(".more").text('更多').removeClass('more-up');
            $(this).text('收起');
        }
        $(this).siblings(".query-tag").toggleClass("height_auto");
        $(this).toggleClass("more-up");
    });

    $(".query-list .more-change").click(function () {
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

    $(".q_cancel").click(function () {
        $(this).parents("li").find(".check_box").toggle();
        $(this).parents("li").find(".query-tag").toggleClass("height_auto");
        $(this).parents("li").find(".more-change").toggleClass("blue_btn_min");
        $(this).parents("li").find(".q_box").toggle();
    });

    $(".more_up").click(function () {
        if ($('.more_detail').hasClass('height_auto')) {
            $(this).text('展开全部 》');
        } else {
            $(this).text('收起 》');
        }
        $('.more_detail').toggleClass('height_auto');
    });
    //申请职位
    $(".apply-job").on('click', function () {
        $.post($("#data-form").attr('action'), $("#data-form").serialize(), function (data) {
            alert(data.msg);
        }, 'json')
    });
    $(".single-apply-job").on('click', function () {
        $.post($("#data-form").attr('action'), {id: $(this).attr('data-job-id')}, function (data) {
            alert(data.msg);
        }, 'json')
    });

    $("#mi_user").unbind('change').bind('change', function () {
        var selected = $('#mi_user option:selected').val();
        if (selected > 2 && IS_LOGIN == 0) {
            alert('请先登录');
            $('#mi_user option:first').attr("selected", true);
        }
    });

    //
    var visible_tag = $(".two-tag:visible").attr('id');
    $("label[for='cb_" + visible_tag + "']").removeClass('on').addClass('on');


    $(function () {
        $('input, textarea').placeholder();
    });

});
function getsub(id) {
    /**
     * 点击出现二级关键词的时候，让其他的都收缩起来
     */
    $("#" + id).parents('li').siblings("li").find(".query-tag").removeClass('height_auto');
    $("#" + id).parents('li').siblings("li").find(".more").text('更多').removeClass('more-up');
    $("#" + id).parents('li').siblings("li").find(".two-tag").hide();
    $("#" + id).parents('.query-list').find("li").find("label[data-type='double']").removeClass('on');
    //end
    $("#" + id).siblings('.two-tag').hide();
    $("#" + id).toggle();
    if ($("#" + id).is(":hidden")) {
        $("label[for='cb_" + id + "']").removeClass('on');
    } else {
        $("label[for='cb_" + id + "']").addClass('on');
    }
}
function no_filter_sub(id) {
    $("#" + id).find("input[type='checkbox']").prop("checked", false);
    form_search_submit();
}
function no_filter(id) {
    $("#" + id).prop('checked', false);
    form_search_submit();
}
/*兼容修改 20160413*/
$(function () {
    $("#form-search label").click(function () {
        $("#" + $(this).attr("for")).click().change();
        if (typeof ($("#" + $(this).attr("for")).val()) == "undefined") {
            $("#" + $(this).attr("for")).siblings("input[type='checkbox']").prop('checked', false);
        } else {
            checkBoxChange($("#" + $(this).attr("for")));
        }

    });
    function checkBoxChange(that) {
        if (typeof (that.val()) == "undefined") { //点击不限
            //that.parent().find("input[type='checkbox']").prop('checked', false);
            //that.prop('checked',true);
            that.siblings("input[type='checkbox']").prop('checked', false);
        }else if(that.val().indexOf("all") != -1){
            that.siblings("input[type='checkbox']").prop('checked', false);
        } else {
            if (that.attr('data-type') == 'sub') { //是二级关键词
                that.parents(".two-tag").find("input[type='checkbox']:first").prop('checked', false);//把全部取消
                // that.parent().find("input[type='checkbox']:first").prop('checked', false);  修改 20160419
            } else { //一级关键词
                that.parents('.query-list').find("li").find(".query-tag").removeClass('height_auto');
                //that.parents('.query-list').find("li").find(".more").text('更多').removeClass('more-up');
                that.parents('.query-list').find("li").find(".two-tag").hide();
            }
            var is_checked = that.prop('checked');
            if (is_checked && (controller_id == 'mi' || controller_id == 'image' || controller_id == 'user' || controller_id == 'company' || controller_id == 'website' || controller_id == 'projectcooperation' || controller_id == 'job' || controller_id == 'industryactive' || controller_id == 'industrynews')) {
                var ck_name = that.attr('name');
                var value = that.val();
                var table = '';
                var name = '';
                var text = $("label[for='" + that.attr('id') + "']").find('a').text();
                switch (ck_name) {
                    case 'type_id[]':
                        if (controller_id == 'mi' || controller_id == 'image') {
                            table = 'mi_type';
                        } else if (controller_id == 'user' || controller_id == 'company') {
                            table = 'ukw_type';
                        }
                        name = 'type_id';
                        break;
                    case 'style_id[]':
                        table = 'mi_style';
                        name = 'style_id';
                        break;
                    case 'place_id[]':
                        table = 'mi_place';
                        name = 'place_id';
                        break;
                    case 'height_id[]':
                        table = 'mi_height';
                        name = 'height_id';
                        break;
                    case 'ln_id[]':
                        table = 'mi_landscape_node';
                        name = 'ln_id';
                        break;
                    case 'landscaping_id[]':
                        table = 'mi_landscaping';
                        name = 'landscaping_id';
                        break;
                    case 'major_id[]':
                        table = 'ukw_major';
                        name = 'major_id';
                        break;
                    case 'project_id[]':
                        table = 'ukw_project';
                        name = 'project_id';
                        break;
                    case 'ukw_type_ids[]':
                        table = 'ukw_type';
                        name = 'ukw_type_ids';
                        break;
                    case 'ukw_major_ids[]':
                        table = 'ukw_major';
                        name = 'ukw_major_ids';
                        break;
                    case 'ukw_project_ids[]':
                        table = 'ukw_project';
                        name = 'ukw_project_ids';
                        break;
                    case 'jb_position[]':
                        table = 'jb_position';
                        name = 'jb_position';
                        break;
                }
                var url = "/ajax/statistics_keyword";
                $.post(url, {table: table, id: value, controller_id: controller_id, name: name, value: value, text: text}, function () {

                }, 'json');
            }
        }
        form_search_submit();
    }
    $(".form-order").find(".order-type").bind('click', function () {
        var value = $(this).attr('data-value');
        var type = $(this).attr('data-type');
        if (type == 'sorting') {
            value = 'desc';
        }
        $("input[name='order']").val(type + "-" + value);
        form_search_submit();
    });
});
function form_search_submit() {
    var more = "";
    var sub = "";
    $.each($(".query-list li"), function (k, v) {
        if ($(this).find(".more").hasClass('more-up')) {
            var index = parseInt(k) + 1
            more += index + ",";
        }
    });
    $.each($(".two-tag"), function (k, v) {
        if (!$(this).is(":hidden")) {
            sub += $(this).attr('id') + ",";
        }
    });

    $("input[name='more']").val(more);
    $("input[name='sub']").val(sub);
    $("#form-search").submit();
}
/**
 * 收藏方法
 * @param {type} fav_id
 * @param {type} fav_type
 * @returns {undefined}
 */
function fav(fav_id, fav_type) {
    var url = '/favourite/fav' + "?fav_type=" + fav_type + "&fav_id=" + fav_id;
    $.getJSON(url, function (data) {
        alert(data.msg);

    });
}
/**
 * 点赞方法
 * @param {type} id
 * @param {type} table
 * @returns {undefined}
 */
function praise(id, table) {
    var url = '/favourite/praise' + "?id=" + id + "&table=" + table;
    $.getJSON(url, function (data) {
        alert(data.msg);
        if (data.sta == 1) {
            var count = $(".show_praise_count[data-id='" + id + "']").html();
            count = parseInt(count) + 1;
            $(".show_praise_count[data-id='" + id + "']").html(count);
        }
    });
}

function add_fans(id) {
    var url = '/fans/addfans' + "?fuser_id=" + id;
    $.getJSON(url, function (data) {
        alert(data.msg);
        location.reload();
    });
}

function dialog(html, title, extract) {
    extract = extract == undefined ? {} : extract;
    title = title == undefined ? '搜景观' : title;
    extract.title = title;
    $("#dialog").html(html);
    $("#dialog").dialog(extract);
    $("#dialog").dialog("open");
}

function alert_msg(msg) {
    $(".alert_success_msg").html(msg).slideDown('slow');
    setTimeout("alert_hide()", 3000);
}
function alert_warming_msg(msg) {
    $(".alert_warming_msg").html(msg).slideDown();
    setTimeout("alert_hide()", 3000);
}
function alert_hide() {
    $(".alert_msg").fadeOut('slow');
}

/**
 * 幻灯片
 */
$(function () {
    var slide_count = $(".slide").find('a').length;
    var slide_html = "<div class='slide_index'>";
    for (var i = 1; i <= slide_count; i++) {
        if (i == 1) {
            slide_html += "<span class='on'>" + i + "</span>"
        } else {
            slide_html += "<span>" + i + "</span>"
        }
    }
    slide_html += "</div>";
    $(".slide").append(slide_html);

    $(document).on('mousemove', '.slide_index span', function () {
        var i = $(this).index();
        $(".slide a:eq(" + i + ")").show().siblings("a").hide();
    });

    $(".get_area").bind('click', function () {
        var c = $(this).attr('data-filter');
        $("." + c).toggle().siblings('.area').hide();
    });

    $(".area li").bind('click', function () {
        $(this).find("span").addClass("hot_selected");
        $(this).siblings('li').find("span").removeClass("hot_selected");
        $(".address_hot_adress[type='" + $(this).find("span").html() + "']").show().siblings(".address_hot_adress").hide();
    });

    $("#form-search select").bind('change', function () {
        if (!$(this).hasClass('no-submit')) {
            $(".query-list").find("li").find(".query-tag").removeClass('height_auto');
            $(".query-list").find("li").find(".more").text('更多').removeClass('more-up');
            $(".query-list").find("li").find(".two-tag").hide();
            form_search_submit();

        }
    });
    $("#form-search #_citys3 a").on('click', function () {
        form_search_submit();
    });
    $(document).on('click', '#form-search input[type="text"]', function () {
        $(".query-list").find("li").find(".query-tag").removeClass('height_auto');
        $(".query-list").find("li").find(".more").text('更多').removeClass('more-up');
        $(".query-list").find("li").find(".two-tag").hide();
    });
//    $("#form-search input").on('blur',function(){ alert(1);
//        $(".query-list").find("li").find(".query-tag").removeClass('height_auto');
//        $(".query-list").find("li").find(".more").text('更多').removeClass('more-up');
//        $(".query-list").find("li").find(".two-tag").hide();
//    });
    /*    $(document).on('mouseenter', ".query-tag label[data-type='double'] a", function () {
     var href = $(this).attr('href');
     href = href.replace("javascript:","");
     $(this).attr("onclick",href);
     $(this).trigger('click');
     //$("label[for='cb_type_id_143'] a").click();
     });
     $(document).on('mouseleave', ".query-tag label[data-type='double'] a", function () {
     var href = $(this).attr('href');
     href = href.replace("javascript:","");
     $(this).attr("onclick",href);
     $(this).trigger('click');
     //$("label[for='cb_type_id_143'] a").click();
     });*/
});
function add_friend(fuser_id) {
    var url = "/mp/dialog/add_friend";
    $.get(url, {fuser_id: fuser_id}, function (html) {
        dialog(html, '添加好友');
    }, 'html');
}



/* 20160419 修改 placeholder IE8 以下兼容性 */
;
(function (window, document, $) {

    var isInputSupported = 'placeholder' in document.createElement('input'),
            isTextareaSupported = 'placeholder' in document.createElement('textarea'),
            prototype = $.fn,
            valHooks = $.valHooks,
            hooks,
            placeholder;

    if (isInputSupported && isTextareaSupported) {

        placeholder = prototype.placeholder = function () {
            return this;
        };

        placeholder.input = placeholder.textarea = true;

    } else {

        placeholder = prototype.placeholder = function () {
            var $this = this;
            $this
                    .filter((isInputSupported ? 'textarea' : ':input') + '[placeholder]')
                    .not('.placeholder')
                    .bind({
                        'focus.placeholder': clearPlaceholder,
                        'blur.placeholder': setPlaceholder
                    })
                    .data('placeholder-enabled', true)
                    .trigger('blur.placeholder');
            return $this;
        };

        placeholder.input = isInputSupported;
        placeholder.textarea = isTextareaSupported;

        hooks = {
            'get': function (element) {
                var $element = $(element);
                return $element.data('placeholder-enabled') && $element.hasClass('placeholder') ? '' : element.value;
            },
            'set': function (element, value) {
                var $element = $(element);
                if (!$element.data('placeholder-enabled')) {
                    return element.value = value;
                }
                if (value == '') {
                    element.value = value;
                    // Issue #56: Setting the placeholder causes problems if the element continues to have focus.
                    if (element != document.activeElement) {
                        // We can’t use `triggerHandler` here because of dummy text/password inputs :(
                        setPlaceholder.call(element);
                    }
                } else if ($element.hasClass('placeholder')) {
                    clearPlaceholder.call(element, true, value) || (element.value = value);
                } else {
                    element.value = value;
                }
                // `set` can not return `undefined`; see http://jsapi.info/jquery/1.7.1/val#L2363
                return $element;
            }
        };

        isInputSupported || (valHooks.input = hooks);
        isTextareaSupported || (valHooks.textarea = hooks);

        $(function () {
            // Look for forms
            $(document).delegate('form', 'submit.placeholder', function () {
                // Clear the placeholder values so they don’t get submitted
                var $inputs = $('.placeholder', this).each(clearPlaceholder);
                setTimeout(function () {
                    $inputs.each(setPlaceholder);
                }, 10);
            });
        });

        // Clear placeholder values upon page reload
        $(window).bind('beforeunload.placeholder', function () {
            $('.placeholder').each(function () {
                this.value = '';
            });
        });

    }

    function args(elem) {
        // Return an object of element attributes
        var newAttrs = {},
                rinlinejQuery = /^jQuery\d+$/;
        $.each(elem.attributes, function (i, attr) {
            if (attr.specified && !rinlinejQuery.test(attr.name)) {
                newAttrs[attr.name] = attr.value;
            }
        });
        return newAttrs;
    }

    function clearPlaceholder(event, value) {
        var input = this,
                $input = $(input);
        if (input.value == $input.attr('placeholder') && $input.hasClass('placeholder')) {
            if ($input.data('placeholder-password')) {
                $input = $input.hide().next().show().attr('id', $input.removeAttr('id').data('placeholder-id'));
                // If `clearPlaceholder` was called from `$.valHooks.input.set`
                if (event === true) {
                    return $input[0].value = value;
                }
                $input.focus();
            } else {
                input.value = '';
                $input.removeClass('placeholder');
                input == document.activeElement && input.select();
            }
        }
    }

    function setPlaceholder() {
        var $replacement,
                input = this,
                $input = $(input),
                $origInput = $input,
                id = this.id;
        if (input.value == '') {
            if (input.type == 'password') {
                if (!$input.data('placeholder-textinput')) {
                    try {
                        $replacement = $input.clone().attr({'type': 'text'});
                    } catch (e) {
                        $replacement = $('<input>').attr($.extend(args(this), {'type': 'text'}));
                    }
                    $replacement
                            .removeAttr('name')
                            .data({
                                'placeholder-password': true,
                                'placeholder-id': id
                            })
                            .bind('focus.placeholder', clearPlaceholder);
                    $input
                            .data({
                                'placeholder-textinput': $replacement,
                                'placeholder-id': id
                            })
                            .before($replacement);
                }
                $input = $input.removeAttr('id').hide().prev().attr('id', id).show();
                // Note: `$input[0] != input` now!
            }
            $input.addClass('placeholder');
            $input[0].value = $input.attr('placeholder');
        } else {
            $input.removeClass('placeholder');
        }
    }

}(this, document, jQuery));

function del_friend(fuser_id) {
    if (window.confirm('您确定删除该好友吗？')) {
        var url = "/mp/friend/del_friend";
        $.get(url, {fuser_id: fuser_id}, function (data) {
            if (data.sta == 0) {
                alert_warming_msg(data.msg);
            } else {
                window.location.reload();
            }
        }, 'json');
    }
}
