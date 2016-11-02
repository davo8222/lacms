<?php
$page = htmlentities($_GET['item']);
?>
<!DOCTYPE html>
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="../plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="tinymce_popup.js"></script>
	<script type="text/javascript" src="uploader.js"></script>
	<script type="text/javascript" src="jscolor.min.js"></script>

	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel='stylesheet' href='shortcode.css' type='text/css' media='all' />
	<?php if ($page == 'tblock') { ?>
		<!--/*************************************/ -->
		<script type="text/javascript">
			var tblock = {
				e: '',
				init: function (e) {
					tblock.e = e;
					tinyMCEPopup.resizeToInnerSize();
				},
				insert: function createGalleryShortcode(e) {
					var Tag = jQuery('#tblockTag').val();
					var Title = jQuery('#tblockTitle').val();
					var Position = jQuery('#pos').val();
					var addclass = jQuery('#class').val();
					var color = jQuery('#color').val();
					var output = '[heading ';
					if (addclass) {
						output += 'class="' + addclass + '" ';
					}
					if (Tag) {
						output += ' tag="' + Tag + '"';
					}
					if (Position) {
						output += ' pos="' + Position + '"';
					}
					if (color) {
						output += ' color="' + color + '"';
					}
					output += ']' + Title + '[/heading]';
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
				<label for="color">Custom color:</label>
				<input class="jscolor" style="width:80px; margin-right:5px;"  name="color" id="color" type="text" value="" />	
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
		<!--/*************************************/ -->
	<?php } elseif ($page == 'fullbg') {
		?>
		<script type="text/javascript">
			var fullbg = {
				e: '',
				init: function (e) {
					fullbg.e = e;
					tinyMCEPopup.resizeToInnerSize();
				},
				insert: function createGalleryShortcode(e) {
					var bgcolor = jQuery('#bgcolor').val();
					var bgimage = jQuery('#bgimage-img').val();
					var bgrepeat = jQuery('#bgrepeat').val();
					var custompadding = jQuery('#custompadding').val();
					var scrollspeed = jQuery('#scrollspeed').val();
					var type = jQuery('#fullbgtype').val();
					var addclass = jQuery('#class').val();

					var output = '[fullbg';

					if (type) {
						output += ' type="' + type + '"';
					}

					if (scrollspeed && type == 'parallax') {
						output += ' scrollspeed="' + scrollspeed + '"';
					}
					if (addclass) {
						output += ' class="' + addclass + '"';
					}
					if (bgcolor) {
						output += ' bgcolor="' + bgcolor + '"';
					}
					if (bgimage) {
						output += ' bgimage="' + bgimage + '"';
					}
					if (bgrepeat) {
						output += ' bgrepeat="' + bgrepeat + '"';
					}

					if (custompadding) {
						output += ' custompadding="' + custompadding + '"';
					}
					var topborder = jQuery('#topborder').val();
					var topbordercolor = jQuery('#topbordercolor').val();
					var rightborder = jQuery('#rightborder').val();
					var rightbordercolor = jQuery('#rightbordercolor').val();
					var bottomborder = jQuery('#bottomborder').val();
					var bottombordercolor = jQuery('#bottombordercolor').val();
					var leftborder = jQuery('#leftborder').val();
					var leftbordercolor = jQuery('#leftbordercolor').val();
					if (topborder) {
						output += ' topborder="' + topborder + '" topbordercolor="' + topbordercolor + '"';
					}
					if (rightborder) {
						output += ' rightborder="' + rightborder + '" rightbordercolor="' + rightbordercolor + '"';
					}
					if (bottomborder) {
						output += ' bottomborder="' + bottomborder + '" bottombordercolor="' + bottombordercolor + '"';
					}
					if (leftborder) {
						output += ' leftborder="' + leftborder + '" leftbordercolor="' + leftbordercolor + '"';
					}
					output += '][/fullbg]';
					tinyMCEPopup.execCommand('mceReplaceContent', false, output);
					tinyMCEPopup.close();
				}
			}
			tinyMCEPopup.onInit.add(fullbg.init, fullbg);

		</script>
		<title>Add Full Width Background(parallax)</title>

	</head>
	<body>
		<form id="GalleryShortcode">
			<script>
				jQuery(function () {
					jQuery("#scrollspeed-wrapper").hide();
					jQuery("#fullbgtype").change(function () {
						var selected = jQuery('#fullbgtype').val();
						if (selected == 'parallax') {
							jQuery("#scrollspeed-wrapper").show();
						} else {
							jQuery("#scrollspeed-wrapper").hide();
						}

					});
					jQuery('#upload_bgimage_button').filemanager('image');
				});
			</script>

			<p>
				<label for="fullbgtype">Type:</label>
				<select id="fullbgtype" name="fullbgtype">
					<option value="">Regular</option>
					<option value="parallax">Parallax</option>
				</select>
			</p>
			<p id="scrollspeed-wrapper">
				<label for="scrollspeed">Scrolling speed:</label>
				<select id="scrollspeed" name="scrollspeed">
					<option value="0.1">0.1</option>
					<option value="0.2">0.2</option>
					<option value="0.3">0.3</option>
					<option value="0.4">0.4</option>
					<option value="0.5">0.5</option>
					<option value="0.6" selected="selected">0.6</option>
					<option value="0.7">0.7</option>
					<option value="0.8">0.8</option>
					<option value="0.9">0.9</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
			</p>
			<p>
				<label for="upload_thumbnail_button">Background image:</label>
				<input id="bgimage-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="bgimageimg" value="" />
				<input id="upload_bgimage_button" type="button" class="small_button" value="Upload" data-input="bgimage-img" data-toggle="modal" data-target="#media_modal"/>
			<div class="clear"></div>
		</p>
		<p>
			<label for="bgcolor">Background color:</label>
			<input class="jscolor" style="width:80px; margin-right:5px;"  name="bgcolor" id="bgcolor" type="text" value="" />	
		</p>
		<p>
			<label for="bgrepeat">Background repeat:</label>
			<select  id="bgrepeat" name="bgrepeat">
				<option value="repeat">Repeat</option>
				<option value="repeat-x">Repeat-X</option>
				<option value="repeat-y">Repeat-Y</option>
				<option value="no-repeat">No-repeat</option>
			</select>
		</p>
		<p>
			<label for="custompadding">Custom padding:</label>
			<input type="text" maxlength="3" style="width:50px" id="custompadding" name="custompadding" value=""/> px
		</p>
		<div class="borders">
			<p>
				<label for="topborder">Border Top</label>
				<input type="text" maxlength="3" style="width:50px" id="topborder" name="topborder" value=""/> px
				<input type=text" class="jscolor" style="width:30px; margin-right:5px;"  name="topbordercolor" id="topbordercolor" type="text" value="000000" />
			</p>
			<p>
				<label for="rightborder">Border Right</label>
				<input type="text" maxlength="3" style="width:50px" id="rightborder" name="rightborder" value=""/> px
				<input type="text" class="jscolor"  style="width:30px; margin-right:5px;"  name="rightbordercolor" id="rightbordercolor" type="text" value="000000"/>
			</p>
			<p>
				<label for="bottomborder">Border Bottom</label>
				<input type="text" maxlength="3" style="width:50px" id="bottomborder" name="bottomborder" value=""/> px
				<input type=text" class="jscolor" style="width:30px; margin-right:5px;"  name="bottombordercolor" id="bottombordercolor" type="text" value="000000" />
			</p>
			<p>
				<label for="leftborder">Border Left</label>
				<input type="text" maxlength="3" style="width:50px" id="leftborder" name="leftborder" value=""/> px
				<input type=text" class="jscolor" style="width:30px; margin-right:5px;"  name="leftbordercolor" id="leftbordercolor" type="text" value="000000" />
			</p>
		</div>
		<p>
			<label for="class">Extra Class</label>
			<input id="class" name="class" type="text" value="" />
		</p>
	</form>
	<div class="mce-foot"><a class="add" href="javascript:fullbg.insert(fullbg.e)">Insert</a></div>
	<!--/*************************************/ -->
	<?php
} elseif ($page == 'button') {
	?>
	<script type="text/javascript">
		var AddButton = {
			e: '',
			init: function (e) {
				AddButton.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				var ButtonColor = jQuery('#ButtonColor').val();
				var ButtonLink = jQuery('#ButtonLink').val();
				var ButtonText = jQuery('#ButtonText').val();
				var addclass = jQuery('#class').val();
				var icon = jQuery('#icon').val();
				var size = jQuery('#ButtonSize').val();
				var output = '[button ';

				if (addclass) {
					output += 'class="' + addclass + '" ';
				}

				if (ButtonColor) {
					output += 'color="' + ButtonColor + '" ';
				}
				if (ButtonLink) {
					output += 'link="' + ButtonLink + '" ';
				}


				if (icon) {
					output += ' icon="' + icon + '"';
				}
				if (size) {
					output += ' size="' + size + '"';
				}
				output += ']' + ButtonText + '[/button]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();

			}
		}
		tinyMCEPopup.onInit.add(AddButton.init, AddButton);

	</script>
	<title>Add Buttons</title>

	</head>
	<body>
		<form id="GalleryShortcode">


			<p>
				<label for="ButtonColor">Button Color:</label>
				<select id="ButtonColor" name="ButtonColor">
					<option value="default">Default</option>
					<option value="btn-primary">Primary</option>
					<option value="btn-info">Info</option>
					<option value="btn-success">Success</option>
					<option value="btn-warning">Warning</option>
					<option value="btn-danger">Danger</option>
				</select>
			</p>
			<p>
				<label for="ButtonSize">Button Size:</label>
				<select id="ButtonSize" name="ButtonSize">
					<option value="default">Default</option>
					<option value="btn-xs">Extra small</option>
					<option value="btn-sm">Small</option>
					<option value="btn-lg">Large</option>
					<option value="btn-xlg">Extra large</option>
				</select>
			</p>
			<p>
				<label for="ButtonLink">Button Link :</label>
				<input id="ButtonLink" name="ButtonLink" type="text" value="http://" />

			</p>

			<p>
				<label for="ButtonText">Button Text :</label>
				<input id="ButtonText" name="ButtonText" type="text" value="" />
			</p>

			<p>
				<label for="icon">Icon</label>
				<input id="icon" name="icon" type="text" value="" />
			</p>
			<p>
				<label for="class">Extra Class</label>
				<input id="class" name="class" type="text" value="" />
			</p>
		</form>
		<div class="mce-foot"><a class="add" href="javascript:AddButton.insert(AddButton.e)">Insert</a></div>
		<!--/*************************************/ -->
	<?php } elseif ($page == 'text') { ?>
		<!--/*************************************/ -->
		<script type="text/javascript">
			var cms_text = {
				e: '',
				init: function (e) {
					cms_text.e = e;
					tinyMCEPopup.resizeToInnerSize();
				},
				insert: function createGalleryShortcode(e) {
					var Tcontent = jQuery('#Tcontent').val();
					var Position = jQuery('#pos').val();
					var tag = jQuery('#tag').val();
					var addclass = jQuery('#class').val();
					var color = jQuery('#color').val();
					var size = jQuery('#size').val();
					var output = '[cms_text ';

					if (tag) {
						output += ' tag="' + tag + '"';
					}
					if (addclass) {
						output += 'class="' + addclass + '" ';
					}
					if (Position) {
						output += ' pos="' + Position + '"';
					}
					if (color) {
						output += ' color="' + color + '"';
					}
					if (size) {
						output += ' size="' + size + '"';
					}
					output += ']' + Tcontent + '[/cms_text]';
					tinyMCEPopup.execCommand('mceReplaceContent', false, output);
					tinyMCEPopup.close();
				}
			}
			tinyMCEPopup.onInit.add(cms_text.init, cms_text);
		</script>
		<title>Add Title Block</title>
	</head>
	<body>
	    <form id="GalleryShortcode">
	        <p>
				<label for="tag">Tag:</label>
				<select id="tag" name="tag">
					<option value="p">Paragraph(P)</option>
					<option value="span">Inline(Span)</option>
				</select>
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
				<label for="color">Custom color:</label>
				<input class="jscolor" style="width:80px; margin-right:5px;"  name="color" id="color" type="text" value="000000" />	
			<p id="sizewrap">
				<label for="size">Custom Font Size:</label>
				<input type="text" id="size" name="size" maxlength="3" style="width:50px" /> px
			</p>
		</p>
		<p>
			<label for="Tcontent">Content</label>
			<textarea  id="Tcontent"></textarea>
		</p>
	    <p>
			<label for="class">Extra Class</label>
			<input id="class" name="class" type="text" value="" />
		</p>
	</form>
	<div class="mce-foot"><a class="add" href="javascript:cms_text.insert(cms_text.e)">Insert</a></div>
	<!--/*************************************/ -->
<?php } elseif ($page == 'fblock') { ?>
	<script type="text/javascript">
		var fblock = {
			e: '',
			init: function (e) {
				fblock.e = e,
						tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				var Title = jQuery('#fblockTitle').val();
				var icon = jQuery('#icon').val();
				var Fcontent = jQuery('#fblockContent').val();
				var addclass = jQuery('#class').val();

				var output = '[fblock';

				if (addclass) {
					output += ' class="' + addclass + '"';
				}


				if (Title) {
					output += ' title="' + Title + '"';
				}
				if (icon) {
					output += ' icon="' + icon + '"';
				}

				output += ']' + Fcontent + '[/fblock]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
			}
		}
		tinyMCEPopup.onInit.add(fblock.init, fblock);
	</script>
	<title>Insert Featured Block</title>
	</head>
	<body>
	    <form id="GalleryShortcode">


			<p>
				<label for="fblockTitle">Block Title:</label>
				<input type="text" id="fblockTitle">
			</p>


			<p>
				<label for="icon">Icon</label>
				<input id="icon" name="icon" type="text" value="" />
			</p>
			<p class="content-wrap">
				<label for="fblockContent">Block Content:</label>
				<textarea id="fblockContent"  style="width:200px; height:50px"></textarea>

			</p>

			<p>
				<label for="class">Extra Class</label>
				<input id="class" name="class" type="text" value="" />

			</p>
		</form>
		<div class="mce-foot"><a class="add" href="javascript:fblock.insert(fblock.e)">Insert</a></div>
		<!--/*************************************/ -->
	<?php } elseif ($page == 'divider') {
		?>
		<script type="text/javascript">
			var divider = {
				e: '',
				init: function (e) {
					divider.e = e;
					tinyMCEPopup.resizeToInnerSize();
				},
				insert: function createGalleryShortcode(e) {
					var type = jQuery('#type').val();
					var customsize = jQuery('#customsize').val();
					var addclass = jQuery('#class').val();
					var output = '[divider ';

					if (addclass) {
						output += 'class="' + addclass + '" ';
					}
					if (type) {
						output += 'type="' + type + '" ';
					}

					if (customsize) {
						output += 'customsize="' + customsize + '" ';
					}

					output += '/]';
					tinyMCEPopup.execCommand('mceReplaceContent', false, output);
					tinyMCEPopup.close();

				}
			}
			tinyMCEPopup.onInit.add(divider.init, divider);

		</script>
		<title>Add Divider</title>

	</head>
	<body>
		<form id="GalleryShortcode">
			<script>
				jQuery(function () {

					jQuery("#type").change(function () {
						var selected = jQuery('#type').val();
						if (selected == 'blank-spacer') {
							jQuery("#sizewrap").show();
						} else {
							jQuery("#sizewrap").hide();
						}
					});
				});
			</script>
			<p>
				<label for="type">Type:</label>
				<select  id="type" name="type">
					<option value="blank-spacer">Blank Spacer</option>
					<option value="line">Line</option>
				</select>
			</p>
			<p id="sizewrap">
				<label for="customsize">Custom Size:</label>
				<input type="text" id="customsize" name="customsize" maxlength="3" style="width:50px" /> px
			</p>

			<p>
				<label for="class">Extra Class</label>
				<input id="class" name="class" type="text" value="" />
			</p>
		</form>
		<div class="mce-foot"><a class="add" href="javascript:divider.insert(divider.e)">Insert</a></div>

		<!--/*************************************/ -->
		<!--/*************************************/ -->

	<?php } elseif ($page == 'regimage') {?>
		<script type="text/javascript">
			var regimage = {
				e: '',
				init: function (e) {
					regimage.e = e;
					tinyMCEPopup.resizeToInnerSize();

				},
				insert: function createGalleryShortcode(e) {
					var image = jQuery('#regimage-img').val();
					var alignment = jQuery('#alignment').val();
					var addclass = jQuery('#class').val();
					var alt = jQuery('#alt').val();
					var link = jQuery('#link').val();
					var leftmargin = jQuery('#leftmargin').val();
					var rightmargin = jQuery('#rightmargin').val();
					var topmargin = jQuery('#topmargin').val();
					var bottommargin = jQuery('#bottommargin').val();

					var output = '[regimage ';

					if (addclass) {
						output += 'class="' + addclass + '" ';
					}
					if (image) {
						output += 'image="' + image + '" ';
					}

					if (alt) {
						output += 'alt="' + alt + '" ';
					}
					if (link) {
						output += 'link="' + link + '" ';
					}

					if (alignment) {
						output += 'alignment="' + alignment + '" ';
					}
					if (leftmargin) {
						output += 'leftmargin="' + leftmargin + '" ';
					}
					if (rightmargin) {
						output += 'rightmargin="' + rightmargin + '" ';
					}
					if (topmargin) {
						output += 'topmargin="' + topmargin + '" ';
					}
					if (bottommargin) {
						output += 'bottommargin="' + bottommargin + '" ';
					}
					output += ' /]';

					tinyMCEPopup.execCommand('mceReplaceContent', false, output);
					tinyMCEPopup.close();
				}
			}
			tinyMCEPopup.onInit.add(regimage.init, regimage);

		</script>
		<title>Add Image</title>

	</head>
	<body>
		<form id="GalleryShortcode">
			<script>
				jQuery(function () {
					jQuery('#upload_regimage_button').filemanager('image');
				});
			</script>
			<p>
				<label for="upload_thumbnail_button">Upload Image image:</label>
				<input id="regimage-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="bgimageimg" value="" />
				<input id="upload_regimage_button" type="button" class="small_button" value="Upload" data-input="regimage-img" data-toggle="modal" data-target="#media_modal"/>
			<div class="clear"></div>
		</p>	
		<p>
			<label for="alignment">Alignment:</label>
			<select id="alignment" name="alignment">
				<option value="alignnone">None</option> 
				<option value="alignleft">Left</option>
				<option value="aligncenter">Center</option>
				<option value="alignright">Right</option>
			</select>
		</p>
		<p>
			<label for="alt">Alt text</label>
			<input id="alt" name="alt" type="text" value="" />
		</p>

		<p>
			<label for="link">Link URL (Optional)</label>
			<input id="link" name="link" type="text" value="" />
		</p>
		<p>
			<label for="leftmargin">Margin Left(Optional)</label>
			<input type="text" id="leftmargin" name="leftmargin" maxlength="4" style="width:50px" /> px
		</p>
		<p>
			<label for="rightmargin">Margin Right(Optional)</label>
			<input type="text" id="rightmargin" name="rightmargin" maxlength="4" style="width:50px" /> px
		</p>
		<p>
			<label for="topmargin">Margin Top(Optional)</label>
			<input type="text" id="topmargin" name="topmargin" maxlength="4" style="width:50px" /> px
		</p>
		<p>
			<label for="bottomtmargin">Margin Bottom(Optional)</label>
			<input type="text" id="bottomtmargin" name="bottomtmargin" maxlength="4" style="width:50px" /> px
		</p>
		<p>
			<label for="class">Extra Class</label>
			<input id="class" name="class" type="text" value="" />
		</p>
	</form>

	<div class="mce-foot"><a class="add" href="javascript:regimage.insert(regimage.e)">Insert</a></div>

	<!--/*************************************/ -->
	<?php } elseif ($page == 'panel') {
		?>
		<script type="text/javascript">
			var panel = {
				e: '',
				init: function (e) {
					panel.e = e;
					tinyMCEPopup.resizeToInnerSize();
				},
				insert: function createGalleryShortcode(e) {
					var bgcolor = jQuery('#bgcolor').val();
					var bgimage = jQuery('#panelbg-img').val();
					var bgrepeat = jQuery('#bgrepeat').val();
					var custompadding = jQuery('#custompadding').val();
					var addclass = jQuery('#class').val();

					var output = '[panel';
					if (addclass) {
						output += ' class="' + addclass + '"';
					}
					if (bgcolor) {
						output += ' bgcolor="' + bgcolor + '"';
					}
					if (bgimage) {
						output += ' bgimage="' + bgimage + '"';
					}
					if (bgrepeat) {
						output += ' bgrepeat="' + bgrepeat + '"';
					}

					if (custompadding) {
						output += ' custompadding="' + custompadding + '"';
					}
					var topborder = jQuery('#topborder').val();
					var topbordercolor = jQuery('#topbordercolor').val();
					var rightborder = jQuery('#rightborder').val();
					var rightbordercolor = jQuery('#rightbordercolor').val();
					var bottomborder = jQuery('#bottomborder').val();
					var bottombordercolor = jQuery('#bottombordercolor').val();
					var leftborder = jQuery('#leftborder').val();
					var leftbordercolor = jQuery('#leftbordercolor').val();
					if (topborder) {
						output += ' topborder="' + topborder + '" topbordercolor="' + topbordercolor + '"';
					}
					if (rightborder) {
						output += ' rightborder="' + rightborder + '" rightbordercolor="' + rightbordercolor + '"';
					}
					if (bottomborder) {
						output += ' bottomborder="' + bottomborder + '" bottombordercolor="' + bottombordercolor + '"';
					}
					if (leftborder) {
						output += ' leftborder="' + leftborder + '" leftbordercolor="' + leftbordercolor + '"';
					}
					output += '][/panel]';
					tinyMCEPopup.execCommand('mceReplaceContent', false, output);
					tinyMCEPopup.close();
				}
			}
			tinyMCEPopup.onInit.add(panel.init, panel);

		</script>
		<title>Add Information Block</title>

	</head>
	<body>
		<form id="GalleryShortcode">
			<script>
				jQuery(function () {
					jQuery('#upload_panelbg_button').filemanager('image');
				});
			</script>
			<p>
				<label for="upload_panelbg_button">Background image:</label>
				<input id="panelbg-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="bgimageimg" value="" />
				<input id="upload_panelbg_button" type="button" class="small_button" value="Upload" data-input="panelbg-img" data-toggle="modal" data-target="#media_modal"/>
			<div class="clear"></div>
		</p>
		<p>
			<label for="bgcolor">Background color:</label>
			<input class="jscolor" style="width:80px; margin-right:5px;"  name="bgcolor" id="bgcolor" type="text" value="" />	
		</p>
		<p>
			<label for="bgrepeat">Background repeat:</label>
			<select  id="bgrepeat" name="bgrepeat">
				<option value="repeat">Repeat</option>
				<option value="repeat-x">Repeat-X</option>
				<option value="repeat-y">Repeat-Y</option>
				<option value="no-repeat">No-repeat</option>
			</select>
		</p>
		<p>
			<label for="custompadding">Custom padding:</label>
			<input type="text" maxlength="3" style="width:50px" id="custompadding" name="custompadding" value=""/> px
		</p>
		<div class="borders">
			<p>
				<label for="topborder">Border Top</label>
				<input type="text" maxlength="3" style="width:50px" id="topborder" name="topborder" value=""/> px
				<input type=text" class="jscolor" style="width:30px; margin-right:5px;"  name="topbordercolor" id="topbordercolor" type="text" value="000000" />
			</p>
			<p>
				<label for="rightborder">Border Right</label>
				<input type="text" maxlength="3" style="width:50px" id="rightborder" name="rightborder" value=""/> px
				<input type="text" class="jscolor"  style="width:30px; margin-right:5px;"  name="rightbordercolor" id="rightbordercolor" type="text" value="000000"/>
			</p>
			<p>
				<label for="bottomborder">Border Bottom</label>
				<input type="text" maxlength="3" style="width:50px" id="bottomborder" name="bottomborder" value=""/> px
				<input type=text" class="jscolor" style="width:30px; margin-right:5px;"  name="bottombordercolor" id="bottombordercolor" type="text" value="000000" />
			</p>
			<p>
				<label for="leftborder">Border Left</label>
				<input type="text" maxlength="3" style="width:50px" id="leftborder" name="leftborder" value=""/> px
				<input type=text" class="jscolor" style="width:30px; margin-right:5px;"  name="leftbordercolor" id="leftbordercolor" type="text" value="000000" />
			</p>
		</div>
		<p>
			<label for="class">Extra Class</label>
			<input id="class" name="class" type="text" value="" />
		</p>
	</form>
	<div class="mce-foot"><a class="add" href="javascript:panel.insert(panel.e)">Insert</a></div>
<?php } ?>

<div class="modal fade" id="media_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-body" >
				<iframe name="post_thumb_frame"  id="post_thumb_frame"></iframe>
			</div>
		</div>
    </div>
</body>
</html>
