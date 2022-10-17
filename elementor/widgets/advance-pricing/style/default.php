<div class="dl_pricing_plan_switcher">
    <div class="dl_switcher_control">
        <?php 
        $before_title = isset($_dl_pro_adpricing_switch[0]['_dl_field_title']) ? $_dl_pro_adpricing_switch[0]['_dl_field_title'] : '';
        $after_title = isset($_dl_pro_adpricing_switch[1]['_dl_field_title']) ? $_dl_pro_adpricing_switch[1]['_dl_field_title'] : '';
        ?>
        <span class="dl_toggler_label dl-before-title"><?php esc_html_e($before_title, 'droit-addons-pro');?></span>
        <div class="dl_toggle">
            <div class="dl_switch"></div>
        </div>
        <span class="dl_toggler_label  dl-after-title"><?php esc_html_e($after_title, 'droit-addons-pro');?></span>
    </div>
    <div class="dl_switcher_content">
    <?php
        $checking = false;
        if( !empty($_dl_pro_adpricing_switch) ){
            foreach($_dl_pro_adpricing_switch as $k){
                $default = isset($k['_dl_field_default']) ? $k['_dl_field_default'] : '';
                
                $_dlContent = isset($k['_dl_pro_adpricing_content_id']) ? $k['_dl_pro_adpricing_content_id'] : '';

                $uniqueId = 0;
                $widgetsid = $id;
                $repeaterid = esc_attr($k['_id']);
                
                if( !empty($_dlContent) ){
                    $exp = explode('___', $_dlContent);
                    if( isset($exp[1])){
                        $uniqueId = !empty($exp[0]) ? $exp[0] : $uniqueId;
                    }
                }

                $checking = ($default == 'yes' && !$checking) ? true : false;
                ?>
            
                <div class="dl_switcher_content-item <?php echo ($default == 'yes' && $checking ) ? 'on-active' : '';?> dl-popup-editor" data-toggle="<?php echo esc_attr($widgetsid.$repeaterid);?>">
                    <?php echo \DROIT_ELEMENTOR_PRO\Dl_Editor::instance()->render($uniqueId, $widgetsid, $repeaterid);?> 
                </div>
                <?php
            }
        }
    ?>
    </div>
</div>


