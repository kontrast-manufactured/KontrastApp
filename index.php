<?php
error_reporting(0);
include 'restRequest.php';



$data = json_decode(file_get_contents('php://input'), true);

//prepare line item for XML 
$lineItemString = '';
$mediaFileTag = '';
$lineItemsArr = $data['line_items'];
//fixed Params
$restRequest = new restRequest();
$mainURL = "https://2393be58496d0027c70ac6b8b354130b:5845b00c86160822c624e00ab90dc5b7@kontrast-manufactured-art.myshopify.com/admin/variants/";
$params = ".json";

$restRequest->setVerb('GET');
$restRequest->setCustomeCurlParams(array(
    'CURLOPT_SSL_VERIFYPEER' => false,
    'CURLOPT_SSL_VERIFYHOST' => 2
));
$i = 0;
 $data['tax_linesRate'] = ($data['tax_lines']['rate']!='')?$data['tax_lines']['rate']:0.0 ;
 $data['tax_linesPrice'] = ($data['tax_lines']['price'] !='')?$data['tax_lines']['price']:0.0;
foreach ($lineItemsArr as $key => $variant) {
    $i = $i + 1;
    ////////////// get the product image /////////////////////
    $productURL = "https://2393be58496d0027c70ac6b8b354130b:5845b00c86160822c624e00ab90dc5b7@kontrast-manufactured-art.myshopify.com/admin/products/";
    $paramsvarient = $variant['product_id'] . ".json";

    $restRequest->setUrl($productURL . $paramsvarient);

    $restRequest->execute();
    $productInfo = json_decode($restRequest->getResponseBody(), true);
    $product = $productInfo['product'];

    //This request for get varient sku//////////////////////////////////
    $restRequest->setUrl($mainURL . $variant['variant_id'] . $params);
    $restRequest->execute();
    $varientInfo = json_decode($restRequest->getResponseBody(), true);

    $lineItemString .= '<LineItem>
          <Pages>
            <Page>
              <PageNumber>1</PageNumber>
              <TemplateID>-1</TemplateID>
              <PageProperties/>
              <Regions>
                <Region>
                  <MediaID>' . $variant['id'] . '</MediaID>
                  <RegionType>IMAGE</RegionType>
                  <RegionID>0</RegionID>
                </Region>
              </Regions>
            </Page>
          </Pages>
          <LineNumber>' . $variant['id'] . '</LineNumber>
          <PaymentInfoID>2</PaymentInfoID>
          <ProductCode>' . $varientInfo['variant']['sku'] . '</ProductCode>
          <Quantity>' . $variant['quantity'] . '</Quantity>
          <UnitPrice>' . $variant['price'] . '</UnitPrice>
          <BaseUnitPrice>' . $variant['price'] . '</BaseUnitPrice>
          <Tax>' .  $data['tax_linesPrice']. '</Tax>
          <ShippingPrice>0</ShippingPrice>
          <HandlingPrice>0.0</HandlingPrice>
          <ChildLineItems/>
        </LineItem>';

    $mediaFileTag .='<MediaFile>
      <MediaID>' . $variant['id'] . '</MediaID>
      <UploadBatchID/>
      <SourceType>URL</SourceType>
      <MediaFileName>' . $i . $data['name'] . '.jpg</MediaFileName>
      <MediaFileType>IMAGE</MediaFileType>
      <Source>
        ' . $product['image']['src'] . '
      </Source>
      <RelativeSource/>
      <Rotation>0</Rotation>
      <SourceWidth>0</SourceWidth>
      <SourceHeight>0</SourceHeight>
      <FileDate>0001-01-01T00:00:00</FileDate>
      <MediaFileProperties/>
    </MediaFile>';


    
}

