<?php

namespace App\Shortcodes;

class ShortcodesBuilder {

	public function __construct() {
		global $count;
		$this->count = $count;
	}

	/*	 * ************Grid system************************ */
	
	//row
	public function cms_grid_row($shortcode, $content) {
		return '<div class="row">'.$content.'</div>';
		
	}
	
	//one hole
	public function cms_grid_one_whole($shortcode, $content) {
		return '<div class="col-md-12">'.$content.'</div>';
		
	}
	//one half
	public function cms_grid_one_half($shortcode, $content) {
		return '<div class="col-md-6">'.$content.'</div>';
		
	}

	//one third
	public function cms_grid_one_third($shortcode, $content) {
		return '<div class="col-md-4">'.$content.'</div>';
		
	}
	
	//one fourth
	public function cms_grid_one_fourth($shortcode, $content) {
		return '<div class="col-md-3">'.$content.'</div>';
		
	}
	
	//one sixth
	public function cms_grid_one_sixth($shortcode, $content) {
		return '<div class="col-md-2">'.$content.'</div>';
		
	}
	
	//two third
	public function cms_grid_two_third($shortcode, $content) {
		return '<div class="col-md-8">'.$content.'</div>';
		
	}
	
	//three fourth
	public function cms_grid_three_fourth($shortcode, $content) {
		return '<div class="col-md-9">'.$content.'</div>';
		
	}
	
	//fix sixth
	public function cms_grid_five_sixth($shortcode, $content) {
		return '<div class="col-md-10">'.$content.'</div>';
		
	}
	
	//five twelth
	public function cms_grid_five_twelveth($shortcode, $content) {
		return '<div class="col-md-5">'.$content.'</div>';
		
	}
	
	//seven twelth
	public function cms_grid_five_seven_twelveth($shortcode, $content) {
		return '<div class="col-md-7">'.$content.'</div>';
		
	}
	
	
	/*	 * ************heading************************ */

	public function cms_heading($shortcode, $content, $compiler, $name) {
		$tag = $shortcode->tag;
		$pos = $shortcode->pos;
		$class = $shortcode->class;
		$out = '';
		$out.='<div class="csm_header  ' . $pos . ' ' . $class . '">
				<' . $tag . ' class="tblock ">';
		$out.=$content;
		$out.='</' . $tag . '>';
		$out.='</div>';
		return $out;
		return $out;
	}

	/*	 * ******************* List ********************** */

	public function cms_list($shortcode, $content, $compiler, $name) {
		$type = $shortcode->type;
		$class = $shortcode->class;
		$GLOBALS['count'] = 0;
		$counter = 0;
		if ($type == 'order') {
			$tag = '<ol ';
			$tagEnd = '</ol>';
		} else {
			$tag = '<ul ';
			$tagEnd = '</ul>';
		}
		if (is_array($GLOBALS['listitems'])) {
			foreach ($GLOBALS['listitems'] as $listitem) {
				$listitems[] = '<li>';
				if ($listitem['link']) {
					$listitems[].='<a href="' . $listitem['link'] . '">';
				}
				if ($type == 'icon-list') {
					$listitems[].='<i class="fa ' . $listitem['icon'] . '"></i>';
				}
				$listitems[].=$listitem['content'];
				if ($listitem['link']) {
					$listitems[].='</a>';
				}

				$listitems[].='</li>';
				$counter++;
			}
			$return = $tag . ' class=" ' . $class . ' ' . $type . '  list-shortcode">' . implode("\n", $listitems) . $tagEnd;
			unset($GLOBALS['listitems']);
		}
		return $return;
	}

	/*	 * ********************* */

	function cms_listitem($shortcode, $content, $compiler, $name) {
		$title = $shortcode->title;
		$link = $shortcode->link;
		$icon = $shortcode->icon;

		$x = $GLOBALS['count'];
		$GLOBALS['listitems'][$x] = array('link' => $link, 'content' => $content, 'icon' => $icon);

		$GLOBALS['count'] ++;
	}

}
