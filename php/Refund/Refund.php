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
namespace Modd\EWay\Refund;

use JsonSerializable;

/**
 * Class Payment
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class Refund implements JsonSerializable {

  /**
   * The amount of the transaction in the lowest denomination for the currency
   * (e.g. a __$27.00__ transaction would have a TotalAmount value of __2700__).
   * The value of this field must be __0__ for the CreateTokenCustomer and
   * UpdateTokenCustomer methods
   * @var int
   */
  public $totalAmount = 0;

  /**
   * The merchant's invoice number for this transaction (optional) (max 12 chars)
   * @var string
   */
  public $invoiceNumber;

  /**
   * A description of the purchase that the customer is making
   * (optional) max 60 chars
   * @var string
   */
  public $invoiceDescription;

  /**
   * The merchant's reference number for this transaction
   * (optional) max 50 chars
   * @var string
   */
  public $invoiceReference;

  /**
   * The ISO 4217 3 character code that represents the currency that this
   * transaction is to be processed in. If no value for this field is provided,
   * the merchant's default currency is used. This should be in uppercase.
   * @var string
   * @link http://en.wikipedia.org/wiki/ISO_4217
   */
  public $currencyCode = 'AUD';

  /**
   * The unique identifier of the transaction to refund. Not required when using REST
   * @required
   * @var string
   */
  public $transactionId;


  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

  /**
   * @param string|array $arr
   * @return Refund
   * @throws \Exception
   */
  static function fromArray($arr) {
    $res = new self();
    foreach($res as $key => $value)
      if(isset($arr[ucfirst($key)]) && $arr[ucfirst($key)])
        $res->$key = $arr[ucfirst($key)];
    return $res;
  }

}