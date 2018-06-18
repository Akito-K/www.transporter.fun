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
	$('.btn_select .label').on('click',function(){
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

	//メニュー
	$(".special_menu_wrap .open_menu_btn a").on("click",function(e) {
		$(".special_menu_wrap").toggleClass("open");
		$(".special_menu_wrap ul.menu").slideToggle();
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
	
	//TOPスライダー
	$('.slider').slick({
		dots: false,
		autoplay: true,
		prevArrow: '<div class="visual_arrow visual_arrow_prev"></div>',
		nextArrow: '<div class="visual_arrow visual_arrow_next"></div>',
	});
	
});

})(jQuery);
