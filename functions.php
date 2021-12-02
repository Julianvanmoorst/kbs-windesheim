<?php
include_once __DIR__ . '/database.php';

// Maak nieuwe klant aan in database
function createCustomer($firstName, $lastName, $customerAddress, $postalCode, $customerCity, $customerEmail, $customerPhoneNumber, $password)
{
    $databaseConnection = connectToDatabase();
    $getEmail = "SELECT email FROM accounts WHERE email=?";
    $stmtGetEmail = $databaseConnection->prepare($getEmail);
    $stmtGetEmail->bind_param("s", $customerEmail);
    $stmtGetEmail->execute();

    $result = $stmtGetEmail->fetch();

    if (!isset($result)) {
        $query = "INSERT INTO accounts (firstName, lastName, address, postalCode, city, phoneNumber,email)
                 VALUES (?,?,?,?,?,?,?)";
        $stmt = $databaseConnection->prepare($query);
        $stmt->bind_param("sssssss", $firstName, $lastName, $customerAddress, $postalCode, $customerCity, $customerPhoneNumber, $customerEmail);
        $stmt->execute();
    }

    // header("Location: index.php");
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
function processOrder($amountToPay, $cart, $customerEmail)
{
    $databaseConnection = connectToDatabase();
    $getEmail = "SELECT accountID FROM accounts WHERE email like '$customerEmail'";
    $result = mysqli_query($databaseConnection, $getEmail);
    $amountToPay = number_format($amountToPay, 2);
    $cart = json_encode($cart);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $accountID = $row['accountID'];

        $query = "INSERT INTO customer_orders (accountID, order_total, order_items)
                 VALUES (?,?,?)";
        $stmt = $databaseConnection->prepare($query);
        $stmt->bind_param("sss", $accountID, $amountToPay, $cart);
        $stmt->execute();

        removeStockFromProduct($cart);
        header("Location: index.php");
    }

}

function removeStockFromProduct($cart)
{
    $databaseConnection = connectToDatabase();

    $cart = json_decode($cart, true);
    foreach ($cart as $itemID => $itemAmount) {
        $query = "UPDATE stockitemholdings SET QuantityOnHand = QuantityOnHand - $itemAmount WHERE StockItemID=$itemID";
        $stmt = $databaseConnection->prepare($query);
        $stmt->execute();
    }
}
// Eind checkout functies
