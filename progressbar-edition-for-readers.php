<?php
/*
	Plugin Name: Progressbar (Edition for Readers)
	Plugin URI: http://wordpress.org/extend/plugins/progressbar-edition-for-readers/
	Description: This plugin indicates progress made on books.
	Version: 0.3
	Author: Janine Große-Beck
	Author URI: http://www.paperthin.de
	Last Updated: 2011-10-18
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
	function ProgressbarCreateMenu() {		
		add_options_page('Progressbar', 'Progressbar', 10, basename(__FILE__), 'ProgressbarSettings');
	}	
	function ProgressbarSettings(){
		require('settings.php');
	}
	require('widget.php'); 
	add_action('admin_menu','ProgressbarCreateMenu',10);
	add_action('widgets_init',create_function('','register_widget("ProgressbarWidget");'));	
	wp_register_sidebar_widget('progressbar','Progressbar','ProgressbarCreateSidebarWidget',array('description' => 'Description of what your widget does'));
?>