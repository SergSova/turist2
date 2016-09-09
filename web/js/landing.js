$(document).ready(function(){
    $('.parallax').parallax();
});
$(window).on('scroll', function(){
	if($('body').scrollTop() > 100){
		$('nav').removeClass('transparent');
	}else{
		$('nav').addClass('transparent');
	}
});
