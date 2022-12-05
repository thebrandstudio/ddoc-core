<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Ddoc_Tab extends Widget_Base {

	public function get_name() {
		return 'drth-tab';
	}

	public function get_title() {
		return __( 'Ddoc Tab', 'ddoc-core' );
	}

	public function get_icon() {
		return 'eicon-device-desktop';
	}

	public function get_categories()
    {
        return ['drth_custom_theme'];
    }

    public function get_keywords()
    {
        return [ 'tab', ];
    }

	protected function register_controls() {

		$repeater = new \Elementor\Repeater();

        // ---Start Document Setting
        $this->start_controls_section(
            'document_filter', [
                'label' => __( 'Filter Options', 'ddoc-core' ),
            ]
        );


        $this->add_control(
            'show_section_count', [
                'label' => esc_html__( 'Show Section Count', 'ddoc-core' ),
                'description' => esc_html__( 'The number of sections to show under every documentation tab. Leave empty or give value -1 to show all sections.', 'ddoc-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 6
            ]
        );

        $this->add_control(
            'main_doc_excerpt', [
                'label' => esc_html__( 'Main Doc Excerpt', 'ddoc-core' ),
                'description' => esc_html__( 'Excerpt word limit of main documentation. If the excerpt got empty, this will get from the post content.', 'ddoc-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 15
            ]
        );

        $this->add_control(
            'doc_sec_excerpt', [
                'label' => esc_html__( 'Doc Section Excerpt', 'ddoc-core' ),
                'description' => esc_html__( 'Excerpt word limit of the documentation sections. If the excerpt got empty, this will get from the post content.', 'ddoc-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 8
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'ddoc-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'is_tab_title_first_word',
            [
                'label' => __( 'Tab Title First Word', 'ddoc-core' ),
                'description' => __( 'Show the first word of the doc in Tab Title.', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'read_more', [
                'label' => esc_html__( 'Read More Text', 'ddoc-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More'
            ]
        );

        $this->end_controls_section();

        // end Document Setting Section
      }

	protected function render() {
		$settings = $this->get_settings();

   ?>

 <!-- Start dt_our_live_document_wrap-->
    <section class="dt_our_live_document_wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab_menu_content dt_doc_tab_content">
                        <ul class="row nav nav-tabs" style="display: flex; flex-direction: row; justify-content: space-evenly;">
                            <?php
                            $parent_docs = get_pages(array(
                                'post_type'     => 'docs',
                                'parent'        => 0,
                                'sort_order'    => $settings['order'],
                            ));
                            if ( $parent_docs ) {
                                foreach ($parent_docs as $i => $doc) {
                                    $active = ($i == 1) ? 'active' : '';
                                    $doc_name = explode( ' ', $doc->post_title );
                                    ?>
                                    <li id="icono-<?php echo esc_attr($doc->ID); ?>" class="col-4 col-sm-2 nav-item" data-id="#doc-<?php echo esc_attr($doc->ID); ?>">
																			<a class="nav-link <?php echo 'doc-'.esc_attr($doc->ID).' '; echo esc_attr($active) ?>" data-toggle="tab" href="#doc-<?php echo esc_attr($doc->ID) ?>">
																				<div class="img post-icon-<?php echo esc_attr($doc->ID); ?>" style="height: 70px; width: 70px; margin-left: auto; margin-right: auto;">
																						<?php echo $this->get_ddoc_icon($doc->ID);  ?>
																				</div>
                                        <?php
																					if ( $settings['is_tab_title_first_word'] == 'yes' ) {
                                          	echo wp_kses_post($doc_name[0]);
                                          } else {
                                            echo wp_kses_post($doc->post_title);
                                          }
                                        ?>
                                      </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>

<style>
li#icono-3855 {
  order: 1;
}
li#icono-1644 {
  order: 2;
}
li#icono-6502 {
  order: 3;
}
li#icono-5886 {
  order: 4;
}
li#icono-1164 {
  order: 5;
}
li#icono-6554 {
  order: 6;
}
</style>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-content tab_content">
                        <?php
                        if ( $parent_docs ) {
                            foreach ($parent_docs as $root) {
                                $sections = get_children( array(
                                    'post_parent'    => $root->ID,
                                    'post_type'      => 'docs',
                                    'post_status'    => 'publish',
                                    'orderby'        => 'menu_order',
                                    'order'          => 'ASC',
                                    'posts_per_page' => !empty($settings['show_section_count']) ? $settings['show_section_count'] : -1,
                                ) );
                                $docs[] = array(
                                    'doc'      => $root,
                                    'sections' => $sections
                                );
                            }
                        }

                        foreach ($docs as $i => $main_doc) :
                            $active = ($i == 1) ? 'active' : '';
                            ?>
                            <div class="tab-pane fade show <?php echo esc_attr($active); ?>" id="doc-<?php echo esc_attr($main_doc['doc']->ID) ?>">
                                <div class="row">
                                    <div class=" col-lg col-md-12 col-12">
                                        <div class="tab_left_content">
                                            <?php if ( $this->get_ddoc_icon($main_doc['doc']->ID) != '') : ?>
                                                <div class="img post-icon-<?php echo esc_attr($main_doc['doc']->ID); ?>">
                                                    <?php echo $this->get_ddoc_icon($main_doc['doc']->ID);  ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ( !empty($main_doc['doc']->post_title) ) : ?>
                                                <h3> <?php echo wp_kses_post($main_doc['doc']->post_title); ?> </h3>
                                            <?php endif; ?>
																						<p id="descripcion" style="color: #08285B; font-size: 24px;">
																							<?php $shortcode = get_post_meta($main_doc['doc']->ID,'descripcion',true);
																								echo do_shortcode($shortcode);?>
																						</p>
                                            <a href="<?php echo get_permalink( $main_doc['doc']->ID ); ?>" class="read_more">
                                                <?php echo esc_html($settings['read_more']); ?> <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <div class="row tab_right_content">
                                            <?php
                                                foreach ($main_doc['sections'] as $section) :
                                                    $icon_bg_color = get_post_meta( $section->ID, 'tab_icon_background', true );
                                                ?>
                                                <div class="col-md-6 col-sm-12 col-12">
                                                    <div class="dt_knowledge_item">
																											<a href="<?php echo get_permalink($section->ID); ?>">
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <?php  $iconclass = 'img_wrap post-icon-'.$section->ID;  ?>

                                                                <div class="<?php echo esc_attr( $iconclass ); ?>" <?php if(!empty( $icon_bg_color )){ ?> style="background-color: <?php echo esc_attr($icon_bg_color) ?>" <?php } ?>>
                                                                   <?php
                                                                    if ( $this->get_ddoc_icon($section->ID) != '' ) {
                                                                        echo $this->get_ddoc_icon($section->ID);
                                                                    } else {
                                                                        $default_icon = plugins_url('image/doc-sec.webp', __FILE__);
                                                                        echo "<img src='$default_icon' alt='{$section->post_title}'>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <h4> <?php echo wp_kses_post($section->post_title); ?> </h4>
                                                                <p>
                                                                <?php
                                                                if( strlen(trim($section->post_excerpt)) != 0 ) {
                                                                    echo wp_trim_words($section->post_excerpt, $settings['doc_sec_excerpt'], '');
                                                                } {
                                                                    echo wp_trim_words($section->post_content, $settings['doc_sec_excerpt'], '');
                                                                }
                                                                ?>
                                                                </p>
                                                            </div>
                                                        </div>
																											</a>
                                                    </div>
                                                </div>
                                                <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end dt_our_live_document_wrap -->

<?php
 }
 protected  function get_ddoc_icon ( $post_id )  {
    $icon = '';
     if(function_exists('get_field')) {
        $get_icon_type = get_field('select_icon_type_', $post_id, true);

        if($get_icon_type == 'icon'){
            $icon = get_field('select_icon', $post_id, true);
        }elseif($get_icon_type == 'image'){
            $imgeId = get_field('upload_image_icon_svg', $post_id, true);
            $icon = wp_get_attachment_image($imgeId['ID'], 'full');
        }
     }
     return $icon;
 }
}
