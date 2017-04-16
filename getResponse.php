<?php
error_reporting(E_ALL);
include 'restRequest.php';
header('Authorization: Fujifilm APIKey=11C7-2462-6CAA-4D87');
header('Content-Type: application/json');
$orderDataSet = file_get_contents('php://input');

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $orderDataSet);
fclose($myfile);


$orderStatus['Data']= json_decode($orderDataSet,true);
$orderStatus['Status']['Code']=200;
echo json_encode($orderStatus);
/*
$orderDataSet ["OrderID"]= "PO1005";
$orderDataSet ["APIKey"]= "11C7-2462-6CAA-4D87";
$orderDataSet ["LineItems"]= array();
$orderDataSet ["LineItems"][]['LineNumber'] = '1';
$orderDataSet ["LineItems"][]['StatusCode'] = 'Error';
$orderDataSet ["LineItems"][]['StatusDescription'] = 'Indicates the item or order has an error that occurred during production';
  

///Auth-key
$url = 'https://preview.webservices.fujifilmesys.com/fes.digitalintegrationservices/orders/pushstatus';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $orderDataSet);
$result = curl_exec($ch);
echo $result;
curl_close($ch);
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