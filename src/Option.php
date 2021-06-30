<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase

namespace ODS;

use ODS\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generate option field
 */
class Option {

	/**
	 * Save all configuratin
	 *
	 * @var array
	 */
	private $options = array();

	/**
	 * Set data value prefix
	 *
	 * @param string $prefix plugin prefix.
	 */
	public function __construct( $prefix = null ) {
		if ( $prefix ) {
			$this->options['prefix'] = $prefix;
		}
	}

	/**
	 * Add admin menu
	 *
	 * @param array $menu menu setting.
	 */
	public function addMenu( $menu ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$this->options['menu'] = $menu;
	}

	/**
	 * Add tab field
	 *
	 * @param string $section section name.
	 */
	public function addTab( $section ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$this->options['tabs']     = true;
		$this->options['sections'] = $section;
	}

	/**
	 * Add text field
	 *
	 * @param string $section section name.
	 * @param array  $option text field option.
	 * @param void   $callback callback function.
	 */
	public function addText( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'text';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add url field
	 *
	 * @param string $section section name.
	 * @param array  $option url field option.
	 * @param void   $callback callback function.
	 */
	public function addUrl( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'url';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add number field
	 *
	 * @param string $section section name.
	 * @param array  $option number field option.
	 * @param void   $callback callback function.
	 */
	public function addNumber( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'number';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add color picker
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addColor( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'color';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add textarea
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addTextarea( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'textarea';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add radio button
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addRadio( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'radio';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add selcet
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addSelect( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'select';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add html
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addHtml( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'html';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add checkbox
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addCheckbox( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'checkbox';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add Multi Select
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addCheckboxes( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'multicheck';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add Post
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param string $posttype post stype.
	 * @param void   $callback callback function.
	 */
	public function addPost( $section, $option, $posttype = 'post', $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type']                 = 'posts';
		$option_default['options']['post_type'] = $posttype;
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add Password
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addPassword( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'password';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add File Uploader
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addFile( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'file';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add Media Uploader
	 *
	 * @param string $section section name.
	 * @param array  $option color picker option.
	 * @param void   $callback callback function.
	 */
	public function addMedia( $section, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$option_default['type'] = 'media';
		$this->append_field( $section, $option_default, $option, $callback );
	}

	/**
	 * Add plugin link
	 *
	 * @param array $slug plugin slug name.
	 * @param array $option link option.
	 */
	public function addLink( $slug, $option ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		$this->options['links']['plugin_basename'] = "{$slug}/{$slug}.php";
		$this->options['links']['action_links']    = $option;
	}

	/**
	 * Call Helper class
	 */
	public function set() {
		new Helper( $this->options );
	}

	/**
	 * Add admin_menu hook
	 */
	public function register() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		add_action( 'admin_menu', array( $this, 'set' ) );
	}

	/**
	 * Add common task
	 *
	 * @param string $section section name.
	 * @param string $option_default field type.
	 * @param array  $option field option.
	 * @param void   $callback callback function.
	 */
	public function append_field( $section, $option_default, $option, $callback = null ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		if ( $callback ) {
			$option_default['callback'] = $callback;
		}
		$this->options['fields'][ $section ][] = array_merge( $option_default, $option );
	}
}

