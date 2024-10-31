<style type="text/css">
#archive_select_image_dialog{
	display: none;
	width: 1000px;
	height: 595px;
	position: fixed;
	bottom: 0px;
	left: 0px;
	right: 0px;
	top: 0px;
	margin-left: auto;
	margin-right: auto;
	margin-top: auto;
	margin-bottom: auto;
	z-index: 1;
}
#archive_select_image_dialog .acontent{
	height: 430px;
	text-align: center;
}
#archive_select_image_dialog .afooter,#archive_select_image_dialog #archive_content_images_container{
	border-top: 1px solid #eee;
	padding-top: 5px;
}
#archive_select_image_dialog .afooter .button{
	float: right;
	margin: 3px;
}
#archive_select_image_dialog #selected_image, #archive_select_image_dialog #selected_image_txt{
	border: 3px solid #eee;
	width: 400px;
	height: 250px;
	text-align: center;
	line-height: 240px;
	margin-top: 10px;
	position: absolute;
	margin-left: auto;
	margin-right: auto;
	left: 0px;
	right: 0px;
	color: #eee;
	font-size: 24px;
}
#archive_select_image_dialog #selected_image>iframe{
	width: 100%;
	height: 100%;
}
#archive_select_image_dialog #selected_image{
	z-index: 2;
	background-size: 100% 100%;
}
#archive_select_image_dialog #selected_image_txt{
	z-index: 1;
}
#archive_select_image_dialog .under_image{
	margin-top: 275px;
}
#archive_select_image_dialog div{
	text-align: left;
}
#archive_select_image_dialog #archive_content_images_container{
	text-align: center;
	overflow-x: hidden;
	overflow-y: scroll;
	height: 100px;
}
#archive_select_image_dialog #archive_content_images_container>div>iframe{
	width: 100%;
	height: 100%;
	position: absolute;
	z-index: 1;
}
#archive_select_image_dialog #archive_content_images_container>div>.iframe_block{
	position: absolute;
	width: 100%;
	height: 100%;
	z-index: 2;	
}
#archive_select_image_dialog #archive_content_images_container>div{
	display: inline-block;
	position: relative;
	width: 160px;
	height: 100px;
	margin: 0px 3px 0px 3px;
	cursor: pointer;
}
#archive_select_image_dialog .archive_text_wrap{
	width: 100%;
	height: 45px;
	position: relative;
	text-align: center;
}
#archive_select_image_dialog .archive_text_wrap textarea{
	text-align: left;
	width: 98%;
	height: 100%;
	margin-top: 5px;
	resize: none;
}
.related_connections_dialog{
	position: fixed;
	margin: 0 auto;
	left: 0px;
	right: 0px;
	width: 300px;
	background-color: whitesmoke;
	padding: 5px;
	top: 40%;
	margin-top: -100px;
	border: 1px solid darkgrey;
	border-radius: 5px;
	z-index: 99;
	display:none;
}
.related_connections_dialog .postbox .hndle{
	padding:5px;
	cursor:default !important;
	margin:0px;
}
.related_connections_dialog .postbox .inside{
	display:none !important;
}
.related_connections_dialog .postbox.selected .inside{
	display:block !important;
}
.related_connections_dialog #pagesdiv{
	margin:0px 0px 5px 0px;
}
.related_connections_dialog #pagesdiv .inside{
	padding:5px;
	margin:0px 0px 10px 0px
	
}

