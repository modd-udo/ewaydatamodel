<?php
/*
This project is Licenced under The MIT License (MIT)

Copyright (c) 2014 Christopher Seufert

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
namespace Modd\EWay;

use JsonSerializable;

/**
 * Class RefundResponse
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class RefundResponse implements JsonSerializable {
  /**
   * The authorisation code for this transaction as returned by the bank
   * @var string
   */
  public $authorisationCode;

  /**
   * The two digit response code returned from the bank
   * @var string
   */
  public $responseCode;

  /**
   * A code that describes the result of the action performed
   * @var string
   */
  public $responseMessage;

  /**
   * A unique identifier that represents the transaction in eWAY's system
   * @var int
   */
  public $transactionID;

  /**
   * A Boolean value that indicates whether the transaction was successful or not
   * @var boolean
   */
  public $transactionStatus;

  /**
   * This set of fields contains the details of the merchant's customer.
   * These are used when creating and updating Token customers.
   * @var DirectPayment\Customer
   */
  public $customer;

  /**
   * This set of fields contains the details of the payment being processed.
   * This section is required when the Method field is set to
   * **ProcessPayment** or **TokenPayment**.
   * @var Refund\Refund
   */
  public $refund;

  const METHOD_PAYMENT = "ProcessPayment";
  const METHOD_CREATETOKEN = "CreateTokenCustomer";
  const METHOD_UPDATETOKEN = "UpdateTokenCustomer";
  const METHOD_TOKENPAYMENT = "TokenPayment";
  const METHOD_AUTHORISE = "Authorise";

  /**
   * The action to perform with this request (see Payment Methods
   * for more information).
   * One of: METHOD_PAYMENT, METHOD_CREATETOKEN, METHOD_UPDATETOKEN,
   * METHOD_TOKENPAYMENT, METHOD_AUTHORISE
   * @var string
   * @link https://eway.io/api-v3/#payment-methods
   */
  public $method = self::METHOD_PAYMENT;

  /**
   * @var string The identification name/number for the device or application
   * used to process the transaction. (optional) Max 50 chars.
   */
  public $deviceID;

  /**
   * The partner ID generated from an eWAY partner agreement
   * (optional) Max 50 Chars
   * @var string
   */
  public $partnerID;

  /**
   * The wallet ID of a third party wallet used for a payment.
   * Currently used for Visa Checkout transactions.
   * @var string
   * @link https://eway.io/api-v3/#integration-steps-direct-api
   */
  public $thirdPartyWalletID;

  /**
   * The customer's IP address. (optional)
   *
   * _When this field is present along with the Customer Country field,
   * any transaction will be processed using Beagle Fraud Alerts_
   * @var string
   */
  public $customerIP;

  /**
   * A comma separated list of any error encountered, these can be looked up
   * in the Response Codes section. (Max 512 bytes)
   *
   * @var string
   */
  public $errors;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

}