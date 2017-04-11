<?php
echo "here";

$data = json_decode(file_get_contents('php://input'), true);
//api for youtube
//

$prepareData = '<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <OrderSubmit xmlns="FES.DigitalIntegrationServices">
      <AppKey>11C7-2462-6CAA-4D87</AppKey>
      <OrderManifest>
  <OriginatorOrderID>1515</OriginatorOrderID>
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
      <OriginatorSubOrderID>1515</OriginatorSubOrderID>
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
        <FirstName>Fuji Testorder</FirstName>
        <LastName>Do Not Fulfill</LastName>
        <Address1>1565 Jefferson Rd</Address1>
        <Address2>Bldg 300</Address2>
        <Address3>Suite 320</Address3>
        <City>Rochester</City>
        <State>NY</State>
        <PostalCode>14623</PostalCode>
        <Country>US</Country>
        <Phone>(585)555-5555</Phone>
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
            <FirstName>Fuji Testorder</FirstName>
            <LastName>Do Not Fulfill</LastName>
            <Address1>1565 Jefferson Rd</Address1>
            <Address2>Bldg 300</Address2>
            <Address3>Suite 320</Address3>
            <City>Rochester</City>
            <State>NY</State>
            <PostalCode>14623</PostalCode>
            <Country>US</Country>
            <Phone>(585)555-5555</Phone>
            <Email>test@fujifilm.com</Email>
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
  var_dump($result);
  

