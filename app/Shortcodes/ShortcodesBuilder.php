<?php

namespace App\Shortcodes;

use Webwizo\Shortcodes\Facades\Shortcode;

class ShortcodesBuilder {

	public function __construct() {
		global $count;
		$this->count = $count;
	}

	/*	 * ************Grid system************************ */

	//row
	public function cms_grid_row($shortcode, $content) {
		return '<div class="row">' . $content . '</div>';
	}

	//row
	public function cms_grid_inner_row($shortcode, $content) {
		return '<div class="container"><div class="row">' . $content . '</div></div>';
	}

	//one hole
	public function cms_grid_one_whole($shortcode, $content) {
		return '<div class="col-md-12">' . $content . '</div>';
	}

	//one half
	public function cms_grid_one_half($shortcode, $content) {
		return '<div class="col-md-6">' . $content . '</div>';
	}

	//one third
	public function cms_grid_one_third($shortcode, $content) {
		return '<div class="col-md-4">' . $content . '</div>';
	}

	//one fourth
	public function cms_grid_one_fourth($shortcode, $content) {
		return '<div class="col-md-3">' . $content . '</div>';
	}

	//one sixth
	public function cms_grid_one_sixth($shortcode, $content) {
		return '<div class="col-md-2">' . $content . '</div>';
	}

	//two third
	public function cms_grid_two_third($shortcode, $content) {
		return '<div class="col-md-8">' . $content . '</div>';
	}

	//three fourth
	public function cms_grid_three_fourth($shortcode, $content) {
		return '<div class="col-md-9">' . $content . '</div>';
	}

	//fix sixth
	public function cms_grid_five_sixth($shortcode, $content) {
		return '<div class="col-md-10">' . $content . '</div>';
	}

	//five twelth
	public function cms_grid_five_twelveth($shortcode, $content) {
		return '<div class="col-md-5">' . $content . '</div>';
	}

	//seven twelth
	public function cms_grid_five_seven_twelveth($shortcode, $content) {
		return '<div class="col-md-7">' . $content . '</div>';
	}

	//full width background
	function cms_grid_fullbg($shortcode, $content, $compiler, $name) {
		$type = $shortcode->type;
		$bgcolor = $shortcode->bgcolor;
		$bgrepeat = $shortcode->bgrepeat;
		$bgimage = $shortcode->bgimage;
		$custompadding = $shortcode->custompadding;
		$notopborder = $shortcode->notopborder;
		$nobottomborder = $shortcode->nobottomborder;
		$scrollspeed = isset($shortcode->scrollspeed) ? $shortcode->scrollspeed : '0.6';
		$class = $shortcode->class;


		$bgcolor = (isset($bgcolor) && $bgcolor !== '') ? ' background-color:#' . $bgcolor . ' !important;' : '';
		$bgimage = (isset($bgimage) && $bgimage !== '') ? ' background-image:url(' . $bgimage . ') !important;' : '';
		$bgrepeat = (isset($bgrepeat) && $bgrepeat !== '') ? ' background-repeat:' . $bgrepeat . ' !important;' : '';

		$elements = $bgcolor . $bgimage . $bgrepeat;
		$custompadding = (isset($custompadding) && !empty($custompadding)) ? ' padding-top:' . $custompadding . 'px !Important;  padding-bottom:' . $custompadding . 'px !Important' : '';
		$out = '';
		if ($type == 'parallax') {
			$out.= '
			<div class="fullsize parallax-bg ' . $notopborder . ' ' . $nobottomborder . '">
				<div class="parallax-wrapper parallax-background ' . $class . '" data-stellar-background-ratio="' . $scrollspeed . '" style="' . $elements . '">
					<div class="parallax-wrapper-inner"  style="' . $custompadding . '">' . $content . '</div>
				</div>
			</div>';
		} else {

			$out.= '<div class="fullsize fullsize-background ' . $notopborder . ' ' . $nobottomborder . '  ' . $class . '" style="' . $elements . ' ' . $custompadding . '">';
			$out.= $content;
			$out.='</div>';
		}

		return $out;
	}

	/*	 * ****************************************************** */

	/*	 * ************heading************************ */

	public function cms_heading($shortcode, $content, $compiler, $name) {
		$tag = $shortcode->tag;
		$pos = $shortcode->pos;
		$class = $shortcode->class;
		$color = $shortcode->color;
		$out = '';

		$color = (isset($color) && $color !== '') ? 'style="color:#' . $color . ' !important"' : '';
		$out.='<div class="csm_header  ' . $pos . ' ' . $class . '">
				<' . $tag . ' class="tblock " ' . $color . '>';
		$out.=$content;
		$out.='</' . $tag . '>';
		$out.='</div>';
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

	/*	 * ***************** BUTTONS ******************* */

	public function cms_button($shortcode, $content, $compiler, $name) {
		$link = $shortcode->link;
		$color = $shortcode->color;
		$icon = $shortcode->icon;
		$class = $shortcode->class;
		$out = '';
		$out.='<a href="' . $link . '"  class="btn  ' . $color . '  ' . $class . ' ">';

		$out.=$content;
		if ($icon) {
			$out.='<i class="fa ' . $icon . '"></i>';
		}
		$out.='</a>';
		return $out;
	}

	/*	 * ********************************************* */

	/*	 * ************custom text************************ */

	public function cms_text($shortcode, $content, $compiler, $name) {
		$pos = $shortcode->pos;
		$class = $shortcode->class;
		$color = $shortcode->color;
		$out = '';

		$color = (isset($color) && $color !== '') ? 'style="color:#' . $color . ' !important"' : '';
		$out.='<p class="cms_text  ' . $pos . ' ' . $class . '" ' . $color . '>';
		$out.=$content;
		$out.='</p>';
		return $out;
	}

	/*	 * ********** FEATURED BLOCK*************** */

	public function cms_fblock($shortcode, $content, $compiler, $name) {
		$title = $shortcode->title;
		$icon = $shortcode->icon;
		$class = $shortcode->class;


		$out = '';
		$out.='<div class="fblock  ' . $class . '">
					<i class="fa ' . $icon . '"></i>
					<h4 class="font-alegreya">' . $title . '</h4>
					<p>' . $content . '</p>
            </div>';


		return $out;
	}

	/*	 * ****************** Divider ********************* */

	public function cms_divider($shortcode, $content) {
		$type = $shortcode->type;
		$customsize = $shortcode->customsize;
		$class = $shortcode->class;
		$out = '';
		$customsize = (isset($customsize) && !empty($customsize)) ? ' style="margin-bottom:' . $customsize . 'px !important; clear:both;"' : '';
		if ($type == 'blank-spacer') {
			$out = '<div class="blank-spacer clearfix  ' . $class . '" ' . $customsize . '></div>';
		} elseif ($type == 'line') {
			$out = '<hr class="line-spacer  ' . $class . '"/>';
		}
		return $out;
	}

}
