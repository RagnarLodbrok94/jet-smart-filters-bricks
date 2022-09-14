<?php
/**
 * Plugin Name: JetSmartFilters for Bricks
 * Plugin URI:  https://crocoblock.com/plugins/jetsmartfilters/
 * Description: Adds easy-to-use AJAX filters to the pages built with Elementor which contain the dynamic listings.
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-smart-filters
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// If class `Jet_Smart_Filters_Bricks` doesn't exists yet.
if ( ! class_exists( 'Jet_Smart_Filters_Bricks' ) ) {

	/**
	 * Sets up and initializes the plugin.
	 */
	class Jet_Smart_Filters_Bricks {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Holder for base plugin path
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_path = null;

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'init' ), -999 );
		}

		/**
		 * Manually init required modules.
		 *
		 * @return void
		 */
		public function init() {

			require $this->plugin_path( 'includes/bricks-views/manager.php' );

			new \Jet_Smart_Filters\Bricks_Views\Manager();
		}

		/**
		 * Check if theme has elementor
		 *
		 * @return boolean
		 */
		public function has_elementor() {
			return defined( 'ELEMENTOR_VERSION' );
		}

		/**
		 * Returns path to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

if ( ! function_exists( 'jet_smart_filters_bricks' ) ) {

	/**
	 * Returns instanse of the plugin class.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	function jet_smart_filters_bricks() {
		return Jet_Smart_Filters_Bricks::get_instance();
	}

}

jet_smart_filters_bricks();
