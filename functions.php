<?php
include_once __DIR__ . '/database.php';

// Maak nieuwe klant aan in database
function createCustomer($email, $password) {
    
}

// Eind nieuwe klant aanmaken in database

// Begin functies voor het winkelwagentje
function getCart()
{
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }

    return $cart;
} // Haal cart op, wanneer de session cart nog niet bestaat, maak gewoon een lege array aan.

function saveCart($cart)
{
    $_SESSION['cart'] = $cart;
} // Sla de cart op in de sessie.

function addProductToCart($stockItemID)
{
    $cart = getCart();
    if (array_key_exists($stockItemID, $cart)) {
        $cart[$stockItemID] += 1;
    } else {
        $cart[$stockItemID] = 1;
    }
    saveCart($cart);
} // Voeg een product toe aan de cart, wanneer het product al aanwezig is in de winkelwagen voeg er gewoon 1 bij op

function deleteProductFromCart($StockItemID)
{
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($key == $_GET['id']) {
            unset($_SESSION['cart'][$key]);
            echo '<script>window.location="../cart.php"</script>';
        }
    }
} // Code om het product te verwijderen uit de winkelwagen

function editProduct($stockItemID, $nieuwAantal, $cart)
{
    if ($nieuwAantal <= 0) {
        unset($cart[$stockItemID]);
    } else {
        $cart[$stockItemID] = $nieuwAantal;
    }
    saveCart($cart);
} // Code om het product aantal te wijzigen naar het nieuwe aantal.

// Eind functies voor het winkelwagentje

// Checkout functies
function processOrder() {

}
// Eind checkout functies