$("document").ready(function(){
	$(".side-menu-toggle").next().show().parent().addClass("active");

	//sidebar menu toggling functionality
	$(".side-menu-toggle").bind("click",function(){
		var actionSrc = $(this).parent();
		var menu = $(this).parent().find(".sub-side-menu");
		if($(menu).is(":visible")){
			$(menu).slideUp();
			$(actionSrc).removeClass("active");
		}
		else if(!$(menu).is(":visible")){
			$(menu).slideDown();
			$(actionSrc).addClass("active");
		}
	});

	//make all images responsive
	$("img").addClass("img-responsive");

	//go to top
	var offset = 200;
	var time = 300;
	$(window).scroll(function(){
		if($(this).scrollTop() > offset){
			$('#top').fadeIn(time);
		}
		else{
			$('#top').fadeOut(time);
		}
	});

	$('#top').click(function(event){
		event.preventDefault();
		$('html, body').animate({scrollTop: 0}, time);
		return false;
	})
});
$(document).ready(function(){
	
});

