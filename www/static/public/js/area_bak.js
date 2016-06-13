(function($) {
    $.fn.area = function(options) {
        var settings = $.extend({
            'init_areacode': '101120103'
        }, options);
        var html = "";
        var obj = $(this);
        $.getScript('/static/public/js/area_json.js',function(data){
            var area_json = getJsonArea();
            var init_areacode = settings.init_areacode;
            var init_areaname = settings.init_areaname;
            if(settings.areacode != undefined){ 
                var areacode_length = settings.areacode.length;
                var region_area_code = "";
                var region_area_name = "";
                html += "<select onchange='select_area(this)'><option value=''>--请选择--</option>";
                $.each(area_json[settings.areacode.substr(0,9)],function(k,v){
                    if(v['area_code'] == settings.areacode.substr(0,12)){
                        html += "<option selected='selected' value='"+v['area_code']+"' data-full-name='"+v['full_name']+"'>"+v['area_name']+"</option>";
                        region_area_code = v['area_code'];
                        region_area_name = v['full_name'];
                    }else{
                        html += "<option value='"+v['area_code']+"' data-full-name='"+v['full_name']+"'>"+v['area_name']+"</option>";
                    }
                });
                html += "</select>";
                if(settings.areacode.length == 15){
                    html += "<select onchange='select_area(this)'><option value=''>--请选择--</option>";
                    $.each(area_json[settings.areacode.substr(0,12)],function(k,v){
                        if(v['area_code'] == settings.areacode.substr(0,15)){
                            region_area_code = v['area_code'];
                            region_area_name = v['full_name'];
                            html += "<option selected='selected' value='"+v['area_code']+"' data-full-name='"+v['full_name']+"'>"+v['area_name']+"</option>";
                        }else{
                            html += "<option value='"+v['area_code']+"' data-full-name='"+v['full_name']+"'>"+v['area_name']+"</option>";
                        }
                    });
                    html += "</select>";
                }
                html += "<input type='hidden' name='region_area_code' value='"+region_area_code+"' />";
                html += "<input type='hidden' name='region_area_name' value='"+region_area_name+"' />";
            }else{
                html += "<input type='hidden' name='region_area_code' value='' />";
                html += "<input type='hidden' name='region_area_name' value='' />";
                html += "<select onchange='select_area(this)'><option value=''>--请选择--</option>";
                $.each(area_json[init_areacode],function(k,v){
                    html += "<option value='"+v['area_code']+"' data-full-name='"+v['full_name']+"'>"+v['area_name']+"</option>";
                }); 
            }
            html += "</select>";
            obj.html(html);
        });
    }
})(jQuery);
function select_area(obj){
    $("input[name='region_area_name']").val($(obj).find("option:selected").attr("data-full-name"));
    $("input[name='region_area_code']").val($(obj).val());
    $(obj).nextAll('select').remove();
    if($(obj).find("option:selected").html() == '--请选择--'){
        return false;
    }
    $.getScript('/static/public/js/area_json.js',function(data){
        var area_json = getJsonArea();
        //$("input[name='form_area_code']").val()
        var area_code = $(obj).val();
        if(area_code == 0){
            $(obj).nextAll().remove();
        }else{
            if(area_json[area_code]){
                var html = "";
                html += "<select onchange='select_area(this)'><option value='"+area_code+"'>--请选择--</option>";
                $.each(area_json[area_code],function(k,v){
                    html += "<option value='"+v['area_code']+"' data-full-name='"+v['full_name']+"'>"+v['area_name']+"</option>";
                }); 
                html += "</select>";
                $(obj).after(html);
            }
        }
    });
}

function areacode_len(area_code){
    var len = 0;
   // for(var i=0;)
}


