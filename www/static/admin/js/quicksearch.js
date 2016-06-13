$(function() {
    $("#divselect").hover(function() {
        $("#divselectchilid").fadeIn();
    }, function() {
        $("#divselectchilid").fadeOut();
    });
    $("#divselectchilid div").click(function() {
        $(this).parents('#divselectchilid').fadeOut();
    });

    $('#divselectchilid div').click(function() {
        var attrid = $(this).attr('attrid');
        $.post(posturl, {item: attrid}, function(data) {
            var str = "";
            if (attrid == 'city') {
                str = "<select name='city_id'>";
                $.each(data.message,function(k,v){
                    str += "<option value='" + k + "'>" + v + "</option>";
                });
                str += "</select>";
            }
            if (attrid == 'bc') {
                str = "<select name='bc_id'>";
                $.each(data.message,function(k,v){
                    str += "<option value='" + k + "'>" + v + "</option>";
                });
                str += "</select>";
            }
            if (attrid == 'ol') {
                str = "<select name='outlets_id'>";
                $.each(data.message,function(k,v){
                    str += "<option value='" + k + "'>" + v + "</option>";
                });
                str += "</select>";
            }
            $('#myselected').html(str);
        }, 'json');
        $('#item').text($(this).text()).attr('attrid', $(this).attr('attrid'));
    });
})