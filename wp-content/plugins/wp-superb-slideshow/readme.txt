=== wp superb Slideshow ===

Contributors: wpslideshow.com
Author URI: http://wpslideshow.com/superb-slideshow/
Tags: slideshow, 3d slider, wp 3d banner rotator, 3d slideshow, flash 3d slideshow
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: trunk

wp superb Slideshow is a plugin that allows you to display a wonderful 3D Slideshow on your wordpress website. It is free.

== Description ==

Display this 3d slider using [superb]. This free 3d slideshow has many features and it is easy to install.

**Features**

* Customizable gallery width and gallery height
* Customizable coloumns and rows in slide transition
* Customizable autoplay option
* Customizable random slideshow option
* Customizable font size and color options

and many More...

Requirements/Restrictions:
-------------------------
 * Works with Wordpress 3.0, WPMU (Wordpress 3.0+ is highly recommended)
 * PHP5 

Working demo: http://wpslideshow.com/superb-slideshow/


== Installation ==

1. Install automatically through the `Plugins`, `Add New` menu in WordPress, or upload the `wp-superblideshow` folder to the `/wp-content/plugins/` directory. 

2. Activate the plugin through the `Plugins` menu in WordPress. you can find "superb" link  on left side navigation, clilck on to configure plugin Options. 


= short codes =
* <code>[superb]</code> - Use this short code in the content / post to display all images under all categories which are not disabled.

* <code>[superb cats=2,3]</code> - Use this short code in the content / post to display all images under the categories with ID's 2,3.

* <code>[superb imgs=1,2,3]</code> - Use this short code in the content / post to display images which has ID's 1,2,3.


* <code><?php echo do_shortcode('[superb]');?></code> - Use this short code in the template (php file) to display all images under all categories which are not disabled.

* <code><?php echo do_shortcode('[superb cats=2,3]');?></code> - Use this short code in the template (php file) to display all images under the categories with ID's 2,3.

* <code><?php echo do_shortcode('[superb imgs=1,2,3]');?></code> - Use this short code in the template (php file) to display images which has ID's 1,2,3.


* If you have any problems in using this plugin please contact at addons@wpslideshow.com

Working demo: http://wpslideshow.com/superb-slideshow/



== Screenshots ==

1. screenshot-1.png - Slideshow front end. 

2. screenshot-2.gif - Add new album / category.

3. screenshot-3.gif - Edit image.

4. screenshot-4.png - bulk upload.

5. screenshot-5.gif - edit album / category.

6. screenshot-6.gif - short code to be placed in the content.

7. screenshot-7.png - Slideshow front end. 


== changelog ==

2.0
It is completely new built. Supports categories and bulk upload of images. It is not possible to upgrade from your old version to new version. You need to uninstall your old version then install the new version. Plesae do remember to take backup of your old slideshow before you proceed.

2.2
Where ever you place the short code, there only the slider shows. Previously it use to show on top of content.

2.3
Fixed security bugs