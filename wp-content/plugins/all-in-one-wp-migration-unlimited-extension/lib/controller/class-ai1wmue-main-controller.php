<?php
/**
 * Copyright (C) 2014-2018 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

class Ai1wmue_Main_Controller {

	/**
	 * Main Application Controller
	 *
	 * @return Ai1wmue_Main_Controller
	 */
	public function __construct() {
		register_activation_hook( AI1WMUE_PLUGIN_BASENAME, array( $this, 'activation_hook' ) );

		// Activate hooks
		$this->activate_actions()
			->activate_filters()
			->activate_textdomain();
	}

	/**
	 * Activation hook callback
	 *
	 * @return Object Instance of this class
	 */
	public function activation_hook() {

	}

	/**
	 * Initializes language domain for the plugin
	 *
	 * @return Object Instance of this class
	 */
	private function activate_textdomain() {
		load_plugin_textdomain( AI1WMUE_PLUGIN_NAME, false, false );

		return $this;
	}

	/**
	 * Register listeners for actions
	 *
	 * @return Object Instance of this class
	 */
	private function activate_actions() {
		// Init
		add_action( 'admin_init', array( $this, 'init' ) );

		// All in One WP Migration
		add_action( 'plugins_loaded', array( $this, 'ai1wm_loaded' ) );

		return $this;
	}

	/**
	 * Register listeners for filters
	 *
	 * @return Object Instance of this class
	 */
	private function activate_filters() {
		add_filter( 'ai1wm_max_file_size', array( $this, 'max_file_size' ) );

		// Add links to plugin list page
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 5, 2 );

		return $this;
	}

	/**
	 * Check whether All in one WP Migration is loaded
	 *
	 * @return void
	 */
	public function ai1wm_loaded() {
		if ( ! defined( 'AI1WM_PLUGIN_NAME' ) ) {
			if ( is_multisite() ) {
				add_action( 'network_admin_notices', array( $this, 'ai1wm_notice' ) );
			} else {
				add_action( 'admin_notices', array( $this, 'ai1wm_notice' ) );
			}
		}
	}

	/**
	 * Display All in one WP Migration notice
	 *
	 * @return void
	 */
	public function ai1wm_notice() {
		?>
		<div class="error">
			<p>
				<?php
				_e(
					'Unlimited extension requires <a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">All-in-One WP Migration plugin</a> to be activated. ' .
					'<a href="https://help.servmask.com/knowledgebase/install-instructions-for-unlimited-extension/" target="_blank">Unlimited extension install instructions</a>',
					AI1WMUE_PLUGIN_NAME
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Add links to plugin list page
	 *
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( $file == AI1WMUE_PLUGIN_BASENAME ) {
			$links[] = Ai1wm_Template::get_content( 'main/user-guide', array(), AI1WMUE_TEMPLATES_PATH );
		}

		return $links;
	}

	/**
	 * Max file size callback
	 *
	 * @return string
	 */
	public function max_file_size() {
		return AI1WMUE_MAX_FILE_SIZE;
	}

	/**
	 * Register initial parameters
	 *
	 * @return void
	 */
	public function init() {
		// Set Purchase ID
		if ( ! get_option( 'ai1wmue_plugin_key' ) ) {
			update_option( 'ai1wmue_plugin_key', AI1WMUE_PURCHASE_ID );
		}
	}
}
