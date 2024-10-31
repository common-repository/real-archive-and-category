<?php
get_header();
function arc_sc_style($params){
	$style = "";
	foreach ($params as $key => $p) {
		if($p != ""){
			switch ($key) {
				case 'bgcolor':
					$style.="background-color:{$p};";
					break;
				case 'textcolor':
					$style.="color:{$p};";
					break;
				case 'textsize':
					$style.="font-size:{$p}px;";
					break;								
			}
		}
	}
	return $style;
}
function parse_arc_shorcode($shortcode,$content){
	//get assoc array with params;
	preg_match_all('/(\['.$shortcode.'[^\]\[]*\])/', $content, $codes);
	if(count($codes[0]) > 0){
		$arr_params = array();
		foreach ($codes[0] as $c) {
			preg_match_all('/([a-z0-9A-Z]+)\=\"([^\"\]\[]*)\"/', $c, $params);
			if(count($params[0]) > 0){
				$params_assoc = array();
				for ($i=0; $i < count($params[0]); $i++) { 
					if((isset($params[1][$i]))&&(isset($params[2][$i]))){
						$params_assoc[$params[1][$i]] = $params[2][$i];
					}
				}
				if(!empty($params_assoc)) $arr_params[] = $params_assoc;
			}
			$ret_code = "";
			//$titles = array('Add to Cart Free','Add to Cart Paid');
			switch ($shortcode) {
				case 'arc_edd_cart_link':
						if(function_exists('edd_get_purchase_link')){
							$form_html = edd_get_purchase_link();
							$form_html = str_replace('name="edd_purchase_download" value="Add to Cart"', 'name="edd_purchase_download" value="Add to Cart"',$form_html);
							//$form_html = str_replace("checked='checked'", '', $form_html);
							/*$cnt = preg_match_all('/input type="radio"[^\>]*id="[^\"\']+"[^\>]+/', $form_html, $matches);
							for ($i=0; $i < $cnt; $i++) {
								$new_button = str_replace('"radio"', '"radio" checked="checked"', $matches[0][$i]);
								$ret_code.= str_replace($matches[0][$i], $new_button, str_replace('name="edd_purchase_download" value="Add to Cart"', 'name="edd_purchase_download" value="'.$titles[$i].'"', $form_html));
							}*/
							$ret_code .= '<a href="'.$params_assoc['demo'].'" target="_blank" class="arc_extralink">Demo</a>';
							$ret_code .= $form_html;
							return $ret_code;
						}
					break;
			}
		}
		//process shorcdes params;
		foreach ($arr_params as $p) {
			switch ($shortcode) {
				case 'arc_link':
					$ret_code .= '<a href="'.$p['link'].'" target="_blank" class="arc_extralink" style="'.arc_sc_style($p).'">'.$p['title'].'</a>';
					break;
				case 'arc_settings':
					return $p;
					break;
				case 'arc_edd_cart_link':
					break;
			}
		}
		return $ret_code;
	}
	return "";
}

