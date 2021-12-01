<?php
require_once __DIR__ . "/functions.php";

$amountToPay = $_SESSION['checkoutTotal'];
unset($_SESSION['checkoutTotal']);

$firstName = $_POST['customerFirstName'];
$lastName = $_POST['customerLastName'];
$customerAddress = $_POST['customerAddress'];
$postalCode = $_POST['customerPostalCode'];
$customerCity = $_POST['customerCity'];
$customerEmail = $_POST['customerEmail'];
$customerPhoneNumber = $_POST['customerPhoneNumber'];

if(isset($_POST['customerCreateAccount'])) {
    $userEmail = $_POST['customerAccountEmail'];
    $userPassword = $_POST['customerAccountPassword'];
    createCustomer($userEmail, $userPassword);
}

$cart = $_SESSION['cart'];
unset($_SESSION['cart']);

processOrder($FirstName, $LastName, $Address, $HomeNumber, $ZIPCode, $PaymentOption, $DiscountCode, isset($_POST['checkout_news_letter_opt_in']) ? true : false, $PaymentAmount, $ShoppingCartDataArray);
