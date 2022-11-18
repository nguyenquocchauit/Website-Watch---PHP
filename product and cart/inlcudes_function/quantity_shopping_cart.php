<?php
session_start();
$quantity_shopping_cart = "";
if (isset($_SESSION['cart']))
    if (sizeof($_SESSION['cart']) > 0)
        $quantity_shopping_cart = sizeof($_SESSION['cart']);
echo $quantity_shopping_cart;
