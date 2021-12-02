<?php
require_once __DIR__ . "/functions.php";
session_start();
$amountToPay = $_SESSION['checkoutTotal'];
unset($_SESSION['checkoutTotal']);

$firstName = $_POST['customerFirstName'];
$lastName = $_POST['customerLastName'];
$customerAddress = $_POST['customerAddress'];
$postalCode = $_POST['customerPostalCode'];
$customerCity = $_POST['customerCity'];
$customerEmail = $_POST['customerEmail'];
$customerPhoneNumber = $_POST['customerPhoneNumber'];
$canLogin = FALSE;

if (isset($_POST['customerCreateAccount']) && !$canLogin) {
    $userEmail = $_POST['customerAccountEmail'];
    $userPassword = $_POST['customerAccountPassword'];
    $canLogin = TRUE;

    // Checken of email al bestaat in DB, zo ja zet canLogin op 1 met update stmt.
    // createCustomer($userEmail, $userPassword);

}

$cart = $_SESSION['cart'];
unset($_SESSION['cart']);

createCustomer($firstName, $lastName, $customerAddress, $postalCode, $customerCity, $customerEmail, $customerPhoneNumber,$password);
processOrder($amountToPay,$cart,$customerEmail);