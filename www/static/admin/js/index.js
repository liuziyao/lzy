function resize_window(){
	$("#left").height($(window).height()-70);
	$("#right").height($(window).height()-100).width($(window).width()-201);
}
$(function(){
	resize_window();
	$(window).resize(function(){
		resize_window();
	})
})

$(function(){
	$('#left dt').click(function(){
		$(this).parents('dl').children('dd').slideToggle();
	});
});
