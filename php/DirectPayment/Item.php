<?php
namespace Modd\EWay\DirectPayment;

use JsonSerializable;

class Item implements JsonSerializable {

  /**
   * The stock keeping unit used to identify this line item
   * (max 12 chars)
   * @var string
   */
  public $SKU;

  /**
   * A brief description of the product (max 26 chars)
   * @var string
   */
  public $description;

  /**
   * The purchased quantity
   * @var int
   */
  public $quantity;

  /**
   * The pre-tax cost per unit of the product in the lowest denomination
   * @var int
   */
  public $unitCost;

  /**
   * The tax amount that applies to this line item in the lowest denomination
   * @var int
   */
  public $tax;

  /**
   * The total amount charged for this line item in the lowest denomination
   * @var int
   */
  public $total;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

}