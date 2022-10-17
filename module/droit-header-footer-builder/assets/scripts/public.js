(function ($) {
    "use strict";

    /*Offcanvas menu wrap*/
    $(window).bind("resize", function () {
        if ($(this).width() <= 1024) {
            $('.drdt-nav-menu__layout-horizontal').addClass('drbt_menu_offcanvas_wrap')
        } else {
            $('.drdt-nav-menu__layout-horizontal').removeClass('drbt_menu_offcanvas_wrap');
            $('.drdt-nav-menu__layout-horizontal').removeClass("drbt_menu_active");
        }
    }).trigger('resize');
    

    // header sticky add class js
    $(window).on('scroll', function () {
        var window_top = $(window).scrollTop() + 0;
        if (window_top > 0) {
            $('.drdt_is_sticky_header').addClass('drdt_menu_fixed');
        } else {
            $('.drdt_is_sticky_header').removeClass('drdt_menu_fixed');
        }
    });

    
    /*Back To Top -------------------------*/
    $(window).scroll(function(){
        if($(this).scrollTop()>100){
            $("#drdt_back_to_top").fadeIn();
        }else{
            $("#drdt_back_to_top").fadeOut();
        }
    });
    $("#drdt_back_to_top").click(function(){
        $("html, body").animate({scrollTop:0},1000)
    })

    // button event
    /*let $creativeMenu = document.querySelectorAll('.drdt-has-submenu');
    //console.log($creativeMenu);
    if( $creativeMenu ){
        for( let $i = 0; $i < $creativeMenu.length; $i++){
            let $self = $creativeMenu[$i];
            if( !$self ){
                continue;
            }
            
            $self.setAttribute('drdt-index', $i);

            let $get = document.querySelector('li[drdt-index="'+$i+'"]');
            if( !$get ){
                continue;
            }
            $get.addEventListener('click', function( $ev ){
                $ev.preventDefault();
                let $this = (this);
                $this.classList.toggle('activeMenu');
                //let $id = $this.getAttribute('id');
                //console.log($id);
            });
        }
    }
    */

    //mega menu js
    // if ($(window).width() < 991) {
    //     $('.drdt-has-submenu > ul.sub-menu').hide();
    //     $('.drdt-has-submenu-container').on('click', function (event) {
    //         event.preventDefault();
    //         $(this).parent(".drdt-has-submenu").children("ul.sub-menu").slideToggle("100");
    //     });
    // }
    $('.drdt-nav-menu-icon').on('click', function () {
        $('.drdt-nav-menu__layout-horizontal').addClass("drbt_menu_active");
        $('.offcanvus_menu_overlay').addClass("drbt_overlay_active");
    });
    $('.drdt-flyout-close, .offcanvus_menu_overlay').on('click', function () {
        $('.drdt-nav-menu__layout-horizontal').removeClass("drbt_menu_active");
        $('.offcanvus_menu_overlay').removeClass("drbt_overlay_active");
    });

    $('.drdt-has-submenu > .drdt-has-submenu-container').on('click', function () {
        // $('.drdt-has-submenu-container').removeClass("active_menu_icon");
        // if ($('.sub-menu').hasClass('active_menu')) {
        //     $(this).parent('.drdt-has-submenu').children('.drdt-has-submenu-container').addClass("active_menu_icon");
        // }
        $(this).parent().find('.sub-menu').first().slideToggle(300).addClass('active_menu');
        $(this).parent().siblings().find('.sub-menu').hide(300).removeClass('active_menu');   
        return false;
    });


    // Back to Top Button
    var back_btn = $('#back_to_top');
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            back_btn.addClass('show');
        } else {
            back_btn.removeClass('show');
        }
    });
    back_btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate(
            {
                scrollTop: 0,
            },
            '300'
        );
    });



    $('.drdt-search-btn').on('click', function () {
        $('body').addClass('open');
        setTimeout(function () {
            $('.drdt-search-input').focus();
        }, 500);
       // console.log(search);
        return false;

    });
    $('.drdt-close-icon').on('click', function () {
        $('body').removeClass('open');
        return false;
    });


}(jQuery));