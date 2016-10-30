<?php
$page = htmlentities($_GET['item']);
?>
<!DOCTYPE html>
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="../plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="tinymce_popup.js"></script>

	<link rel='stylesheet' href='shortcode.css' type='text/css' media='all' />
	<?php if ($page == 'tblock') {?>
	<!--/*************************************/ -->
	<script type="text/javascript">
    var tblock={
        e:'',
        init:function(e){
            tblock.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert:function createGalleryShortcode(e){
			var Tag=jQuery('#tblockTag').val();
            var Title=jQuery('#tblockTitle').val();
			var Position=jQuery('#pos').val();
            var addclass=jQuery('#class').val();
            var output='[tblock ';
            if(addclass){
                output+='class="'+addclass+'" ';
			}
			if(Tag){
                output+=' tag="'+Tag+'"';
            }
			if(Position){
                output+=' pos="'+Position+'"';
            }
            output+=']'+Title+'[/tblock]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(tblock.init, tblock);
</script>
<title>Add Title Block</title>
</head>
<body>
    <form id="GalleryShortcode">
	<p>
        <label for="tblockTag">Tag:</label>
        <select id="tblockTag" name="tblockTag">
            <option value="h1">H1</option>
			<option value="h2">H2</option>
			<option value="h3">H3</option>
			<option value="h4">H4</option>
			<option value="h5">H5</option>
			<option value="h6">H6</option>
		</select>
        </p>
        <p>
            <label for="tblockTitle">Title:</label>
            <input type="text" id="tblockTitle">
        </p>
		<p>
		<label for="pos">Position:</label>
		<select id="pos" name="pos">
			<option value="text-left">Left</option>
			<option value="text-center">Center</option>
			<option value="text-right">Right</option>
		</select>
    </p>
    <p>
		<label for="class">Extra Class</label>
		<input id="class" name="class" type="text" value="" />
	</p>
</form>
<div class="mce-foot"><a class="add" href="javascript:tblock.insert(tblock.e)">Insert</a></div>
		<!--/*************************************/ -->
		<?php } elseif ($page == 'list') { ?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				counter = 1;

				jQuery("#add-listitem").click(function () {
					jQuery('#ListItemShortcodeContent').append('<p><label for="itemName[]">List Item Name</label><input id="itemName[]" name="itemName[]" type="text" value="" /></p><p><label for="itemLink[]">List Item Link</label><input  id="itemLink[]" name="itemLink[]" type="text" value="" /></p><p><label for="icon[]">Icon</label><input id="icon[]" name="icon[]" type="text" value="" /><small>only for <b>Icon List</b> type</small></p><hr class="divider" />');

					counter++;
				});
			});
			var list = {
				e: '',
				init: function (e) {
					list.e = e;
					tinyMCEPopup.resizeToInnerSize();
				},
				insert: function createGalleryShortcode(e) {
					var output = '[list ';
					var anim = jQuery('#anim').val();
					var addclass = jQuery('#class').val();
					var type = jQuery('#type').val();
					var color = jQuery('#color').val();
					if (anim) {
						output += ' anim="' + anim + '"';
					}
					if (type) {
						output += ' type="' + type + '"';
					}
					if (color) {
						output += ' color="' + color + '"';
					}
					if (addclass) {
						output += ' class="' + addclass + '"';
					}
					output += ']';
					jQuery("input[id^=itemName").each(function (intIndex, objValue) {
						output += '[listitem ';
						var iconlink = jQuery('input[id^=itemLink]').get(intIndex);
						var icon = jQuery('input[id^=icon]').get(intIndex);
						if (icon.value) {
							output += ' icon="' + icon.value + '"';
						}
						if (iconlink.value) {
							output += ' link="' + iconlink.value + '"';
						}
						output += ']';
						var obj = jQuery('input[id^=itemName]').get(intIndex);

						output += obj.value;
						output += "[/listitem]";
					});


					output += '[/list]';
					tinyMCEPopup.execCommand('mceReplaceContent', false, output);
					tinyMCEPopup.close();

				}
			}
			tinyMCEPopup.onInit.add(list.init, list);

			

		</script>
		<title>Add  List</title>

	</head>
	<body>
		<form id="GalleryShortcode">
			<div id="ListItemShortcodeContent">
				<p>
					<label for="type">List Type</label>
					<select id="type" name="type">
						<option value="order">Ordered</option>
						<option value="unorder">Unordered</option>
						<option value="list-unstyled">Unstyled</option>
						<option value="icon-list">Icon List</option>
					</select>
				</p>
				<p>
					<label for="class">Extra Class</label>
					<input id="class" name="class" type="text" value="" />
				</p>
				<hr class="divider" />
				<p>
					<label for="itemName[]">List Item Name</label>
					<input id="itemName[]" name="itemName[]" type="text" value="" />

				</p>

				<p>
					<label for="itemLink[]">List Item Link</label>
					<input  id="itemLink[]" name="itemLink[]" type="text" value="" />
				</p>
				<p>
					<label for="icon[]">Icon</label>
					<input id="icon[]" name="icon[]" type="text" value="" />
					<small>only for <b>Icon List</b> type</small>
				</p>

				<hr class="divider" />
			</div>
			<strong><a style="cursor: pointer;" id="add-listitem" class="text-right">+ Add  List Item</a></strong>

		</form>
		<div class="mce-foot"><a class="add" href="javascript:list.insert(list.e)">Insert</a></div>
		<!--/*************************************/ -->
	<?php } ?>

</body>
</html>
