<?php
// public function core
if( !function_exists('drdt_th_core')){
    function drdt_th_core(){
        $obj = new \stdClass();
        $obj->self = \TH_ESSENTIAL\DRTH_Plugin::instance();
        $obj->version = \TH_ESSENTIAL\DRTH_Plugin::version();
        $obj->url = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url();
        $obj->dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir();
        $obj->assets = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/';
        $obj->js = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/js/';
        $obj->css = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/css/';
        $obj->vendor = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/vendor/';
        $obj->images = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'assets/images/';
        $obj->elementor = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'elementor/';
        $obj->elementor_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'elementor/';
        $obj->framework = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'framework/';
        $obj->framework_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'framework/';
        $obj->posttype = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'posttype/';
        $obj->posttype_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'posttype/';
        $obj->core = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_url() . 'core/';
        $obj->core_dir = \TH_ESSENTIAL\DRTH_Plugin::dtdr_th_dir() . 'core/';
    
        $obj->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        $obj->minify = '.min';
        
        return $obj;
    }
}
/**
 * @package Ajax doc search
 * @since 1.0.0
 */

if(!function_exists('ddoc_search_doc')){
    add_action( 'wp_ajax_ddoc_search_doc', 'ddoc_search_doc' );
    add_action( 'wp_ajax_nopriv_ddoc_search_doc', 'ddoc_search_doc' );
    function ddoc_search_doc() {
    if( $_POST['keyword'] == '') {
            wp_die();
        }
        $args = [
            's' => $_POST['keyword'],
            'post_type' => 'docs'
        ];
        if($_POST['cat'] != ''){
            $args['tax_query'] = [[
                'taxonomy' => 'doc-category',
                'field'    => 'id',
                'terms'    => $_POST['cat'],
            ]];
        }
      
        $query = new WP_Query( $args );
        if($query->have_posts()){
            while ($query->have_posts()) { $query->the_post();
                the_title('<a href="'.esc_attr(get_the_permalink(get_the_ID())).'" class="list-group-item list-group-item-action">', '<a/>');
            }
        }else{
            echo esc_html__('Nothing found with this search..', 'ddoc-core');
        }
        wp_die();
    }
}
 // register custom taxonomy for ddoc

 function ddoc_custom_category() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Categories', 'textdomain' ),
        'all_items'         => __( 'All Categories', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'textdomain' ),
        'menu_name'         => __( 'Category', 'textdomain' ),
    );
    $rewrite = [
        'slug'         => 'doc-category',
        'with_front'   => true,
    ];
 
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
        'rewrite'           => $rewrite,
    );
 
    register_taxonomy( 'doc-category', array( 'docs' ), $args );
 }
 add_action( 'init', 'ddoc_custom_category');
function add_cat(){
    add_submenu_page( 'wedocs', __( 'Categories', 'wedocs' ), __( 'Categories', 'wedocs' ), 'manage_categories', 'edit-tags.php?taxonomy=doc-category&post_type=docs' );
}
add_action('admin_menu', 'add_cat');


function get_doc_category_in_options() {
    $terms = get_terms( 'doc-category', array(
        'hide_empty' => true,
    ) );
    $list_get = '';
    foreach($terms as $list) {
       $list_get .= '<option value="'.$list->term_id.'">'.$list->name.'</option>';
    } 
    return   $list_get;
}

// login ajax action
add_action( 'wp_ajax_nopriv_ddoc_ajax_login_form', 'ddoc_ajax_login_form' );
add_action( 'wp_ajax_ddoc_ajax_login_form', 'ddoc_ajax_login_form' );
function ddoc_ajax_login_form() {
    check_ajax_referer( 'dlth_theme_widget_nonce', 'security' );

    if($_POST['user_data']['userEmail'] == ''){
        $error['useremail'] = esc_html__('Please enter valid user name', 'ddoc-core');
    }elseif(!username_exists( $_POST['user_data']['userEmail'] )){
        $error['userPass'] = esc_html__('User Not Exist', 'ddoc-core');
    }

    if($_POST['user_data']['userPass'] == ''){
        $error['userPass'] = esc_html__('Passward not valid', 'ddoc-core');
    }


    if(($_POST['user_data']['userPass'] != '') && $_POST['user_data']['userEmail'] != ''){

        $creds = [];
        $creds['user_login'] = sanitize_user($_POST['user_data']['userEmail']);
        $creds['user_password'] = $_POST['user_data']['userPass'];
        $creds['remember'] = $_POST['user_data']['remember'];

        $user = wp_signon( $creds, false );
        
        $userID = $user->ID;

        if($userID){
            $error['login_success'] = esc_html__('Login Successfull', 'ddoc-core');
            $error['login_success_url'] = admin_url();
        }else{
            $error['login_success'] = esc_html__('User name or password dose not match', 'ddoc-core');
        }

    }
   echo wp_json_encode($error);
 wp_die();
}

add_action( 'wp_ajax_nopriv_ddoc_ajax_registraion_form', 'ddoc_ajax_registraion_form' );
add_action( 'wp_ajax_ddoc_ajax_registraion_form', 'ddoc_ajax_registraion_form' );
function ddoc_ajax_registraion_form() {
    check_ajax_referer( 'dlth_theme_widget_nonce', 'security' );
    $_doc_error = [];
    if(empty($_POST['user_data']['user_pass'])) {
        $_doc_error[] = __('Password is required', 'ddoc-core');
    }
    if(empty($_POST['user_data']['user_login'])) {
        $_doc_error[] = __('User Name Is Required', 'ddoc-core');
    }
    if(empty($_POST['user_data']['user_email'])) {
        $_doc_error[] = __('Email Is Required', 'ddoc-core');
    }
    if(!empty($_POST['user_data']['user_email']) && !is_email($_POST['user_data']['user_email'])) {
        $_doc_error[] = __('Email Not Valid', 'ddoc-core');
    }
    if(!empty($_doc_error)){
        echo wp_json_encode($_doc_error);
        wp_die();
    }

    $userdata = array(
        'display_name' =>  sanitize_text_field($_POST['user_data']['dispaly_name']),
        'user_login'   =>  sanitize_user($_POST['user_data']['user_login']),
        'user_email'   =>  sanitize_email($_POST['user_data']['user_email']),
        'user_pass'    =>  $_POST['user_data']['user_pass'],
    );

     $user_id = wp_insert_user( $userdata ) ;
     
    if ( ! is_wp_error( $user_id ) ) {
        $_doc_error[] =  esc_html__('Registration Success', 'ddoc-core');
    }else{
        $error_code = array_key_first( $user_id->errors );
        $_doc_error[] = $user_id->errors[$error_code][0];
    }

    echo wp_json_encode($_doc_error);

    wp_die();
 }

/**
 * Video Meta Boxes
 */

//Register Meta box
add_action( 'add_meta_boxes', function() {
    add_meta_box( 'video-docs', 'Video link', 'video_docs_field_cb', 'video-docs', 'side' );
} );

//Meta callback function
function video_docs_field_cb( $post ) {
    $meta_val = get_post_meta( $post->ID, 'video_docs_url', true );
    ?>
    <input type="text" name="video_docs_url" value="<?php echo esc_attr( $meta_val ) ?>" style="width: 100%">
    <?php
}

//save meta value with save post hook
add_action( 'save_post', function( $post_id ) {
    if ( isset( $_POST['video_docs_url'] ) ) {
        update_post_meta( $post_id, 'video_docs_url', $_POST['video_docs_url'] );
    }
} );