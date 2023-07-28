<?php
namespace Salvio\Scandiweb\Control;

interface CommAttr
    // Pattern for common attributes validation
{
    public function isValidSku($sku);
    public function isUniqueSku($sku);
    public function isValidName($name);
    public function isValidPrice($price);
}