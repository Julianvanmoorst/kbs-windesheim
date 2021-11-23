<?php
include __DIR__ . "/header.php";

if (isset($_POST['addToCart'])) { // Check of de knop "Voeg toe aan winkelwagen" ingedrukt is
    $product_id = $_POST['product_id'];
    $product = getStockItem($_POST['product_id'], $databaseConnection); // Haal product die aan winkelwagen toegevoegd moet worden uit de database.

    // Array aanmaken met de productgegevens erin
    $cart = array(
        'product_id' => $product_id,
        'productName' => $product['StockItemName'],
        'productPrijs' => $product['SellPrice'],
        'aantal' => $_POST['aantal'],
        'totaalPrijs' => number_format($_POST['aantal'] * $product['SellPrice']),
    );

    // $cart toevoegen aan een $_SESSION variabele.
    $_SESSION['cart'][] = $cart;
}

// Code voor het verwijderen van een product uit de winkelwagen
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($value['product_id'] == $_GET["id"]) {
                unset($_SESSION['cart'][$key]); // Verwijder de item uit de sessie (Winkelwagen)
                echo '<script>window.location="../cart.php"</script>'; //Redirect de klant naar de winkelwagen
            }
        }
    }
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    print_r($_SESSION['cart']);
}

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
</head>
<body>
<h1 class="text-center">Inhoud Winkelwagen</h1>
<div id="shopping-cart">
<?php
if(!empty($_SESSION['cart']) && isset($_SESSION['cart'])){ // Zeker weten dat de session niet leeg is.
    $totaalAantal = 0;
    $cartPrijs = 0;
?>	
<div class="container">
    <form action="cart.php" method="POST">
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody class="text-center">
<tr>
<th>Productnaam</th>
<th>Product ID</th>
<th width="5%">Aantal</th>
<th>Prijs per stuk</th>
<th>Totaalprijs</th>
<th>Verwijderen</th>
</tr>	
<?php
    foreach ($_SESSION["cart"] as $item) {
        if(isset($item['productName'])) { // Kijken of productnaam aanwezig is, zodat je niet lege velden krijgt, en checken of je niet twee x dezelfde toevoegd.
        ?>
				<tr>
				<td><?php echo $item["productName"]; ?></td>
				<td><?php echo $item["product_id"]; ?></td>
				<td width="10%"><input type="number" name="quantity-<?=$item['product_id']; ?>" value="<?=$_SESSION['cart'][$item['product_id']]; ?>" min="1" max="100" required></td>
				<td><?php echo "€ ". number_format($item["productPrijs"], 2); ?></td>
				<td><?php echo "€ ". number_format($item['totaalPrijs'], 2); ?></td>
                <td><a href="cart.php/?action=delete&id=<?php print $item['product_id']; ?>"><i class="far fa-trash-alt"></i></a></td>
        </tr>
        <?php
                $prevItem = $item['productName'];
				$totaalAantal += $item["aantal"];
				$cartPrijs += ($item['totaalPrijs']);
            }
        }
		?>
<tr>
<td>Totaalprijs:</td>
<td><strong><?php echo "€ ".number_format($cartPrijs, 2); ?></strong></td>
<td><input type="submit" value="Update" name="update"></td>
</tr>
</tbody>
</table>
</form>
</div>		
  <?php
} else {
?>
<h3 class="text-center cart-empty">Winkelwagen is leeg</h3>
<p class="text-center"><a class="cart-ref" href="./">Terug naar winkel</a></p>
<?php 
}
?>
</div>
</body>
</html>
