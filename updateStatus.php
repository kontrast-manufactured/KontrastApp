<?php

error_reporting(E_ALL);
include 'restRequest.php';
header('Authorization: Fujifilm APIKey=11C7-2462-6CAA-4D87');
header('Content-Type: application/json');
$orderDataSet = json_decode(file_get_contents('php://input'), true);
define("SHOPIFY_URL", "https://2393be58496d0027c70ac6b8b354130b:5845b00c86160822c624e00ab90dc5b7@kontrast-manufactured-art.myshopify.com/admin/orders/");

$shopifyParamsURL = $orderDataSet['OrderID'] . ".json";
$prepareData["line_items"] = array();


foreach ($orderDataSet['LineItems'] as $singleItems) {

    switch ($singleItems['StatusCode']) {

        case "Error":
            $postNoteData ['order']['id'] = $orderDataSet['OrderID'];
            $postNoteData ['order']['note_attributes']['lineNumber' . $singleItems['LineNumber']] = $singleItems['StatusCode'];
            $postNoteData ['order']['note_attributes']['Description' . $singleItems['LineNumber']] = $singleItems['StatusDescription'];
            $postNoteData ['order']['note'] = $singleItems['StatusDescription'];
            ////Send to shopify to update Order
            $orderToUpdate = json_encode($postNoteData);
            /** use a max of 256KB of RAM before going to disk */
            $fp = fopen('php://temp/maxmemory:256000', 'w');
            if (!$fp) {
                die('could not open temp memory data');
            }
            fwrite($fp, $orderToUpdate);
            fseek($fp, 0);
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
            );

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
            curl_close($ch);

            break;
        case "Shipped":
            //update by creat for shiped items 
            $prepareData["fulfillment"]["tracking_number"] = $singleItems['LineNumber'];
            $prepareData["fulfillment"]["tracking_company"] = $singleItems['LineNumber'];
            $prepareData["line_items"][]["id"] = $singleItems['LineNumber'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, SHOPIFY_URL . $orderDataSet['OrderID'] . "/fulfillments.json");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($prepareData));
            $result = curl_exec($ch);
            var_dump($result);
            curl_close($ch);
            break;
    }
}










//$orderStatus['Data']= json_decode($orderDataSet,true);
$orderStatus['Status']['Code'] = 200;
echo json_encode($orderStatus);

