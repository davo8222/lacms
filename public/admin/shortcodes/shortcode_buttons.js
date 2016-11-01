tinymce.PluginManager.add('cmsShortcodes', function (editor, url) {
	// Add a button that opens a window
	var prefix='cms_';
	editor.addButton('cms_grid', {
		image : url+'/images/grid.png',
		tooltip : 'Grid Blocks',
		type: 'menubutton',
		menu:[
			{text:"Row" , onclick: function () {editor.insertContent('[row][/row]');}},
			{text:"Inner Row" , onclick: function () {editor.insertContent('[inner_row][/inner_row]');}},
			{text:"1 Column" , onclick: function () {editor.insertContent('[one_whole][/one_whole]');}},
			{text:"One Half(1/2)" , onclick: function () {editor.insertContent('[one_half][/one_half]');}},
			{text:"One Third(1/3)" , onclick: function () {editor.insertContent('[one_third][/one_third]');}},
			{text:"One Fourth(1/4)" , onclick: function () {editor.insertContent('[one_fourth][/one_fourth]');}},
			{text:"One Sixth(1/6)" , onclick: function () {editor.insertContent('[one_sixth][/one_sixth]');}},
			{text:"Two Third(2/3)" , onclick: function () {editor.insertContent('[two_third][/two_third]');}},
			{text:"Three Fourth(3/4)" , onclick: function () {editor.insertContent('[three_fourth][/three_fourth]');}},
			{text:"Five Sixth(5/6)" , onclick: function () {editor.insertContent('[five_sixth][/five_sixth]');}},
			{text:"Five Twelveth(5/12)" , onclick: function () {editor.insertContent('[five_twelveth][/five_twelveth]');}},
			{text:"Seven Twelveth(7/12)" , onclick: function () {editor.insertContent('[seven_twelveth][/seven_twelveth]');}},
			{text:"Full width Block" , onclick:function () {
					// Open window
					editor.windowManager.open({
						width : 800,
						height :600,
						title: 'Full width Block',
						file:  url+'/popups.php?item=fullbg',

					});
				},
			
			}
		
		]
	});
	
	//divider
	editor.addButton('cms_divider', {
		image : url+'/images/divider.png',
		tooltip : 'Divider',
		onclick: function() {
			editor.windowManager.open({
			  title: 'Features Block',
			  file:  url+'/popups.php?item=divider',
			  width: 600,
			  height: 450,
				
			});
    },
	});
	
	//heading
	editor.addButton('cms_heading', {
		image : url+'/images/heading.png',
		tooltip : 'Heading',
		onclick: function () {
			// Open window
			editor.windowManager.open({
				width : 600,
				height : 450,
				title: 'Custom Heading',
				file:  url+'/popups.php?item=tblock',
			
			});
		}
	});
	
	//add custom list
	editor.addButton('cms_list', {
		image : url+'/images/list.png',
		tooltip : 'List',
		onclick: function() {
			editor.windowManager.open({
			  title: 'List',
			  file:  url+'/popups.php?item=list',
			  width: 600,
			  height: 450,
				
			});
    },
	});
	//add custom button
	editor.addButton('cms_button', {
		image : url+'/images/button.png',
		tooltip : 'Button',
		onclick: function() {
			editor.windowManager.open({
			  title: 'Button',
			  file:  url+'/popups.php?item=button',
			  width: 600,
			  height: 450,
				
			});
    },
	});
	
	//add custom text
	editor.addButton('cms_text', {
		image : url+'/images/text.png',
		tooltip : 'Text',
		onclick: function() {
			editor.windowManager.open({
			  title: 'Custom text',
			  file:  url+'/popups.php?item=text',
			  width: 600,
			  height: 450,
				
			});
    },
	});
	
	//features block
	editor.addButton('cms_fblock', {
		image : url+'/images/fblock.png',
		tooltip : 'Features Block',
		onclick: function() {
			editor.windowManager.open({
			  title: 'Features Block',
			  file:  url+'/popups.php?item=fblock',
			  width: 600,
			  height: 450,
				
			});
    },
	});

});