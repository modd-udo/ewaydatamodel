<?php
namespace Modd\EWay;

use JsonSerializable;

/**
 * Class DirectPayment
 * @package Modd\EWay
 * @author Chris Seufert <chris@modd.com.au>
 * @link https://eway.io/api-v3/#direct-connection
 */
class DirectPayment implements JsonSerializable {

  public $customer;
  public $shippingAddress;
  public $items;
  public $options;

  /**
   * This set of fields contains the details of the payment being processed.
   * This section is required when the Method field is set to
   * **ProcessPayment** or **TokenPayment**.
   * @var DirectPayment\Payment
   */
  public $payment;

  const METHOD_PAYMENT = "ProcessPayment";
  const METHOD_CREATETOKEN = "CreateTokenCustomer";
  const METHOD_UPDATETOKEN = "UpdateTokenCustomer";
  const METHOD_TOKENPAYMENT = "TokenPayment";
  const METHOD_AUTHORISE = "Authorise";

  /**
   * The action to perform with this request (see Payment Methods
   * for more information).
   * One of: METHOD_PAYMENT, METHOD_CREATETOKEN, METHOD_UPDATETOKEN,
   * METHOD_TOKENPAYMENT, METHOD_AUTHORISE
   * @var string
   * @link https://eway.io/api-v3/#payment-methods
   */
  public $method = self::METHOD_PAYMENT;

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
   * The wallet ID of a third party wallet used for a payment.
   * Currently used for Visa Checkout transactions.
   * @var string
   * @link https://eway.io/api-v3/#integration-steps-direct-api
   */
  public $thirdPartyWalletID;

  /**
   * The customer’s IP address. (optional)
   *
   * _When this field is present along with the Customer Country field,
   * any transaction will be processed using Beagle Fraud Alerts_
   * @var string
   */
  public $customerIP;

  /**
   * __Rapid Libraries Only__ Set to true to capture funds immediately (default),
   * set to false to perform an authorisation and only hold funds. (optional)
   * @var boolean
   */
  public $capture;

  const TYPE_PURCHASE = "Purchase";
  const TYPE_MOTO = "MOTO";
  const TYPE_RECURRING = "Recurring";

  /**
   * The type of transaction you’re performing (see Transaction Types).
   * One of: TYPE_PURCHASE, TYPE_MOTO, TYPE_RECURRING
   * @var string
   * @link https://eway.io/api-v3/#transaction-types
   */
  public $transactionType = self::TYPE_PURCHASE;

  function jsonSerialize() {

  }

}