<?php
session_start();
$apikey = $_SESSION["apikey"];
$post_data = array(
	"apikey" => $apikey,
);
$url = 'localhost/soa_master/api/user/top_up';
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
curl_setopt($curl,CURLOPT_POST,TRUE);
curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
//curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//	'APIKEY: 18c86fc9a70fd942e862ec17313385a7'
//));
$output = curl_exec($curl);
if($output === FALSE)
{
	echo "Failed!";
	//echo "cURL Error :".curl_error($curl);
}
else
{
	echo $output;
}
curl_close($curl);

?>