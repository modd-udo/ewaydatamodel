<?php
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
}