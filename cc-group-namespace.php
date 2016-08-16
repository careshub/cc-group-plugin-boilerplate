<?php
/**
 * Extras for the GroupName hub.
 *
 * @package   GroupName
 * @author    AuthorName
 * @license   GPL-2.0+
 * @link      http://www.communitycommons.org
 * @copyright 2016 Community Commons
 *
 * @wordpress-plugin
 * Plugin Name:       GroupName
 * Plugin URI:        @TODO
 * Description:       Adds custom hub functionality to CC site
 * Version:           1.0.0
 * Author:            AuthorName
 * Text Domain:       cc-group-namespace
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/careshub/cc-group-namespace
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

function group_namespace_class_init() {

	// Helper functions
	require_once( plugin_dir_path( __FILE__ ) . 'includes/nyscaa-functions.php' );

	// Template output functions
	require_once( plugin_dir_path( __FILE__ ) . 'public/views/template-tags.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'public/views/shortcodes.php' );

	// The main class
	require_once( plugin_dir_path( __FILE__ ) . 'public/class-cc-group-namespace.php' );

	// Admin and dashboard functionality
	if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		require_once( plugin_dir_path( __FILE__ ) . 'admin/class-cc-group-namespace-admin.php' );
		add_action( 'bp_include', array( 'CC_GroupName_Admin', 'get_instance' ), 21 );
	}

}
add_action( 'bp_include', 'group_namespace_class_init' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-cc-group-namespace-activator.php';
register_activation_hook( __FILE__, array( 'CC_GroupName_Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'CC_GroupName_Activator', 'deactivate' ) );

/*
 * Helper function.
 * @return Fully-qualified URI to the root of the plugin.
 */
function group_namespace_get_plugin_base_uri(){
	return plugin_dir_url( __FILE__ );
}

/*
 * Helper function.
 * @TODO: Update this when you update the plugin's version above.
 *
 * @return string Current version of plugin.
 */
function group_namespace_get_plugin_version(){
	return '1.0.0';
}