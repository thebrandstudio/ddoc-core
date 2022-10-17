import $ from 'jquery';

$(function(){
    // hide other selection options when it 404 page 
    let currentValStatic = $('#drdt_template_type').val();
    if(currentValStatic == '404'){
        $('#drdt_template_type').parents('.section-block').siblings('.section-block').hide();
    }
    $(document).on('change', '#drdt_template_type', function(){
        let currentVal = $(this).val();
        if(currentVal == '404') {
            $(this).parents('.section-block').siblings('.section-block').hide()
        }else{
            $(this).parents('.section-block').siblings('.section-block').show()
        }
    });

    //  save 404 page meta with ajax 
    $(document).on('change', '.is-active-404', function(){
  
        let ifon = $(this).val();
         var data = {
          'action': 'ddoc_404_page',
          'post_id': $(this).data('post-id'),
          'status' : ifon
        };
    
          jQuery.post(four_zeor_editor.ajaxurl, data, function(response) {
             $('.droit-error').html(response);
             $('.droit-error').fadeIn('slow').addClass('show');
            console.log('Got this from the server: ' + response);
          });
        
          setTimeout(close_post_box, 3000);
          function close_post_box() {
            if($('.droit-error.show').length > 0 ){
              $('.droit-error').fadeOut('slow');
            }
          }
      });

});