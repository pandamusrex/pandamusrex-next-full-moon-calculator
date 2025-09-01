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

        $num_days_until_next_full_moon = PandamusRex_Next_Full_Moon_Math::getNumDaysUntilNextFullMoon();

        if ( $num_days_until_next_full_moon == 0 ) {
            $big_text = __( 'Today!', 'pandamusrex-next-full-moon-calculator' );
            $sub_text = __( 'Today is the next full moon! Awooo!', 'pandamusrex-next-full-moon-calculator' );
        } else {
            $big_text = sprintf(
                __( '%d Days', 'pandamusrex-next-full-moon-calculator' ),
                $num_days_until_next_full_moon
            );
            $sub_text = __( 'Until the next full moon. Rawr.', 'pandamusrex-next-full-moon-calculator' );
        }

        echo '<p class="pandamusrex-next-full-moon-big-text">';
        echo esc_html( $big_text );
        echo '</p>';
        echo '<p class="pandamusrex-next-full-moon-sub-text">';
        echo esc_html( $sub_text );
        echo '</p>';

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