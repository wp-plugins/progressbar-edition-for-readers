<?php
/*
	Plugin Name: Progressbar (Edition for Readers)
	Plugin URI: http://wordpress.org/extend/plugins/progressbar-edition-for-readers/
	Description: This plugin indicates progress made on books.
	Version: 0.7.1
	Author: Janine Große-Beck
	Author URI: http://www.paperthin.de
	Last Updated: 2015-08-08
	License: GPLv2 or later

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

	define('PROGRESSBAR_READERS_PLUGIN_URL', plugin_dir_url(__FILE__));
	define('PROGRESSBAR_READERS_PLUGIN_BASENAME', plugin_basename(__FILE__));
	define('PROGRESSBAR_READERS_PLUGIN_NAME', basename(__FILE__));
	define('PROGRESSBAR_READERS_MEDIA_UPLOAD', 'progressbarMediaUpload');

	include_once('settings.php');
	$progressbarSettings = new ProgressbarSettings();
	
	include_once('widget.php'); 
	
	
	if(is_admin()) {
		require('dashboard.php');
		
		/**
		 * Adds the scripts to be able to use media-upload, thickbox and jquery.
		 * It also adds the custom media-upload.js script.
		 */
		function progressbar_readers_admin_scripts() {
            if(function_exists( 'wp_enqueue_media' )){
				wp_enqueue_script('editor');
				wp_register_script(PROGRESSBAR_READERS_MEDIA_UPLOAD, plugins_url('media-upload-3_5.js', __FILE__));
			} else {
				wp_enqueue_script('jquery');
				wp_enqueue_script('thickbox');
				wp_enqueue_script('media-upload');
				wp_enqueue_style('thickbox');
				wp_register_script(PROGRESSBAR_READERS_MEDIA_UPLOAD, plugins_url('media-upload.js', __FILE__));
			}
		}
			
		/**
		 * registers some plugin specific stylesheets used in the dashboard and sidebar widgets.
		 */
		function progressbar_readers_admin_enqueue_styles() {
			wp_register_style('dashboard_progressbar_style', plugins_url('style.css', __FILE__) );
	        wp_enqueue_style('dashboard_progressbar_style');
		}
	
		/**
		 * Adds the actions to the wordpress plugin hook add_action.
		 */
//		add_action('admin_print_scripts', 'progressbar_readers_admin_scripts');
		add_action('init', 'progressbar_readers_admin_scripts');
//		add_action('admin_print_styles', 'progressbar_readers_admin_styles');
		add_action('admin_enqueue_styles', 'progressbar_readers_admin_enqueue_styles');
	}
?>
