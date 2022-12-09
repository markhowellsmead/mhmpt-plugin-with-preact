<?php

namespace MHMPT\PluginWithPreact;

class Plugin
{
	private static $instance;

	public $name = '';
	public $version = '';
	public $file = '';

	public $admin_stuff = null;
	public $api = null;

	/**
	 * Creates an instance if one isn't already available,
	 * then return the current instance.
	 *
	 * @param  $file The file from which the class is being instantiated.
	 *
	 * @return object       The class instance.
	 */
	public static function getInstance($file)
	{
		if (!isset(self::$instance) && !(self::$instance instanceof Plugin)) {
			if (!function_exists('get_plugin_data')) {
				require_once(ABSPATH . 'wp-admin/includes/plugin.php');
			}

			$data = get_plugin_data($file);
			self::$instance = new Plugin;
			self::$instance->name = $data['Name'];
			self::$instance->version = $data['Version'];
			self::$instance->file = $file;
			self::$instance->path = plugin_dir_path($file);
			self::$instance->url = plugin_dir_url($file);
			self::$instance->run();
		}

		return self::$instance;
	}

	public function run()
	{
		add_action('plugins_loaded', [$this, 'loadPluginTextdomain']);

		require_once 'AdminStuff.php';
		mhmpt_plugin_with_preact_get_instance()->admin_stuff = new AdminStuff();
		mhmpt_plugin_with_preact_get_instance()->admin_stuff->run();
	}

	public function loadPluginTextdomain()
	{
		load_plugin_textdomain('mhmpt_plugin_with_preact', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}
}
