$(function() {
    /**
     * 全选反选
     */
    $('#checkAll').click(function() {
        if ($(this).attr('checked')) {
            $('.fortr input[type="checkbox"]').each(function() {
                $(this).attr('checked', 'checked');
            });
        } else {
            $('.fortr input[type="checkbox"]').each(function() {
                $(this).removeAttr('checked');
            });
        }

    });

    /**
     * 通过选择城市，选出商圈和outlets 的ajax
     */
    $('#city').change(function() {
        $.post(cityURL, {'Area_ID': $(this).val()}, function(data) {
            if (data[0] != null) {
                //$('#Business_circle').html("<option value='0'>--请选择商圈--</option>");
                var Business_circle = "";
                if (data[0].length > 0) {
                    for (var i = 0; i < data[0].length; i++) {
                        Business_circle += "<option value='" + data[0][i]['BC_ID'] + "'>" + data[0][i]['BC_Name'] + "</option>";
                    }
                }
                $('#Business_circle').html("<option value='0'>--请选择商圈--</option>" + Business_circle);
            } else {
                $('#Business_circle').html("<option value='0'>--请选择商圈--</option>");
            }
            if (data[1] != null) {
                //$('#Outlets').html("<option value='0'>--请选择Outlets--</option>");
                var Outlets = "";
                if (data[1].length > 0) {
                    for (var i = 0; i < data[1].length; i++) {
                        Outlets += "<option value='" + data[1][i]['Outlets_ID'] + "'>" + data[1][i]['Build_Name'] + "</option>";
                    }
                }
                $('#Outlets').html("<option value='0'>--请选择Outlets--</option>" + Outlets);
            } else {
                $('#Outlets').html("<option value='0'>--请选择Outlets--</option>");
            }
        }, 'json');
    });


});
/**
 * 全部删除
 */
function delall() {
    if (!confirm('确定要删除？')) {
        return;
    }
    var my_id = '';
    $(".fortr :checked").each(function() {
        my_id += $(this).attr('myid') + ',';
    });
    $('#myids').val(my_id);
    $('#form1').submit();
}

$(function() {
    /**
     * 主要品牌多选
     */
    $('#searchcarname').live('click', function() {
        var car_name = $('#search_car_name').val();
        var posturl = car_url;
        var checked_id = $('#car_type_checkboxhidden input').serializeArray();
        $.post(posturl, {car_name: car_name, checked_id: checked_id}, function(data) {
            $('.car_type').slideDown();
            $('#car_type_checkbox').html(data.message);
        }, 'json');
    });
    $('#car_type_checkbox input').live('click', function() {
        var ischecked = $(this).is(':checked'); //true为选中，false为不选中
        var id = $(this).val();
        var car_name = $('#label_car_type_' + id).html();
        var hiddenInput = "<input type='hidden' name='car_type_id[]' value='" + id + "' />";
        if (ischecked) {
            $('#car_type_checkboxhidden').append(hiddenInput);
            var car_type_text = "<span id='car_type_text_" + id + "' style='padding:5px'>" + car_name + "</span>";
            $('#car_type').append(car_type_text);
        } else {
            $('#car_type_checkboxhidden input[value="' + id + '"]').remove();
            $('#car_type #car_type_text_' + id).remove();
        }
    });
    //主要品牌多选 end
    $('.close').click(function() {
        $(this).closest('div').slideUp();
    });
    
});