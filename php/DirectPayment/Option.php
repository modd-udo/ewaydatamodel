<?php
namespace Modd\EWay\DirectPayment;

use JsonSerializable;

class Option implements JsonSerializable {

  /**
   * This field is not displayed to the customer. Anything can be used here,
   * which can be useful for tracking transactions. Additional characters
   * are truncated at 254
   * @var string
   */
  public $value;

  function jsonSerialize() {
    $o = [];
    foreach($this as $key => $value)
      if(isset($this->$key))
        $o[ucfirst($key)] = $value;
    return $o;
  }

}