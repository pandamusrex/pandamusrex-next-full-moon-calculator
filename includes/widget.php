<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PandamusRex_Next_Full_Moon_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            false,
            __( 'Next Full Moon', 'pandamusrex-next-full-moon-calculator'
            )
        );
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );

        $title  = $instance['title'];
        $title  = apply_filters( 'widget_title', $title );

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        echo esc_html__(
            "XX days until the next full moon!",
            'pandamusrex-next-full-moon-calculator'
        );

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }

    function form( $instance ) {
        $defaults = [];
        $instance = wp_parse_args( (array) $instance, $defaults );

        $title_field_ID    = $this->get_field_id( 'title' );
        $title_field_name  = $this->get_field_name( 'title' );
        $title_field_value = $instance['title'];
        $title_field_value = htmlspecialchars( $title_field_value, ENT_QUOTES );

        echo '<p>';
        echo '<label for="' .
            esc_attr( $title_field_ID ) .
            '">' .
            esc_html__( 'Title:', 'pandamusrex-next-full-moon-calculator' ) .
            '</label>';
        echo '<input type="text" id="' .
            esc_attr( $title_field_ID ) .
            '" name="' .
            esc_attr( $title_field_name ) .
            '" value="' .
            esc_attr( $title_field_value ) .
            '"/>';
        echo '</p>';
	}
}