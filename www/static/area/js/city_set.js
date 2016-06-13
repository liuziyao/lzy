(function($) {
    $.fn.area = function(options) {
        var obj = $(this);
        var text_id = obj.attr('id') + '_text';
        if (!options.width) {
            options.width = 178;
        }
        if (!options.placeholder) {
            options.placeholder = "请选择地区";
        }
        if (!options.source) {
            options.source = "";
        }
        if (!options.class) {
            options.class = "";
        }
        $(this).html("<input data-source='" + options.source + "' class='area_code "+options.class+"' style='width:" + options.width + "px' type='text' id='" + text_id + "' placeholder = '" + options.placeholder + "' />");
        var selected_area_name = "";
        if (options.selected) {
            selected_area_name = setSelectedForm(options.selected);
            $("#" + text_id).val(selected_area_name);
        }
        var ths = document.getElementById(text_id);
        var code_id = ths.id + "_area_code";
        if (!$("#" + code_id).attr('id')) {
            $(ths).after("<input type='hidden' id='" + code_id + "' name='" + code_id + "' value='" + options.selected + "' />");
            $(ths).after("<input type='hidden' id='" + ths.id + "_area_name' name='" + ths.id + "_area_name' value='" + selected_area_name + "' />");
        }
        $("#" + text_id).click(function(e) {
            SelCity(this, e);
        });
    }
})(jQuery);

function SelCity(obj, e, selected) {
    var ths = obj;
    var code_id = ths.id + "_area_code";
    if (!$("#" + code_id).attr('id')) {
        $(ths).after("<input type='hidden' id='" + code_id + "' name='" + code_id + "' value='' />");
        $(ths).after("<input type='hidden' id='" + ths.id + "_area_name' name='" + ths.id + "_area_name' value='' />");
    }

    //var dal = '<div class="_citys"><span title="关闭" id="cColse" >×</span><ul id="_citycountry" class="_citys0"><li class="citySel">国家</li><li>省份</li><li>城市</li><li>区县</li></ul><div id="_citys0" class="_citys1"></div><div style="display:none" id="_citys1" class="_citys1"></div><div style="display:none" id="_citys2" class="_citys1"></div></div>';
    var dal = '<div class="_citys"><span id="clear">清空</span><span title="关闭" id="cColse" >确定</span><ul id="_citycountry" class="_citys0"><li class="citySel">国家</li><li>省份</li><li>城市</li><li>区县</li></ul><div id="_citys0" class="_citys1"></div><div style="display:none" id="_citys1" class="_citys1"></div><div style="display:none" id="_citys2" class="_citys1"></div><div style="display:none" id="_citys3" class="_citys1"></div></div>';
    Iput.show({id: ths, event: e, content: dal, width: "470"});

    $("#cColse").click(function() {
        var source = $(ths).parent().find('input.area_code').attr('data-source');
        if (source) {
            if($(ths).parent().find('input.area_code').val() == ''){
                $(ths).parent().find('input').val('');
            }
            $("#form-search").submit();
        }
        Iput.colse();
    });
    $("#clear").on('click', function() {
        $(ths).parent().find('input').val('');
        Iput.colse();
    });
    var tb_country = [];
    var co = country;
    for (var i = 0, len = co.length; i < len; i++) {
        tb_country.push('<a data-level="0" data-id="' + co[i]['id'] + '" data-name="' + co[i]['name'] + '">' + co[i]['name'] + '</a>');
    }
    $("#_citys0").append(tb_country.join(""));
    $("#_citys0 a").click(function() {
        var g = getProvince($(this));
        $("#_citys1 a").remove();
        $("#_citys1").append(g);
        $("._citys1").hide();
        $("._citys1:eq(1)").show();
        $("#_citys0 a,#_citys1 a,#_citys2 a").removeClass("AreaS");
        $(this).addClass("AreaS");
        var lev = $(this).data("name");
        if (lev == '中国') {
            lev = '';
        }
        ths.value = lev;
        $("#" + ths.id + "_area_code").val($(this).data("id"));
        $("#" + ths.id + "_area_name").val(lev);
        $("#_citys1 a").click(function() {
            var g = getCity($(this));
            $("#_citys1 a,#_citys2 a").removeClass("AreaS");
            $(this).addClass("AreaS");
            var lev = $(this).data("name");
            $("#" + ths.id + "_area_code").val($(this).data("id"));

            $("#_citys2 a").remove();
            $("#_citys2").append(g);
            $("._citys1").hide();
            $("._citys1:eq(2)").show();
            // var val = $("#" + ths.id + "_area_name").val() ? $("#" + ths.id + "_area_name").val() + "-" + lev : lev;
            var val = $("#" + ths.id + "_area_name").val() ? $("#" + ths.id + "_area_name").val() + lev : lev;
            $("#" + ths.id + "_area_name").val(val);
            ths.value = val;
            $("#_citys2 a").click(function() {
                $("#_citys1 a,#_citys2 a，#_citys3 a").removeClass("AreaS");
                $(this).addClass("AreaS");
                var lev = $(this).data("name");
                $("#" + ths.id + "_area_code").val($(this).data("id"));
                //var val = $("#" + ths.id + "_area_name").val() + "-" + lev;
                var val = $("#" + ths.id + "_area_name").val() + lev;
                $("#" + ths.id + "_area_name").val(val);
                var ar = getArea($(this));

                $("#_citys3 a").remove();
                $("#_citys3").append(ar);
                $("._citys1").hide();
                $("._citys1:eq(3)").show();
                ths.value = val;
                $("#_citys3 a").click(function() {
                    $("#_citys3 a").removeClass("AreaS");
                    $(this).addClass("AreaS");
                    var lev = $(this).data("name");
                    $("#" + ths.id + "_area_code").val($(this).data("id"));
                    //var val = $("#" + ths.id + "_area_name").val() + "-" + lev;
                    var val = $("#" + ths.id + "_area_name").val() + lev;
                    $("#" + ths.id + "_area_name").val(val);
                    ths.value = val;
                    var source = $(ths).parent().find('input.area_code').attr('data-source');
                    if (source) {
                        $("#form-search").submit();
                    }
                    Iput.colse();
                });
            });
        });
    });
    $("#_citys0 a:first").trigger('click');
    $("#_citycountry li").click(function() {
        $("#_citycountry li").removeClass("citySel");
        $(this).addClass("citySel");
        var s = $("#_citycountry li").index(this);
        $("._citys1").hide();
        $("._citys1:eq(" + s + ")").show();
    });
}
function getProvince(obj) {
    var c = obj.data('id');
    var e = province;
    var f = e[c];
    var g = '';
    for (var i = 0, plen = f.length; i < plen; i++) {
        g += '<a data-level="2" data-id="' + f[i]['id'] + '" data-name="' + f[i]['name'] + '" title="' + f[i]['name'] + '">' + f[i]['name'] + '</a>'
    }
    $("#_citycountry li").removeClass("citySel");
    $("#_citycountry li:eq(1)").addClass("citySel");
    return g;
}

