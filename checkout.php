<?php
include_once __DIR__ . '/header.php';
?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-8 checkout">
            <h4 class="text-center nawHeader">Adresgegevens</h4>
            <form action="processCheckout.php" class="addressForm" method="POST">
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="customerFirstName" placeholder="Voornaam..." required>
                    </div>
                    <div class="col-6">
                        <input type="text" name="customerLastName" placeholder="Achternaam..." required>
                    </div>
                    <div class="col-12 mt-3">
                        <input type="text" name="customerAddress" placeholder="Adres..." required>
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" name="customerPostalCode" placeholder="Postcode..." required>
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" name="customerCity" placeholder="Stad..." required>
                    </div>
                    <div class="col-6 mt-3">
                        <input type="email" name="customerEmail" placeholder="E-mailadres..." required>
                    </div>
                    <div class="col-6 mt-3">
                        <input type="tel" name="customerPhoneNumber" placeholder="Telefoonnummer..." maxlength="15" required>
                    </div>
                    <div class="col-12 mt-3 text-center createAccount">
                        <input type="checkbox" id="createUser" class="createCustomerAccount" name="customerCreateAccount">
                        <label for="createUser">Account aanmaken met deze gegevens?</label>
                    </div>
                    <div class="col-6 customerAccountEmail mt-3">
                        <input type="email" name="customerAccountEmail" placeholder="E-mailadres...">
                    </div>
                    <div class="col-6 customerAccountPassword mt-3">
                        <input type="password" name="customerAccountPassword" placeholder="Wachtwoord">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="submit" name="bestellen" class="btn btn-primary text-center" value="Bestellen">
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
                    print("<div>" . $item . "x " . $product['StockItemName'] . "</div>");
                }
                ?>
                </div>
            </div>
            <hr>
            <div class="row totaalPrijs">
                <div class="col">
                    <p>Te Betalen: <?php print("&euro; " . number_format($_SESSION['checkoutTotal'], 2)); ?></p>
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
