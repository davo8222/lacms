(function( $ ){

    $.fn.filemanager = function(type = 'image') {

        if (type === 'image' || type === 'images') {
            type = 'Images';
        } else {
            type = 'Files';
        }

        let input_id = this.data('input');
        let preview_id = this.data('preview');
		let target_modal=this.data('target');
        this.on('click', function(e) {
			$(target_modal).modal('show');
            localStorage.setItem('target_input', input_id);
            localStorage.setItem('target_preview', preview_id);	
            window.open('/admin/filemanager?type=' + type, 'post_thumb_frame', 'width=900,height=600');
			
            return false;
        });
		
    }

})(jQuery);


function SetUrl(url){
  //set the value of the desired input to image url
  let target_input = $('#' + localStorage.getItem('target_input'));
  target_input.val(url);

  //set or change the preview image src
  let target_preview = $('#' + localStorage.getItem('target_preview'));
  target_preview.attr('src',url);
  
  //close modal after select
  $('#post_thumb_modal').modal('hide');
}
