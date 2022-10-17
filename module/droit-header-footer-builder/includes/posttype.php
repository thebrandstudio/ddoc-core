<?php
namespace DroitHead\Includes;
defined( 'ABSPATH' ) || exit;

class Posttype Extends Common{

    /**
     * instance property
     *
     * @var String
     */
    private static $instance;

    public function __construct(){

        if(current_user_can('manage_options')){

            // create custom posttype
            add_action( 'init', [ $this, 'custom_posttype' ] );
            // add metabox
            add_action( 'add_meta_boxes', [ $this, 'template_type'] );
            // save meta data
            add_action( 'save_post', [ $this, 'save_meta' ] );
            // manage metabox column and column control
            add_action( 'manage_'.$this->posttype.'_posts_custom_column', [ $this, 'column_content' ], 10, 2 );
            add_filter( 'manage_'.$this->posttype.'_posts_columns', [ $this, 'column_set' ] );
            
            // set header anf footer templates for individual pages nad post
            add_action('add_meta_boxes', [ $this, 'render_metabox']);
        }
        
    }

    /**
    * Name: custom_posttype
    * Desc: Create custom post type for Header Footer Builder
    * Params: @void
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function custom_posttype(){
        $labels = [
			'name'               => __( 'Templates', 'droithead' ),
			'singular_name'      => __( 'Templates', 'droithead' ),
			'menu_name'          => __( 'Templates', 'droithead' ),
			'name_admin_bar'     => __( 'Templates', 'droithead' ),
			'add_new'            => __( 'Add New', 'droithead' ),
			'add_new_item'       => __( 'Add New Header, Footer or Block', 'droithead' ),
			'new_item'           => __( 'New Templates', 'droithead' ),
			'edit_item'          => __( 'Edit Header Footer & Blocks Template', 'droithead' ),
			'view_item'          => __( 'View Header Footer & Blocks Template', 'droithead' ),
			'all_items'          => __( 'All Templates', 'droithead' ),
			'search_items'       => __( 'Search Header Footer & Blocks Templates', 'droithead' ),
			'parent_item_colon'  => __( 'Parent Header Footer & Blocks Templates:', 'droithead' ),
			'not_found'          => __( 'No Header Footer & Blocks Templates found.', 'droithead' ),
			'not_found_in_trash' => __( 'No Header Footer & Blocks Templates found in Trash.', 'droithead' ),
		];

		$args = [
			'labels'              => $labels,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-editor-kitchensink',
            'supports'            => [ 'title', 'thumbnail', 'elementor' ],
            'show_in_nav_menus'     => true,
		];
		register_post_type( $this->posttype, $args );
    }

    /**
    * Name: column_set
    * Desc: Set custom column in custom posttype
    * Params: @array $columns
    * Return: @array $columns
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function column_set( $columns ) {
		unset( $columns['date'] );
		$columns['drdt_type'] = __( 'Templates type', 'droithead' );
		$columns['drdt_shortcode'] = __( 'Shortcode', 'droithead' );
		$columns['drdt_display'] = __( 'Display On', 'droithead' );
		$columns['date']      = __( 'Date', 'droithead' );
		return $columns;
    }
    /**
    * Name: column_content
    * Desc: Set custom column content in custom posttype
    * Params 1: @array $column
    * Params 2: @int $post_id
    * Return: @array $columns
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function column_content( $column, $post_id ){

        $data = get_post_meta($post_id, 'dtdr_header_templates', true);
        $html = '';
        $data_404 = get_post_meta($post_id, 'is_droit_404_active', true);
        if( $data_404 == 'yes'){
            $html = '<span class="active-404">Active</span>';
        }

        switch( $column ):

            case 'drdt_type':
                $type = ($data['type']) ?? '';
                $type = !empty($type) ? $this->template_type_array($type) : '';
                echo esc_html( $type );
            break;

            case 'drdt_display':
                $display = ($data['display']) ?? [];
                echo esc_html( implode(' - ', $display) );
                echo  $html;
            break;

            case 'drdt_shortcode':
                ?>
                <span class="dtdr-shortcode dtdr-clipboard" data-clipborad-action="copy" data-clipboard-target=".dtdr-shortcode" aria-label="Copied">
                <?php
                echo drdt_kses_html('[dtdr-template id="'.esc_attr($post_id).'"]');
                ?>
                </span>
                <?php
            break;

        endswitch;

    }

    public function save_meta( $postid ){

        // check autosave action
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// checking nounce action 
		if ( ! isset( $_POST['droitsave_meta_save'] ) || ! wp_verify_nonce( $_POST['droitsave_meta_save'], 'droitsave_meta_nounce' ) ) {
			return;
		}
		// if our current user can't edit this post, bail.
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
        }
        
        if( isset( $_POST['drdtdata'])){
            $options = ($_POST['drdtdata']) ? $_POST['drdtdata'] : [];
            update_post_meta($postid, 'dtdr_header_templates', $options);
        }

        if( isset( $_POST['dtdrselect'])){
            $options = ($_POST['dtdrselect']) ? $_POST['dtdrselect'] : [];
            update_post_meta($postid, 'dtdr_header_templates_select', $options);
        }

        if( isset( $_POST['is_droit_404_active'])){
            update_post_meta($postid, 'is_droit_404_active', $_POST['is_droit_404_active']);
        }

        return $postid;
    }

    public function template_type(){
        add_meta_box( 
            'droti-template-type',
             __( 'Droit Template Settings', 'droithead' ),
            [ $this, 'meta_action'],
            'droit-templates',
            'normal',
            'high'
        );
    }
    public function get_post_type_list () {
        $get_postype = [];
        $args = array(
            'public'   => true,
            '_builtin' => false
         );
           
         $output = 'names'; // 'names' or 'objects' (default: 'names')
         $operator = 'and'; // 'and' or 'or' (default: 'and')
           
         $post_types = get_post_types( $args, $output, $operator );
           
         if ( $post_types ) { // If there are any custom public post types.
             foreach ( $post_types  as $post_type ) {
                $get_postype[$post_type] = $post_type;
             }
         }
         return $get_postype;
        
    }
    public function meta_action( $post ){
        $data = get_post_meta($post->ID, 'dtdr_header_templates', true);
        
        wp_nonce_field( 'droitsave_meta_nounce', 'droitsave_meta_save' );
        
        $type = $this->template_type_array();

        // query all pages
        $pages = $this->all_posts([
            'post_type' => 'page',
            'post_status' => 'publish',
            'sort_order' => 'ASC',
            'sort_column' => 'ID,post_title',
        ]);
        
        // query all post
        $posts = $this->all_posts([
            'post_type' => 'post',
            'post_status' => 'publish',
            'sort_order' => 'ASC',
            'sort_column' => 'ID,post_title',
        ]);


        $display = apply_filters('drdt_head_template_display', [
            ''               => __('Select', 'droithead'),
            'entire_website' => __('Entire Website', 'droithead'),
            'front_page'     => __('Front Page', 'droithead'),
            'home_page'      => __('Blog Page', 'droithead'),
            'all_page'       => __('All Pages', 'droithead'),
            'single_block'   => __('All Single Post', 'droithead'),
            'archives'       => __('All Archives', 'droithead'),
            'category'       => __('All Category', 'droithead'),
            'four_0_4'       => __('404', 'droithead'),
            'search'         => __('Search', 'droithead'),
            'pages' => [ 
                'title' => __('Pages', 'droithead'),
                'options' => $pages
            ],
            'post' => [ 
                'title' => __('Posts', 'droithead'),
                'options' => $posts
            ],
            'custom_postype' => [ 
                'title' => __('Custom Postype', 'droithead'),
                'options' => $this->get_post_type_list()
            ],
        ]);

        global $wp_roles;
        $roles = $wp_roles->get_names();
        //print_r($roles); exit;
        $userrole = apply_filters('drdt_head_template_role', [
            'all' => __('All', 'droithead'),
            'logged-in' => __('Logged In', 'droithead'),
            'logged-out' => __('Logged Out', 'droithead'),
            'advanced' => [ 
                'title' => __('Advanced', 'droithead'),
                'options' => $roles
            ],

        ]);

        //  include meta files
        include_once( __DIR__ . '/views/posttype-settings-meta.php');
    }


    /**
    * Name: render_metabox
    * Desc: Render meta data into edit post page.
    * Params: @void
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */

