<?php
/**
 * Plugin Name: WP Notepad
 * Description: It is a plug-in that displays a notepad on the widget. The data is saved in LocalStorage in the browser, so you can use it easily without login.
 * Version: 1.1.1
 * Author: Redwoodcity Inc.
 * Author URI: https://www.redwoodcity.jp/
 * Plugin URI: https://www.redwoodcity.jp/app/wpnotepad/
 * Text Domain: rwc-wpnotepad
 * Domain Path: /languages
 * License: GPLv2 or later
 */

require_once( 'includes/plugin.php' );
require_once( 'includes/class.wpnotepad_widget.php' );

function rwcwpnotepad_register_widget() {
	register_widget( "RWC\WPNotepad\WPNotepad_Widget" );
}

add_action( 'widgets_init', 'rwcwpnotepad_register_widget' );

//function rwcwpnotepad_register_block() {
//	register_block_type( __DIR__ . '/blocks/wpnotepad' );
//}
//
//add_action( 'init', 'rwcwpnotepad_register_block' );
