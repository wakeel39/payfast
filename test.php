<?php 

$data = array(
          // Merchant details
          'merchant_id' => '10003462',
          'merchant_key' => '5zkpzohxqfdm9',
          'return_url' => 'return.php',
          'cancel_url' => 'return.php',
          'notify_url' => 'return.php',
	          'name_first' => 'First Name',
	          'name_last'  => 'Last Name',
	          'email_address'=> 'sbtu01@payfast.co.za',
	          'm_payment_id' => '2', //Unique payment ID to pass through to notify_url
	          'amount' =>200, //Amount needs to be in ZAR, 
          //if you have a multicurrency system, the conversion needs to place before building this array 
          'item_name' => 'Pass Payment',
          'item_description' => 'Item Description',
          'payment_method' => 'cc', //custom integer to be passed through           
          'subscription_type' => 2 //'custom string to be passed through with the transaction to the notify_url page'            
          );        
 
      // Create GET string
	  $pfOutput="";
      foreach( $data as $key => $val )
      {
          if(!empty($val))
          {
          	$pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
          }
  	}
      // Remove last ampersand
      $getString = substr( $pfOutput, 0, -1 );
	  //$passPhrase="";
      if( isset( $passPhrase ) )
      {
          $getString .= '&passphrase='.$passPhrase;
      }	
      $data['signature'] = md5( $getString );
	  
	  // If in testing mode use the sandbox domain ?  sandbox.payfast.co.za else www.payfast.co.za
      $testingMode = true;
      $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
      $htmlForm = '
<form action="https://'.$pfHost.'/eng/process" method="post">'; foreach($data as $name=> $value) { $htmlForm .= '<input name="'.$name.'" type="hidden" value="'.$value.'" />'; } $htmlForm .= '<input type="submit" value="Pay Now" /></form>'; echo $htmlForm;

?>
