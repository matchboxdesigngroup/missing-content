=== Missing Content ===
Contributors: dholloran, matchboxdesigngroup, cwhitmore
Donate link: http://matchboxdesingroup.com/
Tags: content, development, testing, shortcode
Requires at least: 3.5
Tested up to: 3.9
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to add placeholder content quickly and easily to your site.

== Description ==
Missing content offers multiple different content choices, if you would like to request something else please post it to the [support forums](http://wordpress.org/support/plugin/missing-content).

= Content Choices =
* Loreum Ipsum from [http://loripsum.net/](http://loripsum.net/)
* Bacon Ipsum from [http://baconipsum.com/api/](http://baconipsum.com/)
* Hipster Ipsum from [http://hipsterjesus.com/](http://hipsterjesus.com/)
* Blokk Font [http://blokkfont.com/](http://blokkfont.com/)
* Image from [http://placehold.it](http://placehold.it)

= How do I use it? =
Either with the shortcode `[missing-content]` in the post editor or with the function `mcn_missing_content( $atts, $echo = true )` in your template.

= Options =
* **content_type="lipsum"** options: lipsum|hipster|bacon|blokk|image
* **paragraph_count="3"** Ignored if random="true"
* **min_paragraph_count="1"** Requires random="true"
* **max_paragraph_count="5"** Requires random="true"
* **width="150"** Ignored if random="true"
* **min_width="150"** Requires random="true" and content_type="image"
* **max_width="1200"** Requires random="true" and content_type="image"
* **height="150"** Ignored if random="true"
* **min_height="150"** Requires random="true" and content_type="image"
* **max_height="1200"** Requires random="true" and content_type="image"
* **random="false"** options: (shortcode: "true"|"false") (function: `true`|`false`)
* **cache_duration="10800"** 3 hours (3 * 60 * 60) options: {time in seconds}|always|never

= Examples =
* **`[missing-content]`** 3 paragraphs from [http://loripsum.net/](http://loripsum.net/) updated every 3 hours.
* **`[missing-content cache_duration="always"]`** Never updates the content.
* **`[missing-content cache_duration="never"]`** 3 paragraphs from [http://loripsum.net/](http://loripsum.net/) updated every page refresh. NOTE: do not use this if using a tool like LiveReload.
* **`[missing-content paragraph_count="1" cache_duration="86400"]`** Displays one paragraph updated every day (24 * 60 * 60).
* **`[missing-content content_type="bacon" paragraph_count="5"]`** 5 paragraphs from [http://baconipsum.com/api/](http://baconipsum.com/) updated every 3 hours.
* **`[missing-content content_type="hipster"]`** 3 paragraphs from [http://hipsterjesus.com/](http://hipsterjesus.com/) updated every 3 hours.
* **`[missing-content content_type="blokk"]`** 3 paragraphs of Blokk font using [http://blokkfont.com/](http://blokkfont.com/) updated every 3 hours.
* **`[missing-content content_type="image" width="500" height="500"]`** 500px x 500px image from [http://placehold.it](http://placehold.it) NOTE: no cache control.
* **[missing-content content_type="image" random="true" min_width="150" max_width="500" min_height="150" max_height="300"]** Random sized image 150px - 500px wide and 150px - 300px high.
* **[missing-content random="true" min_paragraph_count="1" max_paragraph_count="5"]** 1-5 paragraphs from a random content source.

More examples can be found [here](http://danholloran.me/missing-content/)

== Installation ==

= WordPress Plugin Repository =
1. Navigate to Plugins > Add New in the WordPress admin.
1. Search for Missing Content or missing-content.
1. Click Install Now.
1. Choose activate this plugin.
1. Add [missing-content] where you want the missing content to appear with your selected options.

= Manual Installation =
1. Download the latest missing-content.zip.
1. Navigate to Plugins > Add New in the WordPress admin.
1. Select upload from the top navigation.
1. Upload  the latest missing-content.zip.
1. Choose activate this plugin.
1. Add [missing-content] where you want the missing content to appear with your selected options.

== Frequently Asked Questions ==
No FAQs so far.

= How do I ask a question? =
Support forums here http://wordpress.org/support/plugin/missing-content.

= How do I report an issue or bug? =
Please report all issues and bugs to https://github.com/matchboxdesigngroup/missing-content/issues.

== Screenshots ==

1. 3 paragraphs of Loreum Ipsum from [http://loripsum.net/](http://loripsum.net/)
2. 3 paragraphs of Bacon Ipsum from [http://baconipsum.com/api/](http://baconipsum.com/)
3. 3 paragraphs of Hipster Ipsum from [http://hipsterjesus.com/](http://hipsterjesus.com/)
4. 1 paragraph of Blokk Font [http://blokkfont.com/](http://blokkfont.com/)
5. 350px x 150px Image from [http://placehold.it](http://placehold.it)

== Changelog ==

= 1.0.0 =
* Initial release.

= 1.1.0 =
* Added random option to allow retrieval of random amounts of content from a random source.
* Added easy access to missing content in a template using `mcn_missing_content()`
* Fixed assets being enqueued in `wp_head` instead of `wp_enqueue_scripts`
* Miscellaneous tweaks.

== Upgrade Notice ==

= 1.0.0 =
Initial release.

= 1.1.0 =
Adds the option to retrieve random content on each page load and access to a function for use in templates.