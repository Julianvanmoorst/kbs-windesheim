<?php
include __DIR__ . "/header.php";

$StockItem = getStockItem($_POST['product_id'], $databaseConnection);
$StockItemImage = getStockItemImage($_POST['product_id'], $databaseConnection);

$voorraad = explode(': ', $StockItem['QuantityOnHand']);
$voorraad = $voorraad[1];

if (!empty($_POST["aantalProducten"])) {
    $productByCode = $databaseConnection->prepare("SELECT * FROM stockitems WHERE StockItemID='" . $_POST["product_id"] . "'");
    $productByCode->execute();
    $productByCode = $productByCode->fetch();

    $itemArray = array($productByCode["product_id"] => array('product_name' => $productByCode["StockItemName"], 'product_id' => $productByCode["StockItemID"], 'voorraad' => $voorraad, 'prijs' => $productByCode["RecommendedRetailPrice"]));
    if (!empty($_SESSION["cart_item"])) {
        if (in_array($productByCode[0]["product_id"], array_keys($_SESSION["cart_item"]))) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
                if ($productByCode[0]["product_id"] == $k) {
                    if (empty($_SESSION["cart_item"][$k]["voorraad"])) {
                        $_SESSION["cart_item"][$k]["voorraad"] = 0;
                    }
                    $_SESSION["cart_item"][$k]["voorraad"] += $_POST["voorraad"];
                }
            }
        } else {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
            print($_SESSION['cart_item']);
        }
    } else {
        $_SESSION["cart_item"] = $itemArray;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
</head>
<body>
<h1>Inhoud Winkelwagen</h1>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["voorraad"]*$item["prijs"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["product_name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["voorraad"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["prijs"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["voorraad"];
				$total_price += ($item["prijs"]*$item["voorraad"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>
<p><a href='../nerdy/'>Terug naar homescherm</a></p>
</body>
</html>
