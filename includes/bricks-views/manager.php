<?php
/**
 * Bricks views manager
 */
namespace Jet_Smart_Filters\Bricks_Views;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define Manager class
 */
class Manager {

	/**
	 * Elementor Frontend instance
	 *
	 * @var null
	 */
	public $frontend = null;

	/**
	 * Constructor for the class
	 */
	function __construct() {

		if ( ! $this->has_bricks() ) {
			return;
		}

		add_action( 'init', array( $this, 'register_elements' ), 11 );

	}

	public function component_path( $relative_path = '' ) {
		return jet_smart_filters_bricks()->plugin_path( 'includes/bricks-views/' . $relative_path );
	}

	public function register_elements() {
		require $this->component_path( 'elements/base.php' );

		$element_files = array(
			$this->component_path( 'elements/pagination.php' ),
			$this->component_path( 'elements/select.php' ),
			$this->component_path( 'elements/check-range.php' ),
			$this->component_path( 'elements/checkboxes.php' ),
			$this->component_path( 'elements/radio.php' ),
			$this->component_path( 'elements/range.php' ),
			$this->component_path( 'elements/date-range.php' ),
			$this->component_path( 'elements/active-filters.php' ),
			$this->component_path( 'elements/active-tags.php' ),
			$this->component_path( 'elements/alphabet.php' ),
		);

		foreach ( $element_files as $file ) {
			\Bricks\Elements::register_element( $file );
		}

	}

	public function has_bricks() {
		return defined( 'BRICKS_VERSION' );
	}

}