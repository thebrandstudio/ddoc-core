<?php
namespace DdocCore\WP_Widgets;
/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Widget_Support_Ticket extends \WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_support_ticket',
            'description' => esc_html__( 'Your site create support ticket', 'ddoc-core' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ddoc_support_ticket', esc_html__( 'Support Ticket (Theme)', 'ddoc-core' ), $widget_ops );
        $this->alt_option_name = 'widget_recent_entries';
    }

    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     *
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $allowed_tags = array(
            'div' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h4' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h2' => array(
                'class' =>array(),
                'id' => array()
            ),
            'h3' => array(
                'class' =>array(),
                'id' => array()
            ),
        );

        echo wp_kses($args['before_widget'], $allowed_tags);

        $title = isset( $instance['title'] ) ? $instance['title'] : esc_html__('Looking for help contact support?', 'ddoc-core');
        $content = isset( $instance['content'] ) ? $instance['content'] : esc_html__('Welcome to the documentation page of SassLand. Based on the RTF', 'ddoc-core');
        $btn_label = isset( $instance['btn_label'] ) ? $instance['btn_label'] : esc_html__('Create support ticket', 'ddoc-core');
        $btn_url = isset( $instance['btn_url']['url'] ) ? $instance['btn_label']['url'] : '#';
        ?>
        <div class="contact_support_right">
            <h3 class="title"><?php echo esc_html($title) ?></h3>
            <p><?php echo esc_html($content) ?></p>
            <a href="<?php echo esc_url($btn_url) ?>" class="support_btn">
                <?php echo esc_html($btn_label) ?>
            </a>
        </div>
        <?php

        echo wp_kses($args['after_widget'], $allowed_tags);
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title          = isset( $instance['title'] ) ?  $instance['title'] : '';
        $content        = isset( $instance['content'] ) ? $instance['content'] : '';
        $btn_label      = isset( $instance['btn_label'] ) ? $instance['btn_label'] : '';
        $btn_url      = isset( $instance['btn_url'] ) ? $instance['btn_url'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'ddoc-core' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'content' )); ?>"><?php esc_html_e( 'Content:', 'ddoc-core' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'content' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'content' )); ?>" type="text" value="<?php echo esc_attr($content); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'btn_label' )); ?>"><?php esc_html_e( 'Button Label:', 'ddoc-core' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'btn_label' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'btn_label' )); ?>" type="text" value="<?php echo esc_attr($btn_label); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'btn_url' )); ?>"><?php esc_html_e( 'Button URL:', 'ddoc-core' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'btn_url' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'btn_url' )); ?>" type="url" value="<?php echo esc_attr($btn_url); ?>" />
        </p>

        <?php
    }

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']          = sanitize_text_field( $new_instance['title'] );
        $instance['content']        = sanitize_text_field( $new_instance['content'] );
        $instance['btn_label']      = sanitize_text_field( $new_instance['btn_label'] );
        $instance['btn_url']        = sanitize_text_field( $new_instance['btn_url'] );
        return $instance;
    }
}