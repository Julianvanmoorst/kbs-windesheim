<?php
function getCart()
{
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }

    return $cart;
}

function saveCart($cart)
{
    $_SESSION['cart'] = $cart;
}

function addProductToCart($stockItemID)
{
    $cart = getCart();
    if (array_key_exists($stockItemID, $cart)) {
        $cart[$stockItemID] += 1;
    } else {
        $cart[$stockItemID] = 1;
    }
    saveCart($cart);
}

function deleteProductFromCart($StockItemID)
{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'delete') {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['product_id'] == $_GET['id']) {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    }
}

function editProduct($stockItemID, $nieuwAantal, $cart)
{
    if ($nieuwAantal <= 0) {
        unset($cart[$stockItemID]);
    } else {
        $cart[$stockItemID] = $nieuwAantal;
    }
    return $cart;
}