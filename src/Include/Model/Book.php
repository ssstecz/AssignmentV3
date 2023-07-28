<?php
namespace Salvio\Scandiweb\Model;

use Salvio\Scandiweb\Model\Product;

$basedir = $basedir ?? '';
require_once $basedir . "autoload.php";
class Book extends Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $weight;
    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price, $weight);
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function isEmptyPSAttr($weight)
    {
        if (
            isset($_POST['weight']) && ($_POST['weight'] == '')
        ) {
            return true;
        }
    }
    public function isValPSAttr($weight)
    {
        if (
            is_numeric($weight) && floatval($weight > 0) &&
            !preg_match('/\s/', $weight) && !preg_match('/^[a-zA-Z]/', $weight) &&
            !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\:"\\|,<>\/?]+/', $weight) &&
            !preg_match('/^\d+(\s|[a-zA-Z])/', $weight)
        ) {
            return true;
        } elseif (
            isset($_POST['weight']) && ($_POST['weight'] == '')
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
            isset($_POST['weight']) && ($_POST['weight'] !== '') &&
            !($this->isEmptyPSAttr($_POST['weight'])) &&
            ($this->isValPSAttr($_POST['weight']))
        ) {
            $this->weight= $this->getWeight(); 
            $weight = filter_var(
                $_POST['weight'],
                FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION
            );
            $weight = ("Weight: " . $weight . " kg");
            $psAttr = [
                'attr' => $weight,
            ];
        }
        return ($psAttr);
    }
}