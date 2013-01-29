<?php
function superb_get_def_settings()
{
	$superb_settings = array('slideshow_width' => '600',
	'slideshow_height' => '240',
	'noof_squares_coloumn' => '7',
	'noof_squares_rows' => '3',
	'spacing_broken_square' => '10',
	'auto_play' => 'true',
	'random_slide' => 'false',
	'use_buttons' => 'true',
	'slide_transition' => '1',
	'slide_transition_delay' => '2',
	'text1_pos' => 'left',
	'text1_xpos' => '20',
	'text1_ypos' => '100',
	'text1_color' => '#000000',
	'text1_size' => '24',
	'text1_bgcolor' => '#FFFFFF',
	'text1_bgcolor_alpha' => '100',
	'text2_pos' => 'left',
	'text2_xpos' => '20',
	'text2_ypos' => '160',
	'text2_color' => '#FFFFFF',
	'text2_size' => '24',
	'text2_bgcolor' => '#000000',
	'text2_bgcolor_alpha' => '100',
	'show_text1' => 'yes',
	'show_text2' => 'yes',
	'scale_image' => 'false',
	'target' => '_self',
	'use_link' => 'yes'		
			);
	return $superb_settings;
}
function __get_superb_xml_settings()
{
	// (($ops['auto_play'] == 'yes') ? 'true' : 'false')
	//SPB_PLUGIN_URL.'/price_images/'.$ops['pricebtn_img']
	$ops = get_option('superb_settings', array());
	$xml_settings = '<swfWidth>'.$ops['slideshow_width'].'</swfWidth>
		<swfHeight>'.$ops['slideshow_height'].'</swfHeight>
		<imageWidth>'.$ops['slideshow_width'].'</imageWidth>
		<imageHeight>'.$ops['slideshow_height'].'</imageHeight>
		<columns>'.$ops['noof_squares_coloumn'].'</columns>

		<rows>'.$ops['noof_squares_rows'].'</rows>
		<spacing>'.$ops['spacing_broken_square'].'</spacing>
		<autoPlay>'.$ops['auto_play'].'</autoPlay>
		<randomizeSlideOrder>'.$ops['random_slide'].'</randomizeSlideOrder>
		<cycleTransitions>'.$ops['slide_transition'].'</cycleTransitions>
		<useButtons>'.$ops['use_buttons'].'</useButtons>

		<leftButton>'.SPB_PLUGIN_URL.'/buttons/left.png</leftButton>
		<rightButton>'.SPB_PLUGIN_URL.'/buttons/right.png</rightButton>
		<leftButtonOver>'.SPB_PLUGIN_URL.'/buttons/left_over.png</leftButtonOver>
		<rightButtonOver>'.SPB_PLUGIN_URL.'/buttons/right_over.png</rightButtonOver>';
	return $xml_settings;
}
function superb_get_album_dir($album_id)
{
	global $gspb;
	$album_dir = SPB_PLUGIN_UPLOADS_DIR . "/{$album_id}_uploadfolder";
	return $album_dir;
}
/**
 * Get album url
 * @param $album_id
 * @return unknown_type
 */
