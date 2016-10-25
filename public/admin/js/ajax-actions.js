var $ = jQuery.noConflict();
$(document).on({
	ajaxStart: function () {
		$('body').addClass("loading");
	},
	ajaxStop: function () {
		$('body').removeClass("loading");
	}
});
$('document').ready(function () {


	/**
	 * posts multiremove
	 * 
	 */
	$('#multiremove').on('click', function (e) {
		e.preventDefault();
		var token = $(this).data('token');
		var ids=[];
		var target=$(this).prev('table').find('td.post-checks');
		$(target).each(function(){
			var item_id=$(this).find('.post-select').val();
			if($(this).find('.post-select').prop("checked")){
				ids.push(item_id);
			}
		});
		if(ids.length<=0){
			alert('there is no items selected');
		}else{
			console.log(ids);
			$.ajax({
				type: 'delete',
				url: '/admin/posts/multidelete',
				data: {data: ids, _token: token},
				dataType: 'json',
				success: function (data) {
					if (data['status'] == 'success') {
						$('.info-container').prepend('<div class="alert alert-info">Records have been deleted</div>');
						setTimeout(function () {
							$('.alert').remove();
						}, 2000);		
					console.log(data);
				}
				},
				error: function (data) {
					var errors = data.responseJSON;
					console.log(errors);
				}
			});
		}
	});
	/**
	 * category quick edit
	 */
	$('#category_edit .submit-btn').on('click', function (e) {
		e.preventDefault();
		var cid = $(this).parents('#category_edit').find('#cid').val();
		var name = $(this).parents('#category_edit').find('#name').val();
		var slug = $(this).parents('#category_edit').find('#slug').val();
		var formData = {
			name: name,
			slug: slug
		};
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'PUT',
			url: '/admin/categories/' + cid,
			data: formData,
			dataType: 'json',
			success: function (data) {
				if (data['status'] == 'success') {
					$('.info-container').prepend('<div class="alert alert-info">Category Updated</div>');
					setTimeout(function () {
						$('.alert').remove();
					}, 2000);
					$('#edit_' + cid).prev('tr').find('.category-name').text(name);
					$('#edit_' + cid).prev('tr').find('.category-slug').text(slug);
					$('#edit_' + cid).css('display', 'none');
				}
				console.log(data);
			},
			error: function (data) {
				var errors = data.responseJSON;
				console.log(errors);
			}
		});
	});


	/****************menus**************/

	/**
	 * select menu
	 * 
	 */
	$('#select_menu').on('click', function () {
		var menu_id = $('.menu-list').val();
		if (menu_id > 0) {
			var token = $(this).data('token');

			$('#nav_generator #current_menu_id').val(menu_id);
			$('#current_menu_prim').removeAttr('disabled');
			$.ajax({
				type: 'POST',
				url: '/admin/menus/' + menu_id,
				data: {_token: token},
				success: function (data) {

					var obj = data['data'];

					var items_j = $.parseJSON(obj.data);
					console.log(data);
					$('#nav_generator .menu-title').find('#current_menu_title').val(obj.name);
					if (obj.id == parseInt(data['as_primary'])) {
						$('#current_menu_prim').prop('checked', 'checked');
					} else {
						$('#current_menu_prim').removeAttr('checked');
					}
					$('#nav_generator>ul').empty();
					$.each(items_j, function (index, value) {
						if (value.type != 'custom') {
							$('#nav_generator>ul').append('<li><i class="fa fa-arrows"></i><div class="nav-item"><input type="hidden" class="nav-items-data" value="' + value.target + '" data-name="' + value.title + '" data-type="' + value.type + '">' + value.title + '</div><ul class="child"></ul><i class="fa fa-minus-circle item-remove"></i></li>');
						} else {
							$('#nav_generator>ul').append('<li><i class="fa fa-arrows"></i><div class="nav-item"><label>' + value.title + '</label><input type="text" value="' + value.target + '" data-name="' + value.title + '" data-type="custom"></div><ul class="child"></ul><i class="fa fa-minus-circle item-remove"></i></li>');
						}

					})

				},
				error: function (data) {
					var errors = data.responseJSON;
					console.log(errors);
				}
			})
		} else {
			$(this).parents('.info-container>div').append('<p class="error">Select menu</p>');
			setTimeout(function () {
				$('.info-container .error').remove();
			}, 2000);
		}
	});

	/**
	 * save menu
	 * 
	 */
	$('#nav_generator').on('click', '#save_menu', function () {
		var token = $(this).data('token');
		var menu = $('#current_menu_title').val();
		if (!menu) {
			$('.menu-title').append('<p class="error">Menu name required</p>');
			setTimeout(function () {
				$('.menu-title .error').remove();
			}, 2000);
		} else {
			if (($('.nav-elements li')).length > 0) {

				var menu_id = $('#current_menu_id').val();
				var data = {};
				var item_data = [];
				data['name'] = menu;
				if ($.isNumeric(menu_id) && menu_id.length > 0) {
					data['current_id'] = menu_id;

					if ($('#current_menu_prim').prop('checked')) {
						data['as_primary'] = menu_id
					}
				}
				$('#nav_generator>ul>li').each(function () {
					var item_id = $(this).find('input').val();
					var item_name = $(this).find('input').attr('data-name');
					var item_type = $(this).find('input').attr('data-type');
					item_data.push({'target': item_id, 'title': item_name, 'type': item_type});
					data['items'] = JSON.stringify(item_data);
				});
				var end_data = JSON.stringify(data);

				$.ajax({
					type: 'POST',
					url: '/admin/menus',
					data: {data: data, _token: token},
					dataType: "json",
					success: function (data) {
						console.log(data)
					},
					error: function (data) {
						var errors = data.responseJSON;
						console.log(errors);
					}
				});
			} else {
				$(this).parents('#nav_generator').append('<p class="error">Menu cannot be empty</p>');
				setTimeout(function () {
					$('#nav_generator .error').remove();
				}, 2000);
			}
			console.log(data);
		}

	})




})


