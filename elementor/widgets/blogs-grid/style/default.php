<?php 
    $settings = $this->get_settings();
    extract($settings);
    $settings['widget_id'] = $this->get_id();
    $blog_grid = \DROIT_ELEMENTOR_PRO\Module\Query\Grid_Query::getInstance();

    $blog_grid->set_widget_settings($settings);
    $query = $blog_grid->get_query_posts();
    if ( ! $query->have_posts() ) {
        $query_notice = $settings['empty_query_text'];
        $this->get_empty_query_message( $query_notice );
        return;
    }
    if ( 'yes' === $settings['_dl_pro_blog_grid_paging'] ) {

        $total_pages = $query->max_num_pages;

        if ( ! empty( $settings['_dl_pro_blog_max_pages'] ) ) {
            $total_pages = min( $settings['_dl_pro_blog_max_pages'], $total_pages );
        }
    }
    $this->add_render_attribute(
        'blog_wrap',
        [
            'class'         => 'dl_grid_row  dl__blog--grid-wrapper',
        ]
    );
    $this->add_render_attribute(
        'blog',   
        [
            'class'         => 'dl__blog--grid-inner',
        ]
    );
    $page_id = '';
    if ( null !== \Elementor\Plugin::$instance->documents->get_current() ) {
        $page_id = \Elementor\Plugin::$instance->documents->get_current()->get_main_id();
    }
    $this->add_render_attribute( 'blog', 'data-page', $page_id );

    if ( 'yes' === $settings['_dl_pro_blog_grid_paging'] && $total_pages > 1 ) {
        $pagi_ajax_enable = 'yes' === $settings['_dl_pro_blog_pagination_ajax'] ? true : false;
        $this->add_render_attribute( 'blog', 'data-pagination', $pagi_ajax_enable );

    }
?>
<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'blog_wrap' ) ); ?>>
    <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'blog' ) ); ?>>
        <?php 
            $id = $this->get_id();
            $blog_grid->render_posts();
         ?>
    </div>
    <?php if ( 'yes' === $settings['_dl_pro_blog_grid_paging'] && $total_pages > 1 ) : ?>
        <div class="dl-grid-blog-pagination dl-grid-pagination">
            <?php $blog_grid->render_pagination(); ?>
        </div>
    <?php  endif; ?>
</div>