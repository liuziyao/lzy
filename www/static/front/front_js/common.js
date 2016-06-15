var common={
	popShow:function(id){
		$(".pop").hide();
		$(".grey_bg").show();
		$("#"+id).show();
	},
	popHide:function(id){
		$(".grey_bg").hide();
		$("#"+id).hide();
		
	}

	
}

$(".btn-type-2 ul li").click(function(){
	$(this).parents(".btn-type-2").find(".select_text").text($(this).text());
})

$(".query-list .more").click(function(){
	if($(this).siblings(".query-tag").hasClass('height_auto')){
		$(this).text('更多');
	}else{
		$(this).text('收起');
		
	}
	$(this).siblings(".query-tag").toggleClass("height_auto");
	$(this).toggleClass("more-up");
})

$(".query-list .more-change").click(function(){
	if($(this).hasClass("blue_btn_min")){
		$(this).siblings(".query-tag").find(".check_box").hide();
		$(this).siblings(".query-tag").removeClass("height_auto");
		$(this).removeClass("blue_btn_min");
		$(this).siblings(".query-tag").find(".q_box").show();
		
	}else{
		$(this).siblings(".query-tag").find(".check_box").show();
		$(this).siblings(".query-tag").addClass("height_auto");
		$(this).addClass("blue_btn_min");
		$(this).siblings(".query-tag").find(".q_box").show();
	}
	
})

$(".q_cancel").click(function(){
	$(this).parents("li").find(".check_box").toggle();
	$(this).parents("li").find(".query-tag").toggleClass("height_auto");
	$(this).parents("li").find(".more-change").toggleClass("blue_btn_min");
	$(this).parents("li").find(".q_box").toggle();
})

$(".more_up").click(function(){
	
	if($('.more_detail').hasClass('height_auto')){
		$(this).text('展开全部 》');
	}else{
		$(this).text('收起 》');
		
	}
	$('.more_detail').toggleClass('height_auto');


	
})

