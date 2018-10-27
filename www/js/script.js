$(document).ready(function() { 	

	//Модальное окошко формы
    $(".modal-form").fancybox({
      autoDimensions : true,
      fitToView : false,
      autoSize  : true,
      closeClick  : false,
      openEffect  : 'none',
      closeEffect : 'none',
      padding : '0',
      scrolling : 'no',
      maxWidth : '100%'
    });

    //Фото-карусель
    $("#photo-carousel").owlCarousel({ 
      
      navText:['',''],
      pagination: true,
      dots: true,    
      loop : true,    
      center : false,

      items : 1,
      navigationText : ["",""],
      responsive : {
        0 : {
            nav:false
        },
        500 : {
           nav:false
        },
        992 : {
            nav:true
        }
      }
  	});
    //Модальное окошко фото
    $(".photo-modal").fancybox({
      autoDimensions : false,
      fitToView : false,
      autoSize  : false,
      closeClick  : false,
      openEffect  : 'none',
      closeEffect : 'none',
      padding : '0',
      scrolling : 'no',
      maxWidth : '100%',
      wrapCSS : 'fansybox-photo-modal'
    });


    /*$("#centers-carousel").owlCarousel({ 
      nav:true,
      navText:['',''],
      pagination: true,
      dots: false,    
      loop : true,    
      center : false,

      items : 1,
      navigationText : ["",""]
    });*/

    /*Если моб. версия, то включаем карусель в блоке ЦЕНТРЫ*/
    $(function() {
        var owl = $('#centers-carousel.owl-carousel'),
            owlOptions = {
                nav:false,
                navText:['',''],
                pagination: true,
                dots: true,    
                loop : false,    
                center : false,

                items : 1,
                navigationText : ["",""]
            };

        if ( $(window).width() < 854 ) {
            var owlActive = owl.owlCarousel(owlOptions);
        } else {
            owl.addClass('off');
        }

        $(window).resize(function() {
            if ( $(window).width() < 854 ) {
                if ( $('#centers-carousel.owl-carousel').hasClass('off') ) {
                    var owlActive = owl.owlCarousel(owlOptions);
                    owl.removeClass('off');
                }
            } else {
                if ( !$('#centers-carousel.owl-carousel').hasClass('off') ) {
                    owl.addClass('off').trigger('destroy.owl.carousel');
                    owl.find('.owl-stage-outer').children(':eq(0)').unwrap();
                }
            }
        });
    });

    /*Бургер*/
  $(document).ready(function() {     
      $('#burger').on('click', function(e){
          e.preventDefault();     
          $('.burger').toggleClass('burger--open');
          $('.menu').toggleClass('menu--open');     

          $('.main-info__addresses').toggleClass('closeblock'); 
          $('.main-info__btns').toggleClass('closeblock'); 
          $('.main-info__contact').toggleClass('closeblock'); 
      });
  });

	
   
});
