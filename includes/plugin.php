<?php

namespace RWC\WPNotepad;

class PLUGIN {

	const PLUGIN_NAME = 'WP Notepad';
	const PLUGIN_DIR = 'wp-notepad';
	const TEXTDOMAIN = 'rwc-wpnotepad';
	const LANGUAGE_DIR = 'languages';
	const PLUGIN_BASEFILE = WP_PLUGIN_DIR . '/' . self::PLUGIN_DIR . '/' . self::TEXTDOMAIN . '.php';
}

load_plugin_textdomain( PLUGIN::TEXTDOMAIN, false, dirname( plugin_basename( PLUGIN::PLUGIN_BASEFILE ) ) . '/' . PLUGIN::LANGUAGE_DIR );
