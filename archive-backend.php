<?php
	add_action('add_meta_boxes','add_real_archive_meta_box');
	function add_real_archive_meta_box($post_type, $post)
	{
		if(in_array($post_type, array('post','download'))){
		    add_meta_box(
		        'real_archive_meta_box',
		        __( 'Archive Page' ),
		        'real_archive_meta_box_cb',
		        null,
		        'side',
		        'default'
		    );
		}
	}
	function real_archive_meta_box_cb($post){
		include_once('select_image_dialog.php');
		$current = get_post_meta($post->ID, 'archive_face_content', true);
		if(empty($current)){
			$current = '';
		}else{
			$current=json_decode($current,true);
		}
		$out.='<input type="hidden" id="archive_face_content" name="archive_face_content" value="'.$current['link'].'"/>
		<input type="hidden" id="archive_face_type" name="archive_face_type" value="'.$current['type'].'"/>
		<input type="hidden" id="archive_text" name="archive_text" value="'.$current['text'].'"/>
		';
		echo $out;
	}
	add_action('save_post','real_archive_save_post');
	function real_archive_save_post( $post_id )
	{
	  if(!check_ajax_referer( 'inlineeditnonce', '_inline_edit',false)){
		  $post_id = intval($_POST['post_ID']);
		  $archive_face = json_encode(array('link' => $_POST['archive_face_content'],
		  						'type' => $_POST['archive_face_type'],
		  						'text' => $_POST['archive_text']));
		  update_post_meta(intval($post_id),'archive_face_content',$archive_face);
		  update_post_meta(intval($post_id),'archive_related_categories',$_POST['connection_categories']);
		  update_post_meta(intval($post_id),'archive_related_pages',$_POST['connection_pages']);
	  }
	}
?>