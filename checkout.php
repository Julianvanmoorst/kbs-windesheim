<?php
include __DIR__ . '/header.php';
?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-8 checkout">
            <h4 class="text-center text-dark naw">Adresgegevens</h4>
            <form action="processCheckout.php" class="addressForm">
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="customerFirstName" placeholder="Voornaam...">
                    </div>
                    <div class="col-6">
                        <input type="text" name="customerLastName" placeholder="Achternaam...">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="text" name="customerAddress" placeholder="Adres...">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" name="customerPostalCode" placeholder="Postcode...">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" name="customerCity" placeholder="Stad...">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="email" name="customerEmail" placeholder="E-mailadres...">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="tel" name="customerPhoneNumber" placeholder="Telefoonnummer...">
                    </div>
                    <div class="col-12 mt-3 text-center createAccount">
                        <input type="checkbox" class="createCustomerAccount" name="customerCreateAccount">
                        <label for="customerCreateAccount">Account aanmaken met deze gegevens?</label>
                    </div>
                    <div class="col-6 customerAccountEmail mt-3">
                        <input type="email" name="customerAccountEmail" placeholder="E-mailadres...">
                    </div>
                    <div class="col-6 customerAccountPassword mt-3">
                        <input type="password" name="customerAccountPassword" placeholder="Wachtwoord">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="submit" class="btn btn-primary text-center" value="Bestellen">
                    </div>
                </div>
            </form>
        </div>
        <div class="offset-1 col-3 cartSummary text-center">
            <div>
                <h5 class="cartSummaryHeader"><b>In uw winkelwagen</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col aantalProductenText">Product(en):</div>
            </div>
            <div class="row">
                <div class="col productenDesc">
                <?php
                $totaalPrijs = 0;
                foreach($_SESSION['cart'] as $itemID => $item) {
                    $product = getStockItem($itemID, $databaseConnection);
                    print($item . "x ");
                    print($product['StockItemName']);
                    $totaalPrijs += $product['SellPrice'] * $item;
                }
                ?>
                </div>
            </div>
            <hr>
            <div class="row totaalPrijs">
                <div class="col">
                    <p>Te Betalen: <?php print("&euro; " . number_format($totaalPrijs, 2)); ?></p>
                </div>
            </div>
            <div class="row idealWrapper">
                <div class="col">
                    <img src="Public/Img/ideal_logo_transparant.png" class="idealPayment" alt="Onze betalingen gaan via iDEAL">
                </div>
            </div>
        </div>
    </div>
</div>
