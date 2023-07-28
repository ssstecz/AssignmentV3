<?php
namespace Salvio\Scandiweb\Model;

use Salvio\Scandiweb\Model\Product;

$basedir = $basedir ?? '';
require_once $basedir . "autoload.php";
class Disk extends Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $size;
    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price, $size);
    }
    public function getSize()
    {
        return $this->size;
    }
    public function isEmptyPSAttr($size)
    {
        if (
            isset($_POST['size']) && ($_POST['size'] == '')
        ) {
            return true;
        }
    }
    public function isValPSAttr($size)
    {
        if (
            is_numeric($size) && floatval($size > 0) &&
            !preg_match('/\s/', $size) && !preg_match('/^[a-zA-Z]/', $size) &&
            !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\:"\\|,<>\/?]+/', $size) &&
            !preg_match('/^\d+([a-zA-Z])/', $size)
        ) {
            return true;
        } elseif (
            isset($_POST['size']) && ($_POST['size'] == '')
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function psAttr()
    {
        // Set validated product-specific attribute
        $psAttr = [];
        if (
            isset($_POST['size']) && ($_POST['size'] !== '') &&
            !($this->isEmptyPSAttr($_POST['size'])) &&
            ($this->isValPSAttr($_POST['size']))
        ) {
            $this->size= $this->getSize();
            $size = filter_var(
                $_POST['size'],
                FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION
            );
            $size = ("Size: " . $size . " Mb");
            $psAttr = [
                'attr' => $size,
            ];
            return ($psAttr);
        }
    }
}