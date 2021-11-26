<?php
include __DIR__ . "/header.php";
include __DIR__ . "/functions.php";
// Foreach loop maken over cart om resultaat op te halen
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        deleteProductFromCart($_GET['id']);
    }
    
    if($_GET['action'] == 'edit') {
        if(isset($_POST['nieuwAantal'])){
            editProduct($_GET['id'], $_POST['nieuwAantal'], $_SESSION['cart']);
        }
    }
}
?>
<h2 class="text-center">Inhoud Winkelwagen</h2>
<div class="mt-5" id="shopping-cart">
<?php
if (!empty($_SESSION['cart']) && isset($_SESSION['cart'])) { 
    $totaalAantal = 0;
    $cartPrijs = 0;
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 outerCartWrapper">
        <?php
    foreach ($_SESSION["cart"] as $itemID => $item) {
        $product = getStockItem($itemID, $databaseConnection);
        $productIMG = getStockItemImage($itemID, $databaseConnection);
        if (isset($product['StockItemName'])) { ?>
                <div class="col-xs-6 cartImgWrapper">
                    <img src="Public/StockItemIMG/<?php print($productIMG[0]['ImagePath']); ?>" class="cartProductIMG" alt="<?php print($productIMG[0]['ImagePath']);?>">
                </div>
                <div class="col-xs-6 cartContentWrapper">
                    <h5 class="cartItemName"><?php echo $product['StockItemName']; ?></h5>
                    <div class="cartArtikelNR">Artikelnummer: <?php print($product['StockItemID']); ?></div>
                    <p class="cartDescriptionText">Beschrijving: </p>
                    <p class="cartDescription"><?php print($product['SearchDetails']);?></p>
                    <div class="text-right cartSellPrice"><?php echo "€ " . number_format($product["SellPrice"], 2); ?><br><b class="cartSellBTW">Inclusief BTW.</b></div>
                    <form action="cart.php?action=edit&id=<?php print $itemID; ?>" method="POST">
                        <p class="nieuwAantalText"><label for="nieuwAantal">Aantal: <br><input type="number" name="nieuwAantal" value="<?php print($item);?>"></label></p>
                    </form>
                </div>
                <hr class="cartItemSeperator">
            <?php
                $cartPrijs += ($item * $product['SellPrice']);
                $totaalAantal += $item;
            }
        }
        ?>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5 class="text-center"><b>Overzicht</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col aantalProductenText">Aantal Producten: </div>
                <div class="col text-right"><?php print($totaalAantal); ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col totaalPrijsText">Totaal prijs: </div>
                <div class="col text-right"><?php print("&euro;" . number_format($cartPrijs, 2));?></div>
            </div>
            <form action="checkout.php" method="POST"> 
                <input type="submit" class="btn btn-primary" value="Betalen">
            </form>
        </div>
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
