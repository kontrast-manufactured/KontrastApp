<?php
error_reporting(E_ALL);
include 'restRequest.php';

$orderDataSet = file_get_contents('php://input');
echo $orderDataSet;

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $orderDataSet);
fclose($myfile);
echo "here";

/*


define('SHOPIFY_URL', "https://2393be58496d0027c70ac6b8b354130b:5845b00c86160822c624e00ab90dc5b7@kontrast-manufactured-art.myshopify.com/admin/orders/");

$shopifyParamsURL = $orderDataSet['id'] . ".json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, SHOPIFY_URL . $shopifyParamsURL);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_INFILE, $fp); // file pointer
curl_setopt($ch, CURLOPT_INFILESIZE, strlen($orderToUpdate));
curl_setopt($ch, CURLOPT_PUT, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$xml_response = curl_exec($ch);
var_dump($xml_response);
if($xml_response!=false){
    echo "true";
}  else {
     echo "false";
}
*/