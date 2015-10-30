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
 * Class DirectPayment
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class DirectPaymentResponse implements JsonSerializable {

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
   * A unique identifier that represents the transaction in eWAY’s system
   * @var int
   */
  public $transactionId;

  /**
   * A Boolean value that indicates whether the transaction was successful or not
   * @var boolean
   */
  public $transactionStatus;

  /**
   * The transaction type that this transaction was processed under.
   * One of: Purchase, MOTO, Recurring
   * @var string
   */
  public $transactionType;

  /**
   * The amount that was authorised for this transaction. (in Cents)
   * @var int
   */
  public $totalAmount;

  /**
   * Fraud score representing the estimated probability that the order is
   * fraud, based off analysis of past Beagle Fraud Alerts transactions. This
   * field will only be returned for transactions using the Beagle Fraud
   * Alerts gateway
   * @var string
   */
  public $beagleScope;

  /**
   * An array of any error encountered, these can be looked up in the
   * Response Codes section.
   * @var string[]
   * @link https://eway.io/api-v3/#response-amp-error-codes
   */
  public $errors = [];

  /**
   * This set of fields contains the details of the merchant’s customer.
   * These are used when creating and updating Token customers.
   * @var DirectPayment\Customer
   */
  public $customer;

  /**
   * This set of fields contains the details of the payment being processed.
   * This section is required when the Method field is set to
   * **ProcessPayment** or **TokenPayment**.
   * @var DirectPayment\Payment
   */
  public $payment;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

  /**
   * @param array $arr
   * @return DirectPaymentResponse
   * @throws \Exception
   */
  static function fromArray($arr) {
    $res = new self();
    foreach(['authorisationCode','responseCode','responseMessage',
            'transactionID','transactionStatus','transactionType',
            'beagleScore'] as $prop) {
      $key = ucfirst($prop);
      if(isset($arr[$key]))
        $res->$prop = $arr[$key];
    }
    if(isset($arr['Errors']) && $arr['Errors'])
      $res->errors = explode(',',$arr['Errors']);
    if(isset($arr['Payment']) && $arr['Payment'])
      $res->payment = DirectPayment\Payment::fromArray($arr['Payment']);
    if(isset($arr['Customer']) && $arr['Customer'])
      $res->customer = DirectPayment\Customer::fromArray($arr['Customer']);
    return $res;
  }

}