function superb_get_album_url($album_id)
{
	global $gspb;
	$album_url = SPB_PLUGIN_UPLOADS_URL . "/{$album_id}_uploadfolder";
	return $album_url;
}
function superb_get_table_actions(array $tasks)
{
	?>
	<div class="bulk_actions">
		<form action="" method="post" class="bulk_form">Bulk action
			<select name="task">
				<?php foreach($tasks as $t => $label): ?>
				<option value="<?php print $t; ?>"><?php print $label; ?></option>
				<?php endforeach; ?>
			</select>
			<button class="button-secondary do_bulk_actions" type="submit">Do</button>
		</form>
	</div>
	<?php 
}
function shortcode_display_superb_gallery($atts)
{
	$vars = shortcode_atts( array(
									'cats' => '',
									'imgs' => '',
								), 
							$atts );
	//extract( $vars );
	
	$ret = display_superb_gallery($vars);
	return $ret;
}
function display_superb_gallery($vars)
{
	global $wpdb, $gspb;
	$ops = get_option('superb_settings', array());
	//print_r($ops);
	$albums = null;
	$images = null;
	$cids = trim($vars['cats']);
	if (strlen($cids) != strspn($cids, "0123456789,")) {
		$cids = '';
		$vars['cats'] = '';
	}
	$imgs = trim($vars['imgs']);
	if (strlen($imgs) != strspn($imgs, "0123456789,")) {
		$imgs = '';
		$vars['imgs'] = '';
	}
	$categories = '';
	$xml_filename = '';
	if( !empty($cids) && $cids{strlen($cids)-1} == ',')
	{
		$cids = substr($cids, 0, -1);
	}
	if( !empty($imgs) && $imgs{strlen($imgs)-1} == ',')
	{
		$imgs = substr($imgs, 0, -1);
	}
	//check for xml file
	if( !empty($vars['cats']) )
	{
		$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';	
	}
	elseif( !empty($vars['imgs']))
	{
		$xml_filename = "image_".str_replace(',', '', $imgs) . '.xml';
	}
	else
	{
		$xml_filename = "superb_all.xml";
	}
	//die(SPB_PLUGIN_XML_DIR . '/' . $xml_filename);

	$imageContainer = "";
	
	if( !empty($vars['cats']) )
	{
		$query = "SELECT * FROM {$wpdb->prefix}superb_albums WHERE album_id IN($cids) AND status = 1 ORDER BY `order` ASC";
		//print $query;
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gspb->superb_get_album_images($album['album_id']);
			if ($images && !empty($images) && is_array($images)) {
				$album_dir = superb_get_album_url($album['album_id']);//SPB_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];

				foreach($images as $key => $img)
				{
					if( $img['status'] == 0 ) continue;
					
					$imageContainer .= "<item><url scale=\"".$ops['scale_image']."\">".str_replace(" ","-",$album_dir)."/big/{$img['image']}</url><transition>".$ops['slide_transition']."</transition><delay>".$ops['slide_transition_delay']."</delay>".($ops['use_link']=='no'?"":"<link>{$img['link']}</link>")."<target>".$ops['target']."</target><content>";
					
					if($ops['show_text1']=='yes'&&$img['title']!='')
					
					$imageContainer .= "<text><position>".$ops['text1_pos']."</position><x>".$ops['text1_xpos']."</x><y>".$ops['text1_ypos']."</y><color>".$ops['text1_color']."</color><size>".$ops['text1_size']."</size><bgColor>".$ops['text1_bgcolor']."</bgColor><bgAlpha>".$ops['text1_bgcolor_alpha']."</bgAlpha><words>".$img['title']."</words></text>";
					

					if($ops['show_text2']=='yes'&&$img['description']!='')
					
					$imageContainer .= "<text><position>".$ops['text2_pos']."</position><x>".$ops['text2_xpos']."</x><y>".$ops['text2_ypos']."</y><color>".$ops['text2_color']."</color><size>".$ops['text2_size']."</size><bgColor>".$ops['text2_bgcolor']."</bgColor><bgAlpha>".$ops['text2_bgcolor_alpha']."</bgAlpha><words>".$img['description']."</words></text>";
					
					$imageContainer .="</content></item>";
				}

			}
		}
		//$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';
	}
	elseif( !empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}superb_images WHERE image_id IN($imgs) AND status = 1 ORDER BY `order` ASC";
		$images = $wpdb->get_results($query, ARRAY_A);
		if ($images && !empty($images) && is_array($images)) {

			foreach($images as $key => $img)
			{
				$album = $gspb->superb_get_album($img['category_id']);
				$album_dir = superb_get_album_url($album['album_id']);//SPB_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				if( $img['status'] == 0 ) continue;
				
				$imageContainer .= "<item><url scale=\"".$ops['scale_image']."\">".str_replace(" ","-",$album_dir)."/big/{$img['image']}</url><transition>".$ops['slide_transition']."</transition><delay>".$ops['slide_transition_delay']."</delay>".($ops['use_link']=='no'?"":"<link>{$img['link']}</link>")."<target>".$ops['target']."</target><content>";
					
					if($ops['show_text1']=='yes'&&$img['title']!='')
					
					$imageContainer .= "<text><position>".$ops['text1_pos']."</position><x>".$ops['text1_xpos']."</x><y>".$ops['text1_ypos']."</y><color>".$ops['text1_color']."</color><size>".$ops['text1_size']."</size><bgColor>".$ops['text1_bgcolor']."</bgColor><bgAlpha>".$ops['text1_bgcolor_alpha']."</bgAlpha><words>".$img['title']."</words></text>";
					

					if($ops['show_text2']=='yes'&&$img['description']!='')
					
					$imageContainer .= "<text><position>".$ops['text2_pos']."</position><x>".$ops['text2_xpos']."</x><y>".$ops['text2_ypos']."</y><color>".$ops['text2_color']."</color><size>".$ops['text2_size']."</size><bgColor>".$ops['text2_bgcolor']."</bgColor><bgAlpha>".$ops['text2_bgcolor_alpha']."</bgAlpha><words>".$img['description']."</words></text>";
					
					$imageContainer .="</content></item>";
			}
		}
	}
	//no values paremeters setted
	else//( empty($vars['cats']) && empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}superb_albums WHERE status = 1 ORDER BY `order` ASC";
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gspb->superb_get_album_images($album['album_id']);
			$album_dir = superb_get_album_url($album['album_id']);//SPB_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
			if ($images && !empty($images) && is_array($images)) {
				foreach($images as $key => $img)
				{
					if($img['status'] == 0 ) continue;
					
					$imageContainer .= "<item><url scale=\"".$ops['scale_image']."\">".str_replace(" ","-",$album_dir)."/big/{$img['image']}</url><transition>".$ops['slide_transition']."</transition><delay>".$ops['slide_transition_delay']."</delay>".($ops['use_link']=='no'?"":"<link>{$img['link']}</link>")."<target>".$ops['target']."</target><content>";
					
					if($ops['show_text1']=='yes'&&$img['title']!='')
					
					$imageContainer .= "<text><position>".$ops['text1_pos']."</position><x>".$ops['text1_xpos']."</x><y>".$ops['text1_ypos']."</y><color>".$ops['text1_color']."</color><size>".$ops['text1_size']."</size><bgColor>".$ops['text1_bgcolor']."</bgColor><bgAlpha>".$ops['text1_bgcolor_alpha']."</bgAlpha><words>".$img['title']."</words></text>";
					

					if($ops['show_text2']=='yes'&&$img['description']!='')
					
					$imageContainer .= "<text><position>".$ops['text2_pos']."</position><x>".$ops['text2_xpos']."</x><y>".$ops['text2_ypos']."</y><color>".$ops['text2_color']."</color><size>".$ops['text2_size']."</size><bgColor>".$ops['text2_bgcolor']."</bgColor><bgAlpha>".$ops['text2_bgcolor_alpha']."</bgAlpha><words>".$img['description']."</words></text>";
					
					$imageContainer .="</content></item>";
				}
			}
		}
		//$xml_filename = "superb_all.xml";
	}
	
	$xml_tpl = __get_superb_xml_template();
	$settings = __get_superb_xml_settings();