function getCity(obj) {
    var c = obj.data('id').toString();
    var co = c.substr(0, 3);
    var e = province[co];
    var f;
    var g = '';
    for (var i = 0, plen = e.length; i < plen; i++) {
        if (e[i]['id'] == parseInt(c)) {
            f = e[i]['city'];
            break
        }
    }
    for (var j = 0, clen = f.length; j < clen; j++) {
        g += '<a data-level="1" data-id="' + f[j]['id'] + '" data-name="' + f[j]['name'] + '" title="' + f[j]['name'] + '">' + f[j]['name'] + '</a>'
    }
    $("#_citycountry li").removeClass("citySel");
    $("#_citycountry li:eq(2)").addClass("citySel");
    return g;
}
function getArea(obj) {
    var c = obj.data('id');
    var e = area;
    var f = [];
    var g = '';
    for (var i = 0, plen = e.length; i < plen; i++) {
        if (e[i]['pid'] == parseInt(c)) {
            f.push(e[i]);
        }
    }
    for (var j = 0, clen = f.length; j < clen; j++) {
        g += '<a data-level="1" data-id="' + f[j]['id'] + '" data-name="' + f[j]['name'] + '" title="' + f[j]['name'] + '">' + f[j]['name'] + '</a>'
    }

    $("#_citycountry li").removeClass("citySel");
    $("#_citycountry li:eq(3)").addClass("citySel");
    return g;
}

function setSelectedForm(selected) {
    //先取国家
    var selected_country = selected.toString().substr(0, 3);
    var selected_province = selected.toString().substr(0, 6);
    var selected_city = selected.toString().substr(0, 9);
    var selected_area = selected.toString().substr(0, 12);
    var selected_area_name = "";
    for (var i = 0; i < country.length; i++) {
        if (country[i]['id'] == selected_country) {
            if (country[i]['name'] != "中国") {
                selected_area_name += country[i]['name'];
            }
        }
    }
    //console.log(province)
    if (selected_province) {
        for (var i = 0; i < province[selected_country].length; i++) {
            if (province[selected_country][i]['id'] == selected_province) {
                selected_area_name += province[selected_country][i]['name'];
                if (selected_city) {
                    for (var j = 0; j < province[selected_country][i]['city'].length; j++) {
                        if (province[selected_country][i]['city'][j]['id'] == selected_city) {
                            selected_area_name += province[selected_country][i]['city'][j]['name'];
                        }
                    }
                }
            }
        }
    }

    if (selected_area) {
        for (var i = 0; i < area.length; i++) {
            if (area[i]['id'] == selected_area) {
                //selected_area_name += "-" + area[i]['name'];
                selected_area_name += area[i]['name'];
            }
        }
    }
    return selected_area_name;
}

