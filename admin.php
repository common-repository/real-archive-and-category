<?php wp_enqueue_script("jquery"); ?>
<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__) ?>js/colorpicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__) ?>css/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__) ?>css/admin-archive-pages.css">
<script type="text/javascript">
$ = jQuery;
function BindImageSelector(){
		$('select[name="imageType"]').change(function(event) {
		if(($(this).val() != 'Full')&&($(this).val() != 'Thumb')){
			$('.archivepages_local_style_dialog .image_size_settings').hide();
		}else{
			$('.archivepages_local_style_dialog .image_size_settings').show();
		}
		if($(this).val() != 'Full'){
			$('.archivepages_local_style_dialog .list_settings').show();
		}else{
			$('.archivepages_local_style_dialog .list_settings').hide();
		}
	});
	$('select[name="imageType"]').change();
}
jQuery(function($){
	BindImageSelector();
});
</script>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2>REAL Archive Pages View</h2>
	<br/>
	<h2>Create Styles</h2>
	<div id="jb-create-archive-style" class="button-primary" style="">Create New Style</div>
	<div class="archive-styles-list mtable">
	
	<?php 
		$archive_page_styles = json_decode(get_option('real_archive_page_styles'),true);
		$styles = array();
		if($archive_page_styles !== NULL)
		{
			foreach($archive_page_styles as $style)
			{
				$styles[] = $style['label'];
		?>
				<div class="mrow">
					<div class="mcol"><label>Label:&nbsp;</label><input type="text" class="smallInputText" name="styleLabel" value="<?php echo $style['label'];?>"></div>
					<div class="mcol"><label>Columns:&nbsp;</label><input type="text" class="smallInputText" name="colCount" value="<?php echo $style['cols'];?>"></div>
					<div class="mcol"><label>Blog pages show at most:&nbsp;</label><input type="text" class="smallInputText" name="MPP" value="<?php echo intval($style['MPP']);?>"></div>
					<div class="mcol"><label>Padding:&nbsp;</label><input type="text" class="smallInputText" name="colPadding" value="<?php echo $style['colPadding'];?>"></div>
					<div class="mcol"><label>Background Color:&nbsp;</label><input type="text" class="smallInputText input_colorpicker" name="colBgColor" value="<?php echo $style['colBgColor'];?>"></div>
					<div class="mcol">
						<div class="archivepages_local_style_dialog">
							<div class="archivepages_local_style_tabs"><a href="javascript:void(0)" class="tab selected" data-tab="archivepages-headineTable">Headline</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-subheadineTable">Sub Headline</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-contentTable">Content</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-readMoreTable">Hyperlink</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-imageTable">Image</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-pagination">Pagination</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-fonts">Fonts</a><a href="javascript:void(0)" class="tab" data-tab="archivepages-related">Related Links</a></div>
							<table class="archivepages-headineTable selected">
								<tr>
									<td>Color:</td>
									<td><input type="text" name="headlineColor" class="input_colorpicker" value="<?php echo $style['headline']['color'];?>" /></td>
								</tr>
								<tr>
									<td>Alignment:</td>
									<td><select name="headlineAlignment" data-sel="<?php echo $style['headline']['align'];?>"><option>Left</option><option>Center</option><option>Right</option></select></td>
								</tr>
								<tr>
									<td>Style:</td>
									<td>Bold:<input type="checkbox" name="headlineBold" <?php echo ($style['headline']['bold'] == "true")? "checked":"";?>>&nbsp;Italic: <input type="checkbox" name="headlineItalic" <?php echo ($style['headline']['italic'] == "true")? "checked":"";?>></td>
								</tr>
							</table>
							<table class="archivepages-imageTable">
								<tr>
									<td>Type:</td>
									<td><select name="imageType" data-sel="<?php echo $style['image']['type'];?>"><option>Banner</option><option>Thumb</option><option>Full</option><option>No Image</option></select></td>
								</tr>
								<tr>
									<td><span class="image_size_settings">Width:</span></td>
									<td><span class="image_size_settings"><input type="text" name="imageWidth" value="<?php echo $style['image']['width'];?>"></span></td>
								</tr>
								<tr>
									<td><span class="image_size_settings">Height:</span></td>
									<td><span class="image_size_settings"><input type="text" name="imageHeight" value="<?php echo $style['image']['height'];?>"></span></td>
								</tr>
								<tr class="list_settings">
									<td>List Max. Width</td>
									<td>
										<input type="number" name="ListMaxWidth" class="" value="<?php echo $style['item']['ListMaxWidth'];?>" />
										<select name="ListMaxWidthType" data-sel="<?php echo $style['item']['ListMaxWidthType'];?>">
											<option>px</option>
											<option>%</option>
										</select>
									</td>
								</tr>
								<tr class="">
									<td>List Alignment:</td>
									<td><select name="ListAlignment" data-sel="<?php echo $style['item']['ListAlignment'];?>"><option>Left</option><option>Center</option><option>Right</option></select></td>
								</tr>
							</table>
							<table class="archivepages-pagination">
								<tr>
									<td>Text Color:</td>
									<td><input type="text" name="paginationColor" class="input_colorpicker" value="<?php echo $style['pagination']['color'];?>" /></td>
								</tr>
								<tr>
									<td>Background Color:</td>
									<td><input type="text" name="paginationBGColor" class="input_colorpicker" value="<?php echo $style['pagination']['BGColor'];?>" /></td>
								</tr>
								<tr>
									<td>Active Page BG Color:</td>
									<td><input type="text" name="paginationActiveBGColor" class="input_colorpicker" value="<?php echo $style['pagination']['ActiveBGColor'];?>" /></td>
								</tr>
								<tr>
									<td>Active Page Text Color:</td>
									<td><input type="text" name="paginationActiveColor" class="input_colorpicker" value="<?php echo $style['pagination']['ActiveColor'];?>" /></td>
								</tr>
							</table>													
							<table class="archivepages-subheadineTable">
								<tr>
									<td>Color:</td>
									<td><input type="text" name="subheadlineColor" class="input_colorpicker" value="<?php echo $style['subheadline']['color'];?>" /></td>
								</tr>
								<tr>
									<td>Alignment:</td>
									<td><select name="subheadlineAlignment" data-sel="<?php echo $style['subheadline']['align'];?>"><option>Left</option><option>Center</option><option>Right</option></select></td>
								</tr>
								<tr>
									<td>Author:</td>
									<td>Show: <input type="checkbox" name="showAuthor" <?php echo ($style['subheadline']['author']['show'] == "true")? "checked":"";?>>&nbsp;Bold: <input type="checkbox" name="authorBold" <?php echo ($style['subheadline']['author']['bold'] == "true")? "checked":"";?>>&nbsp;Italic: <input type="checkbox" name="authorItalic" <?php echo ($style['subheadline']['author']['italic'] == "true")? "checked":"";?>></td>
								</tr>
								<tr>
									<td>Date:</td>
									<td>Show: <input type="checkbox" name="showDate" <?php echo ($style['subheadline']['date']['show'] == "true")? "checked":"";?>>&nbsp;Bold: <input type="checkbox" name="dateBold" <?php echo ($style['subheadline']['date']['bold'] == "true")? "checked":"";?>>&nbsp;Italic: <input type="checkbox" name="dateItalic" <?php echo ($style['subheadline']['date']['italic'] == "true")? "checked":"";?>></td>
								</tr>
								<tr>
									<td>Category:</td>
									<td>Show: <input type="checkbox" name="showCategory" <?php echo ($style['subheadline']['category']['show'] == "true")? "checked":"";?>>&nbsp;Bold: <input type="checkbox" name="categoryBold" <?php echo ($style['subheadline']['category']['bold'] == "true")? "checked":"";?>>&nbsp;Italic: <input type="checkbox" name="categoryItalic" <?php echo ($style['subheadline']['category']['italic'] == "true")? "checked":"";?>></td>
								</tr>
								
							</table>
							<table class="archivepages-contentTable">
								<tr>
									<td>Color:</td>
									<td><input type="text" name="contentColor" class="input_colorpicker" value="<?php echo $style['content']['color'];?>" /></td>
								</tr>
								<tr>
									<td>Alignment:</td>
									<td><select name="contentAlignment" data-sel="<?php echo $style['content']['align'];?>"><option>Justify</option><option>Left</option><option>Center</option><option>Right</option></select></td>
								</tr>
								<tr>
									<td>Max Words:</td>
									<td><input type="text" name="contentMaxWords" value="<?php echo $style['content']['maxWord'];?>" /></td>
								</tr>
							</table>
							<table class="archivepages-readMoreTable">
								<tr>
									<td>Label:</td>
									<td><input type="text" name="readmoreLabel"  value="<?php echo $style['readMore']['label'];?>" /></td>
								</tr>
								<tr>
									<td>Color:</td>
									<td><input type="text" name="readmoreColor" class="input_colorpicker" value="<?php echo $style['readMore']['color'];?>"/></td>
								</tr>
								<tr>
									<td>Hover Color:</td>
									<td><input type="text" name="readmoreHoverColor" class="input_colorpicker" value="<?php echo $style['readMore']['hcolor'];?>"/></td>
								</tr>
								<tr>
									<td>Visited Color:</td>
									<td><input type="text" name="readmoreVisitedColor" class="input_colorpicker" value="<?php echo $style['readMore']['vcolor'];?>"/></td>
								</tr>
								<tr>
									<td>Alignment:</td>
									<td><select name="readMoreAlignment" data-sel="<?php echo $style['readMore']['align'];?>"><option>Left</option><option>Center</option><option>Right</option><option>With Text</option></select></td>
								</tr>
							</table>
							<table class="archivepages-fonts">
								<tr>
									<td>Font Size:</td>
									<td><input type="number" name="contentFontSize" class="" value="<?php echo $style['fonts']['FontSize'];?>" /></td>
								</tr>
								<tr>
									<td>Font Family:</td>
									<td>
										<select name="contentFontFamily" data-sel="<?php echo $style['fonts']['FontFamily'];?>">
											<option>Arial</option>
											<option>Times New Roman</option>
											<option>Courier New</option>
											<option>Verdana</option>
											<option>Tahoma</option>
											<option>Arial Black</option>
											<option>Comic Sans MS</option>
											<option>Avant Garde</option>
											<option>Palatino</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Headline Size:</td>
									<td>
										<input type="number" name="headlineSizePercent" value="<?php echo $style['fonts']['headlineSizePercent'];?>" />%
									</td>
								</tr>
								<tr>
									<td>Sub Headeline Size:</td>
									<td>
										<input type="number" name="subHeadlineSizePercent" value="<?php echo $style['fonts']['subHeadlineSizePercent'];?>"/>%
									</td>
								</tr>
								<tr>
									<td>Content Size:</td>
									<td>
										<input type="number" name="contentSizePercent" value="<?php echo $style['fonts']['contentSizePercent'];?>"/>%
									</td>
								</tr>
								<tr>
									<td>Read More Size:</td>
									<td>
										<input type="number" name="readMoreSizePercent" value="<?php echo $style['fonts']['readMoreSizePercent'];?>"/>%
									</td>
								</tr>								
							</table>
							<table class="archivepages-related">
							<tr>
								<td>Related Links Headline:</td>
								<td>
									<input type="text" name="relatedLinksHeadline" class="" value="<?php echo $style['related']['headline'];?>"/>
								</td>
							</tr>
							</table>							
							<div class="button-primary jb_style_archivepages_clear" style="float:left;">Clear</div>
							&nbsp;
							<div class="button-primary jb_style_archivepages_close" style="float:right;">Close</div>
						</div>
						<div class="button-primary settings-archivepages-style">Settings</div>
					</div>
					<div class="mcol">
						<div class="button-primary delete-archivepages-style">Delete</div>
					</div>
		</div>
	<?php
			}
		}
	?>
	</div>
	<div class="mrow"><div class="button-primary save-archivepages-style">Save</div></div>
	<br/>
	<h2 style="float:left;">Link Style to Category</h2>
	<input type="text" id="category_filter" value="" placeholder="Category Filter..." style="float:right;margin-top:10px;"/>
	<div class="archive-category-list mtable">
		<?php
		$taxs = array('category'); 
		if(taxonomy_exists('download_category')) $taxs[]= 'download_category';
		$args = array(
				  'orderby' => 'name',
				  'style' => 'none',
				  'taxonomy' => $taxs,
				  'hide_empty' => 0,
				  'title_li' => ''
				);

		$categories = get_categories($args);
		$archive_page_sesttings =  json_decode(get_option('real_archive_page_settings'),true);
		foreach($categories as $cat)
		{
		?>
			<div class="archive-category mrow" data-id="<?php echo $cat->term_id;?>">
				<div class="mcol"><?php echo $cat->name;?></div>
				<div class="mcol"><label>Style:&nbsp;</label><select name="selectStyle" class="archivePageStyle">
					<?php
						$sel = '';
						if(isset($archive_page_sesttings[$cat->term_id]))
						{
							$sel = $archive_page_sesttings[$cat->term_id];
						}
					
						foreach($styles as $ostyle){
							if($sel == $ostyle){
								echo '<option selected>'.$ostyle.'</option>';
							}else{
								echo '<option>'.$ostyle.'</option>';
							}
						}
					?>
				</select></div>
			</div>
		<?php 
		}
		?>
	</div><br/>
	<div class="mcol"><div class="button-primary save-archivepages-view">Save</div></div>