?>
	<script type="text/javascript" src=""></script>
	<section id="primary" class="site-content">
		<div id="content" role="main">
			<style type="text/css">
			/* custom download css */
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .arc_extralink:nth-child(odd),
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .edd_download_purchase_form:nth-child(odd) input[type="submit"],
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .arc_extralink:nth-child(even),
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .edd_download_purchase_form:nth-child(even) input[type="submit"]{
				color: white;
				font-size: 18px;
				display: inline-block;
				width: 140px;
				padding: 3px;
				line-height: normal;
				border: none;
				margin-bottom: 3px;
				margin-right: 5px;
			}		
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .arc_extralink:nth-child(even),
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .edd_download_purchase_form:nth-child(even) input[type="submit"]{
				background-color: red;
			}
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .arc_extralink:nth-child(odd),
			#archiveCategoryList .archiveCategory .archivePost:hover .postHover .edd_download_purchase_form:nth-child(odd) input[type="submit"]{
				background-color: blue;	
			}
			#archiveCategoryList .archivePost:hover .postHover .extralinks .edd_price_options{
				color: white;
				position: absolute;
				bottom: -20px;
				text-align: left;
				right: 20px;
			}
			#archiveCategoryList .archivePost:hover .postHover .extralinks .edd_download_purchase_form{
				display: inline-block;
				margin: 10px;
				margin-bottom: 40px;
			}
			/************************/
			#content .archive-header{
				padding-bottom: 0px;
				margin-bottom: 20px;
			}
			#archiveCategoryList{
				margin-left: <?php echo intval($GLOBALS['panels_left_width']+10) ?>px;
			}
			#archiveCategoryList{
				margin-right: <?php echo intval($GLOBALS['panels_right_width']+10) ?>px;
			}
			#archiveCategoryList .archiveCategory .archivePost .postFace img,
			#archiveCategoryList .archiveCategory .archivePost .postFace iframe{
				width: 100%;
			}
			.videoWrapper {
				position: relative;
				padding-bottom: 56.25%; /* 16:9 */
				height: 0;
			}
			.videoWrapper iframe {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				border: none;
			}
			#archiveCategoryList .archivePosts{
				display: table;
				width: 100%;
				height: 100%;
			}
			#archiveCategoryList .archivePost{
				z-index: 1;
				height: 100%;
				position: relative;
				margin: 0px;
				-moz-box-sizing: border-box;
			}
			#archiveCategoryList .archiveRow{
				display: table-row;
				height: 100%;
			}
			#archiveCategoryList .archiveCell{
				display: table-cell;
				vertical-align: top;
				position: relative;
				padding: 3px 3px 3px 3px;
			}
			#archiveCategoryList .archivePost .postHover{
			    position: absolute;
			    top: 0px;
			    left: 0px;
			    height: 100%;
			    width: 100%;
			    color: black;
			    text-decoration: none;
			    opacity:0.0;
			    filter:alpha(opacity=0);
			}
			#archiveCategoryList .archivePost:hover .postHover{
			    opacity:1.0;
			    filter:alpha(opacity=100);
			    -webkit-transition: all 0.5s ease-in-out;
			    -moz-transition: all 0.5s ease-in-out;
			    -o-transition: all 0.5s ease-in-out;
			    transition: all 0.5s ease-in-out;
				background: rgba(0,0,0,0.5);
		}
		#archiveCategoryList .archivePost:hover .postHover .extralinks{
			margin-bottom: 40px;
			position: absolute;
			bottom: 10px;
			right: 2px;
			width: 100%;
			text-align: center;
		}
		#archiveCategoryList .archive_related_links a{
			margin: 3px;
			display: block;
			margin-left: 5px;
			text-decoration: none;
		}
		#archiveCategoryList .archivePost:hover .postHover .arc_extralink{
			text-decoration: initial;
			padding: 3px;
			margin: 10px 5px 10px 10px;
			border-radius: 3px;
			cursor: pointer;			
		}
		#archiveCategoryList .archivePost .postHover .hoverTitle{
				position: absolute;
				width: 100%;
				text-align: center;
				top: 5px;
				font-weight: bold;
				color: white;
			}
			#archiveCategoryList .archivePost .postHover .postDetails{
				position: absolute;
				background-image: url('<?php echo plugin_dir_url(__FILE__); ?>css/images/search.png');
				cursor: pointer;
				width: 32px;
				height: 32px;
				left: 0px;
				right: 0px;
				top: 0px;
				bottom: 0px;
				margin-left: auto;
				margin-right: auto;
				margin-top: auto;
				margin-bottom: auto;
			}
			@media screen and (-webkit-min-device-pixel-ratio:0) { 
			 #archiveCategoryList .archiveCell{
			 	padding: 3px 3px 3px 3px;
			 }
			}			
			</style>
			<?php
				echo '<div class="real_sidebar_non_extruder left">'.$GLOBALS['panels_left'].'</div>';
			?>
			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
						elseif ( is_category() ) :
							printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' );
						else :
							//_e( 'Archives', 'twentytwelve' );
							printf( __( '%s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' );
							$disable_first_title = TRUE;						
						endif;
					?></h1>
				</header><!-- .archive-header -->
				<div id="archiveCategoryList">
					<?php
					$archivepage_styles = json_decode(get_option('real_archive_page_styles'),true);
					$archivepage_settings =  json_decode(get_option('real_archive_page_settings'),true);
					
					//var_dump($archivepage_styles);
					
					$args = array(
								  'orderby' => 'name',
								  'parent' => 0,
								  'style' => 'none',
								  'taxonomy' => 'category',
								  'hide_empty' => 0,
								  'depth' => 1,
								  'title_li' => ''
								);
					$categories = array();
					if(is_category()){
						$categories[] = get_category(get_query_var('cat'),false);
					}elseif(is_archive()){
						$categories = get_categories($args);
						$obj = get_queried_object();
						if($obj != NULL){
							$obj->cat_name = $obj->name;
							$categories = array();
							$categories[] = $obj;
						}
					}
					foreach ($categories as $cat)
					{
						//get category style name
						$stylename = 	$archivepage_settings[$cat->term_id];
						if($stylename == NULL){
							$child = $cat;
							while($stylename == NULL){
								if(!empty($child->parent)){
									$child = get_term( $child->parent, $child->taxonomy);
									$stylename = 	$archivepage_settings[$child->term_id];
								}
								else{
									break;
								}
							}
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
						if((is_category())||(in_array($cat->taxonomy, array('download_category')))){
							global $post;
							$cat_pageid = intval(get_query_var('paged'));
							if($cat_pageid>0){
								$offset = ($cat_pageid - 1)*intval($styleDetails["MPP"]);
							}
							if(empty($styleDetails["MPP"])){
								$styleDetails["MPP"] = -1;
								$offset = 0;
							}
							$max_per_page = intval($styleDetails["MPP"]);
						}else{
							$max_per_page = -1;
							$offset = 0;
						}

						//get posts belong to parent category
						//get all psot types
						$pt = array();
						$p_types = get_post_types('','names');
						foreach ($p_types as $k => $v) {
						 	$pt[] = $v;
						}
						$pargs = array(
							//'category' => $cat->term_id,
							'post_type' => $pt,
						    'tax_query' => array(
						        array(
						        'taxonomy' => $cat->taxonomy,
						        'field' => 'term_id',
						        'terms' => $cat->term_id)
						    ),
							'posts_per_page' => $max_per_page,
							'offset' => $offset
						);
						$posts = get_posts($pargs); 
						
						//continue if no post in parent category so we dont show blank category list
						if(count($posts) == 0)
							continue;
							
						//create style
						
						//post style
						$postStyle = "";
						if(empty($styleDetails["cols"])) $styleDetails["cols"] = 1;
						$styleDetails["cols"] = intval($styleDetails["cols"]);
						$wid = 100 / $styleDetails["cols"];
						$maxWid = (strpos($styleDetails["colWidth"], "%") === FALSE) ? (strpos($styleDetails["colWidth"], "px") === FALSE)? $styleDetails["colWidth"]."px":$styleDetails["colWidth"]:$styleDetails["colWidth"];
								
						$padding = (strpos($styleDetails["colPadding"], "%") === FALSE) ? (strpos($styleDetails["colPadding"], "px") === FALSE)? $styleDetails["colPadding"]."px":$styleDetails["colPadding"]:$styleDetails["colPadding"];
										
						//content style
						$maxWords = $styleDetails["content"]["maxWord"];
					
						//var_dump($styleDetails);		
					?>
						<style>
							<?php if((is_category())||(in_array($cat->taxonomy, array('download_category')))): ?>
							nav.arc-navigation{
								margin-bottom: 20px;
								margin-top: 20px;
								text-align: center;
							}
							nav.arc-navigation a,nav.arc-navigation span{
								text-decoration: inherit;
								text-transform: uppercase;
								padding: 5px;
							}
							nav.arc-navigation a{
								color: <?php echo $styleDetails["pagination"]["color"]; ?>;
								background-color: <?php echo $styleDetails["pagination"]["BGColor"]; ?>;
							}
							nav.arc-navigation span{
								color: <?php echo $styleDetails["pagination"]["ActiveColor"]; ?>;
								background-color: <?php echo $styleDetails["pagination"]["ActiveBGColor"]; ?>;								
							}
							<?php endif; ?>
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archive_related_links a{
								<?php 
									if(!empty($styleDetails["fonts"]["FontFamily"])){
										echo "font-family:".$styleDetails["fonts"]["FontFamily"].";".PHP_EOL;
									}
									if(empty($styleDetails["fonts"]["FontSize"])) $styleDetails["fonts"]["FontSize"] = 20;
									if(empty($styleDetails["fonts"]["headlineSizePercent"])) $styleDetails["fonts"]["headlineSizePercent"] = 125;
									if(empty($styleDetails["fonts"]["subHeadlineSizePercent"])) $styleDetails["fonts"]["subHeadlineSizePercent"] = 110;
									if(empty($styleDetails["fonts"]["contentSizePercent"])) $styleDetails["fonts"]["contentSizePercent"] = 100;
									if(empty($styleDetails["fonts"]["readMoreSizePercent"])) $styleDetails["fonts"]["readMoreSizePercent"] = 50;
								?>								
								<?php 
									if(!empty($styleDetails["readMore"]["color"])){
										echo "color:".$styleDetails["readMore"]["color"].";";
									}								
								?>
								font-size:<?php echo intval($styleDetails["fonts"]["FontSize"]*$styleDetails["fonts"]["readMoreSizePercent"]/100) ?>px;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archive_related_header{
								font-size:<?php echo intval($styleDetails["fonts"]["FontSize"]*$styleDetails["fonts"]["headlineSizePercent"]/100) ?>px;	
								<?php
								if(!empty($styleDetails["headline"]["color"])){
									echo "color:".$styleDetails["headline"]["color"].";";
								}
								?>
							}							
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archiveCell{
								<?php 
									if($styleDetails["image"]["type"] != "Full"){
										echo "width:".$wid."%;";
									}else{
										echo "width:".intval($styleDetails["image"]["width"])."px;";
									}
									echo "padding:".intval($padding)."px;";
								?>
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost{
								padding: <?php echo (($styleDetails["image"]["type"] != "Full") ? '5px'/*$padding*/ : "0px;min-height:".$styleDetails["image"]["height"]."px") ?>;
								background: <?php echo $styleDetails["colBgColor"];?>;
								vertical-align:top;
								<?php if($styleDetails["image"]["type"] == "Thumb") { ?>
									min-height: <?php echo intval($styleDetails["image"]["height"])."px"; ?>;
								<?php } ?>
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost:hover .postHover .arc_extralink{
								<?php 
									if(!empty($styleDetails["extralinks"]["color"])) echo "color:".$styleDetails["extralinks"]["color"].";";
									if(!empty($styleDetails["extralinks"]["bgcolor"])) echo "background-color:".$styleDetails["extralinks"]["bgcolor"].";";
									if(!empty($styleDetails["extralinks"]["size"])) echo "font-size:".$styleDetails["extralinks"]["size"]."px;";
								?>
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost .postFace{
								<?php
									switch($styleDetails["image"]["type"]){
										case "Thumb":
											echo "float:left;margin-right:5px;";
											if(empty($styleDetails["image"]["width"])){
												$styleDetails["image"]["width"] = '40%';
											}else{
												$styleDetails["image"]["width"].='px';
											}
											echo "width:".$styleDetails["image"]["width"].";";
											if(!empty($styleDetails["image"]["height"])){
												echo "height:".$styleDetails["image"]["height"]."px;";
											}											
										break;
										case "Full":
											echo "width:".intval($styleDetails["image"]["width"])."px;";
											echo "height:".intval($styleDetails["image"]["height"])."px;";
										break;
									}
								?>
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost .postFace img,
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost .postFace .videoWrapper{
								<?php
									switch($styleDetails["image"]["type"]){
										case "Thumb":
											if(!empty($styleDetails["image"]["height"])){
												echo "height:100%;width:100%;padding:0px;";
											}
										break;
										case "Full":
											echo "height:100%;width:100%;padding:0px;";
										break;										
									}
								?>								
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost h1.postTitle{
								font-weight:normal;
								font-size:<?php echo intval($styleDetails["fonts"]["FontSize"]*$styleDetails["fonts"]["headlineSizePercent"]/100) ?>px;
								margin-bottom:5px;
								text-align:<?php echo strtolower($styleDetails["headline"]["align"]);?>;
								margin-top: 0px;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost h1.postTitle a{
								color:<?php echo $styleDetails["headline"]["color"];?>;
								font-weight:<?php echo ($styleDetails["headline"]["bold"] === "true")?"bold":"normal";?>;
								font-style:<?php echo ($styleDetails["headline"]["italic"] === "true")?"italic":"normal";?>;
								text-decoration:none;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost h4.postSubTitle{
								margin-bottom:20px;
								font-size:<?php echo intval($styleDetails["fonts"]["FontSize"]*$styleDetails["fonts"]["subHeadlineSizePercent"]/100) ?>px;
								font-weight:normal;
								color:<?php echo $styleDetails["subheadline"]["color"];?>;
								text-align:<?php echo strtolower($styleDetails["subheadline"]["align"]);?>;
								display:<?php ($styleDetails["subheadline"]["author"]["show"] === "true" || $styleDetails["subheadline"]["date"]["show"] === "true" || $styleDetails["subheadline"]["category"]["show"] === "true")?"block":"none"?>;
								
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost h4.postSubTitle .author{
								font-weight:<?php echo ($styleDetails["subheadline"]["author"]["bold"] === "true")?"bold":"normal";?>;
								font-style:<?php echo ($styleDetails["subheadline"]["author"]["italic"] === "true")?"italic":"normal";?>;
								display:<?php echo ($styleDetails["subheadline"]["author"]["show"] === "true")?"inline":"none";?>;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost h4.postSubTitle .date{
								font-weight:<?php echo ($styleDetails["subheadline"]["date"]["bold"] === "true")?"bold":"normal";?>;
								font-style:<?php echo ($styleDetails["subheadline"]["date"]["italic"] === "true")?"italic":"normal";?>;
								display:<?php echo ($styleDetails["subheadline"]["date"]["show"] === "true")?"inline":"none";?>;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost h4.postSubTitle .category{
								font-weight:<?php echo ($styleDetails["subheadline"]["category"]["bold"] === "true")?"bold":"normal";?>;
								font-style:<?php echo ($styleDetails["subheadline"]["category"]["italic"] === "true")?"italic":"normal";?>;
								display:<?php echo ($styleDetails["subheadline"]["category"]["show"] === "true")?"inline":"none";?>;
							}
							
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost h4.postDescription{
								color:<?php echo $styleDetails["content"]["color"];?>;
								font-size:<?php echo intval($styleDetails["fonts"]["FontSize"]*$styleDetails["fonts"]["contentSizePercent"]/100) ?>px;
								text-align:<?php echo strtolower($styleDetails["content"]["align"]);?>;
								font-weight:normal;
							}
							.archiveCategory.archcat_<?php echo $cat->term_id?> {
								<?php
									if($styleDetails["image"]["type"] == "Full"){
										$styleDetails["item"]["ListMaxWidth"] = intval($styleDetails["image"]["width"])*intval($styleDetails["cols"]);
										$styleDetails["item"]["ListMaxWidth"] += $padding*intval($styleDetails["cols"])*2;
										$styleDetails["item"]["ListMaxWidthType"] = 'px';
									}
									if(!empty($styleDetails["item"]["ListMaxWidth"])){
										echo "width:".$styleDetails["item"]["ListMaxWidth"].$styleDetails["item"]["ListMaxWidthType"].";".PHP_EOL;	//"
									}
									if(!empty($styleDetails["item"]["ListAlignment"])){
										switch($styleDetails["item"]["ListAlignment"]){
											case "Center":
											echo "margin-left:auto;".PHP_EOL."margin-right:auto;".PHP_EOL;
											break;
											case "Right":
											echo "margin-left: auto;".PHP_EOL;
											break;
										}
									}									
								?>
							}
							.archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost .postReadMore {
								<?php if($styleDetails["readMore"]["align"] == 'With Text'){ ?>
									display: inline;
								<?php } else { ?>
									text-align:<?php echo strtolower($styleDetails["readMore"]["align"]);?>;
									margin-top:20px;
								<?php } ?>
								font-size:<?php echo intval($styleDetails["fonts"]["FontSize"]*$styleDetails["fonts"]["readMoreSizePercent"]/100) ?>px;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePosts{
								width: <?php echo (($styleDetails["image"]["type"] == "Full") ? "auto" : "100%") ?>;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost .postReadMore a{
								color:<?php echo $styleDetails["readMore"]["color"];?>;
								font-size:13px;
								text-decoration:none;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost .postReadMore a:hover{
								color:<?php echo $styleDetails["readMore"]["hcolor"];?>;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .archivePost .postReadMore a:visited{
								color:<?php echo $styleDetails["readMore"]["vcolor"];?>;
							}
							#archiveCategoryList .archiveCategory.archcat_<?php echo $cat->term_id?> .categoryName{
								padding: <?php echo intval($padding)."px"; ?>
							}							
						</style>
					
						<div class="archiveCategory archcat_<?php echo $cat->term_id?>">
							<?php if((!is_category())&&(!$disable_first_title)):?><h2 class="categoryName"><?php echo $cat->cat_name;?></h2><?php endif; $disable_first_title = FALSE;?>
							<div class="archivePosts">
								<?php
									$post_n = 1;
									foreach($posts as $post)
									{
										if($post_n == 1){
											?>
										<div class="archiveRow">
											<?php
										}
										$post_face = json_decode(get_post_meta($post->ID,'archive_face_content',true),true);
								?>	
									<div class="archiveCell">
										<div class="archivePost">
											<?php
												$related_cats = get_post_meta($post->ID, 'archive_related_categories', true);
												$related_pages = get_post_meta($post->ID, 'archive_related_pages', true);
												$related_output = '';
												if(!empty($related_pages)){
													$related_pages = explode(',',$related_pages);
													foreach ($related_pages as $p) {
														$rel_page = get_page(intval($p));
														$related_output .= '<a href="'.get_permalink(intval($p)).'">'.$rel_page->post_title.'</a>';
														unset($rel_page);
													}
												}												
												if(!empty($related_cats)){
													$related_cats = explode(',',$related_cats);
													foreach ($related_cats as $c) {
														$rel_cat = get_category(intval($c),false);
														$related_output .= '<a href="'.get_category_link(intval($c)).'">'.$rel_cat->name.'</a>';
														unset($rel_cat);
													}
												}
												if(!empty($related_output)){
													$related_output = '<div class="archive_related_links"><div class="archive_related_header">'.$styleDetails['related']['headline'].'</div>'.$related_output.'</div>';
												}
												if($styleDetails["image"]["type"] != "Full"){
													if(empty($post_face['link'])){
														//$post_face['link']
													}
												}
												if((is_array($post_face))&&(!empty($post_face['link']))&&($styleDetails["image"]["type"] != 'No Image')){
													echo '<div class="postFace">';
													switch ($post_face['type']) {
														case 'youtube':
															echo '<div class="videoWrapper"><iframe src="'.$post_face['link'].'"></iframe></div>';
															break;
														default:
															# Image
															echo '<img src="'.$post_face['link'].'"/>';
															break;
													}
													echo '</div>';
												}
											?>
											<?php if($styleDetails["image"]["type"] != 'Full'): ?>
											<h1 class="postTitle"><a href="<?php echo $post->guid ?>"><?php echo $post->post_title ?></a></h1>
											<h4 class="postSubTitle">Posted <span class="author">by <?php echo the_author_meta('user_nicename',$post->post_author);?></span> <span class="date">on <?php echo date('M jS, Y',strtotime($post->post_date)) ?></span> <span class="category">in <?php echo $cat->cat_name ?></span></h4>
											<h4 class="postDescription"><?php 
												if(empty($post_face['text'])){
													echo wp_trim_words($post->post_content,$maxWords,"...");
												}else{
													echo wp_trim_words(urldecode($post_face['text']),$maxWords,"...");
												}
												if($styleDetails["readMore"]["align"] != 'With Text'){ echo '</h4>'; }
											?>
											<div class="postReadMore">
												<a href="<?php echo $post->guid ?>"><?php echo $styleDetails["readMore"]["label"]?></a>
											</div>
											<?php if($styleDetails["readMore"]["align"] == 'With Text'){ echo '</h4>'; } ?>
											<?php else: ?>
												<div class="postHover">
													<div class="hoverTitle"><?php echo $post->post_title; ?></div>
													<?php
														$extralinks = parse_arc_shorcode('arc_link',$post->post_content);
														if(!empty($extralinks)){
															echo '<div class="extralinks">'.$extralinks.'</div>';
														}
														$arc_sc_settings = parse_arc_shorcode('arc_settings',$post->post_content);
														$cartlinks = parse_arc_shorcode('arc_edd_cart_link',$post->post_content);
														if(!empty($cartlinks)){
															echo '<div class="extralinks">'.$cartlinks.'</div>';
														}														
													?>													
													<?php if($arc_sc_settings['nodetails'] != '1'){ ?><a href="<?php echo $post->guid ?>" class="postDetails"></a><?php } ?>
												</div>
											<?php endif; ?>
											<?php
												if($styleDetails["image"]["type"] != "Full"){
													echo $related_output;
												}
											?>
										</div>
											<?php
												if($styleDetails["image"]["type"] == "Full"){
													echo $related_output;
												}
											?>
									</div>
									<?php		
										if(($post_n % $styleDetails["cols"] == 0)||($post === end($posts))){
											//close row
												$post_n = 1;
											?>
												</div>
											<?php
										}else{
											$post_n++;
										}
									}
								?>
								<div class="clear"></div>
							</div>
							
							
						</div>
					<?php
					}
					?>
				</div>				
			<?php endif; ?>
			<?php
				echo '<div class="real_sidebar_non_extruder right">'.$GLOBALS['panels_right'].'</div>';
			?>
			<?php
			//NAVIGATION
				if (( $wp_query->max_num_pages > 1 )&&($max_per_page > 0)) : 
					?>
					<nav class="arc-navigation" role="navigation">
						<?php
							$big = 999999999;
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages
							) );						
						?>
					</nav>
				<?php endif;		
			?>
		</div><!-- #content -->
	</section><!-- #primary -->
<?php
get_sidebar();
get_footer();
?>