<?php
include_once __DIR__ . '/database.php';
session_start();

$_SESSION['ingelogd'] = false;
$_SESSION['error_msg'] = '';
$conn = connectToDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['email'], $_POST['password'])) {
        $_SESSION['error_msg'] = "Uw gebruikersnaam of wachtwoord is fout, probeer het opnieuw.";
    } elseif (isset($_POST['email'], $_POST['password'])) {
        $email = strip_tags($_POST['email']);
        $password = sha1(strip_tags($_POST['password']));

        $query = $conn->prepare("SELECT accountID, firstName, lastName, address, postalCode, city, phoneNumber, email, password FROM accounts WHERE email=? AND password=?");
        $query->bind_param("ss", $email, $password);
        $query->execute();

        $row = $query->get_result()->fetch_assoc();

        if (isset($row) && !empty($row) && $password = $row['password']) {
            $_SESSION['ingelogd'] = true;
            $customerDetails = array(
                'customerID' => $row['accountID'],
                'customerFirstName' => $row['firstName'],
                'customerLastName' => $row['lastName'],
                'customerAddress' => $row['address'],
                'customerPostalCode' => $row['postalCode'],
                'customerCity' => $row['city'],
                'customerPhoneNumber' => $row['phoneNumber'],
                'customerEmail' => $row['email']
            );
            $_SESSION['customerDetails'] = $customerDetails;
            header("Location: index.php?login=success");
        } else {
            $_SESSION['error_msg'] = "Uw gebruikersnaam of wachtwoord is fout, probeer het opnieuw.";
            header("Location: login.php");
        }
    } else {
        $_SESSION['error_msg'] = "Er is iets fout gegaan, probeer het opnieuw.";
        header("Location: login.php");
    }
}
