<?php
namespace Salvio\Scandiweb\Model;

abstract class Product
{
    private $sku;
    private $name;
    private $price;
    private $attr;

    public function __construct($sku, $name, $price, $attr)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attr = $attr;
    }    
    abstract public function isValPSAttr($attr);
    abstract public function isEmptyPSAttr($attr);
    abstract public function psAttr();
}