=== Adam's Twitter Ticker Feed ===
Contributors: bythegram
Donate link: http://bythegram.ca
Tags: twitter, widget, feed
Requires at least: 3.0.1
Tested up to: 3.6
Stable tag: 1.3.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Twitter Widget that scrolls through your tweets like a stock ticker

== Description ==

This is just the prototype release of the Twitter ticker feed widget. As of now it does not support multiple widgets and will only fetch user feeds. I plan on focusing on enabling multiple widgets next and then I will worry about fetching trends.

Update:
I have updated the plugin to now use Twitter API v1.1 which means it requires
OAuth. You must register a new app at https://dev.twitter.com/apps/new in
order to use this widget. 

Warning:

FYI I just realized that this plugin is breaking the new display policy
Twitter has for how tweets are supposed to be displayed. I'll be updated the
stock css in the next couple of days. Until then be warned that using this
plugin as is will be against Twitter's policies
https://dev.twitter.com/terms/display-requirements

Note:

As of right now the css is pretty basic and only tested on my site. It may need to be adapted to fix your sites needs.




== Installation ==

1. Upload `ag_twitter_feed` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to https://dev.twitter.com/apps/new to create a new Twitter app in order
to get a Consumer Key and Consumer Secret
4. Add you Consumer Key and Consumer Secret to the Twitter Options page
4. Use the AG Twitter Feed Widget in one of your widget areas with the user name desired.

== Frequently Asked Questions ==

= Can I use the widget in multiple places? =

Yes and no. Unfortunately the javascript is not set up to handle multiple user names so though you could have multiple scroller feeds they all will show the same twitter posts

== Screenshots ==


== Changelog ==
= 1.3.3 =
Changed to Twitter v1.1 and oAuth
= 1.3.2 =
Changed to use Twitter's Search API in light of v1 being retired
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
