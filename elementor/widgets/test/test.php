<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Test extends Widget_Base{

    public function get_name()
    {
        return 'drth-test';
    }

    public function get_title()
    {
        return esc_html__( 'Test', 'text-domain' );
    }

    public function get_icon()
    {
        return 'eicon-image-before-after addons-icon';
    }

    public function get_categories()
    {
        return ['drth_custom_theme'];
    }

    public function get_keywords()
    {
        return [ 'test', ];
    }

    protected function register_controls()
    {
        do_action('dl_widgets/test/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
        do_action('dl_widgets/test/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_dl_pr_test_layout_section',
            [
                'label' => __('Layout', 'text-domain'),
            ]
        );

        $this->end_controls_section();
        //start subscribe layout end

    }

    public function _styles_control(){

        $this->start_controls_section(
            '_dl_pr_test_style_section',
            [
                'label' => esc_html__('Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

            ]
        );



        $this->end_controls_section();
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);

        // render
    }

    protected function content_template()
    {}
}