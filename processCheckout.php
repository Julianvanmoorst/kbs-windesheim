<?php
require_once __DIR__ . "/functions.php";
session_start();

if (isset($_POST['bestellen'])) {
    $amountToPay = $_SESSION['checkoutTotal'];
    $firstName = $_POST['customerFirstName'];
    $lastName = $_POST['customerLastName'];
    $customerAddress = $_POST['customerAddress'];
    $postalCode = $_POST['customerPostalCode'];
    $customerCity = $_POST['customerCity'];
    $customerEmail = $_POST['customerEmail'];
    $customerPhoneNumber = $_POST['customerPhoneNumber'];
    $cart = $_SESSION['cart'];
    $canLogin = false;

    if (isset($_POST['customerCreateAccount']) && $canLogin == false) {
        $databaseConnection = connectToDatabase();
        $userEmail = $_POST['customerAccountEmail'];
        $userPassword = $_POST['customerAccountPassword'];

        $getCustomer = "SELECT email FROM accounts WHERE email=?";
        $stmtGetCustomer = $databaseConnection->prepare($getCustomer);
        $stmtGetCustomer->bind_param("s", $userEmail);
        $stmtGetCustomer->execute();

        $result = $stmtGetCustomer->fetch();

        if (!isset($result)) {
            $canLogin = true;
            createCustomer($firstName, $lastName, $customerAddress, $postalCode, $customerCity, $customerEmail, $customerPhoneNumber, $userEmail, $userPassword, $canLogin);
            processOrder($amountToPay, $cart, $customerEmail);
        } else {
            $canLogin = true;
            convertCustomer($userPassword, $canLogin, $userEmail);
            processOrder($amountToPay, $cart, $customerEmail);
        }

    } else {
        createCustomer($firstName, $lastName, $customerAddress, $postalCode, $customerCity, $customerEmail, $customerPhoneNumber, $userEmail, $userPassword, $canLogin);
        processOrder($amountToPay, $cart, $customerEmail);
    }
}
