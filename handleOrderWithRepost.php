<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$data = json_decode(file_get_contents('php://input'), true);
//api for youtube
//
//
$prepareData = '
<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <OrderSubmit xmlns="FES.DigitalIntegrationServices">
      <AppKey>11C7-2462-6CAA-4D87</AppKey>
      <OrderManifest>
        <OrderID>2222</OrderID>
        <OriginatorOrderID>2121</OriginatorOrderID>
        <Summary>
          <TotalTax>2.5</TotalTax>
          <TotalPrice>44</TotalPrice>
          <TotalItemPrice>4.2</TotalItemPrice>
          <TotalShipping>0</TotalShipping>
          <TotalHandling>0</TotalHandling>
          <OwnerInfo>
            <OrderUserTypeID>1</OrderUserTypeID>
            <UserID>lklklklk</UserID>
            <OriginatorUserID>njnj</OriginatorUserID>
            <ShareID>string</ShareID>
          </OwnerInfo>
          <Status>
            <Code>string</Code>
            <Source>string</Source>
            <Description>string</Description>
          </Status>
          <TaxList>
            <Tax xsi:nil="true" />
            <Tax xsi:nil="true" />
          </TaxList>
        </Summary>
        <OriginatorName>string</OriginatorName>
        <ReceiveDate>string</ReceiveDate>
        <CreateDate>string</CreateDate>
        <CheckoutDate>string</CheckoutDate>
        <AppKey>11C7-2462-6CAA-4D87</AppKey>
        <SubOrders>
          <SubOrder>
            <Summary xsi:nil="true" />
            <OriginatorSubOrderID>string</OriginatorSubOrderID>
            <VendorName>string</VendorName>
            <ReceiveDate>string</ReceiveDate>
            <CreateDate>string</CreateDate>
            <FulfillerID>string</FulfillerID>
            <SubOrderID>string</SubOrderID>
            <EnvelopeID>string</EnvelopeID>
            <DealerID>string</DealerID>
            <LabCode>string</LabCode>
            <LineItems xsi:nil="true" />
            <ShippingInfo xsi:nil="true" />
            <SubOrderProperties xsi:nil="true" />
            <Payments xsi:nil="true" />
            <TransactionCollection xsi:nil="true" />
          </SubOrder>
          <SubOrder>
            <Summary xsi:nil="true" />
            <OriginatorSubOrderID>string</OriginatorSubOrderID>
            <VendorName>string</VendorName>
            <ReceiveDate>string</ReceiveDate>
            <CreateDate>string</CreateDate>
            <FulfillerID>string</FulfillerID>
            <SubOrderID>string</SubOrderID>
            <EnvelopeID>string</EnvelopeID>
            <DealerID>string</DealerID>
            <LabCode>string</LabCode>
            <LineItems xsi:nil="true" />
            <ShippingInfo xsi:nil="true" />
            <SubOrderProperties xsi:nil="true" />
            <Payments xsi:nil="true" />
            <TransactionCollection xsi:nil="true" />
          </SubOrder>
        </SubOrders>
        <OrderProperties>
          <Property>
            <Name>string</Name>
            <Type>string</Type>
            <Value>string</Value>
          </Property>
          <Property>
            <Name>string</Name>
            <Type>string</Type>
            <Value>string</Value>
          </Property>
        </OrderProperties>
        <FileList>
          <MediaFile>
            <MediaID>int</MediaID>
            <MD5CheckSum>string</MD5CheckSum>
            <UploadBatchID>string</UploadBatchID>
            <SourceType>string</SourceType>
            <MediaFileName>string</MediaFileName>
            <SizeKB>string</SizeKB>
            <MediaFileType>string</MediaFileType>
            <Status xsi:nil="true" />
            <Source>string</Source>
            <RelativeSource>string</RelativeSource>
            <Rotation>unsignedInt</Rotation>
            <SourceWidth>unsignedInt</SourceWidth>
            <SourceHeight>unsignedInt</SourceHeight>
            <FileDate>dateTime</FileDate>
            <MediaFileProperties xsi:nil="true" />
            <MediaFileBinData>base64Binary</MediaFileBinData>
          </MediaFile>
          <MediaFile>
            <MediaID>int</MediaID>
            <MD5CheckSum>string</MD5CheckSum>
            <UploadBatchID>string</UploadBatchID>
            <SourceType>string</SourceType>
            <MediaFileName>string</MediaFileName>
            <SizeKB>string</SizeKB>
            <MediaFileType>string</MediaFileType>
            <Status xsi:nil="true" />
            <Source>string</Source>
            <RelativeSource>string</RelativeSource>
            <Rotation>unsignedInt</Rotation>
            <SourceWidth>unsignedInt</SourceWidth>
            <SourceHeight>unsignedInt</SourceHeight>
            <FileDate>dateTime</FileDate>
            <MediaFileProperties xsi:nil="true" />
            <MediaFileBinData>base64Binary</MediaFileBinData>
          </MediaFile>
        </FileList>
        <TemplateList>
          <MediaFile>
            <MediaID>int</MediaID>
            <MD5CheckSum>string</MD5CheckSum>
            <UploadBatchID>string</UploadBatchID>
            <SourceType>string</SourceType>
            <MediaFileName>string</MediaFileName>
            <SizeKB>string</SizeKB>
            <MediaFileType>string</MediaFileType>
            <Status xsi:nil="true" />
            <Source>string</Source>
            <RelativeSource>string</RelativeSource>
            <Rotation>unsignedInt</Rotation>
            <SourceWidth>unsignedInt</SourceWidth>
            <SourceHeight>unsignedInt</SourceHeight>
            <FileDate>dateTime</FileDate>
            <MediaFileProperties xsi:nil="true" />
            <MediaFileBinData>base64Binary</MediaFileBinData>
          </MediaFile>
          <MediaFile>
            <MediaID>int</MediaID>
            <MD5CheckSum>string</MD5CheckSum>
            <UploadBatchID>string</UploadBatchID>
            <SourceType>string</SourceType>
            <MediaFileName>string</MediaFileName>
            <SizeKB>string</SizeKB>
            <MediaFileType>string</MediaFileType>
            <Status xsi:nil="true" />
            <Source>string</Source>
            <RelativeSource>string</RelativeSource>
            <Rotation>unsignedInt</Rotation>
            <SourceWidth>unsignedInt</SourceWidth>
            <SourceHeight>unsignedInt</SourceHeight>
            <FileDate>dateTime</FileDate>
            <MediaFileProperties xsi:nil="true" />
            <MediaFileBinData>base64Binary</MediaFileBinData>
          </MediaFile>
        </TemplateList>
      </OrderManifest>
    </OrderSubmit>
  </soap12:Body>
</soap12:Envelope>
 ';
///Auth-key
  $url = 'https://android.googleapis.com/gcm/send';
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_POST, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_POSTFIELDS, "<xml>here</xml>" );
  $result = curl_exec($ch);
  curl_close($ch);
?>