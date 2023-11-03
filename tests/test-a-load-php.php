<?php

/**
 * @package oik-sc-help
 * @copyright (C) Copyright Bobbing Wide 2023
 *
 * Unit tests to load all the shared library files and other relevant PHP files for PHP 8.2
 */

class Tests_load_libs extends BW_UnitTestCase
{

	/**
	 * set up logic
	 *
	 * - ensure any database updates are rolled back
	 * - we need oik-googlemap to load the functions we're testing
	 */
	function setUp(): void
	{
		parent::setUp();

	}

	function test_load_admin() {
		$this->load_dir_files( 'admin' );
		$this->assertTrue( true );

	}

	function test_load_shortcodes() {
		$this->load_dir_files( 'shortcodes' );
		$this->assertTrue( true );
	}

	function load_dir_files( $dir ) {
		$files = glob( '$dir/*.php');
		foreach ( $files as $file ) {
			oik_require( $file, 'oik-sc-help');
		}
	}

	function test_load_plugin() {
		oik_require( 'oik-sc-help.php', 'oik-sc-help');
		$this->assertTrue( true );
	}

}