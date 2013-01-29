<?php
global $wpdb, $gspb;
$ops = get_option('superb_settings', array());
//$ops = array_merge($superb_settings, $ops);
?>
<div class="wrap">
	<h2><?php _e('Create XML File'); ?></h2>
	<form action="" method="post">
		<input type="hidden" name="task" value="save_superb_settings" />
		<table>
		<tr>
			<td><?php _e('Slideshow Width'); ?></td>
			<td><input type="text" name="settings[slideshow_width]" value="<?php print  @$ops['slideshow_width']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Slideshow Height'); ?></td>
			<td><input type="text" name="settings[slideshow_height]" value="<?php print  @$ops['slideshow_height']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Number of columns for the squares'); ?></td>
			<td><input type="text" name="settings[noof_squares_coloumn]" value="<?php print  @$ops['noof_squares_coloumn']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Number of rows for the squares'); ?></td>
			<td><input type="text" name="settings[noof_squares_rows]" value="<?php print  @$ops['noof_squares_rows']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('spacing for each square when broken'); ?></td>
			<td><input type="text" name="settings[spacing_broken_square]" value="<?php print  @$ops['spacing_broken_square']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Auto Play'); ?></td>
			<td>
				<input type="radio" name="settings[auto_play]" value="true" <?php print (@$ops['auto_play'] == 'true') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[auto_play]" value="false" <?php print (@$ops['auto_play'] == 'false') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Random Slideshow'); ?></td>
			<td>
				<input type="radio" name="settings[random_slide]" value="true" <?php print (@$ops['random_slide'] == 'true') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[random_slide]" value="false" <?php print (@$ops['random_slide'] == 'false') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Image Scale'); ?></td>
			<td>
				<input type="radio" name="settings[scale_image]" value="true" <?php print (@$ops['scale_image'] == 'true') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[scale_image]" value="false" <?php print (@$ops['scale_image'] == 'false') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Use Navigation Buttons'); ?></td>
			<td>
				<input type="radio" name="settings[use_buttons]" value="true" <?php print (@$ops['use_buttons'] == 'true') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[use_buttons]" value="false" <?php print (@$ops['use_buttons'] == 'false') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Slide Transition'); ?></td>
			<td>
				<input type="radio" name="settings[slide_transition]" value="1" <?php print (@$ops['slide_transition'] == '1') ? 'checked' : ''; ?>><span><?php _e('Vertical'); ?></span>
				<input type="radio" name="settings[slide_transition]" value="2" <?php print (@$ops['slide_transition'] == '2') ? 'checked' : ''; ?>><span><?php _e('Horizontal'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Slide Transition Time'); ?></td>
			<td><input type="text" name="settings[slide_transition_delay]" value="<?php print  @$ops['slide_transition_delay']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Display Text1 Position'); ?></td>
			<td>
				<input type="radio" name="settings[text1_pos]" value="left" <?php print (@$ops['text1_pos'] == 'left') ? 'checked' : ''; ?>><span><?php _e('Left'); ?></span>
				<input type="radio" name="settings[text1_pos]" value="right" <?php print (@$ops['text1_pos'] == 'right') ? 'checked' : ''; ?>><span><?php _e('Right'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Text1 X-Position'); ?></td>
			<td><input type="text" name="settings[text1_xpos]" value="<?php print  @$ops['text1_xpos']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text1 Y-Position'); ?></td>
			<td><input type="text" name="settings[text1_ypos]" value="<?php print  @$ops['text1_ypos']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text1 Color'); ?></td>
			<td><input type="text" name="settings[text1_color]" class="color {hash:true,caps:true}"  value="<?php print  @$ops['text1_color']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text1 Size'); ?></td>
			<td><input type="text" name="settings[text1_size]" value="<?php print  @$ops['text1_size']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text1 Background Color'); ?></td>
			<td><input type="text" name="settings[text1_bgcolor]" class="color {hash:true,caps:true}"  value="<?php print  @$ops['text1_bgcolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text1 Background Transparency'); ?></td>
			<td>
				<select name="settings[text1_bgcolor_alpha]">
					<option value="0" <?php print (@$ops['text1_bgcolor_alpha'] == '0') ? 'selected' : ''; ?>><?php _e('0');?></option>

					<option value="10" <?php print (@$ops['text1_bgcolor_alpha'] == '10') ? 'selected' : ''; ?>><?php _e('10');?></option>

					<option value="20" <?php print (@$ops['text1_bgcolor_alpha'] == '20') ? 'selected' : ''; ?>><?php _e('20');?></option>

					<option value="30" <?php print (@$ops['text1_bgcolor_alpha'] == '30') ? 'selected' : ''; ?>><?php _e('30');?></option>

					<option value="40" <?php print (@$ops['text1_bgcolor_alpha'] == '40') ? 'selected' : ''; ?>><?php _e('40');?></option>

					<option value="50" <?php print (@$ops['text1_bgcolor_alpha'] == '50') ? 'selected' : ''; ?>><?php _e('50');?></option>

					<option value="60" <?php print (@$ops['text1_bgcolor_alpha'] == '60') ? 'selected' : ''; ?>><?php _e('60');?></option>

					<option value="70" <?php print (@$ops['text1_bgcolor_alpha'] == '70') ? 'selected' : ''; ?>><?php _e('70');?></option>

					<option value="80" <?php print (@$ops['text1_bgcolor_alpha'] == '80') ? 'selected' : ''; ?>><?php _e('80');?></option>

					<option value="90" <?php print (@$ops['text1_bgcolor_alpha'] == '90') ? 'selected' : ''; ?>><?php _e('90');?></option>

					<option value="100" <?php print (@$ops['text1_bgcolor_alpha'] == '100') ? 'selected' : ''; ?>><?php _e('100');?></option>

				</select>
			</td>
		</tr>

		<tr>
			<td><?php _e('Display Text2 Position'); ?></td>
			<td>
				<input type="radio" name="settings[text2_pos]" value="left" <?php print (@$ops['text2_pos'] == 'left') ? 'checked' : ''; ?>><span><?php _e('Left'); ?></span>
				<input type="radio" name="settings[text2_pos]" value="right" <?php print (@$ops['text2_pos'] == 'right') ? 'checked' : ''; ?>><span><?php _e('Right'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Text2 X-Position'); ?></td>
			<td><input type="text" name="settings[text2_xpos]" value="<?php print  @$ops['text2_xpos']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text2 Y-Position'); ?></td>
			<td><input type="text" name="settings[text2_ypos]" value="<?php print  @$ops['text2_ypos']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text2 Color'); ?></td>
			<td><input type="text" name="settings[text2_color]" class="color {hash:true,caps:true}"  value="<?php print  @$ops['text2_color']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text2 Size'); ?></td>
			<td><input type="text" name="settings[text2_size]" value="<?php print  @$ops['text2_size']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text2 Background Color'); ?></td>
			<td><input type="text" name="settings[text2_bgcolor]" class="color {hash:true,caps:true}"  value="<?php print  @$ops['text2_bgcolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Text2 Background Transparency'); ?></td>
			<td>
				<select name="settings[text2_bgcolor_alpha]">
					<option value="0" <?php print (@$ops['text2_bgcolor_alpha'] == '0') ? 'selected' : ''; ?>><?php _e('0');?></option>

					<option value="10" <?php print (@$ops['text2_bgcolor_alpha'] == '10') ? 'selected' : ''; ?>><?php _e('10');?></option>

					<option value="20" <?php print (@$ops['text2_bgcolor_alpha'] == '20') ? 'selected' : ''; ?>><?php _e('20');?></option>

					<option value="30" <?php print (@$ops['text2_bgcolor_alpha'] == '30') ? 'selected' : ''; ?>><?php _e('30');?></option>

					<option value="40" <?php print (@$ops['text2_bgcolor_alpha'] == '40') ? 'selected' : ''; ?>><?php _e('40');?></option>

					<option value="50" <?php print (@$ops['text2_bgcolor_alpha'] == '50') ? 'selected' : ''; ?>><?php _e('50');?></option>

					<option value="60" <?php print (@$ops['text2_bgcolor_alpha'] == '60') ? 'selected' : ''; ?>><?php _e('60');?></option>

					<option value="70" <?php print (@$ops['text2_bgcolor_alpha'] == '70') ? 'selected' : ''; ?>><?php _e('70');?></option>

					<option value="80" <?php print (@$ops['text2_bgcolor_alpha'] == '80') ? 'selected' : ''; ?>><?php _e('80');?></option>

					<option value="90" <?php print (@$ops['text2_bgcolor_alpha'] == '90') ? 'selected' : ''; ?>><?php _e('90');?></option>

					<option value="100" <?php print (@$ops['text2_bgcolor_alpha'] == '100') ? 'selected' : ''; ?>><?php _e('100');?></option>

				</select>
			</td>
		</tr>

		<tr>
			<td><?php _e('Display Text1 Content'); ?></td>
			<td>
				<input type="radio" name="settings[show_text1]" value="yes" <?php print (@$ops['show_text1'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[show_text1]" value="no" <?php print (@$ops['show_text1'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Display Text2 Content'); ?></td>
			<td>
				<input type="radio" name="settings[show_text2]" value="yes" <?php print (@$ops['show_text2'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[show_text2]" value="no" <?php print (@$ops['show_text2'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Slide clickable'); ?></td>
			<td>
				<input type="radio" name="settings[use_link]" value="yes" <?php print (@$ops['use_link'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[use_link]" value="no" <?php print (@$ops['use_link'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Target Link'); ?></td>
			<td>
				<select name="settings[target]">
					<option value="_self" <?php print (@$ops['target'] == '_self') ? 'selected' : ''; ?>><?php _e('Same Window');?></option>

					<option value="_blank" <?php print (@$ops['target'] == '_blank') ? 'selected' : ''; ?>><?php _e('New Window');?></option>

				</select>
			</td>
		</tr>

		<tr>
			<td><?php _e('wmode'); ?></td>
			<td>
				<select name="settings[wmode]">
					<option value="opaque" <?php print (@$ops['wmode'] == 'opaque') ? 'selected' : ''; ?>><?php _e('opaque');?></option>

					<option value="transparent" <?php print (@$ops['wmode'] == 'transparent') ? 'selected' : ''; ?>><?php _e('transparent');?></option>

					<option value="window" <?php print (@$ops['wmode'] == 'window') ? 'selected' : ''; ?>><?php _e('window');?></option>

				</select>
				</td>
		</tr>
		</table>
	<p><button type="submit" class="button-primary"><?php _e('Save Config'); ?></button></p>
	</form>
</div>