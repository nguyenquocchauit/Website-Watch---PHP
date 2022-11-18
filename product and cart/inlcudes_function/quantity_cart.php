<?php
session_start();
$array_message = array();
if (isset($_POST['itemID']) && $_POST['quantity']) {

    $sessionItem = $_POST['itemID'];
    $sessionItemQty = $_POST['quantity'];

    $productSessionPrice = $_SESSION['cart'][$sessionItem][3];

    $_SESSION['cart'][$sessionItem][4] = $sessionItemQty;
    //$_SESSION['cart'][$sessionItem][3] = $sessionItemQty * $productSessionPrice;
    $array_message['message'] =  0;
    $array_message['success'] = 'Gio-Hang.php';
}

echo json_encode($array_message);
