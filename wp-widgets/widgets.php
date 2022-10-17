<?php
// Require widget files
require plugin_dir_path(__FILE__) . 'class-widget-contact-support.php';

// Register Widgets
add_action( 'widgets_init', function() {
    register_widget('DdocCore\WP_Widgets\Widget_Support_Ticket');
});