<!-- in de database is de customer gelinked met people doormiddel van PrimaryContactPersonID in de customer tabel -->
<!-- Email en wachtwoord inserten in people where PrimaryContactPersonID gelijk is aan de FullName -->
<!--
SELECT p.PersonID, c.CustomerID, c.CustomerName, p.FullName FROM People p
INNER JOIN customers c ON c.CustomerName= p.FullName
WHERE c.PrimaryContactPersonID = p.PersonID

Alex vragen hoe hij dit gaat doen
 -->

<?php
if (isset($_POST['customerAccountEmail']) && isset($_POST['customerAccountPassword'])) {
    $customerEmail = $_POST['customerAccountEmail'];
    $customerPassword = $_POST['customerAccountPassword'];


}