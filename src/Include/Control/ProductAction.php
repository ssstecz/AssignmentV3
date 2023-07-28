<?php
namespace Salvio\Scandiweb\Control;

require_once $basedir . "autoload.php";
use Salvio\Scandiweb\Control\DbResource;

// Insert data on the database
class ProductAction
{
    private $sku;
    private $name;
    private $price;
    private $attr;
    private $connection;
    public function __construct($sku, $name, $price, $attr)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attr = $attr;
    }
    // Setter method for injecting the connection
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }
    // Getters / Setters for each attribute
    //(unused available for future implementations)
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
        return $this;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    public function setAttr($attr)
    {
        $this->attr = $attr;
        return $this;
    }
    public function saveProduct($sku, $name, $price, $attr)
    {
        $this->sku = $this->getSku();
        $this->name = $this->getName();
        $this->price = $this->getPrice();
        $this->attr = $this->getAttr();
        $this->setConnection((new DbResource())->sharedConnection());
        $query = $this->connection->prepare
        ('INSERT INTO tab05 (sku, product, price, attr)
        VALUES (?, ?, ?, ?)');
        $query->execute([$this->sku, $this->name, $this->price, $this->attr]);
        echo "<script>window.location.href = 'https://scwta.000webhostapp.com/';</script>";
        exit();
    }
    public function getAllProducts()
    {
        $this->setConnection((new DbResource())->sharedConnection());
        $query = $this->connection->prepare('SELECT * FROM tab05');
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $products = [];
        foreach ($result as $row) {
            $product = new ProductAction
            ($row['sku'], $row['product'], $row['price'], $row['attr']);
            $products[] = $product;
        }
        return $products;
    }
    public function deleteProduct()
    {
        $this->setConnection((new DbResource())->sharedConnection());
        $query = $this->connection->prepare('DELETE FROM tab05 WHERE sku = ?');
        $query->execute([$this->sku]);
    }
}