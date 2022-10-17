"use strict";
var clipboard = new ClipboardJS('.dtdr-clipboard');
clipboard.on('success', function(e) {
    //e.clearSelection();
});

(function ($) {
    var $ = jQuery;
    // start tab control function here
    var p = document.querySelectorAll(".tab-menu-link"),
        B = document.querySelectorAll(".tab-bar-content");
    function tabz(b) {
        p.forEach(function (c) {
            c.addEventListener("click", tabcontrol);
        });
    }
    function tabcontrol(b) {
        b = b.currentTarget;
        let c = b.dataset.content;
        B.forEach(function (d) {
            d.classList.remove("active");
        });
        p.forEach(function (d) {
            d.classList.remove("active");
        });
        document.querySelector("#" + c).classList.add("active");
        b.classList.add("active");
    }
    $(window).on("load", function () {
        tabz();
    });
    // end tab control function here
    
    // save setting data start
    $('form.dtdr-dark-form').on('submit', function(ev){
        // form event close when submit this form
        ev.preventDefault();

        let $this = $(this);

        // get button icon class
        let $btn = $this.find('button.setting-submit > i');
       
        // load the ajax submit when click the submit button
        $.ajax({
            url: dtdr.ajax_url+'?action=dtsave_settings',
            type: "post",
            data: {
               form_data: $this.serialize(),
               message: 'save settings data'
            },
            beforeSend: function() {
                $btn.attr('class', 'fa fa-spinner fa-spin');
                $this.addClass('drdt-loading');
            },
            success: function(res){
               // consoole.log(res);
            },
            error: function(res){
                alert('Something is wrong!!');
            },
            complete: function() {
                $btn.removeAttr('class');
                $this.removeClass('drdt-loading');
            },
        });

    });
    // save the form setting data end

})(jQuery);
