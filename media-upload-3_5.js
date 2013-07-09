var mm_formField = "";
function media_upload(fieldId) {

	mm_formField = jQuery('#'+fieldId).attr('id');
	var send_attachment_bkp = wp.media.editor.send.attachment;

    wp.media.editor.send.attachment = function(props, attachment) {
        jQuery('#'+mm_formField).val(attachment.url);
        wp.media.editor.send.attachment = send_attachment_bkp;
    }
    wp.media.editor.open();
	return false;
}