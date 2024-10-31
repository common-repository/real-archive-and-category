<?php

/**
 * Plugin Name: REAL Archive Pages List
 * Plugin URI: http://jb-webs.com
 * Description: This plugin provides user to create a visual view for archive pages and customize the view in many ways.
 * Version: 1.0
 * Author: clickandsell
 * Author URI: http://jb-webs.com
 * License: GPL2
 */

add_action('admin_menu','set_real_archive_pages_full_menu',20);
include_once('ajax.php');
include_once('archive-backend.php');
function set_real_archive_pages_full_menu()
{
	$menu = array_flip($GLOBALS['admin_page_hooks']);
	$address = dirname(__FILE__).'/admin.php';
	$parent = '';
    if(!isset($menu['website-builder'])){
      	add_menu_page('Website Builder', 'Website Builder', 'manage_options', $address, '');
      	$parent = $address;
    }else{
      $parent = $menu['website-builder'];
    }
	add_submenu_page( $parent, 'REAL Archive Pages', 'REAL Archive Pages', 'manage_options', $address);	
}

function get_custom_post_type_template( $archive_template ) {
	$archive_template = dirname( __FILE__ ) . '/archive-template.php';
    return $archive_template;
}
function change_posts_per_page( $query ) {
    //Only alter main query. This only works for 3.3+
    if( ! $query->is_main_query() )
        return;
    if ((is_category())||(isset($query->query_vars['download_category']))){	
    	$archivepage_styles = json_decode(get_option('real_archive_page_styles'),true);
		$archivepage_settings =  json_decode(get_option('real_archive_page_settings'),true);
		$stylename = $archivepage_settings[get_cat_ID($query->query_vars['category_name'])];
		if(isset($query->query_vars['download_category'])){
			$stylename = $archivepage_settings[get_term_by('slug',$query->query_vars['download_category'],'download_category')->term_id];
		}
		//get style details
		$styleDetails = NULL;
		foreach($archivepage_styles as $astyle){
			if($astyle["label"] == $stylename){
				$styleDetails = $astyle;
				break;
			}
		}
		if(empty($styleDetails)){
			$styleDetails = $archivepage_styles[0];
		}
		$MPP = intval($styleDetails['MPP']);
		if($MPP>0){
			$query->set( 'posts_per_page', $MPP);
		}
    }
}
add_action('pre_get_posts', 'change_posts_per_page', 1);
add_filter( 'archive_template', 'get_custom_post_type_template' );
add_filter( 'category_template', 'get_custom_post_type_template' );
?>