$prepareData = '<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <OrderSubmit xmlns="FES.DigitalIntegrationServices">
      <AppKey>11C7-2462-6CAA-4D87</AppKey>
      <OrderManifest>
  <OriginatorOrderID>' . $data['id'] . '</OriginatorOrderID>
  <Summary>
    <TotalTax>' . $data['total_tax'] . '</TotalTax>
    <TotalPrice>' . $data['total_price'] . '</TotalPrice>
    <TotalItemPrice>' . $data['total_line_items_price'] . '</TotalItemPrice>
    <TotalShipping>0</TotalShipping>
    <TotalHandling>0.0</TotalHandling>
    <OwnerInfo>
      <FirstName>' . $data['customer']['first_name'] . '</FirstName>
      <LastName>' . $data['customer']['last_name'] . '</LastName>
      <Phone>' . $data['customer']['phone'] . '</Phone>
      <Email>' . $data['customer']['email'] . '</Email>
      <OrderUserTypeID>0</OrderUserTypeID>
    </OwnerInfo>
    <TaxList>
        <Tax>
          <TaxID>VAT</TaxID>
          <Rate>' .$data['tax_linesRate']. '</Rate>
          <Amount>' .$data['tax_linesPrice']  . '</Amount>
        </Tax>
    </TaxList>
  </Summary>
  <OriginatorName>Order Integration Service 1.1</OriginatorName>
  <CheckoutDate>2012-08-31T13:40:56-04:00</CheckoutDate>
  <AppKey>11C7-2462-6CAA-4D87</AppKey>
  <SubOrders>
    <SubOrder>
      <Summary>
       <TotalTax>' . $data['total_tax'] . '</TotalTax>
    <TotalPrice>' . $data['total_price'] . '</TotalPrice>
    <TotalItemPrice>' . $data['total_line_items_price'] . '</TotalItemPrice>
    <TotalShipping>0</TotalShipping>
        <TotalHandling>0</TotalHandling>
        <OwnerInfo>
          <FirstName>' . $data['customer']['first_name'] . '</FirstName>
          <LastName>' . $data['customer']['last_name'] . '</LastName>
          <Phone>' . $data['customer']['phone'] . '</Phone>
          <OrderUserTypeID>0</OrderUserTypeID>
        </OwnerInfo>
      </Summary>
      <OriginatorSubOrderID>' . $data['name'] . '</OriginatorSubOrderID>
      <CreateDate>' . $data['created_at'] . '</CreateDate>
      <FulfillerID>30242</FulfillerID>
      <LineItems>
        '.$lineItemString.'
      </LineItems>
      <ShippingInfo>
        <FirstName>' . $data['shipping_address']['first_name'] . '</FirstName>
        <LastName>' . $data['shipping_address']['last_name'] . '</LastName>
        <Address1>' . $data['shipping_address']['address1'] . '</Address1>
        <Address2>' . $data['shipping_address']['address2'] . '</Address2>
        <City>' . $data['shipping_address']['city'] . '</City>
        <State>' . $data['shipping_address']['province_code'] . '</State>
        <PostalCode>' . $data['shipping_address']['zip'] . '</PostalCode>
        <Country>' . $data['shipping_address']['country_code'] . '</Country>
        <Phone>' . $data['shipping_address']['phone'] . '</Phone>
        <PickupTime> 2017-04-12T11:00:00 </PickupTime>    
        <MethodCode>SD</MethodCode>
        <MethodName>Standard Delivery</MethodName>
      </ShippingInfo>
      <Payments>
        <PaymentInfo>
          <PaymentInfoID>2</PaymentInfoID>
          <PaymentAmount>' . $data['total_price'] . '</PaymentAmount>
          <PaymentMethodID>COD</PaymentMethodID>
          <BillingInfo>
            <FirstName>' . $data['billing_address']['first_name'] . '</FirstName>
            <LastName>' . $data['billing_address']['last_name'] . '</LastName>
            <Address1>' . $data['billing_address']['address1'] . '</Address1>
            <Address2>' . $data['billing_address']['address2'] . '</Address2>
            <City>' . $data['billing_address']['city'] . '</City>
            <State>' . $data['billing_address']['province_code'] . '</State>
            <PostalCode>' . $data['billing_address']['zip'] . '</PostalCode>
            <Country>' . $data['billing_address']['country_code'] . '</Country>
            <Phone>' . $data['billing_address']['phone'] . '</Phone>
          </BillingInfo>
          <PaymentProperties/>
        </PaymentInfo>
      </Payments>
      <TransactionCollection/>
    </SubOrder>
  </SubOrders>
  <OrderProperties/>
  <FileList>
     '.$mediaFileTag.'
  </FileList>
  <TemplateList/>
</OrderManifest>
    </OrderSubmit>
  </soap12:Body>
</soap12:Envelope>';



///Auth-key
$url = 'https://preview.webservices.fujifilmesys.com/fes.digitalintegrationservices/order/orderservices.asmx';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/soap+xml'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $prepareData);
$result = curl_exec($ch);
curl_close($ch);




