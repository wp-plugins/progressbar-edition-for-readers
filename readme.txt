=== Progress Bar (Edition for Readers) ===
Contributors: Paperthin.de, iTux
Tags: progressbar, progress, tracker, bar, goal, graph, meter, book, reading, ebook, kindle, books
Author URI: http://paperthin.de/
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3SW5E4FK99NS6
Requires at least: 3.0
Tested up to: 4.3
Stable tag: 0.7.1
License: GPLv2 or later

This plugin indicates progress made on books.

== Description == 

This plugin indicates progress made on books.

Important: Your theme needs to support widgets to show the progressbar in the sidebar/widget area.

Major features in Progressbar (Edition for Readers) 0.6 include:


* Added: Support for new WP 3.5 media library.

== Installation ==

Upload the Progressbar (Edition for Readers) plugin to your blog and activate it.

== Screenshots == 

1. Main settings
2. Options in the widget area
3. What it looks like
4. Dashboard widget to change the progress of each widget.

== Changelog == 

= 0.7.1 = 

* Fixed: The plugin is now compatible with Wordpress 4.3.

= 0.7 =

* Fixed: Add new post thumbnails.

= 0.6 =



* Added: Support for new WP 3.5 media library.



= 0.5.2 =



* Fixed: Restored ebook progress based on percentage.


= 0.5 =

* Added: Dashboard widget to provide an easier access to update the reading progress.
* Added: Wordpress's Media-Upload to upload the cover image and insert it into the widget.
* Added: Additional content can be added to the widget now. (e.g. the booklet text)
* Improved: Changed the image class to `progressbar-thumb` to avoid any changes to your theme files. (Change the layout in the file _style.php)
* Improved: _config.php removed, used Wordpress Options API.

= 0.4 = 

* Added: The appearance of the progress bar can be changed in the options.
* Added: Support for audiobooks and ebooks.
* Added: Special Thanks
* Improved: Progress can be saved in the widget options.
* Improved: The new data model is completely free of redundancy.

= 0.3 = 

* Fixed: Devision by zero.

= 0.2 =

* Added: The appearance of the progress bar can be changed in the options.
* Improved: No change to the theme is necessary.
* Improved: Progress can be saved in the widget options.
* Improved: The ne data model is completely free of redundancy.
* Fixed: Incorrect entries will result in a prompt asking for correction.
* Fixed: The encoding is set to UTF-8 without BOM.

= 0.1 = 

* Added: The progress is stored in a database table.

== Upgrade Notice ==

= 0.5 =

* After upgrading to version 0.5 the plugin tries to delete the file _config.php. You may have to delete the file manually if the plugin does not have sufficient rights to delete the file.

== Frequently Asked Questions ==

= How to change the appearance of the cover ? =

Styling such as width, height, padding, background-color, etc., of the cover can be customized by changing the class `.progressbar-thumb` in the file _style.php.

== Special Thanks ==

A big thank you goes out to @plueschsarg, because she is as she is.

Special thanks to @bookexhibitionism, @methinksabout, @MortalBookshelf and @xCrini for their input during the development of this plugin. 

Additional a big thanks to all the users, especially to @buchsaiten, @ichbinkreativ, @nina2null and @WhiteSences.
