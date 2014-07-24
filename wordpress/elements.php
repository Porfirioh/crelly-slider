<?php
function crellyslider_printElements($edit, $slider, $slide, $elements) {
?>
	<div class="cs-elements">

		<div
		class="cs-slide-editing-area"
		<?php if($edit && $slide): ?>
			<?php
			if($slide->background_type_image != 'none') {
				echo 'data-background-image-src="' . $slide->background_type_image . '"';
			}
			?>
			style="
			width: <?php echo $slider->startWidth; ?>px;
			height: <?php echo $slider->startHeight; ?>px;
			background-image: url('<?php echo $slide->background_type_image; ?>');
			background-color: <?php echo $slide->background_type_color == 'transparent' ? 'rgb(255, 255, 255)' : $slide->background_type_color; ?>;
			background-position-x: <?php echo $slide->background_propriety_position_x; ?>;
			background-position-y: <?php echo $slide->background_propriety_position_y; ?>;
			background-repeat: <?php echo $slide->background_repeat; ?>;
			background-size: <?php echo $slide->background_propriety_size; ?>;
			<?php echo stripslashes($slide->custom_css); ?>
			"
		<?php endif; ?>
		>		
			<?php
			if($edit && $elements != NULL) {
				foreach($elements as $element) {
					switch($element->type) {
						case 'text':
							?>
							<p
							class="cs-element cs-text-element"
							style="
							<?php
							echo 'z-index: ' . $element->z_index . ';';
							echo 'left: ' . $element->data_left . 'px;';
							echo 'top: ' . $element->data_top . 'px;';
							echo stripslashes($element->custom_css);
							?>
							"
							data-delay="<?php echo $element->data_delay; ?>"
							data-easeIn="<?php echo $element->data_easeIn; ?>"
							data-easeOut="<?php echo $element->data_easeOut; ?>"
							data-in="<?php echo $element->data_in; ?>"
							data-out="<?php echo $element->data_out; ?>"
							data-top="<?php echo $element->data_top; ?>"
							data-left="<?php echo $element->data_left; ?>"
							data-time="<?php echo $element->data_time; ?>"
							>
							<?php echo stripslashes($element->inner_html); ?>
							</p>
							<?php
						break;
						case 'image':
							?>
							<img
							class="cs-element cs-image-element"
							src="<?php echo $element->image_src; ?>"
							style="
							<?php
							echo 'z-index: ' . $element->z_index . ';';
							echo 'left: ' . $element->data_left . 'px;';
							echo 'top: ' . $element->data_top . 'px;';
							echo stripslashes($element->custom_css);
							?>
							"
							data-delay="<?php echo $element->data_delay; ?>"
							data-easeIn="<?php echo $element->data_easeIn; ?>"
							data-easeOut="<?php echo $element->data_easeOut; ?>"
							data-in="<?php echo $element->data_in; ?>"
							data-out="<?php echo $element->data_out; ?>"
							data-top="<?php echo $element->data_top; ?>"
							data-left="<?php echo $element->data_left; ?>"
							data-time="<?php echo $element->data_time; ?>"
							/>
							<?php
						break;
					}
				}
			}
			?>
		</div>
		
		<br />
		<br />

		<div class="cs-elements-actions">
			<div style="float: left;">		
				<a class="cs-add-text-element cs-button cs-is-warning"><?php _e('Add text', 'crellyslider'); ?></a>
				<a class="cs-add-image-element cs-button cs-is-warning"><?php _e('Add image', 'crellyslider'); ?></a>
			</div>
			<div style="float: right;">
				<a class="cs-live-preview cs-button cs-is-success"><?php _e('Live preview', 'crellyslider'); ?></a>
				<a class="cs-delete-element cs-button cs-is-danger cs-is-disabled"><?php _e('Delete element', 'crellyslider'); ?></a>
				<a class="cs-duplicate-element cs-button cs-is-primary cs-is-disabled"><?php _e('Duplicate element', 'crellyslider'); ?></a>
			</div>
			<div style="clear: both;"></div>
		</div>
		
		<br />
		<br />
		
		<div class="cs-elements-list">
			<?php
			if($edit && $elements != NULL) {
				foreach($elements as $element) {
					switch($element->type) {
						case 'text':
							echo '<div class="cs-element-settings cs-text-element-settings" style="display: none;">';
							crellyslider_printTextElement($element);
							echo '</div>';
							break;
						case 'image':
							echo '<div class="cs-element-settings cs-image-element-settings" style="display: none;">';
							crellyslider_printImageElement($element);
							echo '</div>';
							break;
					}
				}
			}
			echo '<div class="cs-void-element-settings cs-void-text-element-settings cs-element-settings cs-text-element-settings">';
			crellyslider_printTextElement(false);
			echo '</div>';
			echo '<div class="cs-void-element-settings cs-void-image-element-settings cs-element-settings cs-image-element-settings">';
			crellyslider_printImageElement(false);
			echo '</div>';
			?>
		</div>

	</div>
<?php
}

