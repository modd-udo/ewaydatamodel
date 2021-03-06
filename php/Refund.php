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
 * Class Refund
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class Refund implements JsonSerializable {

  /**
   * This set of fields contains the details of the merchant's customer.
   * These are used when creating and updating Token customers.
   * @var DirectPayment\Customer
   */
  public $customer;

  /**
   * The ShippingAddress section is optional. It is used by Beagle Fraud Alerts
   * (Enterprise) to calculate a risk score for this transaction.
   * @var DirectPayment\ShippingAddress
   */
  public $shippingAddress;

  /**
   * The Items section is optional. If provided, it should contain a list of
   * line items purchased by the customer, up to a maximum of 99 items. It is
   * used by Beagle Fraud Alerts (Enterprise) to calculate a risk score for
   * this transaction.
   * @var DirectPayment\Item[]
   */
  public $items;
  /**
   * This section is optional. Anything appearing in this section is not
   * displayed to the customer. Up to 99 options can be defined.
   * Each option has just one field
   * @var DirectPayment\Option[]
   */
  public $options;

  /**
   * This set of fields contains the details of the payment being processed.
   * This section is required when the Method field is set to
   * **ProcessPayment** or **TokenPayment**.
   * @var Refund\Refund
   */
  public $refund;

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
   * The customer's IP address. (optional)
   *
   * _When this field is present along with the Customer Country field,
   * any transaction will be processed using Beagle Fraud Alerts_
   * @var string
   */
  public $customerIP;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

}