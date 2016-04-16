jQuery(document).ready(function($){

	ABSWidget = {

		uploader : function( widget_id, widget_id_string ) {
			var frame = wp.media({
				title : ABSWidget_local.frame_title,
				multiple : false,
				library : { type : 'image' },
				button : { text : ABSWidget_local.button_title }
			});
			frame.on('close',function( ) {
				var attachments = frame.state().get('selection').toJSON();
				ABSWidget.print_html( widget_id, widget_id_string, attachments[0] );
			});
			frame.open();
			return false;
		},

		print_html : function( widget_id, widget_id_string, attachment ) {
			var img_html = '<img src="'+attachment.url+'" ';
			img_html += attachment.width > 300 ? 'width="300" ' : 'width="'+attachment.width+'" ';
			img_html += '/>';
			$("#"+widget_id_string+'preview').html(img_html);
			$("#"+widget_id_string+'image_url').val(attachment.url);
			$("#"+widget_id_string+'title').val( $("#"+widget_id_string+'title').val()=='' ? attachment.title : $("#"+widget_id_string+'title').val() );
			$("#"+widget_id_string+'alt').val( $("#"+widget_id_string+'alt').val()=='' ? attachment.alt : $("#"+widget_id_string+'alt').val() );
		}
		
	};
});