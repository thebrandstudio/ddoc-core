<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Ddoc_List extends Widget_Base {

	public function get_name() {
		return 'ddoc-list';
	}

	public function get_title() {
		return __( 'Doc List (ddoc)', 'ddoc-core' );
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
        return [ 'wedoc', 'list', 'shortcode'];
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
            'posts_per_page', [
                'label' => esc_html__( 'Posts Per Page', 'ddoc-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '6'
            ]
        );

        $this->end_controls_section();

        // end Document Setting Section
      }

	protected function render() {
		$settings = $this->get_settings();
           $args = [
            'post_type'   => 'docs',
            'numberposts' => $settings['posts_per_page'],
            'post_parent' => 0,
            'post_status'    => "publish",
           ];
           $get_docs = get_posts($args);
          
           ?>
            <div class="row">
                <?php if(!empty($get_docs)) :
                     
                     foreach($get_docs as $list) :   
                        //  get id  $list->ID
                        $args = [
                            'posts_per_page' => -1,
                            'order'          => 'ASC',
                            'post_parent'    => $list->ID,
                            'post_status'    => "publish",
                            'post_type'      => 'docs',
                            "depth"          => 0, 
                        ];
                        $args2 = [
                            'posts_per_page' => 6,
                            'order'          => 'ASC',
                            'post_parent'    => $list->ID,
                            'post_status'    => "publish",
                            'post_type'      => 'docs',
                            "depth"          => 0, 
                        ];
                        $list_count = count(get_children( $args ));
                        $get_lists = get_children( $args2 );
                        $parent_post_link = get_the_permalink($list->ID);
                    ?>
                    <div class="col-lg-4 col-md-6">
                     <div class="list-content">
                         <div class="header d-flex">
                            <div class="icon">
                                <?php echo $this->get_list_icon($list->ID); ?>
                            </div>
                            <div class="content">
                                <h4><?php echo esc_html( $list->post_title); ?></h4>
                                <span><?php echo esc_html($list_count); ?><span> <?php esc_html_e('topics', 'ddoc-core'); ?></span></span>
                            </div>
                         </div>
                         <ul class="list-group list-group-flush">
                            <?php if($list_count > 0 ) : 
                                 foreach($get_lists as $list) {  ?>
                                <li class="list-group-item">
                                    <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ).'assets/images/book.svg'); ?>" alt="icon" width="20" height="20">
                                    <a href="<?php echo esc_url(get_the_permalink($list->ID)) ?>"><?php  echo esc_html($list->post_title); ?></a>
                                </li>
                            <?php  } endif; ?>
                        </ul>
                         <div class="ddoc-read-more-list">
                             <a href="<?php echo esc_url($parent_post_link); ?>"><?php esc_html_e('Learn More', 'ddoc-core'); ?></a>
                         </div> 
                    </div>
                </div>
                <?php endforeach; endif; ?> 
            </div>
           <?php 
        }
 protected function get_list_icon ($post_id) {
      $icon_html = '';
      $icon_type = get_field( "select_icon_type_", $post_id );
      $icon = get_field( "select_icon", $post_id );
      $image = get_field( "upload_image_icon_svg", $post_id );
      if($icon_type == 'image') {
        $icon_html = '<img src="'.$image['url'].'" alt="icon"  height="'.$image['height'].'" width="'.$image['width'].'">'; 
      }
      if($icon_type == 'icon') {
        $icon_html = $icon; 
      }
       return $icon_html;
 }
}