//	$xml = str_replace(array('{settings}', '{default_category}', '{categories}'), 
//						array($settings, $album['album_id'], $categories), $xml_tpl);
	$xml = str_replace(array('{settings}', '{image_container}'), 
						array($settings, $imageContainer), $xml_tpl);
						
	//write new xml file
	$fh = fopen(SPB_PLUGIN_XML_DIR . '/' . $xml_filename, 'w+');
	fwrite($fh, $xml);
	fclose($fh);
	//print "<h3>Generated filename: $xml_filename</h3>";
	//print $xml;
	if( file_exists(SPB_PLUGIN_XML_DIR . '/' . $xml_filename ) )
	{
		$fh = fopen(SPB_PLUGIN_XML_DIR . '/' . $xml_filename, 'r');
		$xml = fread($fh, filesize(SPB_PLUGIN_XML_DIR . '/' . $xml_filename));
		fclose($fh);
		//print "<h3>Getting xml file from cache: $xml_filename</h3>";
		$ret_str = "
		<script language=\"javascript\">AC_FL_RunContent = 0;</script>
<script src=\"".SPB_PLUGIN_URL."/js/AC_RunActiveContent.js\" language=\"javascript\"></script>

		<script language=\"javascript\"> 
	if (AC_FL_RunContent == 0) {
		alert(\"This page requires AC_RunActiveContent.js.\");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '".$ops['slideshow_width']."',
			'height', '".$ops['slideshow_height']."',
			'src', '".SPB_PLUGIN_URL."/js/wp_superbslideshow',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '".$ops['wmode']."',
			'devicefont', 'false',
			'id', 'xmlswf_vmsss',
			'bgcolor', '".$ops['backgroundColor']."',
			'name', 'xmlswf_vmsss',
			'menu', 'true',
			'allowFullScreen', 'true',
			'allowScriptAccess','sameDomain',
			'movie', '".SPB_PLUGIN_URL."/js/wp_superbslideshow',
			'salign', '',
			'flashVars','xmlURL=".SPB_PLUGIN_URL."/xml/$xml_filename'
			); //end AC code
	}
</script>
";
//echo SPB_PLUGIN_UPLOADS_URL."<hr>";
//		print $xml;
		return $ret_str;
	}
	return true;
}
function __get_superb_xml_template()
{
	$xml_tpl = '<?xml version="1.0" encoding="utf-8" ?>
				<data>
					<settings>{settings}</settings><!-- end settings -->
					<media>{image_container}					    
					</media><!-- end images -->
				</data>';
	return $xml_tpl;
}
?>