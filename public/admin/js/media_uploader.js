var $ = jQuery.noConflict();
/**
 * 
 * @returns media items list
 * 
 */
function get_media() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        url: '/admin/uploads/all',
        data: {_token: token},
        success: function (data) {
            if (data['status'] === 'success') {
                $.each(data['data'], function (key, val) {
                    $('#media_list').append('<li class="media-item"><img src="/media/' + val + '" alt="' + key + '" data-name="' + key + '"></li>');
                })
            }
        }
    })
}


/**
 * 
 * @param string token
 * @returns boolean
 * 
 */
function delete_media(token) {
    var img_cont = $('.media-list').find('li.selected');
    var img_name = img_cont.find('img').attr('data-name');
    console.log(img_name);
    $.ajax({
        type: 'post',
        url: '/admin/uploads/' + img_name + '/delete',
        data: {_method: 'delete', _token: token},
        success: function (data) {
            $('#media_list').empty();
            get_media();
            $('#insert_media').addClass('disabled');
            $('#delete_media').addClass('disabled');
        },
        error: function (data) {
            var errors = data.responseJSON;
            console.log(errors);
        }
    })
}
$('document').ready(function () {
    /**************upload media********************/
    Dropzone.options.bookImage = {
        paramName: "image", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        dictDefaultMessage: "Drop File here or Click to upload Image",
        thumbnailWidth: "150",
        thumbnailHeight: "150",
        accept: function (file, done) {
            done()
        },
        init: function () {
            this.on("complete", function (file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    $('#post_media').find('.nav a[href="#library"]').tab('show');
                    $('#media_list').empty();
                    get_media();
                }
            });
        }
    };

    function uploadSuccess(data, file) {
        var messageContainer = $('.dz-success-mark'),
                message = $('<p></p>', {
                    'text': 'Image Uploaded Successfully!'
                })
        message.appendTo(messageContainer);
        messageContainer.addClass('show');


    }

    function uploadCompleted(data) {

        if (data.status != "success")
        {
            var error_message = $('.dz-error-mark'),
                    message = $('<p></p>', {
                        'text': 'Image Upload Failed'
                    });

            message.appendTo(error_message);
            error_message.addClass('show');
            return;
        }
    }



    $('#media_lib_modal').one('click', function () {
		$('#post_media').modal('show');
        get_media();
		
    });

    $('.media-list').on('click', 'li', function () {
        $('.media-list li').removeClass('selected');
        $(this).addClass('selected');
        $('#insert_media').removeClass('disabled');
        $('#delete_media').removeClass('disabled');
    });

    $('#post_media').on('click', '#insert_media', function () {

        var img_cont = $(this).parents('#post_media').find('li.selected');
        var img_src = img_cont.find('img').attr('src');
        var preview_container = $(this).parents('.post-create').find('#post_img_prev');
        preview_container.addClass('active');
        preview_container.empty().append('<span class="ti ti-close" title="Remove image"></span><img src="' + img_src + '" class="img-responsive" alc="preview">');
        preview_container.parents('#post_image_wrap').find('input').val(img_src);
        preview_container.parents('#post_image_wrap').find('a').html('<span class="ti ti-plus"></span>Change Image');
        $('#post_media').modal('hide');
    });

    $('#post_media').on('click', '#delete_media', function () {
        var token = $(this).data('token');
        delete_media(token);
    });




    $('#cancel_media').on('click', function () {
        $('#post_media').modal('hide')
    });
    $('#post_img_prev').on('click', 'span', function () {
        $(this).parents('#post_image_wrap').find('input').val('');
        $(this).parents('#post_image_wrap').find('a').html('<span class="ti ti-plus"></span>Add Image');
        $('#post_img_prev').empty();
    });


    $('.media-library').on('click', '#delete_media', function () {
        var token = $(this).data('token');
        delete_media(token);
    });

})

