<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Shortcodes\ShortcodesBuilder;
use Webwizo\Shortcodes\Facades\Shortcode;
class CustomShortcodesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
		//grid
		Shortcode::register('row', 'App\Shortcodes\ShortcodesBuilder@cms_grid_row');
		Shortcode::register('one_whole', 'App\Shortcodes\ShortcodesBuilder@cms_grid_one_whole');
		Shortcode::register('one_half', 'App\Shortcodes\one_half');
		Shortcode::register('one_third', 'App\Shortcodes\ShortcodesBuilder@cms_grid_one_third');
		Shortcode::register('one_fourth', 'App\Shortcodes\ShortcodesBuilder@cms_grid_one_fourth');
		Shortcode::register('one_sixth', 'App\Shortcodes\ShortcodesBuilder@cms_grid_one_sixth');
		Shortcode::register('two_third', 'App\Shortcodes\ShortcodesBuilder@cms_grid_two_third');
		Shortcode::register('three_fourth', 'App\Shortcodes\ShortcodesBuilder@cms_grid_three_fourth');
		Shortcode::register('five_sixth', 'App\Shortcodes\ShortcodesBuilder@cms_grid_five_sixth');
		Shortcode::register('five_twelveth', 'App\Shortcodes\ShortcodesBuilder@cms_grid_five_twelveth');
		Shortcode::register('seven_twelveth', 'App\Shortcodes\ShortcodesBuilder@cms_grid_five_seven_twelveth');
		
		//heading block
        Shortcode::register('heading', 'App\Shortcodes\ShortcodesBuilder@cms_heading');
		//lists
		Shortcode::register('list', 'App\Shortcodes\ShortcodesBuilder@cms_list');
		Shortcode::register('listitem', 'App\Shortcodes\ShortcodesBuilder@cms_listitem');
    }
}
