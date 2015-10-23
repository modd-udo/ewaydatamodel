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