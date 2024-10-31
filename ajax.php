<?php
	add_action( 'wp_ajax_save_real_archive_page_styles', 'save_real_archive_page_styles' );
	add_action( 'wp_ajax_save_real_archive_page_view', 'save_real_archive_page_view' );
	
	function save_real_archive_page_styles() 
	{
		$styles = $_POST['styles'];
		$styles = json_encode($styles);
		update_option('real_archive_page_styles', $styles);
		
		echo "Saved.";
	}
	function save_real_archive_page_view() 
	{
		$settings = $_POST['settings'];
		$settings = json_encode($settings);
		update_option('real_archive_page_settings', $settings);
		
		echo "Saved.";
	}
	
?>