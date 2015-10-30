<?php

require_once "../php/DirectPaymentResponse.php";
require_once "../php/DirectPayment/CardDetails.php";
require_once "../php/DirectPayment/Customer.php";
require_once "../php/DirectPayment/Payment.php";

class TestResponse extends PHPUnit_Framework_TestCase{

  function testLoadJson() {
    $json = '{"AuthorisationCode":"982507","ResponseCode":"00","ResponseMessage":"A2000","TransactionID":12011894,"TransactionStatus":true,"TransactionType":"Purchase","BeagleScore":0,"Verification":{"CVN":0,"Address":0,"Email":0,"Mobile":0,"Phone":0},"Customer":{"CardDetails":{"Number":"444433XXXXXX1111","Name":"MR TEST","ExpiryMonth":"01","ExpiryYear":"17","StartMonth":null,"StartYear":null,"IssueNumber":null},"TokenCustomerID":null,"Reference":"1202","Title":"Mr.","FirstName":"Chris","LastName":"Test","CompanyName":"","JobDescription":"","Street1":"1 Number St","Street2":"","City":"Melbourne","State":"Victoria","PostalCode":"3000","Country":"","Email":"chris+test@modd.com.au","Phone":"0400123132","Mobile":"","Comments":"","Fax":"","Url":""},"Payment":{"TotalAmount":4140,"InvoiceNumber":"","InvoiceDescription":"","InvoiceReference":"#7320","CurrencyCode":"AUD"},"Errors":null}';
    $jsonData = json_decode($json, JSON_OBJECT_AS_ARRAY);
    $dpr = \Modd\EWay\DirectPaymentResponse::fromArray($jsonData);

    foreach(['authorisationCode','responseCode','responseMessage',
                'transactionID','transactionStatus','transactionType',
                'beagleScore'] as $prop) {
      $key = ucfirst($prop);
      $this->assertEquals($jsonData[$key], $dpr->$prop);
      var_dump($key, $prop, $jsonData[$key], $dpr->$prop);
    }
  }


}