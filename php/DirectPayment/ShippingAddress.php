<?php
namespace Modd\EWay\DirectPayment;

use JsonSerializable;

/**
 * Class Shipping Address
 *
 * The ShippingAddress section is optional. It is used by Beagle Fraud Alerts
 * (Enterprise) to calculate a risk score for this transaction.
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class ShippingAddress implements JsonSerializable {

  /**
   * The method used to ship the customer’s order
   *
   * __One of: Unknown, LowCost, DesignatedByCustomer, International, Military, NextDay, StorePickup, TwoDayService, ThreeDayService, Other___
   * @var string
   */
  public $shippingMethod;

  /**
   * The customer’s first name
   * @var string
   */
  public $firstName;

  /**
   * The customer’s last name
   * @var string
   */
  public $lastName;

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
   *
   * __When this field is present, along with the customer’s IP address,
   * any transaction will be processed using Beagle__
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
  public $fax;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }
}