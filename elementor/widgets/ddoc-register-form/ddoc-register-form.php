<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Ddoc_Register_Form extends Widget_Base {

	public function get_name() {
		return 'ddoc-register-form';
	}

	public function get_title() {
		return __( 'Doc Registration Form (ddoc)', 'ddoc-core' );
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
        return [ 'registration', 'doc registration', 'ddoc registration', 'form'];
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
        $registration_enable = get_option('users_can_register');
        if(!$registration_enable) {
            echo esc_html__('Registration not enable', 'ddoc-core');
            return;
        }
   ?>
   <div class="ddoc-registration-from ddoc-login-from">
        <div class="mb-4">
            <input type="text" class="form-control ddoc-registration-full-name" id="userfullname" placeholder="<?php echo esc_attr__('Full Name', 'ddoc-core') ?>">
        </div> 
        <div class="mb-4">
            <input type="text" class="form-control ddoc-user-login" id="user-login-name" placeholder="<?php echo esc_attr__('User Name', 'ddoc-core') ?>">
        </div>  
        <div class="mb-4">
            <input type="email" class="form-control ddoc-user-email" id="user-login-name" placeholder="<?php echo esc_attr__('Enter email address', 'ddoc-core') ?>">
        </div>  
        <div class="mb-4">
            <input type="password" class="form-control ddoc-user-pas" id="user-login-pas" placeholder="<?php echo esc_attr__('Enter password', 'ddoc-core') ?>">
        </div>  
        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input ddoc-terms" type="checkbox" value="true" id="ddoc-trems-me">
                <label class="form-check-label" for="ddoc-trems-me">
                <?php echo esc_html__('I agree to terms and services', 'ddoc-core'); ?>
                </label>
            </div>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary ddoc-registration" type="button">
                <span class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
                <?php echo esc_html__('Registration', 'ddoc-core'); ?>
            </button>
         </div>  
         <div class="success-registration">

         </div>  
         <div class="ddoc_social_login">
         	<p><?php echo esc_html__('Or Register with', 'ddoc-core'); ?></p>
            <?php echo do_shortcode('[miniorange_social_login shape="square" theme="default" space="4" size="35"]'); ?> 
        </div>  
    </div>
<?php 
 }
}