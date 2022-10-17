<?php
namespace DroitHead\Includes\Supports;
defined( 'ABSPATH' ) || exit;

abstract class Support{

    abstract public function __construct();

    abstract public function apply_method1();

    abstract public function apply_method2();

    abstract public function replace_header();

    abstract public function replace_header_method2();

    abstract public function replace_footer();

    abstract public function replace_footer_method2();

    public function get_method(){
        return 'method1';
    }

    public function enabled_header( $type = 'header' ){
        return ($this->get_templates($type) != 0) ? true : false;
    }

    public function enabled_footer( $type = 'footer' ){
        return ($this->get_templates($type) != 0) ? true : false;
    }

    public function render_header(){
        if ( false == apply_filters( 'enable_drdt_render_header', true ) ) {
            return;
        }
        $id = $this->get_templates('header');
        $this->css_render($id);
        ?>
        <header class="drdt-header" id="masthead" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
        <?php
        echo drdt_kses_html(\Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id ) );
        ?>
        </header>
        <?php
    }
    
    public function render_header_top(){
        if ( false == apply_filters( 'enable_drdt_render_header_top', true ) ) {
            return;
        }
        $id = $this->get_templates('top_header');
        $this->css_render($id);
        ?>
        <div class="drdt-header-top">
        <?php
        echo drdt_kses_html(\Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id ) );
        ?>
        </div>
        <?php
    }

    public function render_header_bottom(){
        if ( false == apply_filters( 'enable_drdt_render_header_bottom', true ) ) {
            return;
        }
        $id = $this->get_templates('bottom_header');
        $this->css_render($id);
        ?>
        <div class="drdt-header-bottom">
        <?php
        echo drdt_kses_html(\Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id ) );
        ?>
        </div>
        <?php
    }

    public function render_footer(){
        if ( false == apply_filters( 'enable_drdt_render_footer', true ) ) {
            return;
        }
        $id = $this->get_templates('footer');
        $this->css_render($id);
        ?>
        <footer class="drdt-footer" itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
        <?php
        echo drdt_kses_html(\Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id ) );
        ?>
        </footer>
        <?php
    }

    public function render_footer_before(){
        if ( false == apply_filters( 'enable_drdt_render_footer_before', true ) ) {
            return;
        }
        $id = $this->get_templates('before_footer');
        $this->css_render($id);
        ?>
        <div class="drdt-footer-before">
        <?php
        echo drdt_kses_html(\Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id ) );
        ?>
        </div>
        <?php
    }

    public function get_templates( $type = 'header'){
        global $post;
        if( isset($post->ID) ){
            $get = get_post_meta($post->ID, 'dtdr_header_templates_select', true);
            $header = ($get[$type]) ?? 0;
            if( $header != 0 && $header != ''){
                return $header;
            }
        }
        $id = ($post->ID) ?? 0;
        // query templates from heading
        $arg = [
            'post_type' => 'droit-templates',
            'post_status' => 'publish',
            'sort_order' => 'ASC',
            'sort_column' => 'ID,post_title',
        ];
        $page = get_posts( $arg );
        foreach($page as $v){
            if( !isset($v->ID) ){
                continue;
            }
            $get = get_post_meta($v->ID, 'dtdr_header_templates', true);
            
            $typeh = !empty($get['type']) ? $get['type'] : '';
            if ( $typeh == $type ) {
                $display = !empty($get['display']) ? $get['display'] : [];
                $notdisplay = !empty($get['notdisplay']) ? $get['notdisplay'] : [];
                $roles = !empty($get['role']) ? $get['role'] : [];

                // check not display
                if(in_array('singulars', $notdisplay) ){
                    $postType = ($post->post_type) ?? '';
                    if( is_singular( $postType ) ){
                        return 0;
                    }
                }else if(in_array('archives', $notdisplay) ){
                    if( is_archive() ){
                        return 0;
                    }
                } else if(in_array('all_posts', $notdisplay) ){
                    return 0;
                }else if( in_array('entire_website', $notdisplay) ){
                    return 0;
                }else{
                    if(in_array($id, $notdisplay) ){
                        return 0;
                    }
                }

                // check display
               
                if(in_array('singulars', $display) && $this->user_role($roles)  ){
                    $postType = ($post->post_type) ?? '';
                    if( is_singular( $postType ) ){
                        return $v->ID;
                    }
                }
                else if(in_array('archives', $display) && $this->user_role($roles)  ){
                    if( is_archive() ){
                        return $v->ID;
                    }
                } else if(in_array('all_posts', $display) && $this->user_role($roles)  ){
                    return $v->ID;
                } else if( in_array('entire_website', $display) && $this->user_role($roles) ){
                    return $v->ID;
                } else{
                    if(in_array($id, $display) && $this->user_role($roles)  ){
                        return $v->ID;
                    }
                }
            }
        }
        return 0;
    }

    public function user_role( array $check = [] ){
        global $wp_roles;

        if( in_array('logged-in', $check) ){
            return is_user_logged_in() ? true : false;
        }
        else if( in_array('logged-out', $check) ){
            return is_user_logged_in() ? false : true;
        } 
        else if( in_array('all', $check) ){
            return true;
        } else{
            global $wp_roles;
            $roles = array_keys($wp_roles->get_names());
            if( count( array_intersect($check, $roles) ) != 0 ){
                $user = wp_get_current_user();
                if ( in_array( $user->roles, $check) ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function css_render( $id = 0){
        if( $id != 0){
            if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new \Elementor\Core\Files\CSS\Post( $id );
                $css_file->enqueue();
            } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                $css_file = new \Elementor\Post_CSS_File( $id );
                $css_file->enqueue();
            }
        }
        
    }
}