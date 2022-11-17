<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Video_Docs extends Widget_Base {

    public function get_name() {
        return 'ddoc-video-docs';
    }

    public function get_title() {
        return esc_html__( 'Video Docs', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-image-before-after addons-icon';
    }

    public function get_categories() {
        return ['drth_custom_theme'];
    }

    public function get_keywords() {
        return [ 'Doc', 'Docs' ];
    }

    protected function register_controls() {
        do_action('dl_widgets/video/register_control/start', $this);

        // add content
        $this->_content_control();

        //style section
        $this->_styles_control();

        do_action('dl_widgets/video/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);

    }

    public function _content_control(){

        //============================= Filter Options =================================== //
        $this->start_controls_section(
            'filter_sec_opt', [
                'label' => __('Filter', 'rave-core'),
            ]
        );

        $this->add_control(
            'cats', [
                'label' => esc_html__( 'Category', 'rave-core' ),
                'description' => esc_html__( 'Display blog by categories', 'rave-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => self::get_cat_array(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__('Show Posts Count', 'rave-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__('Order', 'rave-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'orderby', [
                'label' => esc_html__( 'Order By', 'rave-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Name (by post slug)',
                    'date' => 'Date',
                    'rand' => 'Random',
                ],
                'default' => 'none'
            ]
        );

        $this->add_control(
            'exclude', [
                'label' => esc_html__( 'Exclude Video', 'rave-core' ),
                'description' => esc_html__( 'Enter the video post IDs to hide/exclude. Input the multiple ID with comma separated', 'rave-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'video_icon', [
                'label' => esc_html__( 'Icon', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section(); //End Filter

    }

    public function _styles_control(){

        $this->start_controls_section(
            '_dl_pr_video_style_section', [
                'label' => esc_html__('Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    //Html render
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $args = [
            'post_type' => 'video-docs',
            'post_status' => 'publish',
        ];

        if ( !empty($settings['show_count'] ) ) {
            $args['posts_per_page'] = $settings['show_count'];
        }

        if ( !empty($settings['order'] ) ) {
            $args['order'] = $settings['order'];
        }

        if ( !empty($settings['orderby'] ) ) {
            $args['orderby'] = $settings['orderby'];
        }

        if ( !empty($settings['exclude'] ) ) {
            $args['post__not_in'] = $settings['exclude'];
        }

        if ( !empty($cats && $cats != '') ) {
            $args['tax_query'] = [
                [
                    'taxonomy'  => 'video-category',
                    'field'     => 'id',
                    'terms'     => $cats,
                ]
            ];
        }

        $posts = new \WP_Query( $args );

        // render
        ?>

        <div class="video-docs">
            <div class="container">
                <div class="row">
                    <?php
                    while ( $posts->have_posts() ) : $posts->the_post();
                        $author_id = get_the_author_meta( 'ID' );
                        $author_name = get_the_author_meta( 'display_name', $author_id );
                        $video_url = get_post_meta( get_the_ID(), 'video_docs_url', true);
                        ?>
                        <div class="col-lg-4">
                            <div class="video_doc_item">
                                <div class="video-bg d-flex justify-content-center align-items-center" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>)">
                                    <a href="<?php echo $video_url ?>" class="video-popup video-icon" id="video-popup">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </a>
                                </div>
                                <a href="#" title="<?php the_title_attribute() ?>">
                                    <?php the_title('<h3>', '</h3>') ?>
                                </a>
                                <div class="bottom_line border-bottom"></div>
                                <div class="author-info d-flex justify-content-between align-items-center">
                                    <div class="author d-flex">
                                      <img alt="" src="/wp-content/uploads/2022/03/icono-klic-b.svg" class="avatar avatar-32 photo img-rounded me-1" height="32" width="32" loading="lazy" decoding="async">
                                      <h4 class="name">Cinépolis Klic<sup>®</sup></h4>
                                    </div>
                                    <p class="date mb-0"><?php echo get_the_date() ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

        </div>
        <?php
    }

    protected function content_template()
    {}

    static function get_cat_array() {

        $terms = get_terms(array(
            'taxonomy' => 'video-category'
        ));

        $term_array = [];
        foreach ( $terms as $term ) {
            $term_array[$term->term_id] = $term->name;
        }

        return $term_array;

    }

}
