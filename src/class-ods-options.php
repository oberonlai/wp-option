<?php

namespace ODS;

use ODS\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Option {

	private $options = array();

	public function __construct( $prefix = null ) {
		if ( $prefix ) {
			$this->options['prefix'] = $prefix;
		}
	}

	public function addTab( $section = null ) {
		$this->options['tabs']     = true;
		$this->options['sections'] = $section;
	}

	public function addMenu( $menu ) {
		$this->options['menu'] = $menu;
	}

	public function set() {
		return new Helper( $this->options );
	}
	public function register() {
		add_action( 'admin_menu', array( $this, 'set' ) );
	}
}

