<?php
namespace Salvio\Scandiweb\View;

$basedir = $basedir ?? '';
require_once $basedir . "autoload.php";
use Salvio\Scandiweb\Control\ProductAction;

?>
<div id="app">
    <nav class="navbar navbar-expand-lg fixed-top nav-bar">
        <div class="container-fluid">
            <h1 class="navbar-brand">&emsp;PRODUCT LIST</h1>
            <div>
                <div class="btn-group">
                    <a :href="additemsPage">
                        <button type="button" style="background-color: grey;
                        color: white; border: none;
                        padding: 10px 20px; border-radius: 5px;">ADD</button></a>
                    <form name="del_form" method="POST">
                        <input name="del_item" type="hidden" id="del_item">
                        <button type="submit" style="background-color: crimson;
                        color: white; 
                        border: none; padding: 10px 20px; border-radius: 5px;"
                        id="delete-product-btn"
                            :onclick="getCheckedBoxes">MASS DELETE</button>
                    </form>
                </div>
            </div>
    </nav>
    <br><br><br><br>
    <div class="container">
        <?php
        $productAction = new ProductAction(null, null, null, null);
        // Retrieve all products from the database
        $products = $productAction->getAllProducts();
        // Display the products
        foreach ($products as $product) {
            $sku = $product->getSku();
            $name = $product->getName();
            $price = $product->getPrice();
            $attr = $product->getAttr(); ?>
            <div class="flex-lg-6">
                <input type="checkbox" name="item" class="delete-checkbox"
                id="<?php echo $sku; ?> ">
                <p id='sku' class='text-center'>
                    <?php echo $sku; ?>
                </p>
                <p id='name' class='text-center'>
                    <?php echo $name; ?>
                </p>
                <p id='price' class='text-center'>$
                    <?php echo $price; ?>
                </p>
                <p id='attr' class='text-center'>
                    <?php echo $attr; ?>
                </p>
            </div>
        <?php } ?>
    </div>
</div>
<?php
// Delete selected products
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del_item'])) {
    $del_item = ($_POST['del_item']);
    $productAction = new ProductAction($sku, null, null, null);
    $prod = explode(',', $del_item);
    foreach ($prod as $sku) {
        $productAction->setSku($sku);
        $productAction->deleteProduct();
    }
     echo "<script>window.location.href = 'https://scwta.000webhostapp.com/';</script>";
    exit();
}
?>