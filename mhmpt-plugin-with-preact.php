<?php
/*
 * Plugin Name: BASE PLUGIN WITH REACT FOR DEVELOPMENT
 * Plugin URI: https://github.com/markhowellsmead/mhmpt-plugin-with-preact
 * Description: Tools for Soliswiss to manage member registrations. Minimal version 2022, most functionality remains in the Theme soliswiss-web.
 * Text Domain: mhmpt_plugin_with_preact
 * Author: Mark Howells-Mead
 * Version: 0.0.1
 * Requires at least: 6.1
 * Requires PHP: 8.0
 * Author URI: https://permanenttourist.ch/wordpress/
 * Update path: https://github.com/markhowellsmead/mhmpt-plugin-with-preact
*/

spl_autoload_register(function ($class) {

	// project-specific namespace prefix
	$prefix = 'MHMPT\\PluginWithPreact\\';

	// base directory for the namespace prefix
	$base_dir = __DIR__ . '/src/';

	// does the class use the namespace prefix?
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}

	// get the relative class name
	$relative_class = substr($class, $len);

	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

	// if the file exists, require it
	if (file_exists($file)) {
		require $file;
	}
});

require_once 'src/Plugin.php';

function mhmpt_plugin_with_preact_get_instance()
{
	return MHMPT\PluginWithPreact\Plugin::getInstance(__FILE__);
}

mhmpt_plugin_with_preact_get_instance();
