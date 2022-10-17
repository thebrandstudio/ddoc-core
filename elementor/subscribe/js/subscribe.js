/**
* Name: Dl_Subscribe
* Desc: Droit Addons editor elementor popup
* Params: no params
* Return: @void
* version: 1.0.0
* Package: @droitedd
* Author: DroitThemes
* Developer: Hazi
*/
"use strict";

class Dl_Subscribe{
    constructor() {
        
    }
    subscribe(){
        //console.log(dl_subscribe);
        var $ = jQuery;
        // save setting data start
        $('form.dl_pro_subscribe_form_action').on('submit', function(ev){
            // form event close when submit this form
            ev.preventDefault();
            let $this = $(this);

            // get button icon class
            let $btn = $this.find('button.dl_cu_btn');
            let $message = $this.find('span.dl_subs_message');
            $message.removeClass('dl-success').removeClass('dl-error');
           
            let $classConfirm = this.querySelector('.confirm-submitform');
            if($classConfirm){
                if($classConfirm.checked == false){
                    $message.addClass('dl-error');
                    $message.html('Please select checkbox.');
                    $btn.removeAttr('disabled');
                    return;
                }
            }

            // load the ajax submit when click the submit button
            $.ajax({
                    url: dl_subscribe.ajax_url+'?action=dtsubscribe_add',
                    type: "post",
                    data: {
                    form_data: $this.serialize(),
                    form_settings: $this.data('settings'),
                },
                // before ajax action
                beforeSend: function() {
                    $btn.attr('disabled', 'disabled');
                },
                // success ajax 
                success: function(res){
                    if(res.success){
                        $message.addClass('dl-success');
                        $this.trigger("reset");
                    } else {
                        $message.addClass('dl-error');
                    }
                    $message.html(res.data);
                    $btn.removeAttr('disabled');
                },
                // error ajax page
                error: function(res){
                    $btn.removeAttr('disabled');
                },
                // ajax complate function 
                complete: function() {
                    $btn.removeAttr('disabled');
                },
            });
        });
    }
}

// call subscriber form action
new Dl_Subscribe().subscribe();