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
 * Class Customer
 * This set of fields contains the details of the merchantís customer.
 * These are used when creating and updating Token customers.
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class Customer implements JsonSerializable {

  /**
   * An eWAY issued ID that represents the Token customer to be loaded for this action.
   * Required for UpdateTokenCustomer method
   * @var int
   */
  public $tokenCustomerID;

  /**
   * The merchantís reference for this customer (optional)
   * @var string
   * @maxlength 50
   */
  public $reference;

  /**
   * The customerís title, empty string allowed.
   * _One of: Mr., Ms., Mrs., Miss, Dr., Sir., Prof._
   *
   * **When creating a new Token customer, this field is required**
   * @var string
   */
  public $title;

  /**
   * The customerís first name
   *
   * **When creating a new Token customer, this field is required**
   *
   * @var string
   */
  public $firstName;

  /**
   * The customerís last name
   *
   * **When creating a new Token customer, this field is required**
   *
   * @var string
   */
  public $lastName;

  /**
   * The customerís company name
   * @var string
   */
  public $companyName;

  /**
   * The customerís job description / title
   * @var string
   */
  public $jobDescription;

  /**
   * The customerís street address
   * @var string
   */
  public $street1;

  /**
   * The customerís street address (line 2)
   * @var string
   */
  public $street2;

  /**
   * The customerís city / town / suburb
   * @var string
   */
  public $city;

  /**
   * The customerís state / county
   * @var string
   */
  public $state;

  /**
   * The customerís post / zip code
   * @var string
   */
  public $postalCode;

  /**
   * The customerís country.
   *
   * This should be the two letter ISO 3166-1 alpha-2 code. This field must
   * be lower case. __e.g. Australia = au__
   *
   * __When this field is present, along with the customerís IP address,
   * any transaction will be processed using Beagle__
   * @var string
   * @link https://www.iso.org/obp/ui/#search/code/
   */
  public $country;

  /**
   * The customerís email address, which must be correctly formatted if present
   * @var string
   */
  public $email;

  /**
   * The customerís phone number
   * @var string
   */
  public $phone;

  /**
   * The customerís fax number
   * @var string
   */
  public $mobile;

  /**
   * Any comments the merchant wishes to add about the customer
   * @var string
   */
  public $comments;

  /**
   * The customerís fax number
   * @var string
   */
  public $fax;

  /**
   * The customerís website URL, which must be correctly formatted if present
   * @var string
   */
  public $url;

  /**
   * The card details section is within the Customer section and is used to
   * pass the customerís card details for the transaction.
   * @var CardDetails
   */
  public $cardDetails;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

  static function fromArray($arr) {
    $res = new self();
    foreach($res as $key => $value)
      if (isset($arr[ucfirst($key)]) && $arr[ucfirst($key)])
        if($key == "cardDetails"){
          $res->$key = CardDetails::fromArray($arr[ucfirst($key)]);
        } else {
          $res->$key = $arr[ucfirst($key)];
        }
    return $res;
  }

}