import $ from 'jquery';
$(function(){
    $(document).on('click', '.ddoc-font-size-decrease', function(){
      let getTarget =   $(this).parents('.row').find('.type-docs .entry-content, .type-docs .entry-header');
      if(getTarget.length > 0 ) {
          let element = getTarget.find('*');
          if(element.length> 0 ) {
            element.each(function(){
                let cuurent_font_size = Number($(this).css('font-size').match(/\d+/)[0]);
                
                $(this).css('font-size', (cuurent_font_size - 1) + 'px');
            });
          }
      }
    });
    $(document).on('click', '.ddoc-font-size-increase', function(){
        let getTarget =   $(this).parents('.row').find('.type-docs .entry-content, .type-docs .entry-header');
        if(getTarget.length > 0 ) {
            let element = getTarget.find('*');
            if(element.length> 0 ) {
              element.each(function(){
                  let cuurent_font_size = Number($(this).css('font-size').match(/\d+/)[0]);
                  $(this).css('font-size', (cuurent_font_size + 1) + 'px');
              });
            }
        }
      });
      $(document).on('click', '.ddoc-font-size-reset', function(){
        let getTarget =   $(this).parents('.row').find('.type-docs .entry-content, .type-docs .entry-header');
        if(getTarget.length > 0 ) {
            let element = getTarget.find('*');
            if(element.length> 0 ) {
              element.each(function(){
                $(this).css('font-size', '');
              });
            }
        }
      });
      $(document).on('click', '.wp-block-ddoc-block-zoomtext button', function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
      });
      $(document).on('click', '.print-ddoc', function(e){
          e.preventDefault();        
        var printContents = $('.type-docs .entry-content').html();
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
      });
});
