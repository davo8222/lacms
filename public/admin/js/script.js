var $=jQuery.noConflict();
$('document').ready(function(){
	$('#post_type').change(function(){
		var post_type=$(this).val();
		if(post_type==='page'){
			$('#create_form').find('#create_catlist, #post_image_wrap').hide();
		}else{
			$('#create_form').find('#create_catlist, #post_image_wrap').show();
		}
	});
	
	$('.category_edit').on('click', function(e){
		e.preventDefault();
		var edit_id=$(this).attr('data-editid');
		$('.categories-table').find('#'+edit_id).toggle('600');
	});
	
	
	/************menu**********/
	$('.nav-item-container').on('click', 'button', function(){
		var cont=$(this).prev('ul').find('li');
		var type;
		if($(this).parents('.nav-item-container').hasClass('nav-pages')){
			type='page';
		}
		else if($(this).parents('.nav-item-container').hasClass('nav-categories')){
			type='category';
		}else{
			type='custom';
		}
		cont.each(function(){
			var target=$(this).find('.nav-checkbox').attr("data-name");
			var item_id=$(this).find('.nav-checkbox').val();
			if($(this).find('.nav-checkbox').prop("checked")){
				$('#nav_generator>ul').append('<li><i class="fa fa-arrows"></i><div class="nav-item"><input type="hidden" class="nav-items-data" value="'+item_id+'" data-name="'+target+'" data-type="'+type+'">'+target+'</div><ul class="child"></ul><i class="fa fa-minus-circle item-remove" title="remove item"></i></li>');
				$(this).find('.nav-checkbox').prop('checked', false);
			}
		})
		
	})
	$('.nav-custom').on('click', '#nav_add_custom', function () {
		var name = $('#nav_custom_name').val();
		var url = $('#nav_custom_url').val();
		$('#nav_generator>ul').append('<li><i class="fa fa-arrows"></i><div class="nav-item"><label>' + name + '</label><input type="text" value="' + url + '" data-name="'+name+'" data-type="custom"></div><ul class="child"></ul><i class="fa fa-minus-circle item-remove"></i></li>');
		$('.nav-custom').find('.form-control').val("");
	});
        
        $("#nav_generator ul").on('click', 'i.item-remove', function(){
           $(this).parent('li').remove();
        });        
	var oldContainer;
	$("#nav_generator ul").sortable({
		group: 'nested',
                handle : 'i.fa-arrows',
		afterMove: function (placeholder, container) {
			if (oldContainer != container) {
				if (oldContainer)
					oldContainer.el.removeClass("active");
				container.el.addClass("active");

				oldContainer = container;
			}
		},
		onDrop: function ($item, container, _super) {
			container.el.removeClass("active");
			_super($item, container);
		}
	});

	$(".switch-container").on("click", ".switch", function (e) {
		var method = $(this).hasClass("active") ? "enable" : "disable";
		$(e.delegateTarget).next().sortable(method);
	});
	
	/****post thumnail****/
	$('#post_img_prev').on('click', 'span', function () {
        $(this).parents('#post_image_wrap').find('input').val('');
        $(this).parents('#post_image_wrap').find('a').html('<span class="ti ti-plus"></span>Add Image');
        $('#post_img_prev img').attr('src', '');
		$(this).remove();
    });
	
	
})


