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
		$topborder = $shortcode->topborder;
		$topbordercolor = $shortcode->topbordercolor;
		$rightborder = $shortcode->rightborder;
		$rightbordercolor = $shortcode->rightbordercolor;
		$bottomborder = $shortcode->bottomborder;
		$bottombordercolor = $shortcode->bottombordercolor;
		$leftborder = $shortcode->leftborder;
		$leftbordercolor = $shortcode->leftbordercolor;
		$scrollspeed = isset($shortcode->scrollspeed) ? $shortcode->scrollspeed : '0.6';
		$class = $shortcode->class;


		$bgcolor = (isset($bgcolor) && $bgcolor !== '') ? ' background-color:#' . $bgcolor . ' !important;' : '';
		$bgimage = (isset($bgimage) && $bgimage !== '') ? ' background-image:url(' . $bgimage . ') !important;' : '';
		$bgrepeat = (isset($bgrepeat) && $bgrepeat !== '') ? ' background-repeat:' . $bgrepeat . ' !important;' : '';
		$topborder = (isset($topborder) && $topborder !== '') ? ' border-top:' . $topborder . 'px solid #'.$topbordercolor.' !important;' : '';
		$rightborder = (isset($rightborder) && $rightborder !== '') ? ' border-right:' . $rightborder . 'px solid #'.$rightbordercolor.' !important;' : '';
		$bottomborder = (isset($bottomborder) && $bottomborder !== '') ? ' border-bottom:' . $bottomborder . 'px solid #'.$bottombordercolor.' !important;' : '';
		$leftborder = (isset($leftborder) && $leftborder !== '') ? ' border-left:' . $leftborder . 'px solid #'.$leftbordercolor.' !important;' : '';

		$elements = $bgcolor . $bgimage . $bgrepeat.$topborder . $rightborder . $bottomborder.$leftborder;
		$custompadding = (isset($custompadding) && !empty($custompadding)) ? ' padding-top:' . $custompadding . 'px !Important;  padding-bottom:' . $custompadding . 'px !Important' : '';
		$out = '';
		if ($type == 'parallax') {
			$out.= '
			<div class="fullsize parallax-bg">
				<div class="parallax-wrapper parallax-background ' . $class . '" data-stellar-background-ratio="' . $scrollspeed . '" style="' . $elements . '">
					<div class="parallax-wrapper-inner"  style="' . $custompadding . '">' . $content . '</div>
				</div>
			</div>';
		} else {

			$out.= '<div class="fullsize fullsize-background   ' . $class . '" style="' . $elements . ' ' . $custompadding . '">';
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
		$size = $shortcode->size;
		$class = $shortcode->class;
		$out = '';
		$out.='<a href="' . $link . '"  class="btn  ' . $color . ' '.$size.' ' . $class . ' ">';

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
		$tag = $shortcode->tag;
		$size = $shortcode->size;
		$class = $shortcode->class;
		$color = $shortcode->color;
		$out = '';

		$color = (isset($color) && $color !== '') ? 'color:#' . $color . ' !important; ' : '';
		$size = (isset($size) && $size !== '') ? 'font-size:' . $size . 'px !important; ' : '';
		$elements=($size || $color)? 'style="'.$size.$color.'"' : '';
		$out.='<'.$tag.' class="cms_text  ' . $pos . ' ' . $class . '" ' . $elements . '>';
		$out.=$content;
		$out.='</'.$tag.'>';
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
	
	/*	 * *******************Single image************** */

	public function cms_image($shortcode, $content) {
		$image = $shortcode->image;
		$alignment = $shortcode->alignment;
		$alt = $shortcode->alt;
		$link = $shortcode->link;
		$leftmargin = $shortcode->leftmargin;
		$rightmargin = $shortcode->rightmargin;
		$topmargin = $shortcode->topmargin;
		$bottommargin = $shortcode->topmargin;
		$class = $shortcode->class;
		
		$out='';
		$leftmargin = (isset($leftmargin) && $leftmargin !== '') ? ' margin-left:' . $leftmargin . 'px !important;' : '';
		$rightmargin = (isset($rightmargin) && $rightmargin !== '') ? ' margin-right:' . $rightmargin . 'px !important;' : '';
		$topmargin = (isset($topmargin) && $topmargin !== '') ? ' margin-top:' . $topmargin . 'px !important;' : '';
		$bottommargin = (isset($bottommargin) && $bottommargin !== '') ? ' margin-bottom:' . $bottommargin . 'px !important;' : '';
		if($leftmargin || $rightmargin || $topmargin || $bottommargin){
			$elements ='style="'. $leftmargin . $rightmargin . $topmargin.$bottommargin.'"';
		}else{
			$elements='';
		}
		
		if ($link) {
			$out.='<a href="' . $link . '">';
		}
		$out.='<img src="' . $image . '" class="cms_image ' . $alignment . '  ' . $class . '" alt="' . $alt . '" '.$elements.'>';
		if ($link) {
			$out.='</a>';
		}

		return $out;
	}
/****************panel****************************/
	function cms_panel($shortcode, $content) {
		$bgcolor = $shortcode->bgcolor;
		$bgrepeat = $shortcode->bgrepeat;
		$bgimage = $shortcode->bgimage;
		$custompadding = $shortcode->custompadding;
		$topborder = $shortcode->topborder;
		$topbordercolor = $shortcode->topbordercolor;
		$rightborder = $shortcode->rightborder;
		$rightbordercolor = $shortcode->rightbordercolor;
		$bottomborder = $shortcode->bottomborder;
		$bottombordercolor = $shortcode->bottombordercolor;
		$leftborder = $shortcode->leftborder;
		$leftbordercolor = $shortcode->leftbordercolor;
		$class = $shortcode->class;


		$bgcolor = (isset($bgcolor) && $bgcolor !== '') ? ' background-color:#' . $bgcolor . ' !important;' : '';
		$bgimage = (isset($bgimage) && $bgimage !== '') ? ' background-image:url(' . $bgimage . ') !important;' : '';
		$bgrepeat = (isset($bgrepeat) && $bgrepeat !== '') ? ' background-repeat:' . $bgrepeat . ' !important;' : '';
		$topborder = (isset($topborder) && $topborder !== '') ? ' border-top:' . $topborder . 'px solid #'.$topbordercolor.' !important;' : '';
		$rightborder = (isset($rightborder) && $rightborder !== '') ? ' border-right:' . $rightborder . 'px solid #'.$rightbordercolor.' !important;' : '';
		$bottomborder = (isset($bottomborder) && $bottomborder !== '') ? ' border-bottom:' . $bottomborder . 'px solid #'.$bottombordercolor.' !important;' : '';
		$leftborder = (isset($leftborder) && $leftborder !== '') ? ' border-left:' . $leftborder . 'px solid #'.$leftbordercolor.' !important;' : '';

		$elements = $bgcolor . $bgimage . $bgrepeat.$topborder . $rightborder . $bottomborder.$leftborder;
		$custompadding = (isset($custompadding) && !empty($custompadding)) ? ' padding-top:' . $custompadding . 'px !Important;  padding-bottom:' . $custompadding . 'px !Important' : '';
		$out = '';

			$out.= '<div class="cms_panel clearfix ' . $class . '" style="' . $elements . ' ' . $custompadding . '">';
			$out.= $content;
			$out.='</div>';

		return $out;
	}

	/*	 * ****************************************************** */
}
