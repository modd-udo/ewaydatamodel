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
   * The method used to ship the customerís order
   *
   * __One of: Unknown, LowCost, DesignatedByCustomer, International, Military, NextDay, StorePickup, TwoDayService, ThreeDayService, Other___
   * @var string
   */
  public $shippingMethod;

  /**
   * The customerís first name
   * @var string
   */
  public $firstName;

  /**
   * The customerís last name
   * @var string
   */
  public $lastName;

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
  public $fax;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }
}