<?php
/*
Plugin Name: WordPress File Monitor Plus
Plugin URI: http://l3rady.com/projects/wordpress-file-monitor-plus/
Description: Monitor your website for added/changed/deleted files
Author: Scott Cariss
Version: 3.0
Author URI: http://l3rady.com/
Text Domain: wordpress-file-monitor-plus
Domain Path: /languages
*/

/*  Copyright 2013  Scott Cariss  (email : scott@l3rady.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Not a WordPress context? Stop.
!defined( 'ABSPATH' ) and exit;

global $current_blog;

// Only allow WPFMP to run on single sites or on a multisite if on current blog id.
if ( !is_multisite() || ( defined( "BLOG_ID_CURRENT_SITE" ) && is_multisite() && $current_blog->blog_id == BLOG_ID_CURRENT_SITE ) ) {
	// Define the permission to see/read/remove admin alert if not already set in config
	if ( !defined( 'SC_WPFMP_ADMIN_ALERT_PERMISSION' ) ) {
		// If multisite then only allow network admins the permission to see alerts.
		if ( is_multisite() ) {
			define( 'SC_WPFMP_ADMIN_ALERT_PERMISSION', 'manage_network_options' );
		}
		else {
			define( 'SC_WPFMP_ADMIN_ALERT_PERMISSION', 'manage_options' );
		}
	}

	define( 'SC_WPFMP_PLUGIN_FILE', __FILE__ );
	define( 'SC_WPFMP_PLUGIN_FOLDER', dirname( SC_WPFMP_PLUGIN_FILE ) );

	require SC_WPFMP_PLUGIN_FOLDER . '/classes/wpfmp.class.php';
	require SC_WPFMP_PLUGIN_FOLDER . '/classes/wpfmp.settings.class.php';
	require SC_WPFMP_PLUGIN_FOLDER . '/functions/compatability.php';

	sc_WordPressFileMonitorPlus::init();
	sc_WordPressFileMonitorPlusSettings::init();
}