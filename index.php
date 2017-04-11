<?php
  require 'lib/phpmailer/PHPMailerAutoload.php';


$data = json_decode(file_get_contents('php://input'), true);
//api for youtube
//
$prepareData = '<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <OrderSubmit xmlns="FES.DigitalIntegrationServices">
      <AppKey>11C7-2462-6CAA-4D87</AppKey>
      <OrderManifest>
  <OriginatorOrderID>'.$data['id'].'</OriginatorOrderID>
  <Summary>
    <TotalTax>1.25</TotalTax>
    <TotalPrice>3.25</TotalPrice>
    <TotalItemPrice>0.232</TotalItemPrice>
    <TotalShipping>15.44</TotalShipping>
    <TotalHandling>0.0</TotalHandling>
    <OwnerInfo>
      <FirstName>Fuji Testorder</FirstName>
      <LastName>Do Not Fulfill</LastName>
      <Phone>5555555555</Phone>
      <OrderUserTypeID>0</OrderUserTypeID>
    </OwnerInfo>
    <TaxList>
        <Amount>0.12</Amount>
    </TaxList>
  </Summary>
  <OriginatorName>Order Integration Service 1.1</OriginatorName>
  <CheckoutDate>2012-08-31T13:40:56-04:00</CheckoutDate>
  <AppKey>11C7-2462-6CAA-4D87</AppKey>
  <SubOrders>
    <SubOrder>
      <Summary>
        <TotalTax>0</TotalTax>
        <TotalPrice>0</TotalPrice>
        <TotalItemPrice>0</TotalItemPrice>
        <TotalShipping>0.0</TotalShipping>
        <TotalHandling>0</TotalHandling>
        <OwnerInfo>
          <FirstName>Fuji Testorder</FirstName>
          <LastName>Do Not Fulfill</LastName>
          <Phone>5555555555</Phone>
          <OrderUserTypeID>0</OrderUserTypeID>
        </OwnerInfo>
      </Summary>
      <OriginatorSubOrderID>'.$data['id'].'-Sub'.'</OriginatorSubOrderID>
      <CreateDate>2012-08-31T13:40:56-04:00</CreateDate>
      <FulfillerID>30242</FulfillerID>
      <LineItems>
        <LineItem>
          <Pages>
            <Page>
              <PageNumber>1</PageNumber>
              <TemplateID>-1</TemplateID>
              <PageProperties/>
              <Regions>
                <Region>
                  <MediaID>1</MediaID>
                  <RegionProperties>
                    <Property>
                      <Name>AutoRedeye</Name>
                      <Type>enh</Type>
                      <Value>0</Value>
                    </Property>
                    <Property>
                      <Name>Enhance</Name>
                      <Type>enh</Type>
                      <Value>0</Value>
                    </Property>
                  </RegionProperties>
                  <RegionType>IMAGE</RegionType>
                  <RegionID>0</RegionID>
                  <TemplateRegionPosition>
                      <InsetX>100</InsetX>
                      <InsetY>100</InsetY>
                      <Width>100</Width>
                      <Height>100</Height>
                      <ZIndex>0</ZIndex>
                      
                  </TemplateRegionPosition>
                </Region>
              </Regions>
            </Page>
          </Pages>
          <LineNumber>1</LineNumber>
          <PaymentInfoID>2</PaymentInfoID>
          <ItemType>1</ItemType>
          <ProductCode>PRGift;4075</ProductCode>
          <Quantity>1</Quantity>
          <UnitPrice>0</UnitPrice>
          <BaseUnitPrice>0</BaseUnitPrice>
          <Tax>0.1</Tax>
          <ShippingPrice>0</ShippingPrice>
          <HandlingPrice>0</HandlingPrice>
          <ItemProperties>
            <Property>
              <Name>CropMode</Name>
              <Value>FITIN</Value>
            </Property>
            <Property>
              <Name>SurfaceID</Name>
              <Type>OPINSTRUCTION</Type>
              <Value>9</Value>
            </Property>
          </ItemProperties>
          <ChildLineItems/>
        </LineItem>
      </LineItems>
      <ShippingInfo>
        <FirstName>'.$data['customer']['first_name'].'</FirstName>
        <LastName>'.$data['customer']['last_name'].'</LastName>
        <Address1>'.$data['customer']['email'].'</Address1>
        <Address2>'.$data['customer']['email'].'</Address2>
        <Address3>'.$data['customer']['email'].'</Address3>
        <City>'.$data['customer']['email'].'</City>
        <State>'.$data['customer']['email'].'</State>
        <PostalCode>'.$data['customer']['email'].'</PostalCode>
        <Country>US</Country>
        <Phone>'.$data['customer']['email'].'</Phone>
        <Email/>
        <PickupTime>2012-08-27T11:00:00</PickupTime>
        <MethodCode>SD</MethodCode>
        <MethodName>Standard Delivery</MethodName>
      </ShippingInfo>
      <Payments>
        <PaymentInfo>
          <PaymentInfoID>2</PaymentInfoID>
          <PaymentAmount>23.2</PaymentAmount>
          <PaymentMethodID>COD</PaymentMethodID>
          <BillingInfo>
            <FirstName>'.$data['customer']['first_name'].'</FirstName>
            <LastName>'.$data['customer']['last_name'].'</LastName>
            <Address1>test</Address1>
            <Address2>test</Address2>
            <Address3>test</Address3>
            <City>'.$data['customer']['email'].'</City>
            <State>'.$data['email'].'</State>
            <PostalCode>'.$data['customer']['last_name'].'</PostalCode>
            <Country>'.$data['customer']['last_name'].'</Country>
            <Phone>'.$data['customer']['last_name'].'</Phone>
            <Email>'.$data['customer']['last_name'].'</Email>
          </BillingInfo>
          <PaymentProperties/>
        </PaymentInfo>
      </Payments>
      <TransactionCollection/>
    </SubOrder>
  </SubOrders>
  <OrderProperties/>
  <FileList>
    <MediaFile>
      <MediaID>1</MediaID>
      <UploadBatchID/>
      <SourceType>URL</SourceType>
      <MediaFileName>image10.jpg</MediaFileName>
      <MediaFileType>IMAGE</MediaFileType>
      <Source>
        http://webservices.fujifilmesys.com/venus/imagebank/image10.jpg
      </Source>
      <RelativeSource/>
      <Rotation>0</Rotation>
      <SourceWidth>0</SourceWidth>
      <SourceHeight>0</SourceHeight>
      <FileDate>0001-01-01T00:00:00</FileDate>
      <MediaFileProperties/>
    </MediaFile>
  </FileList>
  <TemplateList/>
</OrderManifest>
    </OrderSubmit>
  </soap12:Body>
</soap12:Envelope>';
///Auth-key
  $url = 'https://preview.webservices.fujifilmesys.com/fes.digitalintegrationservices/order/orderservices.asmx';
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_POST, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/soap+xml'));
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $prepareData );
  $result = curl_exec($ch);
  curl_close($ch);



$mail = new PHPMailer;

$body = $_POST['Body'];


//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->CharSet = 'UTF-8';

$mail->setFrom($_POST['email'], $_POST['name']);


$mail->addAddress('mona.subaih@gmail.com', 'Mona');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = "Kontrast :: Contact Form";
$mail->Body = json_encode($data);
$mail->AltBody = json_encode($data);

if (!$mail->send()) {

    $data['success'] = false;
    $data['messageError'] = 'Message could not be sent.' . 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $data['success'] = true;
}
echo json_encode($data);

