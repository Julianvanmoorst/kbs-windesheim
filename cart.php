<?php
include __DIR__ . "/header.php";
include __DIR__ . "/functions.php";
// Foreach loop maken over cart om resultaat op te halen
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        deleteProductFromCart($_GET['id']);
    } // Als de action delete is, verwijder het product uit het winkelmandje, zie functions.php voor de functie.
    
    if($_GET['action'] == 'edit') {
        if(isset($_POST['nieuwAantal'])){
            editProduct($_GET['id'], $_POST['nieuwAantal'], $_SESSION['cart']);
        }
    } // Als de action edit is, wijzig het aantal, zie functions.php voor uitleg over de functie.
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
            $voorraad = explode(': ', $product['QuantityOnHand']);
            $voorraad = $voorraad[1];

            if (isset($product['StockItemName'])) { ?>
                    <div class="col-xs-4 cartImgWrapper">
                        <a href="view.php?id=<?php print($product['StockItemID']); ?>">
                            <img src="Public/StockItemIMG/<?php print($productIMG[0]['ImagePath']); ?>" class="cartProductIMG" alt="<?php print($productIMG[0]['ImagePath']);?>">
                        </a>
                    </div>
                    <div class="col-xs-8 cartContentWrapper">
                        <h5 class="cartItemName"><?php echo $product['StockItemName']; ?></h5>
                        <div class="cartArtikelNR">Artikelnummer: <?php print($product['StockItemID']); ?></div>
                        <p class="cartDescriptionText">Beschrijving: </p>
                        <p class="cartDescription"><?php print($product['SearchDetails']);?></p>
                        <div class="row">
                            <div class="col-6 pl-0 pr-0">
                                <form action="cart.php?action=edit&id=<?php print $itemID; ?>" method="POST" class="nieuwAantalWrapper">
                                    <label for="nieuwAantal" class="nieuwAantalText">Aantal: </label>
                                    <input type="number" name="nieuwAantal" max="<?php print($voorraad); ?>" value="<?php print($item);?>">
                                </form>
                            </div>
                            <div class="col-6 cartSellPrice"><?php echo "€ " . number_format($product["SellPrice"], 2); ?><br><b class="cartSellBTW mt-2">Inclusief BTW.</b></div>
                        </div>
                    </div>
                    <hr class="cartItemSeperator">
                <?php
                    $cartPrijs += ($item * $product['SellPrice']);
                    $totaalAantal += $item;
                }
            }
            $_SESSION['checkoutTotal'] = $cartPrijs;
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
