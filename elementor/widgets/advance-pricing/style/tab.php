<div class="dl_pricing_plan_switcher">
    <div class="dl_switcher_control">
        <div class="dl_switcher_control_inner">
        <?php
            $checking = false;
            if( !empty($_dl_pro_adpricing_switch) ){
                foreach($_dl_pro_adpricing_switch as $v){
                    $default = isset($v['_dl_field_default']) ? $v['_dl_field_default'] : '';
                    $title = isset($v['_dl_field_title']) ? $v['_dl_field_title'] : '';
                
                    $_dlContent = isset($v['_dl_pro_adpricing_content_id']) ? $v['_dl_pro_adpricing_content_id'] : '';

                    $uniqueId = 0;
                    $widgetsid = $id;
                    $repeaterid = esc_attr($v['_id']);
                    
                    if( !empty($_dlContent) ){
                        $exp = explode('___', $_dlContent);
                        if( isset($exp[1])){
                            $uniqueId = !empty($exp[0]) ? $exp[0] : $uniqueId;
                        }
                    }

                    $checking = ($default == 'yes' && !$checking) ? true : false;
                    ?>
                
                    <div class="dl_switcher_control-item <?php echo ($default == 'yes' && $checking ) ? 'on-select' : '';?>" data-target="<?php echo esc_attr($widgetsid.$repeaterid);?>">
                        <label><?php esc_html_e($title, 'droit-addons-pro');?></label>
                    </div>
                    <?php
                }
            }
        ?>
        </div>
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


