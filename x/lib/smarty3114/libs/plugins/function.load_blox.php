<?php

// // setup our function for fetching stock data
// function load_blox($symbol)
// {
//    // put logic here that fetches $ticker_info
//    // from some ticker resource
//    return $ticker_info;
// }

function smarty_function_load_blox($params, $template)
{

	 $site_url = 'http://localhost/html/'.$params['blox']; 
	 $homepage = file_get_contents($site_url);
	// $timeout = 5; // set to zero for no timeout
	// curl_setopt ($ch, CURLOPT_URL, $site_url);
	// curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	// ob_start();
	// curl_exec($ch);
	// curl_close($ch);
	// $file_contents =  ob_get_contents();
	// ob_end_clean();



	//	echo $file_contents;
 
   // assign template variable
   // $this->assign($params['assign'], $file_contents);
   return   $homepage;
}
?>
