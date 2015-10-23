<?php
namespace Modd\EWay\DirectPayment;

use JsonSerializable;

/**
 * Class Customer
 * This set of fields contains the details of the merchant’s customer.
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
   * The merchant’s reference for this customer (optional)
   * @var string
   * @maxlength 50
   */
  public $reference;

  /**
   * The customer’s title, empty string allowed.
   * _One of: Mr., Ms., Mrs., Miss, Dr., Sir., Prof._
   *
   * **When creating a new Token customer, this field is required**
   * @var string
   */
  public $title;

  /**
   * The customer’s first name
   *
   * **When creating a new Token customer, this field is required**
   *
   * @var string
   */
  public $firstName;

  /**
   * The customer’s last name
   *
   * **When creating a new Token customer, this field is required**
   *
   * @var string
   */
  public $lastName;

  /**
   * The customer’s company name
   * @var string
   */
  public $companyName;

  /**
   * The customer’s job description / title
   * @var string
   */
  public $jobDescription;

  /**
   * The customer’s street address
   * @var string
   */
  public $street1;

  /**
   * The customer’s street address (line 2)
   * @var string
   */
  public $street2;

  /**
   * The customer’s city / town / suburb
   * @var string
   */
  public $city;

  /**
   * The customer’s state / county
   * @var string
   */
  public $state;

  /**
   * The customer’s post / zip code
   * @var string
   */
  public $postalCode;

  /**
   * The customer’s country.
   *
   * This should be the two letter ISO 3166-1 alpha-2 code. This field must
   * be lower case. __e.g. Australia = au__
   * @var string
   * @link https://www.iso.org/obp/ui/#search/code/
   */
  public $country;

  /**
   * The customer’s email address, which must be correctly formatted if present
   * @var string
   */
  public $email;

  /**
   * The customer’s phone number
   * @var string
   */
  public $phone;

  /**
   * The customer’s fax number
   * @var string
   */
  public $mobile;

  /**
   * Any comments the merchant wishes to add about the customer
   * @var string
   */
  public $comments;

  /**
   * The customer’s fax number
   * @var string
   */
  public $fax;

  /**
   * The customer’s website URL, which must be correctly formatted if present
   * @var string
   */
  public $url;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }
}