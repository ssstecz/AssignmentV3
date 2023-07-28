<?php
namespace Salvio\Scandiweb\Control;

use Salvio\Scandiweb\Control\SetAttr;
use Salvio\Scandiweb\Model\Book;
use Salvio\Scandiweb\Model\Disk;
use Salvio\Scandiweb\Model\Furniture;

// use of future new types of product can be added from here

class ValPSAttr extends SetAttr
{
    public function isEmptyAttr()
    {
        if (
            (isset($_POST['size']) &&
                (new Disk(null, null, null, null))->isEmptyPSAttr($_POST['size']))
            ||
            (isset($_POST['weight']) &&
                (new Book(null, null, null, null))->isEmptyPSAttr($_POST['weight']))
            ||
            (isset($_POST['height'])) && (isset($_POST['width'])) && (isset($_POST['length'])) &&
            ((new Furniture(null, null, null, null))->isEmptyPSAttr($_POST['height']) ||
                (new Furniture(null, null, null, null))->isEmptyPSAttr($_POST['width']) ||
                (new Furniture(null, null, null, null))->isEmptyPSAttr($_POST['length']))
            // check for empty fields for future new types of product can be added from here
        ) {
            return true;
        }
    }
    public function isValidAttr()
    {
        if (
            (isset($_POST['size'])) &&
            (new Disk(null, null, null, null))
                ->isValPSAttr($_POST['size']) == true
            ||
            (isset($_POST['weight'])) &&
            (new Book(null, null, null, null))
                ->isValPSAttr($_POST['weight']) == true
            ||
            ((isset($_POST['height'])) &&
                (isset($_POST['width'])) &&
                (isset($_POST['length']))) &&
            ((new Furniture(null, null, null, null))
                ->isValPSAttr($_POST['height']) == true
                &&
                (new Furniture(null, null, null, null))
                    ->isValPSAttr($_POST['width']) == true
                &&
                (new Furniture(null, null, null, null))
                    ->isValPSAttr($_POST['length']) == true)
            // field validation logic for future new types of product can be added from here
        ) {
            return true;
        } elseif (
            !(isset($_POST['productType']))
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function setValidAttr()
    {
        $psAttr = [];
        if ($psAttr = (new Disk(null, null, null, null))->psAttr()) {
            $attr = $psAttr['attr'];
        } elseif ($psAttr = (new Book(null, null, null, null))->psAttr()) {
            $attr = $psAttr['attr'];
        } elseif ($psAttr = (new Furniture(null, null, null, null))->psAttr()) {
            $attr = $psAttr['attr'];
            // setting of product-specific fields for future new types of product can be added from here
        }
        return ($psAttr);
    }
}