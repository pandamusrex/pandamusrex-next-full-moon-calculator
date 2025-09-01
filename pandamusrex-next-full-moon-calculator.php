<?php
/**
 * Plugin Name: PandamusRex Next Full Moon Calculator
 * Version: 1.0.0
 * Plugin URI: https://github.com/pandamusrex/pandamusrex-next-full-moon-calculator
 * Description: PandamusRex Next Full Moon Widget
 * Author: PandamusRex
 * Author URI: https://www.github.com/pandamusrex/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 6.4
 * Requires PHP: 7.0
 * Tested up to: 6.8
 *
 * Text Domain: pandamusrex-next-full-moon-calculator
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author PandamusRex
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once( plugin_dir_path(__FILE__) . 'includes/widget.php' );
require_once( plugin_dir_path(__FILE__) . 'includes/math.php' );

class PandamusRex_Next_Full_Moon_Calculator {
    private static $instance;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}

    public function __wakeup() {}

    public function __construct() {
        add_action( 'widgets_init', [ $this, 'widgets_init' ] );
    }

    public function widgets_init() {
        register_widget( 'PandamusRex_Next_Full_Moon_Widget' );
    }
}

PandamusRex_Next_Full_Moon_Calculator::get_instance();
