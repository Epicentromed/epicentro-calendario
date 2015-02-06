<?php
require_once '/lib/Unirest.php';

if (!isset($_POST['name']) || 
	!isset($_POST['email']) || 
	!isset($_POST['date']) || 
	!isset($_POST['time']) || 
	!isset($_POST['reason']))
{
	echo "Debe llenar todos los campos";
}
else
{

	// Fetch vars
	$name = urlencode($_POST['name']);
	$email = $_POST['email'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$reason = urlencode($_POST['reason']);
		

	// Prepare URL
	$url = 'https://calendar.zoho.com/eventreq/f677f2e42b07b7fa527e8964d494942ae5664a239afc39c61662f19c2a4d43264a64100d17cdc3bb';
	$params = "?name={$name}&mailId={$email}&date=${date}&time={$time}&reason={$reason}";
	$url = $url . $params;

	$headers = array("Accept" => "application/json");

	Unirest\Request::verifyPeer(false);
	$response = Unirest\Request::post($url, $headers);

	echo $response->code . " ----- ";        // HTTP Status code
	print_r($response->headers);     // Headers
	print_r($response->body);        // Parsed body
	echo $response->raw_body;    // Unparsed body

}

?>