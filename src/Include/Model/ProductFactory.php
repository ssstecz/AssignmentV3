<?php
namespace Salvio\Scandiweb\Model;

use Salvio\Scandiweb\Control\ChkValid;
use Salvio\Scandiweb\Control\ProductAction;
use Salvio\Scandiweb\Control\ValCommAttr;
use Salvio\Scandiweb\Control\ValPSAttr;

class ProductFactory
{
    protected $sku;
    protected $name;
    protected $price;
    protected $attr;
    public function getSku()
    {
        return $this->sku;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getAttr()
    {
        return $this->attr;
    }
    public function setSku($sku)
    {
        $this->sku = $sku;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setAttr($attr)
    {
        $this->attr = $attr;
    }
    public function createProduct()
    {
        // Check data validation 
        if (
            ((new ChkValid())->errMsg() > 0)
        ) {
            exit();
        }
        if (
            ($commAttr = (new ValCommAttr())->setValidAttr())
        ) {
            // Extract Validated Common attributes for product creation            
            $sku = $commAttr['sku'];
            $name = $commAttr['name'];
            $price = $commAttr['price'];
        }
        // Extract Validated Product-specific attributes for product creation
        if (
            ($psAttr = (new ValPSAttr())->setValidAttr())
        ) {
            $attr = $psAttr['attr'];
        }

        if ((isset($sku)) && (isset($name) && isset($price) && isset($attr))) {
            // Proceed new product creation and saving to database
            $newProduct = new ProductFactory();
            $newProduct->setSku($sku);
            $newProduct->setName($name);
            $newProduct->setPrice($price);
            $newProduct->setAttr($attr);
            $newProduct->save(new ProductAction($sku, $name, $price, $attr));
        } else {
            return false;
        }
    }
    public function save(ProductAction $setProd)
    {
        $setProd->saveProduct(
            $this->getSku(), $this->getName(),
            $this->getPrice(), $this->getAttr()
        );
    }
}