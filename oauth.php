<?php
$options = get_option( 'ag_twitter_options' );

define('CONSUMER_KEY', $options['ag_key']);
define('CONSUMER_SECRET', $options['ag_secret']);
/**
*	Get the Bearer Token, this is an implementation of steps 1&2
*	from https://dev.twitter.com/docs/auth/application-only-auth
*/
function ag_get_bearer_token(){
	// Step 1
	// step 1.1 - url encode the consumer_key and consumer_secret in accordance with RFC 1738
	$encoded_consumer_key = urlencode(CONSUMER_KEY);
	$encoded_consumer_secret = urlencode(CONSUMER_SECRET);
	// step 1.2 - concatinate encoded consumer, a colon character and the encoded consumer secret
	$bearer_token = $encoded_consumer_key.':'.$encoded_consumer_secret;
	// step 1.3 - base64-encode bearer token
	$base64_encoded_bearer_token = base64_encode($bearer_token);
	// step 2
	$url = "https://api.twitter.com/oauth2/token"; // url to send data to for authentication
	$headers = array( 
		"POST /oauth2/token HTTP/1.1", 
		"Host: api.twitter.com", 
		"User-Agent: ukoel Twitter Application-only OAuth App v.1",
		"Authorization: Basic ".$base64_encoded_bearer_token."",
		"Content-Type: application/x-www-form-urlencoded;charset=UTF-8", 
		"Content-Length: 29"
	); 

	$ch = curl_init();  // setup a curl
	curl_setopt($ch, CURLOPT_URL,$url);  // set url to send to
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // set custom headers
	curl_setopt($ch, CURLOPT_POST, 1); // send as post
	curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); // post body/fields to be sent
	$header = curl_setopt($ch, CURLOPT_HEADER, 1); // send custom headers
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	ob_start();  // start ouput buffering
	curl_exec ($ch); // execute the curl
	$retrievedhtml = ob_get_contents(); // grab the retreived html
	ob_end_clean(); //End buffering and clean output 
	curl_close($ch); // close the curl
	$output = explode("\n", $retrievedhtml);
	$bearer_token = '';
	foreach($output as $line)
	{
		if($pos === false)
		{
			// there was no bearer token
		}else{
			$bearer_token = $line;
		}
	}
	$bearer_token = json_decode($bearer_token);
	return $bearer_token->{'access_token'};
}

/**
* Invalidates the Bearer Token
* Should the bearer token become compromised or need to be invalidated for any reason,
* call this method/function.
*/
function ag_invalidate_bearer_token($bearer_token){
	$encoded_consumer_key = urlencode(CONSUMER_KEY);
	$encoded_consumer_secret = urlencode(CONSUMER_SECRET);
	$consumer_token = $encoded_consumer_key.':'.$encoded_consumer_secret;
	$base64_encoded_consumer_token = base64_encode($consumer_token);
	// step 2
	$url = "https://api.twitter.com/oauth2/invalidate_token"; // url to send data to for authentication
	$headers = array( 
		"POST /oauth2/invalidate_token HTTP/1.1", 
		"Host: api.twitter.com", 
		"User-Agent: ukoel Twitter Application-only OAuth App v.1",
		"Authorization: Basic ".$base64_encoded_consumer_token."",
		"Accept: */*", 
		"Content-Type: application/x-www-form-urlencoded", 
		"Content-Length: ".(strlen($bearer_token)+13).""
	); 
    
	$ch = curl_init();  // setup a curl
	curl_setopt($ch, CURLOPT_URL,$url);  // set url to send to
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // set custom headers
	curl_setopt($ch, CURLOPT_POST, 1); // send as post
	curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=".$bearer_token.""); // post body/fields to be sent
	$header = curl_setopt($ch, CURLOPT_HEADER, 1); // send custom headers
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	ob_start();  // start ouput buffering
	curl_exec ($ch); // execute the curl
	$retrievedhtml = ob_get_contents(); // grab the retreived html
	ob_end_clean(); //End buffering and clean output 
	curl_close($ch); // close the curl
	return $retrievedhtml;
}

/**
* Search
* Basic Search of the Search API
* Based on https://dev.twitter.com/docs/api/1/get/search
*/
function ag_search_for_a_term($bearer_token, $query, $since='', $result_type='mixed', $rpp='50'){
	$url = "https://api.twitter.com/1.1/search/tweets.json"; // base url
	$q = '?q='.$query; // query term
	
	$formed_url = $q; // fully formed url
	if($result_type!='mixed'){$formed_url = $formed_url.'&result_type='.$result_type;} // result type - mixed(default), recent, popular
	if($rpp!=''){$formed_url = $formed_url.'&count='.$rpp;} // results per page - defaulted to 15
	if($since!=''){$formed_url = $formed_url.'&since_id='.$since;} //since_id
	$formed_url = $formed_url.'&include_entities=true'; // makes sure the entities are included, note @mentions are not included see documentation

	$headers = array( 
		"GET /1.1/search/tweets.json".$formed_url." HTTP/1.1", 
		"Host: api.twitter.com", 
		"User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
		"Authorization: Bearer ".$bearer_token."",
	);
	$ch = curl_init();  // setup a curl
	curl_setopt($ch, CURLOPT_URL,$url.$formed_url);  // set url to send to
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // set custom headers
	ob_start();  // start ouput buffering
	$output = curl_exec ($ch); // execute the curl
	$retrievedhtml = ob_get_contents(); // grab the retreived html
	ob_end_clean(); //End buffering and clean output 
	curl_close($ch); // close the curl
	return $retrievedhtml;
}
$bearer_token = ag_get_bearer_token();
?>
