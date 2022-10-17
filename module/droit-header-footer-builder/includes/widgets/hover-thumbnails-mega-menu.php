<?php
namespace Elementor;

use WP_Query;

defined( 'ABSPATH' ) || exit;

class DRDT_Hover_Thumbnails_Mega_Menu Extends Widget_Base{

    protected $index = 1;

    public function get_name() {
        return 'drdt_hover_thumbnails_mega_menu';
    }

    public function get_title() {
        return __( 'Hover Thumbnails Mega Menu', 'droithead' );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return [ 'drit-header-footer' ];
    }

    public function get_script_depends() {
        return [];
    }

    /**
     * Name: register_controls
     * Desc: Register controls for this widgets
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @droithead
     * Author: DroitThemes
     * Developer: Hazi
     */
    protected function register_controls() {
        $this->render_content_section();
        $this->render_style_section();
    }

    /**
     * Name: render_content
     * Desc: Register content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @droithead
     * Author: DroitThemes
     * Developer: Hazi
     */
    public function render_content_section(){

        $this->start_controls_section(
            'drdt_mega_menu_sec',
            [
                'label' => __( 'Mega Menu Items', 'droithead' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $pages = $this->get_pages();

        $repeater->add_control(
            'drdt_menu_item',
            [
                'label'        => __( 'Select Menu Item', 'droithead' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => $pages,
                'default'      => array_keys( $pages )[0],
            ]
        );

        $repeater->add_control(
            'drdt_menu_item_thumbnails',
            [
                'label' => __( 'Thumbnails', 'droithead' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'drdt_mega_menu_items',
            [
                'label' => __( 'Add Menu Item', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ drdt_menu_item }}}',
                'prevent_empty' => false,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Name: render_style
     * Desc: Register style content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @droithead
     * Author: DroitThemes
     * Developer: Hazi
     */
    public function render_style_section(){

        $this->start_controls_section(
            'drdt_mega_menu_style',
            [
                'label' => __( 'Menu Items', 'droithead' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'drdt_item_typo',
            [
                'label' => __( 'Space Between', 'droithead' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .nav-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        //------------------------- Start Tabs ---------------------------//
        $this->start_controls_tabs(
            'drdt_item_title_tabs'
        );

        // Tab 01
        $this->start_controls_tab(
            'drdt_item_normal_color', [
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'drdt_item_normal_text_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'drdt_item_active_text_color',
            [
                'label' => __( 'Active Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-link.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End Tab 01


        // Tab 02
        $this->start_controls_tab(
            'drdt_item_hover_color',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'drdt_item_hover_text_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End Tab 02

        $this->end_controls_tabs(); // End Tabs

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'drdt_item_typo',
                'label' => __( 'Typography', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} .nav-link',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'drdt_item_padding',
            [
                'label' => __( 'Padding', 'plugin-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

    }


    /**
     * Name: render
     * Desc: Widgets Render
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @droithead
     * Author: DroitThemes
     * Developer: Hazi
     */
    protected function render() {
        $settings         = $this->get_settings_for_display();
        extract($settings); // extract settings data

        ?>
        <ul class="dropdown-menu11">
            <?php
            if ( is_array( $drdt_mega_menu_items ) ) {
                foreach ( $drdt_mega_menu_items as $menu_item ) {
                    $thumbnails = isset($menu_item['drdt_menu_item_thumbnails']) ? $menu_item['drdt_menu_item_thumbnails'] : [];
                    $page = isset($menu_item['drdt_menu_item']) ? $menu_item['drdt_menu_item'] : '';
                    $pageInfo = $this->get_pages(true, $page);
                    $id = isset($pageInfo[0]) ? $pageInfo[0] : 0;
                    $title = isset($pageInfo[1]) ? $pageInfo[1] : '';
                    ?>
                    <li class="nav-item" data-src="<?php echo wp_get_attachment_image_url( $thumbnails['id'], 'thumbnail' ); ?>">
                        <a href="<?php echo esc_url(get_page_link( $id )); ?>" class="nav-link">
                            <?php echo esc_html($title); ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <?php
    }

    /**
     * Name: render_style
     * Desc: Register style content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @droithead
     * Author: DroitThemes
     * Developer: Hazi
     */
    private function get_pages( $url = false, $get = '') {

        $pages = get_pages([
            'post_status' => 'publish',
            'post_type'   => 'page',
        ]);
        $options = [];
        foreach ( $pages as $menu ) {
            if( $url ){
                $options[ $menu->post_name ] = [ $menu->ID, $menu->post_title];
            } else {
                $options[ $menu->post_name ] = $menu->post_title;
            }
        }

        if( !empty($get) ){
            return isset($options[$get]) ? $options[$get]: $options;
        }
        return $options;
    }

}