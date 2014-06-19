(function($) {

    $(function(){

      if ($('.swiper-container').size()>0){
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
      }

	  
      $('.sub-menu').addClass('is-transparent');

      $(document).on('mouseenter', '.level-0, .m-postlist .box', function(){
          $(this).find('.sub-menu, .post-infos').removeClass('is-fading-out');
          $(this).find('.sub-menu, .post-infos').addClass('is-fading-in');
      });

      $(document).on('mouseleave', '.level-0, .m-postlist .box', function(){
          $(this).find('.sub-menu, .post-infos').removeClass('is-fading-in');
          $(this).find('.sub-menu, .post-infos').addClass('is-fading-out');
      });
	  
	  
	  $('.post-img, .sliderthumb, .post-banner').each(function() {
    		var Colors = [ 'pink', 'yellow', 'green', 'grey' ];
    		var Class = Colors[Math.floor(Math.random()*Colors.length)];
		  
    	  	$(this).addClass(Class);
	  });
	  
      if ($('.attachment-singlepage-banner').size()>0) {
		  $('.post-banner').removeClass('is-hidden');
      }


      if ($('.twitter-share-button').size()>0) {
          $('.twitter-share-button').click(function(event) {
          var width  = 575,
              height = 400,
              left   = ($(window).width()  - width)  / 2,
              top    = ($(window).height() - height) / 2,
              url    = this.href,
              opts   = 'status=1' +
                       ',width='  + width  +
                       ',height=' + height +
                       ',top='    + top    +
                       ',left='   + left;
          
          window.open(url, 'twitter', opts);
       
          return false;
        });
      }

	  
	  $(window).scroll(function(){
		  	if($(window).scrollTop()>200){
				$('.m-backtop').removeClass('is-hidden');
		    }
	  		else if($(window).scrollTop()<200){
				$('.m-backtop').addClass('is-hidden');
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
