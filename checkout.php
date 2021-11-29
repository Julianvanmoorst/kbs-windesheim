<?php
include __DIR__ . '/header.php';
?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-8 checkout">
            <h4 class="text-center text-dark">Adresgegevens</h4>
            <form action="" class="addressForm">
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
                    <div class="col-12 mt-3">
                        <input type="submit" class="btn btn-primary text-center">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4 cartSummary">
            <div>
                <h5 class="text-center"><b>In uw winkelwagen</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col aantalProductenText">Producten: </div>
                <div class="col text-right"><?php print($totaalAantal); ?></div>
            </div>
        </div>
    </div>
</div>
