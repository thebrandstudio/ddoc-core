<?php 
$id_int = substr( $this->get_id_int(), 0, 4 );
$this->add_render_attribute(
    '_dl_pro_video_popup_wrapper',
    [
        'id' => "button-{$id_int}",
        'class' => ['dl-button-wrapper-pro', 'video_popup_area','dl-button-wrapper', $skin],
    ]
);

$this->add_render_attribute( 'button', 'class', 'droit-button' );
if ( 'yes' === $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_adv_hover_enable') ) {
    $this->add_render_attribute( 'button', 'class', 'droit-button---adv-hover' );
}
if ( !empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_adv_icon_reverse'))  ) {
    $this->add_render_attribute( 'button', 'class', 'reverse-' . $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_adv_icon_reverse') );
}

if ( ! empty( $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') ) && 'none' != $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') ) {
    $migrated = isset( $this->_dl_pro_video_popup_settings('__fa4_migrated')['_dl_pro_video_popup_selected_icon'] );

    if (  !empty( $this->_dl_pro_video_popup_settings('icon') ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
        
        $settings['icon'] = 'fas fa-play-circle';
    }

    $is_new = empty( $this->_dl_pro_video_popup_settings('icon') ) && \Elementor\Icons_Manager::is_migration_allowed();
    $has_icon = ( ! $is_new || ! empty( $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_selected_icon')['value'] ) );
}
  $embed_url = $this->_dl_pro_video_popup_settings('embed_url');
  $autoplay = !empty($this->_dl_pro_video_popup_settings('autoplay')) ? $this->_dl_pro_video_popup_settings('autoplay') : 0;
  $loop = !empty($this->_dl_pro_video_popup_settings('loop')) ? $this->_dl_pro_video_popup_settings('loop') : 0;
  $controls = !empty($this->_dl_pro_video_popup_settings('controls')) ? $this->_dl_pro_video_popup_settings('controls') : 0;
  $mute = !empty($this->_dl_pro_video_popup_settings('mute')) ? $this->_dl_pro_video_popup_settings('mute') : 0;
  $start = !empty($this->_dl_pro_video_popup_settings('start')) ? $this->_dl_pro_video_popup_settings('start') : 0;
  $end = !empty($this->_dl_pro_video_popup_settings('end')) ? $this->_dl_pro_video_popup_settings('end') : 0;
  $modestbranding = !empty($this->_dl_pro_video_popup_settings('modestbranding')) ? $this->_dl_pro_video_popup_settings('modestbranding') : 0;
  $showinfo = !empty($this->_dl_pro_video_popup_settings('showinfo')) ? $this->_dl_pro_video_popup_settings('showinfo') : 0;
  $vimeo_byline = !empty($this->_dl_pro_video_popup_settings('vimeo_byline')) ? $this->_dl_pro_video_popup_settings('vimeo_byline') : 0;
  $vimeo_portrait = !empty($this->_dl_pro_video_popup_settings('vimeo_portrait')) ? $this->_dl_pro_video_popup_settings('vimeo_portrait') : 0;
  $vimeo_title = !empty($this->_dl_pro_video_popup_settings('vimeo_title')) ? $this->_dl_pro_video_popup_settings('vimeo_title') : 0;
  
  if($this->_dl_pro_video_popup_settings('video_type') == 'youtube'){
  $dl_video_popup_url = $embed_url."?autoplay={$autoplay}&loop={$loop}&controls={$controls}&mute={$mute}&start={$start}&end={$end}&rel=0&modestbranding={$modestbranding}&showinfo={$showinfo}";
  }else{
    $dl_video_popup_url = $embed_url."?html5=1&autoplay={$autoplay}&loop={$loop}&controls={$controls}&mute={$mute}&start={$start}s&byline={$vimeo_byline}&portrait={$vimeo_portrait}&title={$vimeo_title}";
  }
  
?>
<div <?php echo $this->get_render_attribute_string( '_dl_pro_video_popup_wrapper' ); ?>>
    <a href="<?php echo esc_url($dl_video_popup_url); ?>" <?php echo $this->get_render_attribute_string( 'button' ); ?>>
        <?php 
            if ($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') != 'none' ) {
                if($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') == 'icon'){
                    if ( $is_new || $migrated ) { ?>
                        <span class="droit-button-media droit-button_icon" aria-hidden="true">
                            <?php \Elementor\Icons_Manager::render_icon( $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_selected_icon') ); ?>
                        </span>
                    <?php }
                }elseif( $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') == 'image' && !empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_image')['url']) ){ 
                    ?>
                    <span class="droit-button-media droit-button_image" aria-hidden="true">
                        <img src="<?php echo esc_url($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_image')['url']); ?>" alt="Button Icon">
                    </span>

                <?php }
            }

        ?>
        <?php if (!empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_text'))): ?>
          <span class="dl-button-text">
              <?php echo $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_text') ?>
          </span>
        <?php endif ?>
    </a>
</div>
