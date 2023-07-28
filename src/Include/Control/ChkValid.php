<?php
namespace Salvio\Scandiweb\Control;

use Salvio\Scandiweb\Control\ValCommAttr;
use Salvio\Scandiweb\Control\ValPSAttr;

class ChkValid
{
    private $errmsg;
    public function errMsg()
    {
        $this->errmsg = 0;
        if (
            (((new ValCommAttr())->isValidAttr() == false) ||
                (((new ValPSAttr())->isValidAttr()) === false))
        ) {
            $this->errmsg++;
            echo "<script>  alert('Please, provide the data of indicated type'); </script>";
        }
        if (
            ((new ValCommAttr())->isEmptyAttr() === true) ||
            (new ValPSAttr())->isEmptyAttr() === true
        ) {
            $this->errmsg++;
            if (!isset($_POST['productType'])) {
                echo "<p class ='resp'><strong>Please, submit required data</strong></p>";
            }
            echo "<script>  alert('Please, submit required data'); </script>";
        }
        return $this->errmsg;
    }
}