var mm_formField = "";
function media_upload(fieldId) {

	mm_formField = jQuery('#'+fieldId).attr('id');
	tb_show('Upload a cover', 'media-upload.php?referer=progressbar&type=image&TB_iframe=true&post_id=0', false);
	return false;
}

jQuery(document).ready(function() {
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery('#'+mm_formField).val(imgurl);
		tb_remove();
	}
});
