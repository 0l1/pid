(function($) {

    $(function(){

      var mySwiper = $('.swiper-container').swiper({
        //Your options here:
        mode:'horizontal',
        loop: true,
        autoplay: 3000,
        speed: 3000,
		pagination: '.pagination',
		paginationClickable: true
        //etc..
      });

	  
      $('.sub-menu').addClass('is-transparent');

      $(document).on('mouseenter', '.level-0, .m-postlist .box', function(){
          $(this).find('.sub-menu, .post-infos').removeClass('is-fading-out');
          $(this).find('.sub-menu, .post-infos').addClass('is-fading-in');
      });

      $(document).on('mouseleave', '.level-0, .m-postlist .box', function(){
          $(this).find('.sub-menu, .post-infos').removeClass('is-fading-in');
          $(this).find('.sub-menu, .post-infos').addClass('is-fading-out');
      });
	  
	  
	  $('.m-postlist img, .m-slider img, .attachment-singlepage-banner').each(function() {
    		var Colors = [ 'pink', 'yellow', 'green', 'grey' ];
    		var Class = Colors[Math.floor(Math.random()*Colors.length)];
		  
    	  	$(this).addClass(Class);
	  });

	  
	  $(window).scroll(function(){
		  	if($(window).scrollTop()>200){
				$('.m-backtop').removeClass('hiding');
		    }
	  		else if($(window).scrollTop()<200){
				$('.m-backtop').addClass('hiding');
			}
	  });
	  
      $(document).on('click', '.m-backtop', function(event){
          event.preventDefault();
		  $('html,body').animate({
		      scrollTop: 0
		  }, 1000);
		  return false;
      });
	  
    })

})(jQuery);