</div>

<script type="text/javascript">
$(document).ready(function(e) {
	
	$(".archive-styles-list select[data-sel]").each(function(){
		$(this).val($(this).attr("data-sel"));
		$(this).removeAttr("data-sel");
	});
	
	// init color picker
	
	$(".archive-styles-list .input_colorpicker").ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val('#'+hex);
			$(el).css('background-color','#'+hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
		$(this).css('background-color',this.value);
	}).keyup();	
	
	
	
	$(".archive-styles-list").on('click','.settings-archivepages-style',function(){
		$(this).prev(".archivepages_local_style_dialog").show();
		$(this).prev(".archivepages_local_style_dialog").find('select[name="imageType"]').change();
	});
	
	$(".archive-styles-list").on('click','.archivepages_local_style_dialog .archivepages_local_style_tabs a.tab',function(){
		var arcdialog = $(this).closest(".archivepages_local_style_dialog");
		
		$(arcdialog).find("a.tab").removeClass("selected");
		$(arcdialog).find("table").removeClass("selected");
		
		$(this).addClass("selected");
		$(arcdialog).find("."+$(this).attr("data-tab")).addClass("selected");
	});
	$(".archive-styles-list").on('click','.archivepages_local_style_dialog .jb_style_archivepages_close',function(){
		$(this).closest(".archivepages_local_style_dialog").hide();	
	});
	$(".archive-styles-list").on('click','.archivepages_local_style_dialog .jb_style_archivepages_clear',function(){
		$(this).closest(".archivepages_local_style_dialog").find("input,select").val("");
	});
	
	
	$("#jb-create-archive-style").bind('click',function(){
		
		var styleNo = $(".archive-styles-list .mrow").length  + 1;
		
		var template = '<div class="mrow"><div class="mcol"><label>Label:&nbsp;</label><input type="text" class="smallInputText" name="styleLabel" value="{{STYLE_LABEL}}"></div><div class="mcol"><label>Columns:&nbsp;</label><input type="text" class="smallInputText" name="colCount" value=""></div><div class="mcol"><label>Blog pages show at most:&nbsp;</label><input type="text" class="smallInputText" name="MPP" value=""></div><div class="mcol"><label>Padding:&nbsp;</label><input type="text" class="smallInputText" name="colPadding" value=""></div><div class="mcol"><label>Background Color:&nbsp;</label><input type="text" class="smallInputText input_colorpicker" name="colBgColor" value=""></div><div class="mcol"><div class="archivepages_local_style_dialog"><div class="archivepages_local_style_tabs"><a href="javascript:void(0)" class="tab selected" data-tab="archivepages-headineTable">Headline</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-subheadineTable">Sub Headline</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-contentTable">Content</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-readMoreTable">Hyperlink</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-imageTable">Image</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-pagination">Pagination</a>&nbsp;<a href="javascript:void(0)" class="tab" data-tab="archivepages-fonts">Fonts</a><a href="javascript:void(0)" class="tab" data-tab="archivepages-related">Related Links</a></div><table class="archivepages-headineTable selected"><tr><td>Color:</td><td><input type="text" name="headlineColor" class="input_colorpicker" value=""/></td></tr><tr><td>Alignment:</td><td><select name="headlineAlignment" data-sel=""><option>Left</option><option>Center</option><option>Right</option></select></td></tr><tr><td>Style:</td><td>Bold: <input type="checkbox" name="headlineBold">&nbsp;Italic: <input type="checkbox" name="headlineItalic"></td></tr></table><table class="archivepages-fonts"><tr><td>Font Size:</td><td><input type="number" name="contentFontSize" class="" value="" /></td></tr><tr><td>Font Family:</td><td><select name="contentFontFamily" data-sel=""><option>Arial</option><option>Times New Roman</option><option>Courier New</option><option>Verdana</option><option>Tahoma</option><option>Arial Black</option><option>Comic Sans MS</option><option>Avant Garde</option><option>Palatino</option></select></td></tr><tr><td>Headline Size:</td><td><input type="number" name="headlineSizePercent" value="" />%</td></tr><tr><td>Sub Headeline Size:</td><td><input type="number" name="subHeadlineSizePercent" value=""/>%</td></tr><tr><td>Content Size:</td><td><input type="number" name="contentSizePercent" value=""/>%</td></tr><tr><td>Read More Size:</td><td><input type="number" name="readMoreSizePercent" value=""/>%</td></tr></table><table class="archivepages-imageTable"><tr><td>Select:</td><td><div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" class="button insert-media add_media" data-editor="content" title="Add Media"><span class="wp-media-buttons-icon"></span> Select Image</a></div></td></tr><tr><td>Type:</td><td><select name="imageType" data-sel=""><option>Banner</option><option>Thumb</option><option>Full</option><option>No Image</option></select></td></tr><tr><td>Width:</td><td><input type="text" name="imageWidth" value=""></td></tr><tr><td>Height:</td><td><input type="text" name="imageHeight" value=""></td></tr><tr class="list_settings"><td>List Max. Width</td><td><input type="number" name="ListMaxWidth" class="" value="" /><select name="ListMaxWidthType" data-sel=""><option>px</option><option>%</option></select></td></tr><tr class=""><td>List Alignment:</td><td><select name="ListAlignment" data-sel=""><option>Left</option><option>Center</option><option>Right</option></select></td></tr></table><table class="archivepages-pagination"><tr><td>Text Color:</td><td><input type="text" name="paginationColor" class="input_colorpicker" value="" /></td></tr><tr><td>Background Color:</td><td><input type="text" name="paginationBGColor" class="input_colorpicker" value="" /></td></tr><tr><td>Active Page BG Color:</td><td><input type="text" name="paginationActiveBGColor" class="input_colorpicker" value="" /></td></tr><tr><td>Active Page Text Color:</td><td><input type="text" name="paginationActiveColor" class="input_colorpicker" value="" /></td></tr></table><table class="archivepages-subheadineTable"><tr><td>Color:</td><td><input type="text" name="subheadlineColor" class="input_colorpicker" value=""/></td></tr><tr><td>Alignment:</td><td><select name="subheadlineAlignment" data-sel=""><option>Left</option><option>Center</option><option>Right</option></select></td></tr><tr><td>Author:</td><td>Show: <input type="checkbox" name="showAuthor">&nbsp;Bold: <input type="checkbox" name="authorBold">&nbsp;Italic: <input type="checkbox" name="authorItalic"></td></tr><tr><td>Date:</td><td>Show: <input type="checkbox" name="showDate">&nbsp;Bold: <input type="checkbox" name="dateBold" >&nbsp;Italic: <input type="checkbox" name="dateItalic"></td></tr><tr><td>Category:</td><td>Show: <input type="checkbox" name="showCategory">&nbsp;Bold: <input type="checkbox" name="categoryBold">&nbsp;Italic: <input type="checkbox" name="categoryItalic"></td></tr></table><table class="archivepages-contentTable"><tr><td>Color:</td><td><input type="text" name="contentColor" class="input_colorpicker" value="" /></td></tr><tr><td>Alignment:</td><td><select name="contentAlignment" data-sel=""><option>Justify</option><option>Left</option><option>Center</option><option>Right</option></select></td></tr><tr><td>Max Words:</td><td><input type="text" name="contentMaxWords" value=""/></td></tr></table><table class="archivepages-readMoreTable"><tr><td>Label:</td><td><input type="text" name="readmoreLabel" value=""/></td></tr><tr><td>Color:</td><td><input type="text" name="readmoreColor" class="input_colorpicker" value=""/></td></tr><tr><td>Hover Color:</td><td><input type="text" name="readmoreHoverColor" class="input_colorpicker" value=""/></td></tr><tr><td>Visited Color:</td><td><input type="text" name="readmoreVisitedColor" class="input_colorpicker" value=""/></td></tr><tr><td>Alignment:</td><td><select name="readMoreAlignment" data-sel=""><option>Left</option><option>Center</option><option>Right</option><option>With Text</option></select></td></tr></table><table class="archivepages-related"><tr><td>Related Links Headline:</td><td><input type="text" name="relatedLinksHeadline" class="" value=""/></td></tr></table><div class="button-primary jb_style_archivepages_clear" style="float:left;">Clear</div>&nbsp;<div class="button-primary jb_style_archivepages_close" style="float:right;">Close</div></div><div class="button-primary settings-archivepages-style">Settings</div></div><div class="mcol"><div class="button-primary delete-archivepages-style">Delete</div></div></div>';
		template = template.replace(/{{STYLE_LABEL}}/,"Style "+styleNo);
		
		$(".archive-styles-list").append(template);
		
		$(".archive-styles-list .input_colorpicker").ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#'+hex);
				$(el).css('background-color','#'+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
			$(this).css('background-color',this.value);
		}).keyup();	
		BindImageSelector();
		
	});
	
	$(".archive-styles-list").on('click','.mrow .delete-archivepages-style',function(){
		$(this).closest(".mrow").remove();
	});
	
	$(".save-archivepages-style").bind('click',function(){
		
		var styles =  {};
		var styleOptions = "";
		$(".archive-styles-list .mrow").each(function(){
			styles[$(this).index()]= {
										label: $(this).find("input[name='styleLabel']").val(),
										cols: $(this).find("input[name='colCount']").val(),
										MPP : $(this).find("input[name='MPP']").val(),
										colPadding:$(this).find("input[name='colPadding']").val(),
										colBgColor: $(this).find("input[name='colBgColor']").val(),
										headline:{
													color: $(this).find("input[name='headlineColor']").val(),
													align: $(this).find("select[name='headlineAlignment']").val(),
													bold: $(this).find("input[name='headlineBold']").prop("checked"),
													italic:$(this).find("input[name='headlineItalic']").prop("checked")
												},
										subheadline:{
													color: $(this).find("input[name='subheadlineColor']").val(),
													align: $(this).find("select[name='subheadlineAlignment']").val(),
													author: {
																show: $(this).find("input[name='showAuthor']").prop("checked"),
																bold: $(this).find("input[name='authorBold']").prop("checked"),
																italic: $(this).find("input[name='authorItalic']").prop("checked")
															 },
													date:	 {
																show: $(this).find("input[name='showDate']").prop("checked"),
																bold: $(this).find("input[name='dateBold']").prop("checked"),
																italic: $(this).find("input[name='dateItalic']").prop("checked")
															 },
													category:{
																show: $(this).find("input[name='showCategory']").prop("checked"),
																bold: $(this).find("input[name='categoryBold']").prop("checked"),
																italic: $(this).find("input[name='categoryItalic']").prop("checked")
															 }
												},
												
										content:{
													color: $(this).find("input[name='contentColor']").val(),
													align: $(this).find("select[name='contentAlignment']").val(),
													maxWord: $(this).find("input[name='contentMaxWords']").val()
												},
										fonts:{
											FontSize: $(this).find("input[name='contentFontSize']").val(),
											FontFamily: $(this).find("select[name='contentFontFamily']").val(),
											headlineSizePercent: $(this).find("input[name='headlineSizePercent']").val(),
											subHeadlineSizePercent: $(this).find("input[name='subHeadlineSizePercent']").val(),
											contentSizePercent: $(this).find("input[name='contentSizePercent']").val(),
											readMoreSizePercent: $(this).find("input[name='readMoreSizePercent']").val()
										},
										readMore:{
													label: $(this).find("input[name='readmoreLabel']").val(),
													color:  $(this).find("input[name='readmoreColor']").val(),
													hcolor:  $(this).find("input[name='readmoreHoverColor']").val(),
													vcolor:  $(this).find("input[name='readmoreVisitedColor']").val(),
													align:  $(this).find("select[name='readMoreAlignment']").val()
												 },
										image:{
													src: "",
													type: $(this).find("select[name='imageType']").val(),
													width: $(this).find("input[name='imageWidth']").val(),
													height: $(this).find("input[name='imageHeight']").val()
											  },
										pagination:{
													color: $(this).find("input[name='paginationColor']").val(),
													BGColor: $(this).find("input[name='paginationBGColor']").val(),
													ActiveBGColor: $(this).find("input[name='paginationActiveBGColor']").val(),
													ActiveColor: $(this).find("input[name='paginationActiveColor']").val()
										},
										item:{
												ListMaxWidth: $(this).find("input[name='ListMaxWidth']").val(),
												ListAlignment: $(this).find("select[name='ListAlignment']").val(),
												ListMaxWidthType: $(this).find("select[name='ListMaxWidthType']").val()
										},
										related:{
											headline: $(this).find("input[name='relatedLinksHeadline']").val()
										}
									};
									
			styleOptions += "<option>"+$(this).find("input[name='styleLabel']").val()+"</option>";
		});
		$.post(ajaxurl, {'action' : 'save_real_archive_page_styles', 'styles' : styles}, function(data, textStatus, xhr) {
			alert(data.substring(0,data.length-1));
			$(".archive-category-list .archive-category .archivePageStyle").each(function(){
				var val = $(this).val();
				$(this).empty();
				$(this).append(styleOptions);	
				$(this).val(val);
			});
			
		});
	});
	
	$(".save-archivepages-view").bind('click',function(){
		
		var settings = {};
		
		$(".archive-category-list .archive-category").each(function(){
			var termid = $(this).attr("data-id");
			settings[termid] = $(this).find(".archivePageStyle").val();
		});
			
		$.post(ajaxurl, {'action' : 'save_real_archive_page_view', 'settings' : settings}, function(data, textStatus, xhr) {
			alert(data.substring(0,data.length-1));
		});
	});
	$('#category_filter').keyup(function(event) {
		var filter = $(this).val();
		var list = $('.archive-category-list.mtable');
		if(filter.length){
			list.find('.mrow').each(function(index, el) {
				if($(this).find('.mcol:first').html().toLowerCase().indexOf(filter.toLowerCase()) != -1){
					$(this).show();
					$(this).attr('filter','');
				}else{
					$(this).attr('filter','out');
					$(this).hide();
				}
			});
		}else{
			list.find('.mrow').show();
			list.find('.mrow').attr('filter','');
		}
		list.find('.mrow[filter=""]').removeClass('line1');
		list.find('.mrow[filter=""]').removeClass('line2');
		list.find('.mrow[filter=""]:even').addClass('line2');
		list.find('.mrow[filter=""]:odd').addClass('line1');
	});
	$('#category_filter').keyup();
});
</script>