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

		add_filter( 'bricks/builder/i18n', function( $i18n ) {
			$i18n['jetsmartfilters'] = esc_html__( 'JetSmartFilters', 'jet-engine' );

			return $i18n;
		} );

		// Add JetSmartFilters icons font
		add_action( 'wp_enqueue_scripts', function() {
			// Enqueue your files on the canvas & frontend, not the builder panel. Otherwise custom CSS might affect builder)
			if ( bricks_is_builder() ) {
				wp_enqueue_style(
					'jet-smart-filters-icons-font',
					jet_smart_filters()->plugin_url( 'assets/css/lib/jet-smart-filters-icons/jet-smart-filters-icons.css' ),
					array(),
					jet_smart_filters()->get_version()
				);
			}
		} );

	}

	public function component_path( $relative_path = '' ) {
		return jet_smart_filters_bricks()->plugin_path( 'includes/bricks/' . $relative_path );
	}

	public function register_elements() {
		require $this->component_path( 'elements/base.php' );
		require $this->component_path( 'elements/base-checkbox.php' );

		$element_files = array(
//			$this->component_path( 'elements/active-filters.php' ),
//			$this->component_path( 'elements/active-tags.php' ),
			$this->component_path( 'elements/alphabet.php' ),
//			$this->component_path( 'elements/apply-button.php' ),
			$this->component_path( 'elements/check-range.php' ),
			$this->component_path( 'elements/checkboxes.php' ),
			$this->component_path( 'elements/color-image.php' ),
			$this->component_path( 'elements/date-period.php' ),
//			$this->component_path( 'elements/date-range.php' ),
			$this->component_path( 'elements/pagination.php' ),
			$this->component_path( 'elements/radio.php' ),
			/*$this->component_path( 'elements/range.php' ),
			$this->component_path( 'elements/rating.php' ),
			$this->component_path( 'elements/remove-filters.php' ),*/
			$this->component_path( 'elements/select.php' ),
			/*$this->component_path( 'elements/search.php' ),
			$this->component_path( 'elements/sorting.php' ),*/
		);

		foreach ( $element_files as $file ) {
			\Bricks\Elements::register_element( $file );
		}

	}

	public function has_bricks() {
		return defined( 'BRICKS_VERSION' );
	}

}