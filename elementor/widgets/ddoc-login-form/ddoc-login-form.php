<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Ddoc_Login_Form extends Widget_Base {

	public function get_name() {
		return 'ddoc-login-form';
	}

	public function get_title() {
		return __( 'Doc Login Form (ddoc)', 'ddoc-core' );
	}

	public function get_icon() {
		return 'eicon-arrow-right';
	}

	public function get_categories()
    {
        return ['drth_custom_theme'];
    }

    public function get_keywords()
    {
        return [ 'login', 'doc login', 'ddoc login', 'form'];
    }

	protected function register_controls() {

		$repeater = new \Elementor\Repeater();

        // ---Start Document Setting
        $this->start_controls_section(
            'document_filter', [
                'label' => __( 'Search Settings', 'ddoc-core' ),
            ]
        );
        $this->add_control(
            'add_popular_keywords', [
                'label' => esc_html__( 'Suggestions Keywords', 'ddoc-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'how to, install, plugin, ajax, elemenor', 'ddoc-core' ),
            ]
        );

        $this->end_controls_section();

        // end Document Setting Section
      }

	protected function render() {
		$settings = $this->get_settings();
        if(!is_user_logged_in()):
   ?>
    <div class="ddoc-login-from">
        <div class="mb-4">
            <input type="text" class="form-control ddoc-user" id="usernameemail" placeholder="<?php esc_attr_e('Enter User Name', 'ddoc-core'); ?>">
        </div> 
        <div class="mb-4">
            <input type="password" class="form-control ddoc-user-pass" id="password" placeholder="<?php esc_attr_e('Enter password', 'ddoc-core'); ?>">
        </div>  
        <div class="mb-4 d-flex justify-content-between">
          <div class="form-check">
            <input class="form-check-input ddoc-remember-me" type="checkbox" value="true" id="ddoc-rememebar-me">
            <label class="form-check-label" for="ddoc-rememebar-me">
                <?php echo esc_html__('Remember me', 'ddoc-core'); ?>
            </label>
          </div>
          <div class="forget-link">
            <a href="<?php echo esc_url( wp_lostpassword_url( get_home_url() ) ); ?>">
                <?php esc_html_e( 'Forgot your password ?', 'ddoc-core' ); ?>
            </a>
          </div>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary ddoc-login" type="button">
                <span class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
                <?php echo esc_html__('Login', 'ddoc-core'); ?>
            </button>
         </div>  
         <ul class="success-login">
         </ul>   
        <div class="ddoc_social_login">
            <p><?php echo esc_html__('Or Login with', 'ddoc-core'); ?></p>
            <?php echo do_shortcode('[miniorange_social_login shape="square" theme="default" space="4" size="35"]'); ?>
        </div>
        
    </div>
<?php 
 else: printf(__("You already Login! <a href='%s'>Logout From Here</a>", "ddoc-core"), wp_logout_url());
endif;
 }
}