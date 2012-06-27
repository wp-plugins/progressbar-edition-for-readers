var mm_formField = "";
function media_upload(fieldId) {
	mm_formField = jQuery('#'+fieldId).attr('id');
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
}

jQuery(document).ready(function() {
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery('#'+mm_formField).val(imgurl);
		tb_remove();
	}
});