    public function render_metabox( ){
        global $post;
       
        if($post->post_type == 'droit-templates') {
            return;
        }
        add_meta_box( 
            'droti-template-select',
             __( 'Droit Template', 'droithead' ),
            [ $this, 'meta_action_select'],
            $this->working_posttype(),
            'side',
            'high'
        );
    }


    public function meta_action_select( $post ){

        $data = get_post_meta($post->ID, 'dtdr_header_templates_select', true);

        wp_nonce_field( 'droitsave_meta_nounce', 'droitsave_meta_save' );

        $tem = $this->all_posts([
            'post_type' => $this->posttype,
            'post_status' => 'publish',
            'sort_order' => 'ASC',
            'sort_column' => 'ID,post_title',
            'meta_query' => [
                'key'     => 'dtdr_header_templates',
                'value'   => 'header',
                'compare' => 'IN'
            ]
        ]);
        ?>        
        <div class="droit-templates-meta">
           <label for="drdt_template_head_select">
                <?php echo esc_html__('Header Templates', 'droithead'); ?>
           </label>
           <select name="dtdrselect[header]" id="drdt_template_head_select">
               <option value=""><?php echo esc_html__('Default', 'droithead'); ?></option>
                <?php
                foreach($tem as $k=>$v ){
                    if( $k == 0){
                        continue;
                    }
                    $selected = selected( ($data['header']) ?? '', $k, 'selected');
                    ?>
                    <option value="<?php echo esc_attr($k);?>" <?php echo esc_attr($selected); ?> ><?php echo esc_html($v);?></option>
                    <?php
                }
                ?>
           </select>
         
        </div>

        <div class="droit-templates-meta">
           <label for="drdt_template_foot_select">
           <?php echo esc_html__('Footer Templates', 'droithead'); ?>
           </label>
           <select name="dtdrselect[footer]" id="drdt_template_foot_select">
               <option value=""><?php echo esc_html__('Default', 'droithead'); ?></option>
               <?php
                foreach($tem as $k=>$v ){
                    if( $k == 0){
                        continue;
                    }
                    $selected = selected( ($data['footer']) ?? '', $k, 'selected');
                    ?>
                   <option value="<?php echo esc_attr($k);?>" <?php echo esc_attr($selected); ?> ><?php echo esc_html($v);?></option>
                   <?php
                }
                ?>
           </select>
         
        </div>

        <?php
    }

    public static function _instance(){
        if( is_null(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}