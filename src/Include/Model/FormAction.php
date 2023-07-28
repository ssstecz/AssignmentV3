<?php
namespace Salvio\Scandiweb\Model;

$basedir = $basedir ?? '';

require_once $basedir . "../../../autoload.php";


$newProduct = (new ProductFactory())->createProduct();