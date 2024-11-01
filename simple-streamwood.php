<?php
/**
 * Plugin Name: Simple StreamWood
 * Plugin URI:
 * Description: Enables <a href="https://streamwood.ru/">StreamWood</a> widget on all pages.
 * Version:     1.0.0
 * Author:      hayk
 * Author URI:  http://hayk.500plus.org/
 * Text Domain: simple-streamwood
 * Domain Path: /languages
 * License:     GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Simple StreamWood is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Simple StreamWood is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Simple StreamWood. If not, see https://www.gnu.org/licenses/gpl-3.0.txt.
 *
 */

if (!defined('WP_CONTENT_URL')) {
	define ('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
}
if (!defined('WP_CONTENT_DIR')) {
	define ('WP_CONTENT_DIR', ABSPATH.'wp-content');
}
if (!defined('WP_PLUGIN_URL')) {
	define ('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
}
if (!defined('WP_PLUGIN_DIR')) {
	define ('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');
}

function activate_simple_streamwood() {
	if (!get_option('simple_streamwood_key')) {
		add_option('simple_streamwood_key', '0');
	}
	if (!get_option('simple_streamwood_domain_key')) {
		add_option('simple_streamwood_domain_key', '0');
	}
}

function deactive_simple_streamwood() {

}

function uninstall_simple_streamwood() {
	delete_option('simple_streamwood_key');
	delete_option('simple_streamwood_domain_key');
}

function admin_init_simple_streamwood() {
	register_setting('simple-streamwood', 'simple_streamwood_key');
	register_setting('simple-streamwood', 'simple_streamwood_domain_key');
}

function admin_menu_simple_streamwood() {
	add_options_page('Simple StreamWood', 'Simple StreamWood', 'manage_options', 'simple-streamwood', 'options_page_simple_streamwood');
}

function options_page_simple_streamwood() {
	include (WP_PLUGIN_DIR.'/simple-streamwood/options.php');
}

function simple_streamwood() {
	if ( ($simple_streamwood_key = get_option('simple_streamwood_key')) && ($simple_streamwood_domain_key = get_option('simple_streamwood_domain_key')) ) {
		wp_enqueue_style('simple-streamwood', '//clients.streamwood.ru/StreamWood/sw.css');
		wp_enqueue_script('simple-streamwood', '//clients.streamwood.ru/StreamWood/sw.js');
		$code = "swQ(document).ready(function(){swQ().SW({swKey:'$simple_streamwood_key',swDomainKey:'$simple_streamwood_domain_key'});swQ('body').SW('load');});";
		wp_add_inline_script('simple-streamwood', $code, 'after');
	}
}

register_activation_hook(__FILE__, 'activate_simple_streamwood');
register_deactivation_hook(__FILE__, 'deactive_simple_streamwood');
register_uninstall_hook(__FILE__, 'uninstall_simple_streamwood');

if (is_admin()) {
	add_action('admin_init', 'admin_init_simple_streamwood');
	add_action('admin_menu', 'admin_menu_simple_streamwood');
}

if(!function_exists('wp_get_current_user')) {
	include (ABSPATH . "wp-includes/pluggable.php");
}

if (!is_admin()) {
	add_action('wp_head', 'simple_streamwood');
}