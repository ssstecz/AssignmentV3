<?php
namespace Salvio\Scandiweb\Control;

abstract class SetAttr
{
    private $sku;
    private $name;
    private $price;
    abstract public function isEmptyAttr();
    abstract public function isValidAttr();
    abstract public function setValidAttr();
}