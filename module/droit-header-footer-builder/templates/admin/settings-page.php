<div id="wrapper">
<div class="dl_elementor_addons_pack dl_sidebar_tab">
    <div class="dl_elementor_addon_content dl_d_flex">
      <div class="dl_tab_menu_content">
        <div class="sticky_sldebar">
          <h4 class="droit-logo-text"><?php echo esc_html( 'Droit Header Footer Builder', 'droit-elementor-addons' );?></h4>
          <div class="tab-menu tab_left_content">
            <button class="tab-menu-link active" data-content="droit_general">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="tab_content">
                    <h4><?php echo esc_html( 'General Settings', 'droit-dark' );?></h4>
                    <span><?php echo esc_html( 'Basic settings for dark mode', 'droit-dark' );?></span>
                  </div>
                </div>
              </div>
            </button>
            <button class="tab-menu-link" data-content="droit_display">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="tab_content">
                    <h4><?php echo esc_html( 'Display Settings', 'droit-dark' );?></h4>
                    <span><?php echo esc_html( 'Frontend settings for dark mode', 'droit-dark' );?></span>
                  </div>
                </div>
              </div>
            </button>
            <button class="tab-menu-link" data-content="droit_advance">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="tab_content">
                    <h4><?php echo esc_html( 'Advance Settings', 'droit-dark' );?></h4>
                    <span><?php echo esc_html( 'Frontend settings for dark mode', 'droit-dark' );?></span>
                  </div>
                </div>
              </div>
            </button>
            <button class="tab-menu-link" data-content="droit_preset">
              <div class="dl_tab_content">
                <div class="tab_content_inner">
                  <div class="tab_content">
                    <h4><?php echo esc_html( 'Preset Design', 'droit-dark' );?></h4>
                    <span><?php echo esc_html( 'By default preset design for dark mode', 'droit-dark' );?></span>
                  </div>
                </div>
              </div>
            </button>

            <?php do_action('drdt-settings-tabs-menu');?>
           
          </div>
        </div>
      </div>
      <div class="tab-bar">
        <div class="tab-bar-content active" id="droit_general">
            <?php include_once( __DIR__ . '/view/general.php');?>
        </div>
        <div class="tab-bar-content" id="droit_display">
            <?php include_once( __DIR__ . '/view/display.php');?>
        </div>
        <div class="tab-bar-content" id="droit_advance">
            <?php include_once( __DIR__ . '/view/advance.php');?>
        </div>
        <div class="tab-bar-content" id="droit_preset">
            <?php include_once( __DIR__ . '/view/preset.php');?>
        </div>

        <?php do_action('drdt-settings-tabs-content');?>

      </div>
    </div>
  </div>
</div>