function crellyslider_printTextElement($element) {
	$void = !$element ? true : false;
	
	$animations = array(
		'slideDown' => array(__('Slide down', 'crellyslider'), false),
		'slideUp' => array(__('Slide up', 'crellyslider'), false),
		'slideLeft' => array(__('Slide left', 'crellyslider'), false),
		'slideRight' => array(__('Slide right', 'crellyslider'), false),
		'fade' => array(__('Fade', 'crellyslider'), true),
		'fadeDown' => array(__('Fade down', 'crellyslider'), false),
		'fadeUp' => array(__('Fade up', 'crellyslider'), false),
		'fadeLeft' => array(__('Fade left', 'crellyslider'), false),
		'fadeRight' => array(__('Fade right', 'crellyslider'), false),
		'fadeSmallDown' => array(__('Fade small down', 'crellyslider'), false),
		'fadeSmallUp' => array(__('Fade small up', 'crellyslider'), false),
		'fadeSmallLeft' => array(__('Fade small left', 'crellyslider'), false),
		'fadeSmallRight' => array(__('Fade small right', 'crellyslider'), false),
	);
	
	?>
	<table class="cs-element-settings-list cs-text-element-settings-list cs-table">
		<thead>
			<tr class="odd-row">
				<th colspan="3"><?php _e('Element Options', 'crellyslider'); ?></th>
			</tr>
		</thead>
		
		<tbody>
			<tr class="cs-table-header">
				<td><?php _e('Option', 'crellyslider'); ?></td>
				<td><?php _e('Parameter', 'crellyslider'); ?></td>
				<td><?php _e('Description', 'crellyslider'); ?></td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Text', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-inner_html" type="text" value="' . __('Text element', 'crellyslider') . '" />';
					else echo '<input class="cs-element-inner_html" type="text" value="' . stripslashes($element->inner_html) .'" />';
					?>
				</td>
				<td class="cs-description">
					<?php _e('Write the text or the HTML.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Left', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_left" type="text" value="0" />';
					else echo '<input class="cs-element-data_left" type="text" value="' . $element->data_left .'" />';
					?>
					px
				</td>
				<td class="cs-description">
					<?php _e('Left distance in px from the start width.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Top', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_top" type="text" value="0" />';
					else echo '<input class="cs-element-data_top" type="text" value="' . $element->data_top .'" />';
					?>
					px
				</td>
				<td class="cs-description">
					<?php _e('Top distance in px from the start height.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Z - index', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-z_index" type="text" value="1" />';
					else echo '<input class="cs-element-z_index" type="text" value="' . $element->z_index .'" />';
					?>
				</td>
				<td class="cs-description">
					<?php _e('An element with an high z-index will cover an element with a lower z-index if they overlap.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Delay', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_delay" type="text" value="0" />';
					else echo '<input class="cs-element-data_delay" type="text" value="' . $element->data_delay .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the element wait before the entrance.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Time', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_time" type="text" value="all" />';
					else echo '<input class="cs-element-data_time" type="text" value="' . $element->data_time .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the element be displayed during the slide execution. Write "all" to set the entire time.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('In animation', 'crellyslider'); ?></td>
				<td class="cs-content">
					<select class="cs-element-data_in">
						<?php
						foreach($animations as $key => $value) {
							echo '<option value="' . $key . '"';
							if(($void && $value[1]) || (!$void && $element->data_in == $key)) {
								echo ' selected';
							}
							echo '>' . $value[0] . '</option>';
						}
						?>
					</select>
				</td>
				<td class="cs-description">
					<?php _e('The in animation of the element.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Out animation', 'crellyslider'); ?></td>
				<td class="cs-content">
					<select class="cs-element-data_out">
						<?php
						foreach($animations as $key => $value) {
							echo '<option value="' . $key . '"';
							if(($void && $value[1]) || (!$void && $element->data_out == $key)) {
								echo ' selected';
							}
							echo '>' . $value[0] . '</option>';
						}
						?>
					</select>
				</td>
				<td class="cs-description">
					<?php _e('The out animation of the element.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Ease in', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_easeIn" type="text" value="300" />';
					else echo '<input class="cs-element-data_easeIn" type="text" value="' . $element->data_easeIn .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the in animation take.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Ease out', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_easeOut" type="text" value="300" />';
					else echo '<input class="cs-element-data_easeOut" type="text" value="' . $element->data_easeOut .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the out animation take.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Custom CSS', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<textarea class="cs-element-custom_css"></textarea>';
					else echo '<textarea class="cs-element-custom_css">' . stripslashes($element->custom_css) . '</textarea>';
					?>
				</td>
				<td class="cs-description">
					<?php _e('Style the element.', 'crellyslider'); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}

function crellyslider_printImageElement($element) {
	$void = !$element ? true : false;
	
	$animations = array(
		'slideDown' => array(__('Slide down', 'crellyslider'), false),
		'slideUp' => array(__('Slide up', 'crellyslider'), false),
		'slideLeft' => array(__('Slide left', 'crellyslider'), false),
		'slideRight' => array(__('Slide right', 'crellyslider'), false),
		'fade' => array(__('Fade', 'crellyslider'), true),
		'fadeDown' => array(__('Fade down', 'crellyslider'), false),
		'fadeUp' => array(__('Fade up', 'crellyslider'), false),
		'fadeLeft' => array(__('Fade left', 'crellyslider'), false),
		'fadeRight' => array(__('Fade right', 'crellyslider'), false),
		'fadeSmallDown' => array(__('Fade small down', 'crellyslider'), false),
		'fadeSmallUp' => array(__('Fade small up', 'crellyslider'), false),
		'fadeSmallLeft' => array(__('Fade small left', 'crellyslider'), false),
		'fadeSmallRight' => array(__('Fade small right', 'crellyslider'), false),
	);
	
	?>
	<table class="cs-element-settings-list cs-image-element-settings-list cs-table">
		<thead>
			<tr class="odd-row">
				<th colspan="3"><?php _e('Element Options', 'crellyslider'); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr class="cs-table-header">
				<td><?php _e('Option', 'crellyslider'); ?></td>
				<td><?php _e('Parameter', 'crellyslider'); ?></td>
				<td><?php _e('Description', 'crellyslider'); ?></td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Upload image', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-image-element-upload-button cs-button cs-is-default" type="button" value="' . __('Select image', 'crellyslider') . '" />';
					else echo '<input data-src="' . $element->image_src . '" data-alt="' . $element->image_alt . '" class="cs-image-element-upload-button cs-button cs-is-default" type="button" value="' . __('Select image', 'crellyslider') . '" />';
					?>
				</td>
				<td class="cs-description">
					<?php _e('Upload the image you want to insert.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Left', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_left" type="text" value="0" />';
					else echo '<input class="cs-element-data_left" type="text" value="' . $element->data_left .'" />';
					?>
					px
				</td>
				<td class="cs-description">
					<?php _e('Left distance in px from the start width.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Top', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_top" type="text" value="0" />';
					else echo '<input class="cs-element-data_top" type="text" value="' . $element->data_top .'" />';
					?>
					px
				</td>
				<td class="cs-description">
					<?php _e('Top distance in px from the start height.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Z - index', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-z_index" type="text" value="1" />';
					else echo '<input class="cs-element-z_index" type="text" value="' . $element->z_index .'" />';
					?>
				</td>
				<td class="cs-description">
					<?php _e('An element with an high z-index will cover an element with a lower z-index if they overlap.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Delay', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_delay" type="text" value="0" />';
					else echo '<input class="cs-element-data_delay" type="text" value="' . $element->data_delay .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the element wait before the entrance.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Time', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_time" type="text" value="all" />';
					else echo '<input class="cs-element-data_time" type="text" value="' . $element->data_time .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the element be displayed during the slide execution. Write "all" to set the entire time.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('In animation', 'crellyslider'); ?></td>
				<td class="cs-content">
					<select class="cs-element-data_in">
						<?php
						foreach($animations as $key => $value) {
							echo '<option value="' . $key . '"';
							if(($void && $value[1]) || (!$void && $element->data_in == $key)) {
								echo ' selected';
							}
							echo '>' . $value[0] . '</option>';
						}
						?>
					</select>
				</td>
				<td class="cs-description">
					<?php _e('The in animation of the element.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Out animation', 'crellyslider'); ?></td>
				<td class="cs-content">
					<select class="cs-element-data_out">
						<?php
						foreach($animations as $key => $value) {
							echo '<option value="' . $key . '"';
							if(($void && $value[1]) || (!$void && $element->data_out == $key)) {
								echo ' selected';
							}
							echo '>' . $value[0] . '</option>';
						}
						?>
					</select>
				</td>
				<td class="cs-description">
					<?php _e('The out animation of the element.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Ease in', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_easeIn" type="text" value="300" />';
					else echo '<input class="cs-element-data_easeIn" type="text" value="' . $element->data_easeIn .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the in animation take.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Ease out', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<input class="cs-element-data_easeOut" type="text" value="300" />';
					else echo '<input class="cs-element-data_easeOut" type="text" value="' . $element->data_easeOut .'" />';
					?>
					ms
				</td>
				<td class="cs-description">
					<?php _e('How long will the out animation take.', 'crellyslider'); ?>
				</td>
			</tr>
			<tr>
				<td class="cs-name"><?php _e('Custom CSS', 'crellyslider'); ?></td>
				<td class="cs-content">
					<?php
					if($void) echo '<textarea class="cs-element-custom_css"></textarea>';
					else echo '<textarea class="cs-element-custom_css">' . stripslashes($element->custom_css) . '</textarea>';
					?>
				</td>
				<td class="cs-description">
					<?php _e('Style the element.', 'crellyslider'); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}
?>