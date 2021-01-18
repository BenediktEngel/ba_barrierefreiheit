=== composition book ===

Contributors: peterste
Tags: custom-background, featured-images, threaded-comments, translation-ready, accessibility-ready
Requires at least: 5.2
Tested up to: 5.4
Stable tag: 1.2.1
Requires PHP: 7.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html	

A blogging or small business theme.

== Description ==

This theme is probably best used for a blog or some other kind of personal website. It hooks into
WooCommerce to provide mom-and-pop scale ecommerce functionality.

Two "features" which might need short explanations:
* You can alter the way posts appear on index pages, namely the blog/posts page and taxonomy
pages, by choosing the background image template in the post editor. This template only affects posts 
that appear in lists and will not affect the "single" view of the post. It's best that any 
post that uses this template has a featured image.

* You can add panels, consisting of a large image with text layered on top, to a page on your site 
by selecting the panel page template. You can also include these panels on your blog page by navigating 
to your blog page and checking the box in the CP Panels customizer section.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Does this theme support any plugins? =

Composition Book includes support for Infinite Scroll in Jetpack and WooCommerce.

== Changelog ==

= 1.2.1 =

* small style change to padding in single post sidebar.
* changed custom logo fallback text from a heading to a paragraph. 
* fixed screenshot size

= 1.2.0 =

* Fixed focus order in header to match visual order. 
* Main navigation remains visually hidden unless explcitly triggered with toggle.
* fix outline of comment form in firefox
* Changed H1 content on blog page to site title instead of description.

= 1.1.0 =
* Changed theme name from "chocolate passion" to "composition book".
* Added wp_body_open to header files.
* Replaced non-GPL compatible images.
* Removing custom logo in customizer will properly show fallback text.
* 'Show Panels on Blog Page' customizer control restricted to appearing when blog page is previewed.
* Conditional show/hide functionality added to CB Panels section of customizer controls.
* Setting a post to 'background image' view is now done via post template file rather than post meta box.
* Added support for jetpack social menu
* Minor styling changes to posts in archive views
* Styling changes to comments
* Some escaping fixes. 
* Some code formatting fixes
* Fixed errors in TGM Plugin Activation
* Added license information for fonts
* Minor style changes to search results page
* Added version check to deactivate theme if PHP version is less than 7.0

= 1.0 =
* Initial release

== Copyright ==

Composition Book Theme, Copyright 2020 Peter Steele.
Composition Book is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Credits ==

* Based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
* TGM Plugin Activation, Copyright 2011 Thomas Griffin Media, [GPUv2](https://www.gnu.org/licenses/gpl-2.0.html),
http://tgmpluginactivation.com/
* Font Awesome, © Fonticons, Inc., Creative Commons BY 4.0, https://fontawesome.com. 
* Composition Book incorporates code from Twentyseventeen theme by WordPress, Copyright 2016 WordPress.org.
 Twentyseventeen Theme is distributed under the terms of the GNU GPL. Twentyseventeen code can be found in 
 composition_book_setup function in functions.php.

Fonts:

"Nunito"
Primary font, Copyright Vernon Adams, principal designer, and Jacques Le Bailly
License: SIL Open Font License (OFL) v1.1
Source: https://fonts.google.com/specimen/Nunito

"Abel"
Secondary font, Copright MadType 
License: SIL Open Font License (OFL) v1.1
Source: https://fonts.google.com/specimen/Abel

Photos:

“Landscape with trees and fog”
Image for theme screenshot starter content, Copyright Lisa Yount
License: CC0 1.0 Universal (CC0 1.0)
Source: https://skitterphoto.com/photos/1731/landscape-with-trees-and-fog

“Sunrise”
Image for theme screenshot & starter content, Copyright Erik van den Broek
License: CC0 1.0 Universal (CC0 1.0)
Source: https://skitterphoto.com/photos/1071/sunrise

"Woods"
Image for theme screenshot & starter content, Copyright Peter Steele
License: GNU General Public License v2
Source: original

"bgwidget"
Background texture, copyright Peter Steele
License: GNU General Public License v2 
source: original
