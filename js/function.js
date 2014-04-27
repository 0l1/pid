(function($) {

    $(function(){

      var mySwiper = $('.swiper-container').swiper({
        //Your options here:
        mode:'horizontal',
        loop: true,
        autoplay: 3000,
        speed: 3000,
        calculateHeight: true
        //etc..
      });

      $('.sub-menu').addClass('is-transparent');

      $(document).on('mouseenter', '.level-0', function(){
          $(this).find('.sub-menu').removeClass('is-fading-out');
          $(this).find('.sub-menu').addClass('is-fading-in');
      });

      $(document).on('mouseleave', '.level-0', function(){
          $(this).find('.sub-menu').removeClass('is-fading-in');
          $(this).find('.sub-menu').addClass('is-fading-out');
      });

    })

})(jQuery);
