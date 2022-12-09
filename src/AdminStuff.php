<?php
/*
	Stuff for the Admin interface
*/

namespace MHMPT\PluginWithPreact;

class AdminStuff
{

	public function run()
	{
		add_action('admin_menu', [$this, 'registerAdminPage']);
		add_action('admin_enqueue_scripts', [$this, 'enqueueAdminScripts']);
	}

	public function registerAdminPage()
	{
		add_menu_page(
			_x('Membership Applications', '', ''),
			'Membership Applications',
			'manage_options',
			'sht-membership-price-groups',
			[$this, 'displayAdminPage'],
			'dashicons-groups',
			20
		);
	}

	public function displayAdminPage()
	{
		$page_title = get_admin_page_title();

		echo "<h1>{$page_title}</h1>";
		echo '<div data-soliswiss-registration-list></div>';
	}

	public function enqueueAdminScripts($hook)
	{

		if ($hook === 'toplevel_page_sht-membership-price-groups') {

			$min = '.min';
			if (defined('WP_DEBUG') && WP_DEBUG) {
				$min = '';
			}

			$css_file = "assets/styles/index{$min}.css";

			wp_enqueue_style('mhmpt_soliswiss_registrations_tags', mhmpt_soliswiss_registrations_get_instance()->url . $css_file, false, filemtime(mhmpt_soliswiss_registrations_get_instance()->path . '/' . $css_file));

			// Preact files are always minified
			$js_file = "assets/preact/admin-list.min.js";

			$deps_js = [];

			wp_enqueue_script('preact', mhmpt_soliswiss_registrations_get_instance()->url . 'assets/plugins/preact/preact.min.js', $deps_js, '10.5.12', true);
			$deps_js[] = 'preact';

			wp_enqueue_script('preact-hooks', mhmpt_soliswiss_registrations_get_instance()->url . 'assets/plugins/preact/preact-hooks.min.js', $deps_js, '10.5.12', true);
			$deps_js[] = 'preact-hooks';

			wp_enqueue_script('preact-compat', mhmpt_soliswiss_registrations_get_instance()->url . 'assets/plugins/preact/preact-compat.min.js', $deps_js, '10.5.12', true);
			$deps_js[] = 'preact-compat';

			wp_enqueue_script('mhmpt_soliswiss_registrations_list', mhmpt_soliswiss_registrations_get_instance()->url . $js_file, $deps_js, filemtime(mhmpt_soliswiss_registrations_get_instance()->path . '/' . $js_file), true);

			wp_localize_script('mhmpt_soliswiss_registrations_list', 'api', [
				'root' => get_rest_url(),
				'nonce' => wp_create_nonce('wp_rest'),
				'uid' => get_current_user_id()
			]);

			wp_localize_script('mhmpt_soliswiss_registrations_list', 'mhmpt', [
				'translations' => [
					'hello' => _x('Hallo', '', 'mhmpt_soliswiss_registrations'),
				]
			]);
		}
	}
}