.related_connections_dialog #pagesdiv .inside .tabs-panel{
	padding:5px;
	max-height:250px;
	overflow-y:auto;
}
.related_connections_dialog #pagesdiv .inside #pageschecklist{
	margin:0px;	
}
.related_connections_dialog input[type="checkbox"]{
	height: 16px;
	width: 16px;
	vertical-align: middle;
}
</style>
<div class="related_connections_dialog" data-connection-pages="" data-connection-category="">
	<!-- pages start here -->
	<div id="pagesdiv" class="postbox selected">
		<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle' ); ?>"><br /></div>
		<h3 class="hndle">
			<?php _e('Pages') ?>
		</h3>
		<div class="inside">
			<div id="pages-all" class="tabs-panel">
				<ul id="pageschecklist" data-wp-lists="list:pages" class="pageschecklist form-no-clear">
					<li class="page_item page-item-all"><label>
					</li>
					<?php  
							$pages = get_pages();  
							foreach ( $pages as $page ) { ?>
								<li class="page_item page-item-<?php echo $page->ID; ?>">
									<label>
										<input type="checkbox" name="pageSelector[]" value="<?php echo $page->ID; ?>">&nbsp;&nbsp;<?php echo $page->post_title; ?>
									</label>
								</li>
						<?php 
							} 
					
							/*$pages = wp_list_pages( apply_filters('widget_pages_args',array("echo"=>0,"title_li"=>""))); 
							$pages = preg_replace('%<a ([^>]+)>%U','<label $1><input type="checkbox" name="pageSelector[]" value="">&nbsp;&nbsp;', $pages);
							$pages = str_replace('</a>','</label>', $pages);
							echo $pages;*/
						?>
				</ul>
			</div>
		</div>
	</div>
	<!-- pages end here ...--> 
	
	<!-- category start here -->
	<?php 
		$tax = get_taxonomy( 'category' );
	?>
	<div id="categorydiv" class="postbox">
		<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle' ); ?>"><br /></div>
		<h3 class="hndle"><?php _e('Categories') ?></h3>
		<div class="inside">
			<div id="taxonomy-category" class="categorydiv">
				<ul id="category-tabs" class="category-tabs">
					<li class="tabs all-category-tab"><a href="javascript:void(0);"><?php echo $tax->labels->all_items; ?></a></li>
					<li class="hide-if-no-js mostused-category-tab"><a href="javascript:void(0);"><?php _e( 'Most Used' ); ?></a></li>
				</ul>
				<div id="category-pop" class="tabs-panel" style="display: none;">
					<ul id="categorychecklist-pop" class="categorychecklist form-no-clear" >
						<?php $popular_ids = wp_popular_terms_checklist( 'category' ); ?>
					</ul>
				</div>
				<div id="category-all" class="tabs-panel">
					<ul id="categorychecklist" data-wp-lists="list:category" class="categorychecklist form-no-clear">
						<li id="category-all">
							<label class="selectit">
						</li>
						<?php 
							$tax_get_list = array('category');
							if(taxonomy_exists('download_category')){
								$tax_get_list[] = 'download_category';
							}
							ob_start();
							wp_terms_checklist($post_ID, array( 'taxonomy' => $tax_get_list, 'popular_cats' => $popular_ids ) );
							$catsStr = ob_get_contents();
							ob_end_clean();
							echo str_replace("disabled='disabled'", "", $catsStr);
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--- Category div end here--> 
	<div class="button-primary archive_save_related">Save</div>&nbsp;<div class="button-primary archive_close_related">Close</div>
	
</div>
<div id="archive_select_image_dialog" class="postbox">
<h3 class="hndle"><span>Text for archive page</span></h3>
<div class="archive_text_wrap">
<textarea id="text_for_archive"></textarea>
</div>
<h3 class="hndle"><span>Image for archive page</span></h3>
<div class="inside">
	<div class="acontent">
		<div id="selected_image"></div>
		<div id="selected_image_txt">Selected Image</div>
		<input type="hidden" id="image_for_archive" name="image_for_archive" value=""/>
		<input type="hidden" id="connection_categories" name="connection_categories" value="<?php echo get_post_meta($post->ID, 'archive_related_categories', true); ?>"/>
		<input type="hidden" id="connection_pages" name="connection_pages" value="<?php echo get_post_meta($post->ID, 'archive_related_pages', true); ?>"/>
		<a href="#" id="archive_open_gallery" class="button under_image">Select From Gallery</a>
		<a href="#" id="archive_set_related" class="button under_image">Set Related Pages</a>
		<div>Select from content:</div>
		<div id="archive_content_images_container">
		</div>
	</div>
	<div class="afooter">
		<a href="#" id="archive_img_confirm_btn" class="button">Select</a>
		<a href="#" id="archive_img_cancel_btn" class="button">Close</a>
	</div>
