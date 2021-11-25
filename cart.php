<?php
include __DIR__ . "/header.php";
include __DIR__ . "/cartFunctions.php";
// Foreach loop maken over cart om resultaat op te halen

if (isset($_GET['action'])) {
    deleteProductFromCart($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
</head>
<body>
<h2 class="text-center">Inhoud Winkelwagen</h2>
<div class="mt-5" id="shopping-cart">
<?php
if (!empty($_SESSION['cart']) && isset($_SESSION['cart'])) { 
    $totaalAantal = 0;
    $cartPrijs = 0;
    ?>
<div class="container">
    <div class="row">
        <?php
    foreach ($_SESSION["cart"] as $itemID => $item) {
        $product = getStockItem($itemID, $databaseConnection);
        $productIMG = getStockItemImage($itemID, $databaseConnection);
        // var_dump($productIMG[0]['ImagePath']);
        if (isset($product['StockItemName'])) { ?>
                <div class="col-xs-6">
                    <img src="Public/StockItemIMG/<?php print($productIMG[0]['ImagePath']); ?>" class="cartProductIMG" alt="<?php print($productIMG[0]['ImagePath']);?>">
                </div>
                <div class="col-xs-6">
                    <h5 class="cartItemName"><?php echo $product['StockItemName']; ?></h5>
                    <p class="cartArtikelNR">Artikelnummer: <?php print($product['StockItemID']); ?></p>
                    <p class="cartDescriptionText">Beschrijving: </p>
                    <p class="cartDescription"><?php print($product['SearchDetails']);?></p>
                    <form method="POST">
                        <label for="nieuwAantal" class="">Aantal: </label>
                        <input type="number">
                    </form>
                    <p class="cartSellPrice"><?php echo "€ " . number_format($product["SellPrice"], 2); ?><br><b class="cartSellBTW">Inclusief BTW.</b></p>
                <td><?php echo $product['StockItemID']; ?></td>
                    <td><?php echo $item;?></td>
                    <td><?php echo "€ " . number_format($product["SellPrice"], 2); ?></td>
                    <td><?php echo "€ " . number_format($item * $product['SellPrice'], 2); ?></td>
                    <td><a href="cart.php/?action=delete&id=<?php print $itemID; ?>"><i class="far fa-trash-alt"></i></a></td>
                </div>
            <?php
                $cartPrijs += ($item * $product['SellPrice']);
            }
        }
        ?>
<!-- <td><strong>echo "€ " . number_format($cartPrijs, 2); ?></strong></td> -->
    </div>
</div>
  <?php
} else {
    ?>
<h3 class="text-center cart-empty">Winkelwagen is leeg</h3>
<p class="text-center"><a class="cart-ref" href="../index.php">Terug naar winkel</a></p>
<?php
}
?>
</div>
</body>
</html>
