/*-- VTSLIDER ADMIN SCRIPT -----------------
------------------------------------------*/
jQuery(document).ready(function(){
jQuery('#vts_admin .handlediv,#vts_admin .hndle').click(function(){
	jQuery(this).parent().find('.inside').slideToggle("fast");
});

jQuery('#vts_admin #vtsbdrclr').wpColorPicker();

/*-- UPLOAD IMAGE --
------------------*/
	var targetfield= '';
	var vts_send_to_inputtxt = window.send_to_editor;
	jQuery('.vts_uploadbtn').click(function(){
		targetfield = jQuery(this).prev('.vts_uploadimg');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery(targetfield).val(imgurl);
			tb_remove();
			window.send_to_editor = vts_send_to_inputtxt;
		}
		return false;
	});	
});
