<?php
namespace Salvio\Scandiweb\Model;

use Salvio\Scandiweb\Model\Product;

$basedir = $basedir ?? '';
require_once $basedir . "autoload.php";
class Furniture extends Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $height;
    protected $width;
    protected $length;
    protected $dimension;
    public function __construct($sku, $name, $price, $dimension)
    {
        parent::__construct($sku, $name, $price, $dimension);
    }
    public function getHeight()
    {
        return $this->height;
    }
    public function getWidth()
    {
        return $this->width;
    }
    public function getLength()
    {
        return $this->length;
    }
    public function getDimension()
    {
        return $this->dimension;
    }
    public function isEmptyPSAttr($dimension)
    {
        if (
            isset($_POST['height']) && ($_POST['height'] == '') ||
            isset($_POST['width']) && ($_POST['width'] == '') ||
            isset($_POST['length']) && ($_POST['length'] == '')
        ) {
            return true;
        }
    }
    public function isValPSAttr($dimension)
    {
        if (
            is_numeric($dimension) && floatval($dimension > 0) &&
            !preg_match('/\s/', $dimension) && !preg_match('/^[a-zA-Z]/', $dimension) &&
            !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\:"\\|,<>\/?]+/', $dimension) &&
            !preg_match('/^\d+([a-zA-Z])/', $dimension)
        ) {
            return true;
        } elseif (
            $dimension == ''
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function psAttr()
    {
        // Perform validation on common attributes
        $psAttr = [];
        // Validate Dimension    
        if (
            isset($_POST['height']) && ($_POST['height'] !== '') &&
            isset($_POST['width']) && ($_POST['width'] !== '') &&
            isset($_POST['length']) && ($_POST['length'] !== '') &&
            ($this->isValPSAttr($_POST['height'])) &&
            ($this->isValPSAttr($_POST['width'])) &&
            ($this->isValPSAttr($_POST['length']))
        ) {
            $this->height= $this->getHeight();
            $height = filter_var(
                $_POST['height'],
                FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION
            );
            $this->width= $this->getWidth();
            $width = filter_var(
                $_POST['width'],
                FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION
            );
            $this->length= $this->getLength();
            $length = filter_var(
                $_POST['length'],
                FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION
            );
            $this->dimension= $this->getDimension();
            $dimension = ("Dimensions: " .
                $height . " cm x " . $width . " cm x " . $length . " cm");
        }       
        $psAttr = [
            'attr' => $dimension,
        ];
        return ($psAttr);

    }
}