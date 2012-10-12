=== Adam's Twitter Ticker Feed ===
Contributors: bythegram
Donate link: http://bythegram.ca
Tags: twitter, widget, feed
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 1.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Twitter Widget that scrolls through your tweets like a stock ticker

== Description ==

This is just the prototype release of the Twitter ticker feed widget. As of now it does not support multiple widgets and will only fetch user feeds. I plan on focusing on enabling multiple widgets next and then I will worry about fetching trends.

Note:

As of right now the css is pretty basic and only tested on my site. It may need to be adapted to fix your sites needs.

Fixed: Twitter changed their API recently as a result the feed was not showing, 
this should now be fixed

== Installation ==

1. Upload `ag_twitter_feed` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the AG Twitter Feed Widget in one of your widget areas with the user name desired.

== Frequently Asked Questions ==

= Can I use the widget in multiple places? =

Yes and no. Unfortunately the javascript is not set up to handle multiple user names so though you could have multiple scroller feeds they all will show the same twitter posts

== Screenshots ==


== Changelog ==
= 1.3.1 =
Sorry in my rush to release the last fix I made some mistakes this should take care of it
= 1.3 =
Small fixes to the links (added target="_blank" and made the tweet link to the actual tweet) and changed the title from "username" to "Follow 
username on Twitter". Thanks to toes21 for the suggestions!
suggestion.
= 1.2 =
Updated the twitter call to match with the new API
= 1.1 =
Added jquery enqueue to ensure proper functionality
= 1.0 =
The first release. Tested and works. 
