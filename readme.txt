=== Custom-Single ===
Contributors: Tor N. Johnson
Tags: categories, custom, custom templates, posts, template, single.php
Requires at least: 3.5
Stable tag: 1.0.0 
Tested up to: 3.8.1

Enables themes to support custom single.php templates per category in the form single-CATEGORYID.php.

== Description ==

This plugin enables themes to specify a different single.php template based on post category. As posts can have multiple categories assigned, it uses the following to select which possible custom template to use:

1) Categories directly assigned
	-- Check for extant single-CATEGORYID.php files and prioritize based on category order
2) Parents of categories
	-- Parents are checked based on category order of the directly assigned categories.

Note, the above assumes that there's a category order plugin installed. If the categories are NOT in a specific order AND there are multiple categories assigned per post then the template selection will be left up to the server.  Naturally, if there is only category assigned per post (or only one possible template per post), then there will be no issue.

== Screenshots ==




== Installation ==

1. Upload the folder `Custom-Single` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create customized single.php template files as desired.




== Changelog ==

= 1.0.0 (2013-10-09) =
* Initial Release

= 1.0.1 (2014-02-26) =
* enabled custom single to use either category ID or names

== Requirements ==


