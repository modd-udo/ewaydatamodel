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

namespace Modd\EWay\DirectPayment;

use JsonSerializable;

/**
 * Class Card
 * The card details section is within the Customer section and is used to pass
 * the customer’s card details for the transaction.
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class CardDetails implements JsonSerializable {

  /**
   * The name of the card holder
   * @var string
   */
  public $name;

  /**
   * The card number that is to be processed for this transaction.
   * _(Not required when processing using an existing CustomerTokenID with
   * TokenPayment method)._ __This should be the encrypted value if using
   * Client Side Encryption.__
   * @var string
   * @link https://eway.io/api-v3/#client-side-encryption
   */
  public $number;

  /**
   * The month that the card expires.
   *
   * _(Not required when processing using an existing
   * Customer TokenID with TokenPayment method)_
   * @var int
   */
  public $expiryMonth;

  /**
   * The year that the card expires.
   *
   * _(Not required when processing using an existing
   * Customer TokenID with TokenPayment method)_
   * @var int
   */
  public $expiryYear;

  /**
   * The month that the card is valid from
   *
   * __Applies to UK only__
   * @var int
   */
  public $startMonth;


  /**
   * The year that the card is valid from
   *
   * __Applies to UK only__
   * @var int
   */
  public $startYear;

  /**
   * The card’s issue number
   *
   * __Applies to UK only__
   * @var int
   */
  public $issueNumber;
  /**
   * The Card Verification Number. This should be the encrypted value if
   * using Client Side Encryption. (Required if the TransactionTye is Purchase)
   * @var int
   * @link https://eway.io/api-v3/#client-side-encryption
   */
  public $CVN;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

  /**
   * @param array|string $json
   * @return CardDetails
   * @throws \Exception
   */
  static function fromJson($json) {
    if(is_object($json))
      $json = (array)$json;
    elseif(!is_array($json))
      $json = json_decode($json, JSON_OBJECT_AS_ARRAY);
    else
      throw new \Exception("Unable to determine JSON Data type");

    $res = new self();
    foreach($res as $key => $value)
      if(isset($json[ucfirst($key)]) && $json[ucfirst($key)])
        $res->$key = $json[ucfirst($key)];
    return $res;
  }

}