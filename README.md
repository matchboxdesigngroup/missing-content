## Missing Content
Allows you to add placeholder content quickly and easily to your site.

## Description
Missing content offers multiple different content choices, if you would like to request something else please post it to the support forums.

###How do I use it?
Either with the shortcode `[missing-content]` in the post editor or with the function `mcn_missing_content( $atts, $echo = true )` in your template.

### Content Choices
* Loreum Ipsum from [http://loripsum.net/](http://loripsum.net/)
* Bacon Ipsum from [http://baconipsum.com/api/](http://baconipsum.com/)
* Hipster Ipsum from [http://hipsterjesus.com/](http://hipsterjesus.com/)
* Blokk Font [http://blokkfont.com/](http://blokkfont.com/)
* Image from [http://placehold.it](http://placehold.it)

### Options
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

### Examples
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