</div>
</div>
<a href="#" id="archive_select_image_btn" class="button">Select Image</a>
<script type="text/javascript">
jQuery(function($){
	function REAL_archiveSave(){
		$('#archive_face_content').val($('#image_for_archive').val());
		var type = "image";
		if($('#selected_image>iframe').length>0){
			var type = "youtube";
		}
		$('#archive_face_type').val(type);
		$('#archive_text').val(escape($('#text_for_archive').val()));
		$('#archive_select_image_dialog').fadeOut(300, function() {});
		$('#connection_categories').val($(".related_connections_dialog").attr('data-connection-category'));
		$('#connection_pages').val($(".related_connections_dialog").attr('data-connection-pages'));
	}
	function REAL_resetArchiveDialog(){
		$('#image_for_archive').val('');
		$('#archive_content_images_container, #selected_image').html('');
		$('#selected_image').css('background-image','none');
		//load current archive image\video
		var current_link = $('#archive_face_content').val();
		var current_type = $('#archive_face_type').val();
		if(current_link != ''){
			if(current_type == ''){
				current_type = 'image';
			}
			switch(current_type){
				case 'image':
					$('#selected_image').css('background-image','url("'+current_link+'")');
				break;
				case 'youtube':
					$('#selected_image').html('<iframe src="'+current_link+'"></iframe>');
				break;
			}
			$('#text_for_archive').val(unescape($('#archive_text').val()));
			$('#image_for_archive').val(current_link);
		}
		//Get Image\Video list from content
		var re = /\<img[^\>]+src=\"([^\"]+)\"[^\>]*\>|\<iframe[^\>]+src=\"([htp\:\/w\.]*youtube[^\"]+)\"[^\>]*\>/gm; 
		var str = $('textarea.wp-editor-area').val();
		while ((m = re.exec(str)) != null) {
		    if (m.index === re.lastIndex) {
		        re.lastIndex++;
		    }
		    var content = '';
		    var c_url = m[1];
		    if(c_url != undefined){
		    	content = '<div class="a_image" src="'+c_url+'" style="background-image:url(\''+c_url+'\')"></div>';
		    }else{
		    	c_url = m[2];
		    	content = '<div class="a_youtube" src="'+c_url+'"><div class="iframe_block"></div><iframe src="'+c_url+'"></iframe></div>';
		    }
		    $('#archive_select_image_dialog #archive_content_images_container').append(content);
		}
		$('#archive_select_image_dialog #archive_content_images_container>div').click(function(event) {
			event.preventDefault();
			event.stopPropagation();
			var src = $(this).attr('src');
			if($(this).hasClass('a_image')){
				$('#selected_image').html('');
	      		$('#selected_image').css('background-image','url("'+src+'")');
	      		$('#image_for_archive').val(src);
			}else if($(this).hasClass('a_youtube')){
				$('#selected_image').css('background-image','none');
				$('#selected_image').html('<iframe src="'+src+'"></iframe>');
				$('#image_for_archive').val(src);
			}
		});
	}
	$(".related_connections_dialog .postbox .hndle, .related_connections_dialog .postbox .handlediv").bind('click',function(){
		$(".related_connections_dialog .postbox").removeClass("selected");
		$(this).closest(".postbox").addClass("selected");
	});	
	$('.archive_save_related').on('click',function(){
		var conection_pages = [];
		var connection_category = [];
		$(".related_connections_dialog input[name='pageSelector[]']:checked").each(function(){
			conection_pages.push($(this).val());
		});
		$(".related_connections_dialog input[name='tax_input[Array][]']:checked").each(function(){
			connection_category.push($(this).val());
		});
		$(".related_connections_dialog").attr({
			"data-connection-category":connection_category.join(","),
			"data-connection-pages":conection_pages.join(",")
		});		
		$(".related_connections_dialog").hide();
	});
	$('.archive_close_related').click(function(event) {
		$(this).parent().hide();
	});
	$('#archive_select_image_btn').click(function(event) {
		event.preventDefault();
		REAL_resetArchiveDialog();
		$('#archive_select_image_dialog').fadeIn(300, function() {});
	});
	$('#archive_img_cancel_btn').click(function(event) {
		event.preventDefault();
		$('#archive_select_image_dialog').fadeOut(300, function() {});
	});
	$('#archive_img_confirm_btn').click(function(event) {
		event.preventDefault();
		REAL_archiveSave();
	});	
	$('#archive_set_related').click(function(event) {
		$(".related_connections_dialog input[type='checkbox']").prop("checked",false);
		try{
			var connection_category	= $('#connection_categories').val().split(",");
			var connection_pages	= $('#connection_pages').val().split(",");
			
			for(var i = 0; i < connection_category.length; i++){
				$(".related_connections_dialog #categorydiv.postbox input[type='checkbox'][value='"+connection_category[i]+"']").prop("checked",true);
			}
			
			for(var i = 0; i < connection_pages.length; i++){
				$(".related_connections_dialog #pagesdiv.postbox input[type='checkbox'][value='"+connection_pages[i]+"']").prop("checked",true);
			}
		}catch(e){}
		$('.related_connections_dialog').show();
	});
	// Uploading files
	var file_frame;
  	$('#archive_open_gallery').live('click', function( event ){
 		event.preventDefault();
    	// If the media frame already exists, reopen it.
	    if ( file_frame ) {
	      file_frame.open();
	      return;
	    }
	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      title: jQuery( this ).data( 'uploader_title' ),
	      button: {
	        text: jQuery( this ).data( 'uploader_button_text' ),
	      },
	      multiple: false  // Set to true to allow multiple files to be selected
	    });
    	// When an image is selected, run a callback.
	    file_frame.on( 'select', function() {
	      // We set multiple to false so only get one image from the uploader
	      attachment = file_frame.state().get('selection').first().toJSON();
	      $('#image_for_archive').val(attachment.url);
	      $('#selected_image').html('');
	      $('#selected_image').css('background-image','url("'+attachment.url+'")');
	    });
    // Finally, open the modal
    file_frame.open();
  });
  //Save event hook
  var original_submit = $('#publishing-action input[type="submit"]');
  original_submit.hide();
  $('#publishing-action').append('<input type="button" style="width:70px;" class="button button-primary button-large" id="archive_fake_submit"value="'+original_submit.val()+'">');
  $('#archive_fake_submit').click(function(event) {
  	event.preventDefault();
  	if($('#archive_face_content').val() == ''){
  		$('#archive_select_image_btn').click();
  		$("#archive_img_cancel_btn, #archive_img_confirm_btn").unbind("click");
		$('#archive_img_cancel_btn').click(function(event) {
			event.preventDefault();
			$('#archive_select_image_dialog').fadeOut(300, function() {});
			original_submit.click();	
		});
		$('#archive_img_confirm_btn').click(function(event) {
			event.preventDefault();
			REAL_archiveSave();
			original_submit.click();
		});	
  	}else{
  		original_submit.click();
  	}
  });

})
</script>