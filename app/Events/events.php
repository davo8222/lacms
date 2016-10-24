<?php
Event::listen('menu.build', function($menu){
	$menu->add('index', 'Index', URL::route('index'), 1, 'index');
	$menu->add('/frontview', 'Users', URL::route('posts'), 100, 'users'); 
	
});

