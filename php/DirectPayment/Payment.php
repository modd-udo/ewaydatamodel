<?php
namespace Modd\EWay\DirectPayment;

use JsonSerializable;

/**
 * Class Payment
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class Payment implements JsonSerializable {

  /**
   * The amount of the transaction in the lowest denomination for the currency
   * (e.g. a __$27.00__ transaction would have a TotalAmount value of __2700__).
   * The value of this field must be __0__ for the CreateTokenCustomer and
   * UpdateTokenCustomer methods
   * @var int
   */
  public $totalPayment = 0;

  /**
   * The merchant’s invoice number for this transaction (optional) (max 12 chars)
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
   * The merchant’s reference number for this transaction
   * (optional) max 50 chars
   * @var
   */
  public $invoiceReference;

  /**
   * The ISO 4217 3 character code that represents the currency that this
   * transaction is to be processed in. If no value for this field is provided,
   * the merchant’s default currency is used. This should be in uppercase.
   * @var string
   * @link http://en.wikipedia.org/wiki/ISO_4217
   */
  public $currencyCode = 'AUD';


  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }
}