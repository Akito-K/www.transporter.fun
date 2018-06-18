(function($){

//aタグ スムーススクロール
$(function(){
  $('.scroll').click(function(){
	var headerHeight = $('.header-wrap').outerHeight();
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top - headerHeight;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});

//
$(function(){
		console.log(1);
	$('.btn_select .label').on('click',function(){
		console.log(2);
		var btn = $(this);
		var childHeight = btn.parents('.btn_select').find('.child_wrap .child').outerHeight();
		if(btn.hasClass('active')){
			btn.removeClass('active');
			btn.parents('.btn_select').find('.child_wrap').removeClass('open').height(0);
		   }else{
			btn.addClass('active');
			btn.parents('.btn_select').find('.child_wrap').addClass('open').height(childHeight);
		   }
		return false;
	});
	
	//SP menu
	$('.menu_open').on('click','a',function(){
		$('header .header_wrap').addClass('open');
		return false;
	});
	$('.menu_close').on('click','a',function(){
		$('header .header_wrap').removeClass('open');
		return false;
	});
	
});

})(jQuery);
