<?php
include __DIR__ . "/header.php";
include __DIR__ . "/cartFunctions.php";
// Foreach loop maken over cart om resultaat op te halen

if (isset($_GET['delete'])) {
    deleteProductFromCart($_GET['id']);
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
if (!empty($_SESSION['cart']) && isset($_SESSION['cart'])) { 
    $totaalAantal = 0;
    $cartPrijs = 0;
    ?>
<div class="container">
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody class="text-center">
<tr>
<th>Productnaam</th>
<th>Product ID</th>
<th>Aantal</th>
<th>Prijs per stuk</th>
<th>Totaalprijs</th>
<th>Verwijderen</th>
</tr>
<?php
foreach ($_SESSION["cart"] as $itemID => $item) {
    
    $product = getStockItem($itemID, $databaseConnection);
        if (isset($product['StockItemName'])) { ?>
				<tr>
				<td><?php echo $product['StockItemName']; ?></td>
				<td><?php echo $product['StockItemID']; ?></td>
                <td><?php echo $item;?></td>
				<td><?php echo "€ " . number_format($product["SellPrice"], 2); ?></td>
				<td><?php echo "€ " . number_format($item * $product['SellPrice'], 2); ?></td>
                <td><a href="cart.php/?action=delete&id=<?php print $itemID; ?>"><i class="far fa-trash-alt"></i></a></td>
        </tr>
        <?php
            $cartPrijs += ($item * $product['SellPrice']);
        }
    }
    ?>
<tr>
<td>Totaalprijs:</td>
<td><strong><?php echo "€ " . number_format($cartPrijs, 2); ?></strong></td>
</tr>
</tbody>
</table>
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
