<?php
// VTSLIDER ADMIN SETTING OPTIONS ---------------------------
//-----------------------------------------------------------
function vts_backend_menu()
{
	?>
	<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<h2><?php _e('Vertical Tab Slider '.vts_plugin_version().' Setting\'s','vtslider'); ?></h2>
	</div>

	<div id="poststuff" style="position:relative;">
	
		<div class="postbox" id="vts_admin">
		
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3 class="hndle"><span><?php _e("Slider Settings",'vtslider'); ?></span></h3>
			<div class="inside" style="padding: 15px;margin: 0;">
				<form method="post" action="options.php">
					<?php
						wp_nonce_field('update-options');
						$options = get_option('vts_options');
					?>
					<table>
					
						<tr>
							<td><?php _e("Slider Border", 'vtslider'); ?> :</td>
							<td><input type="text" size="12" name="vts_options[sliderborder]" value="<?php echo $options['sliderborder'] ?>" />&nbsp;<small>(<?php _e('in Pixel','vtslider');  ?></small>)</td>
						</tr>
					
						<tr>
							<td><?php _e("Slider Border Color", 'vtslider'); ?> :</td>
							<td><input type="text" size="12" id="vtsbdrclr" name="vts_options[sliderbdrclr]" value="<?php echo $options['sliderbdrclr'] ?>" /></td>
						</tr>
					
						<tr>
							<td><?php _e("Image Width", 'vtslider'); ?> :</td>
							<td><input type="text" size="12" name="vts_options[imgwidth]" value="<?php echo $options['imgwidth'] ?>" />&nbsp;<small>(<?php _e('in Pixel','vtslider');  ?></small>)</td>
						</tr>
						
						<tr>
							<td><?php _e("Image Height", 'vtslider'); ?> :</td>
							<td><input type="text" size="12" name="vts_options[imgheight]" value="<?php echo $options['imgheight'] ?>" />&nbsp;<small>(<?php _e('in Pixel','vtslider');  ?></small>)</td>
						</tr>
						
						<tr>
							<td><?php _e("Tab Sidebar Width", 'vtslider'); ?> :</td>
							<td><input type="text" size="12" name="vts_options[sidebarwidth]" value="<?php echo $options['sidebarwidth'] ?>" />&nbsp;<small>(<?php _e('in Pixel','vtslider');  ?></small>)</td>
						</tr>
						
						<tr>
							<td><?php _e("Slider Navigation",'vtslider'); ?> :</td>
							<td>
								<select name="vts_options[navigation]">
									<option value="1" <?php selected('1', $options['navigation']); ?>><?php _e('Yes','vtslider'); ?></option>
									<option value="0" <?php selected('0', $options['navigation']); ?>><?php _e('No','vtslider'); ?></option>
								</select>
							</td>
						</tr>
					
						<tr>
							<td><?php _e("Autoplay",'vtslider'); ?> :</td>
							<td>
								<select name="vts_options[autoplay]">
									<option value="1" <?php selected('1', $options['autoplay']); ?>><?php _e('Yes','vtslider'); ?></option>
									<option value="0" <?php selected('0', $options['autoplay']); ?>><?php _e('No','vtslider'); ?></option>
								</select>
							</td>
						</tr>
								
						<tr>
							<td><?php _e("Effect",'vtslider'); ?> :</td>
							<td>
								<select name="vts_options[effect]">
									<option value="fade" <?php selected('fade', $options['effect']); ?>><?php _e('Fade','vtslider'); ?></option>
									<option value="slideLeft" <?php selected('slideLeft', $options['effect']); ?>><?php _e('Slide-Left','vtslider'); ?></option>
									<option value="slideRight" <?php selected('slideRight', $options['effect']); ?>><?php _e('Slide-Right','vtslider'); ?></option>
									<option value="slideUp" <?php selected('slideUp', $options['effect']); ?>><?php _e('Slide-Up','vtslider'); ?></option>
									<option value="slideDown" <?php selected('slideDown', $options['effect']); ?>><?php _e('Slide-Down','vtslider'); ?></option>
								</select>
							</td>
						</tr>	
								
						<tr>
							<td><?php _e("Pause On Hover",'vtslider'); ?> :</td>
							<td>
								<select name="vts_options[pausehover]">
									<option value="1" <?php selected('1', $options['pausehover']); ?>><?php _e('Yes','vtslider'); ?></option>
									<option value="0" <?php selected('0', $options['pausehover']); ?>><?php _e('No','vtslider'); ?></option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td><?php _e("Delay Between Slides", 'vtslider'); ?> :</td>
							<td><input type="text" size="12" name="vts_options[timedelay]" value="<?php echo $options['timedelay'] ?>" />&nbsp;<small>(<?php _e('in MSec','vtslider');  ?></small>)</td>
						</tr>
						
						<tr>
							<td><?php _e("Transition Speed", 'vtslider'); ?> :</td>
							<td><input type="text" size="12" name="vts_options[transpeed]" value="<?php echo $options['transpeed'] ?>" />&nbsp;<small>(<?php _e('in MSec','vtslider');  ?></small>)</td>
						</tr>
						
					</table>
					
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="page_options" value="vts_options" />

					<p class="button-controls"><input type="submit" value="<?php _e('Save Settings','vtslider'); ?>" class="button-primary" id="vts_update" name="vts_update"></p>

			</div>
		</div>

	</div>
	
	
	<div id="poststuff" style="position:relative;">
	
		<div class="postbox" id="vts_admin">
		
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3 class="hndle"><span><?php _e("Tab Content Settings",'vtslider'); ?></span></h3>
			<div class="inside" style="padding: 15px;margin: 0;">

					<table>
					
						<!-- Tab 1 Section Starts -->
							<tr>
								<td><?php _e("Image 1 PATH/URL", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image1url]" class="vts_uploadimg" value="<?php echo $options['image1url']; ?>" /><input class="vts_uploadbtn button" type="button" value="Upload Image" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Image 1 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image1desp]" value="<?php echo stripslashes( $options['image1desp'] ); ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Image 1 Title link", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image1link]" value="<?php echo $options['image1link']; ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Tab 1 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[tab1title]" value="<?php echo stripslashes( $options['tab1title'] ); ?>" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Tab 1 Description", 'vtslider'); ?> :</td>
								<td><textarea col="10" name="vts_options[tab1desp]"><?php echo stripslashes( $options['tab1desp'] ); ?></textarea></td>
							</tr>
						<!-- Tab 1 Section Ends -->
							
							<tr><td height="30" colspan="2"><hr style="color: #DDDDDD;" /></td></tr>
						
						<!-- Tab 2 Section Starts -->
							<tr>
								<td><?php _e("Image 2 PATH/URL", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image2url]" class="vts_uploadimg" value="<?php echo $options['image2url']; ?>" /><input class="vts_uploadbtn button" type="button" value="Upload Image" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Image 2 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image2desp]" value="<?php echo stripslashes( $options['image2desp'] ); ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Image 2 Title link", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image2link]" value="<?php echo $options['image2link']; ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Tab 2 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[tab2title]" value="<?php echo stripslashes( $options['tab2title'] ); ?>" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Tab 2 Description", 'vtslider'); ?> :</td>
								<td><textarea col="10" name="vts_options[tab2desp]"><?php echo stripslashes( $options['tab2desp'] ); ?></textarea></td>
							</tr>
						<!-- Tab 2 Section Ends -->
							
							<tr><td height="30" colspan="2"><hr style="color: #DDDDDD;" /></td></tr>
						
						<!-- Tab 3 Section Starts -->
							<tr>
								<td><?php _e("Image 3 PATH/URL", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image3url]" class="vts_uploadimg" value="<?php echo $options['image3url']; ?>" /><input class="vts_uploadbtn button" type="button" value="Upload Image" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Image 3 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image3desp]" value="<?php echo stripslashes( $options['image3desp'] ); ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Image 3 Title link", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image3link]" value="<?php echo $options['image3link']; ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Tab 3 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[tab3title]" value="<?php echo stripslashes( $options['tab3title'] ); ?>" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Tab 3 Description", 'vtslider'); ?> :</td>
								<td><textarea col="10" name="vts_options[tab3desp]"><?php echo stripslashes( $options['tab3desp'] ); ?></textarea></td>
							</tr>
						<!-- Tab 3 Section Ends -->
						
							<tr><td height="30" colspan="2"><hr style="color: #DDDDDD;" /></td></tr>
						
						<!-- Tab 4 Section Starts -->
							<tr>
								<td><?php _e("Image 4 PATH/URL", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image4url]" class="vts_uploadimg" value="<?php echo $options['image4url']; ?>" /><input class="vts_uploadbtn button" type="button" value="Upload Image" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Image 4 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image4desp]" value="<?php echo stripslashes( $options['image4desp'] ); ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Image 4 Title link", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image4link]" value="<?php echo $options['image4link']; ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Tab 4 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[tab4title]" value="<?php echo stripslashes( $options['tab4title'] ); ?>" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Tab 4 Description", 'vtslider'); ?> :</td>
								<td><textarea col="10" name="vts_options[tab4desp]"><?php echo stripslashes( $options['tab4desp'] ); ?></textarea></td>
							</tr>
						<!-- Tab 4 Section Ends -->
						
							<tr><td height="30" colspan="2"><hr style="color: #DDDDDD;" /></td></tr>
						
						<!-- Tab 5 Section Starts -->
							<tr>
								<td><?php _e("Image 5 PATH/URL", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image5url]" class="vts_uploadimg" value="<?php echo $options['image5url']; ?>" /><input class="vts_uploadbtn button" type="button" value="Upload Image" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Image 5 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image5desp]" value="<?php echo stripslashes( $options['image5desp'] ); ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Image 5 Title link", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[image5link]" value="<?php echo $options['image5link']; ?>" /></td>
							</tr>
							
							<tr>
								<td><?php _e("Tab 5 Title", 'vtslider'); ?> :</td>
								<td><input type="text" name="vts_options[tab5title]" value="<?php echo stripslashes( $options['tab5title'] ); ?>" /></td>
							</tr>
						
							<tr>
								<td><?php _e("Tab 5 Description", 'vtslider'); ?> :</td>
								<td><textarea col="10" name="vts_options[tab5desp]"><?php echo stripslashes( $options['tab5desp'] ); ?></textarea></td>
							</tr>
						<!-- Tab 5 Section Ends -->

					</table>
					
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="page_options" value="vts_options" />

					<p class="button-controls"><input type="submit" value="<?php _e('Save Settings','vtslider'); ?>" class="button-primary" id="vts_update" name="vts_update"></p>
				</form>
			</div>
		</div>

	</div>

<?php
}