## Missing Content
Allows you to add placeholder content quickly and easily to your site.

## Description
Missing content offers multiple different content choices, if you would like to request something else please post it to the support forums.

### Content Choices
* Loreum Ipsum from [http://loripsum.net/](http://loripsum.net/)
* Bacon Ipsum from [http://baconipsum.com/api/](http://baconipsum.com/)
* Hipster Ipsum from [http://hipsterjesus.com/](http://hipsterjesus.com/)
* Blokk Font [http://blokkfont.com/](http://blokkfont.com/)
* Image from [http://placehold.it](http://placehold.it)

### ShortCode Attributes
* content_type
	* default: lipsum
	* options: lipsum|hipster|bacon|blokk|image
* paragraph_count
	* default: 3
* width
	* default: 150
* height
	* default: 150
* cache_duration
	* default: 3 hours aka 10800 aka (3 * 60 * 60)
	* options: {time in seconds}|always|never

### Examples
* **`[missing-content]`** 3 paragraphs from [http://loripsum.net/](http://loripsum.net/) updated every 3 hours.
* **`[missing-content cache_duration="always"]`** Never updates the content.
* **`[missing-content cache_duration="never"]`** 3 paragraphs from [http://loripsum.net/](http://loripsum.net/) updated every page refresh. NOTE: do not use this if using a tool like LiveReload.
* **`[missing-content paragraph_count="1" cache_duration="86400"]`** Displays one paragraph updated every day (24 * 60 * 60).
* **`[missing-content content_type="bacon" paragraph_count="5"]`** 5 paragraphs from [http://baconipsum.com/api/](http://baconipsum.com/) updated every 3 hours.
* **`[missing-content content_type="hipster"]`** 3 paragraphs from [http://hipsterjesus.com/](http://hipsterjesus.com/) updated every 3 hours.
* **`[missing-content content_type="blokk"]`** 3 paragraphs of Blokk font using [http://blokkfont.com/](http://blokkfont.com/) updated every 3 hours.
* **`[missing-content content_type="image" width="500" height="500"]`** 500px x 500px image from [http://placehold.it](http://placehold.it) NOTE: no cache control.

More examples can be found [here](http://danholloran.me/missing-content/)