<?php
$settings = $this->get_settings_for_display();
$tabsFormat = ($settings['_dl_pro_tabs_format']) ?? '';

if ( !empty( $settings['_dl_pro_tabs_skin'] == '_skin_1' ) ) {
   
    $this->add_render_attribute(
        'dl_tab_wrapper',
        [
            'id' => "droit-advance-tabs-{$this->get_id()}",
            'class' => [ 'droit-advance-tabs dl_tab_container', $this->get_pro_tabs_settings('_dl_tabs_skin'),$tabsFormat,($settings['_dl_pro_tabs_direction'])],
            'data-tabid' => $this->get_id(),
        ]
    );
} 



$this->add_render_attribute( '_dl_tab_title_attr', 'class', 'dl_title droit-tab-title' );
$this->add_render_attribute( '_dl_tab_description_attr', 'class', 'dl_desc droit-tab-text' );
$has_tabs = ! empty( $this->get_pro_tabs_settings('_dl_pro_tab_list_') );
$id_int = substr( $this->get_id_int(), 0, 4 );

if ($has_tabs): 
?>

    <div <?php echo $this->get_render_attribute_string('dl_tab_wrapper'); ?>>
    <div class="droit-tabs-nav droit-advance-tabs-navs">
        <ul class="dl_tab_menu droit-advance-navs">
            <?php foreach ($this->get_pro_tabs_settings('_dl_pro_tab_list_') as $index => $tab): 
                $tab_count = $index + 1;
                $tab_title_setting_key = $this->get_repeater_setting_key( '_dl_pro_tab_title_', '_dl_pro_tab_list_', $index );
                
                
                $this->add_render_attribute( $tab_title_setting_key, [
                    'id' => 'droit-tab-title-' . $id_int . $tab_count,
                    'class' => [ 'dl_tab_menu_item droit-tab-nav-items', ($settings['_dl_pro_adv_tab_border_controls'])],
                    'data-tab' => $tab_count,
                ]);
                $this->add_render_attribute($tab_title_setting_key, 'class', $tab['_dl_pro_tab_show_as_default']);
                $this->add_render_attribute($tab_title_setting_key, 'class', 'elementor-repeater-item-'.$tab['_id']);

                if (!empty($this->get_pro_tabs_settings('_dl_tabs_border_bottom_none'))) {
                    $this->add_render_attribute($tab_title_setting_key, 'class', $this->get_pro_tabs_settings('_dl_tabs_border_bottom_none'));
                }
                if ( !empty($tab['_dl_pro_advance_tab_adv_icon_reverse'])  ) {
                    $this->add_render_attribute( $tab_title_setting_key , 'class', 'reverse-' . $tab['_dl_pro_advance_tab_adv_icon_reverse'] );
                }

                
                ?>
                <li <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                    <span class="droit-tab-title"><?php echo $tab['_dl_pro_tab_title_'] ?></span>
                    <div class="droit_tab_icon_inner">
                        <?php 
                        
                        if ( ! empty(  $tab['_dl_pro_advance_tab_icon_type'] ) && 'none' !=  $tab['_dl_pro_advance_tab_icon_type'] ) {
                            $is_migrated = isset($tab['__fa4_migrated']['_dl_pro_advance_tab_selected_icon']);
                            $is_new = empty($tab['icon']);
                        }
                        if ($tab['_dl_pro_advance_tab_icon_type'] != 'none' ) {
                            if($tab['_dl_pro_advance_tab_icon_type'] == 'icon'){
                                if ( $is_new || $is_migrated ) { ?>
                                    <span class="droit-button-media droit-button_icon" aria-hidden="true">
                                        <?php \Elementor\Icons_Manager::render_icon( $tab['_dl_pro_advance_tab_selected_icon'] ); ?>
                                    </span>
                                <?php }
                            }elseif( $tab['_dl_pro_advance_tab_icon_type'] == 'image' && !empty($tab['_dl_pro_advance_tab_icon_image']['url']) ){ 
                                ?>
                                <span class="droit-button-media droit-button_image" aria-hidden="true">
                                    <img src="<?php echo esc_url($tab['_dl_pro_advance_tab_icon_image']['url']); ?>" alt="Button Icon">
                                </span>

                            <?php }
                        }
                       
                        ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="tab_container droit-tab-content-wrapper">
        <?php foreach ($this->get_pro_tabs_settings('_dl_pro_tab_list_') as $tab):
            $tab_count = $index + 1;
            $has_title_text = ! empty( $tab['_dl_pro_tab_title__text'] );
            $has_description_text = ! empty( $tab['_dl_tabs_description_text'] );

            $icon_tag = '';
            if ( ! empty( $tab['_dl_tabs_link']['url'] ) ) {
                $icon_tag = 'a';
                $this->add_link_attributes( '_dl_tabs_link', $tab['_dl_tabs_link'] );
            }
            $link_attributes = $this->get_render_attribute_string( '_dl_tabs_link' );

            $tab_content_setting_key = $this->get_repeater_setting_key( '_dl_tabs_description_text', '_dl_pro_tab_list_', $index );
                
            $this->add_render_attribute( $tab_content_setting_key, [
                'id' => 'droit-tab-content-' . $id_int . $tab_count,
                'class' => [ 'dl_tab_content_wrapper' ],
                'data-tab' => $tab_count,
            ] );
            $this->add_render_attribute($tab_content_setting_key, 'class', $tab['_dl_pro_tab_show_as_default']);
                
            $_dlContent = isset($tab['_dl_pro_tab_content_id']) ? $tab['_dl_pro_tab_content_id'] : '';

            $uniqueId = 0;
            $widgetsid = $id;
            $repeaterid = esc_attr($tab['_id']);
            
            if( !empty($_dlContent) ){
                $exp = explode('___', $_dlContent);
                if( isset($exp[1])){
                    $uniqueId = !empty($exp[0]) ? $exp[0] : $uniqueId;
                }
            }
            ?>
        <div class="dl_tab_content_wrapper <?php echo esc_attr($tab['_dl_pro_tab_show_as_default']); ?> dl-popup-editor" >
            <?php echo \DROIT_ELEMENTOR_PRO\Dl_Editor::instance()->render($uniqueId, $widgetsid, $repeaterid);?>  
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>  