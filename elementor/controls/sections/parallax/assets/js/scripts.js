!(function ($, ele) {
    "use strict";
    var $parallax = {
        init: function () {
            ele.hooks.addAction("frontend/element_ready/section", $parallax.elementorSection);
            
             var wow = new WOW({
                animateClass: 'animated',
                offset: 100,
                mobile: false,
                duration: 1000,
            });
            wow.init();
        },
        elementorSection: function (e) {
            Boolean(ele.isEditMode());
            new $renderParalax(e).init();
        },
    };

    var $renderParalax = function( e ){
        var $this = this;
        var $id = e.data('id');
        var $data = e.data('dl_parallax');
        var $move = e.data('dl_move');

        var $render = document.querySelector('#dl_parallax_ele-' + $id);
        if( !e.data('dl_parallax') ){
            if($render){
                $data = JSON.parse($render.getAttribute('data-dl_parallax'));
                $move = JSON.parse($render.getAttribute('data-dl_move'));
            }
        }
        if(!$render){
            e.prepend('<div id="dl_parallax_ele-'+$id+'" class="dl_parallax_ele-wrapper"></div>');
            $render = document.querySelector('#dl_parallax_ele-' + $id);
        }
        
        $this.init = function(){
            if( Array.isArray($data) && $render){
                
                $data.forEach(function($v, $k){
                    
                    var $idRep = $v._id;
                    var item_source = $v.item_source;

                    var $pDiv  = document.createElement('div');
                    $pDiv.setAttribute('class', 'dl_parallax_element elementor-repeater-item-'+$idRep);
                    $pDiv.setAttribute('style', 'position: absolute;');

                    if($v.dl_hide_tablet == "hidden-tablet"){
                        $pDiv.classList.add('dl-hidden-tablet');
                        var tablet = window.matchMedia("(max-width: 1024px) and (min-width: 768px)");
                        $this.tablateMedia(tablet);
                        tablet.addListener($this.tablateMedia);
                    }
                    if($v.dl_hide_mobile == "hidden-phone"){
                        $pDiv.classList.add('dl-hidden-mobile');
                        var mobile = window.matchMedia("(max-width: 767px)");
                        $this.mobileMedia(mobile);
                        mobile.addListener($this.mobileMedia);
                    }

                    if($v.dl_wow_enable){
                        $pDiv.classList.add('wow');
                        if($v.dl_animation !== null){
                            $pDiv.classList.add($v.dl_animation);
                        }
                        if( $v.dl_animation_delay !== ''){
                            $pDiv.setAttribute('data-wow-delay', $v.dl_animation_delay+'s');
                        }
                        if( $v.dl_animation_duration !== ''){
                            $pDiv.setAttribute('data-wow-duration', $v.dl_animation_duration+'s');
                        }
                    }

                    var $layer = document.createElement('div');
                    $layer.setAttribute('class', 'layer');
                    $layer.classList.add('layer'+$k);

                    if($v.dl_item_depth){
                        $layer.setAttribute('data-depth', $v.dl_item_depth);
                    }
                    
                  
                    var $settings = {};
                    if($v.dl_parallax_data_popup){

                        if($v.dl_translate_x_axix !== ''){
                            $settings.x = $v.dl_translate_x_axix;
                        }
                        if($v.dl_translate_y_axix !== ''){
                            $settings.y = $v.dl_translate_y_axix;
                        }
    
                        if($v.dl_rotate_x_axix !== ''){
                            $settings.rotateX = $v.dl_rotate_x_axix;
                        }
                        if($v.dl_rotate_y_axix !== ''){
                            $settings.rotateY = $v.dl_rotate_y_axix;
                        }
                        if($v.dl_rotate_z_axix !== ''){
                            $settings.rotateZ = $v.dl_rotate_z_axix;
                        }
    
                        if($v.dl_scale_x_axix !== ''){
                            $settings.scaleX = $v.dl_scale_x_axix;
                        }
                        if($v.dl_scale_y_axix !== ''){
                            $settings.scaleX = $v.dl_scale_y_axix;
                        }
    
                        if($v.dl_scale_x_axix !== ''){
                            $settings.scaleX = $v.dl_scale_x_axix;
                        }
                        if($v.dl_scale_y_axix !== ''){
                            $settings.scaleX = $v.dl_scale_y_axix;
                        }
                        if($v.dl_scale_z_axix !== ''){
                            $settings.scaleZ = $v.dl_scale_z_axix;
                        }
                    }
                    
                    if(item_source == 'text'){

                    }else if(item_source == 'icon'){

                    } else{
                        var $eleRen = document.createElement('img');
                        $eleRen.setAttribute('src', $v.image.url);
                        $eleRen.setAttribute('alt', '');
                        //new Parallax($eleRen); 
                    }

                    
                   
                    $eleRen.setAttribute('data-parallax', JSON.stringify($settings));

                    $layer.appendChild($eleRen);

                    $pDiv.appendChild($layer);

                    $render.appendChild($pDiv);
                    
                });
                
               //console.log($move.dl_parallaxmove_enable);

                if($move.dl_parallaxmove_enable == 'yes'){
                    e.parallax({
                        scalarX: $move.dl_scalar_x_axix,
                        scalarY: $move.dl_scalar_y_axix,
                    });
                }
            }
        }

        $this.tablateMedia = function( $x){
            if($x.matches){
                document.querySelectorAll('.dl-hidden-tablet').forEach(function($v){
                    $v.style.display = "none";
                });
            } else {
                document.querySelectorAll('.dl-hidden-tablet').forEach(function($v){
                    $v.style.display = "block";
                });
            }
        }

        $this.mobileMedia = function( $x){
            if($x.matches){
                document.querySelectorAll('.dl-hidden-mobile').forEach(function($v){
                    $v.style.display = "none";
                });
            } else {
                document.querySelectorAll('.dl-hidden-mobile').forEach(function($v){
                    $v.style.display = "block";
                });
            }
        }
    }

    
    $(window).on("elementor/frontend/init", $parallax.init);
    
})(jQuery, window.elementorFrontend);
