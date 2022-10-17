<?php 
    $accordion_items_          = $this->get_pro_accordions_settings('_dl_pro_accordions_list_');

    $id_int = substr( $this->get_id_int(), 0, 4 );
    $this->add_render_attribute( 'accordion_pro_wrap', [
        'id' => 'accordion-'.$id_int,
        'class' => [
            'dl_container',
            'droit__pro_accordion',
            'style_01',
            '_skin_',
            'droit-accordion-wrap-pro' 
        ],
    ] );


    $accordion_pro_wrap =  $this->get_render_attribute_string( 'accordion_pro_wrap' );

    $migrated_icon = isset($this->get_pro_accordions_settings('__fa4_migrated')['_dl_pro_accordion_content_icon_']);
    $is_icon = empty($this->get_pro_accordions_settings('icon')) && \Elementor\Icons_Manager::is_migration_allowed();
    $has_icon = (!$is_icon || !empty($this->get_pro_accordions_settings('_dl_pro_accordion_content_icon_')['value']));

    if ( ! empty( $this->get_pro_accordions_settings('_dl_pro_accordion_icon_type') ) && 'none' != $this->get_pro_accordions_settings('_dl_pro_accordion_icon_type') ) {
        $migrated = isset( $this->get_pro_accordions_settings('__fa4_migrated')['_dl_pro_accordion_selected_icon'] );
    
        if (  !empty( $this->get_pro_accordions_settings('icon') ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
            
            $settings['icon'] = 'fab fa-facebook-f';
        }
    
    
        $is_new = empty( $_dl_pro_accordion_selected_icon ) && \Elementor\Icons_Manager::is_migration_allowed();
        $has_icon = ( ! $is_new || ! empty( $_dl_pro_accordion_selected_icon['value'] ) );
    }
        
 ?>


 
<div <?php echo $accordion_pro_wrap; ?>>
    <div class="dl_accordion">
        <?php
            $i = 1;
            foreach ( $accordion_items_ as $index => $item ) :
            
            $item_active_class = ($item['_dl_pro_accordions_show_as_default_'] == 'yes') ? 'is-active' : '';

            // editor
            $_dlContent = isset($item['_dl_pro_accordions_content_id']) ? $item['_dl_pro_accordions_content_id'] : '';
            $showIcon = isset($item['_dl_pro_accordions_after_icon']) ? $item['_dl_pro_accordions_after_icon'] : 'no';
            
            $uniqueId = 0;
            $widgetsid = $id;
            $repeaterid = esc_attr($item['_id']);
            
            if( !empty($_dlContent) ){
                $exp = explode('___', $_dlContent);
                if( isset($exp[1])){
                    $uniqueId = !empty($exp[0]) ? $exp[0] : $uniqueId;
                }
            }
            
        ?>
        <div class="dl_accordion_item <?php echo esc_attr($item_active_class);?>">
            <div class="d-flex">
                <?php if( $showIcon == 'yes'){?>
                <div class="dl_pro_accordion_icon_after">
                    <?php 
                        \Elementor\Icons_Manager::render_icon( $item['_dl_pro_accordion_selected_icon'], [ 'aria-hidden' => 'true' ] ); 
                    ?>
                </div>
                <?php }?>
                <div class="dl_accordion_item_title">
                    <h3 class="dl_accordion_title"><?php echo esc_html__($item['_dl_pro_accordions_title_'] ,'droit-addons-pro');?></h3>
                    <div class="dl_accordion_title_icon">
                        <div class="dl_accordion_normal_icon dl_pro_accordion_icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['_dl_pro_accordions_title_icon_id'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                        
                        <div class="dl_accordion_active_icon dl_pro_accordion_icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['_dl_pro_accordions_active_icon_id'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dl_accordion_panel" >
                <div class="dl_accordion_inner">
                    <div class="dl_accordion_inner_content dl-popup-editor">
                        <?php echo \DROIT_ELEMENTOR_PRO\Dl_Editor::instance()->render($uniqueId, $widgetsid, $repeaterid);?>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; 
    endforeach; ?>
    </div>
</div>