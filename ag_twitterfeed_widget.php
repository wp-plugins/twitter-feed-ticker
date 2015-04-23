<?php
/*
 * Plugin name: Twitter Feed Ticker 
 * Plugin URI: http://bythegram.ca
 * Description: A scrolling twitter feed (work in progress)
 * Version: 1.3.4
 * Author: Adam Graham
 * 
 */

require (plugin_dir_path( __FILE__ ).'/ag-twitter-options.php');
require (plugin_dir_path( __FILE__ ).'/oauth.php');

if (!class_exists("ag_twitfeed_widget")) {
	
	function agTfeedstyle() {
		if (!wp_script_is( 'jquery', 'queue' ) ) {
		wp_enqueue_script('jquery');	
		};
    		wp_enqueue_script('gitfi', plugin_dir_url( __FILE__ ) . '/js/gistfile1.js');
		wp_enqueue_style( 'AG Twitter Feed Style', plugin_dir_url( __FILE__ ) . '/css/tfeedstyle.css', array(), '0.1', 'screen' );
		wp_enqueue_script('bytwit',  plugin_dir_url( __FILE__ ) . '/js/feed.js', array(), false, true);
		}
		
		add_action( 'wp_enqueue_scripts', 'agTfeedstyle' );
	
	class ag_twitfeed_widget extends WP_Widget {
 				
 		function ag_twitfeed_widget() {
			$widget_ops = array('classname' => 'ag_twitfeed_widget', 'description' => 'A Scrolling Twitter Feed' );
			$this->WP_Widget('ag_twitterfeed_widget', 'Twitter Feed Ticker', $widget_ops);
		}
 		/* This is the code that gets displayed on the UI side,
		 * what readers see.
		 */
		function widget($args, $instance) {
			
		$twittername = $instance['twittername'];
		
		$options = get_option( 'ag_twitter_options' );	
		$app_id = $options['ag_appid'];
		$app_secret = $options['ag_appsecret'];	
		$key = $options['ag_key'];
		$secret = $options['ag_secret'];
		
		$settings = array(
    		'oauth_access_token' => "$app_id",
    		'oauth_access_token_secret' => "$app_secret",
    		'consumer_key' => "$key",
		'consumer_secret' => "$secret"
		);				
				
		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$getfield = '?screen_name='.$twittername.'&count=10';
		$requestMethod = 'GET';
		$twitter = new TwitterAPIExchange($settings);
		$tweets = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

		$tweets = json_decode($tweets);
		
		echo '<div id="twitter">';
    	echo '<a href="http://www.twitter.com/'.$twittername.'" target="_blank" ><h2>Follow @<span id="twitname">'.$twittername.'</span> on Twitter</h2></a>';
		echo '<marquee behavior="scroll" scrollamount="1" direction="left">';
		
		if ( !empty($tweets) ) {
		
		foreach ( $tweets as $entry ) {
		echo '<a href="http://twitter.com/'. $twittername .'#stream-item-tweet-' . $entry->id_str . '" target="_blank">' . $entry->text . '<i>' . date('F d Y', strtotime($entry->created_at)) . '</i></a>';
		}
		
		}

		echo '</marquee>';
		
		
    	echo '<noscript>This feature requires JavaScript</noscript>';
		echo '</div>';
		
		}
 
		function update($new_instance, $old_instance) {
		return $new_instance;
		}
 		/* Back end, the interface shown in Appearance -> Widgets
		 * administration interface.
		 */
		function form($instance) {
			
           	$twittername = esc_attr($instance['twittername']);
            
?>

<p>
  <label for="<?php echo $this->get_field_id('twittername'); ?>">
    <?php _e('Twitter User Name:','your-theme'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('twittername'); ?>" value="<?php echo $twittername; ?>" class="widefat" id="<?php echo $this->get_field_id('twittername'); ?>" />
</p>
<?php
		}			
	}
 
	function agtwit_widget_init() {
		register_widget('ag_twitfeed_widget');
	}
        
	add_action('widgets_init', 'agtwit_widget_init');
 
}
 
$wpdpd = new ag_twitfeed_widget();

 
?>
