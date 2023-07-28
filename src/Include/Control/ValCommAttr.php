<?php
namespace Salvio\Scandiweb\Control;

use Salvio\Scandiweb\Control\CommAttr;
use Salvio\Scandiweb\Control\DbResource;

class ValCommAttr extends SetAttr implements CommAttr
{
    protected $connection;
    protected $sku;
    protected $name;
    protected $price;
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }
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
    public function isValidSku($sku)
    {
        if (
            !preg_match('/\s/', $_POST['sku']) && strlen($_POST['sku'] > 0) &&
            !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\:"\\|,.<>\/?]+/', $_POST['sku'])
        ) {
            return true;
        } elseif (
            isset($_POST['sku']) && ($_POST['sku'] == '')
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function isUniqueSku($sku)
    {
        $this->sku = $this->getSku();
        $this->setConnection((new DbResource())->sharedConnection());
        $stmt = "SELECT COUNT(*) FROM tab05 WHERE sku = :sku";
        $query = $this->connection->prepare($stmt);
        $query->bindValue(':sku', $sku);
        $query->execute();
        $cnt = $query->fetchColumn();
        if ($cnt > 0) {
            echo "<script>document.getElementById('sku').value =
                    '%Value given for SKU already exists on database%';
                    document.getElementById('sku-field').classList.add('error');
                    document.getElementById('sku-msg').textContent = 'Please, provide the data of indicated type';</script>";
        } else {
            return true;
        }
    }
    public function isValidName($name)
    {
        if (
            !preg_match('/^\s*$/', $_POST['name']) &&
            !preg_match('/^[^\w\s]+$/', $_POST['name'])
        ) {
            return true;
        } elseif (
            isset($_POST['name']) && ($_POST['name'] == '')
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function isValidPrice($price)
    {
        if (
            is_numeric($price) && floatval($price > 0) &&
            !preg_match('/\s/', $price) && !preg_match('/^[a-zA-Z]/', $price) &&
            !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\:"\\|,<>\/?]+/', $price) &&
            !preg_match('/^\d+([a-zA-Z])/', $price)
        ) {
            return true;
        } elseif (
            isset($_POST['price']) && ($_POST['price'] == '')
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function isEmptyAttr()
    {
        if (
            (isset($_POST['sku']) && ($_POST['sku'] == '') ||
                isset($_POST['name']) && ($_POST['name'] == '') ||
                isset($_POST['price']) && ($_POST['price'] == '')) ||
            (!isset($_POST['productType']))
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function isValidAttr()
    {
        if (
            ($this->isValidSku($_POST['sku'])) &&
            ($this->isUniqueSku($_POST['sku'])) &&
            ($this->isValidName($_POST['name'])) &&
            ($this->isValidPrice($_POST['price']))
        ) {
            return true;
        } else {
            return false;
        }
    }
    public function setValidAttr()
    {
        $this->sku = $this->getSku();
        $this->name = $this->getName();
        $this->price = $this->getPrice();
        $commAttr = [];
        if ($this->isValidAttr() == true)
            ; {
            $sku = htmlspecialchars($_POST['sku']);
            $name = htmlspecialchars($_POST['name']);
            $price = filter_var(
                $_POST['price'],
                FILTER_SANITIZE_NUMBER_FLOAT,
                FILTER_FLAG_ALLOW_FRACTION
            );
            $commAttr = [
                'sku' => $sku,
                'name' => $name,
                'price' => $price,
            ];
        }
        return ($commAttr);
    }
}