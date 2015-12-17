<?php
/*
Plugin Name: Kaltst plugin
Description: A kaltst plugin to upload, manage, edit and delet video content from Kaltura CE 10
Author: Pavel Tashev
Version: 0.1
*/
require_once(plugin_dir_path( __FILE__ ).'lib/KalturaClient.php');
require_once(plugin_dir_path( __FILE__ ).'lib/settings.php');
require_once(plugin_dir_path( __FILE__ ).'kaltst-uploader.php');
require_once(plugin_dir_path( __FILE__ ).'kaltst_table.php');
include('kaltst_list.php');
add_action('admin_menu', 'kaltst_plugin_setup_menu');
function kaltst_plugin_setup_menu(){
        add_menu_page( 'Kaltst Plugin Page', 'Kaltura', 'manage_options', 'kaltst', 'kaltst_lst' );
        add_submenu_page( 'kaltst', 'Kaltst Plugin Page', 'Kaltura Uploader', 'manage_options', 'kaltst-plugin', 'kaltura_uploader' );
}
add_action('kalupload_hock', 'kaltura_uploader');
function kaltura_uploader() { do_action('kalturauploader_hoock'); }

add_action('admin_head','hook_javascript');
function hook_javascript(){
    global $url;
	//echo "<meta name='viewport' content='width=device-width, initial-scale=1'>"."\r\n";
    foreach ( glob( plugin_dir_path( __FILE__ ) . "lib/js/*.js" ) as $file ) {
        $url = plugins_url( wp_basename( $file ), "/kaltst/lib/js/*.js");
        echo "<script type='text/javascript' src='". $url . "'></script>"."\r\n";
    }
    foreach (glob( plugin_dir_path( __FILE__ ) . "lib/css/*.css" ) as $csss ) {
        $url = plugins_url( wp_basename( $csss ), "/kaltst/lib/css/*.css");
        echo "<link rel='stylesheet' type='text/css' href='".$url ."'>"."\r\n";
    }
}

add_action('admin_menu', 'register_my_custom_submenu_page');
function register_my_custom_submenu_page() {
	add_submenu_page( 'kaltst', 'Kaltst Plugin List', 'Kaltura List', 'manage_options', 'kaltst-list', 'kaltst_lst');
}
function tl_save_error() {
    update_option( 'plugin_error',  ob_get_contents() );
    file_put_contents( plugin_dir_path( __FILE__ ) .'/errors_log' , ob_get_contents() );
}
add_action( 'activated_plugin', 'tl_save_error' );