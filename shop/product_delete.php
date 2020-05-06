<?php
session_start();
session_regenerate_id(true);

require('../function.php');

$max = $_GET['max'];

$cart = $_SESSION['cart'];
for($i = $max; 0 <= $i; $i--) {
    if(isset($_GET['max']) == ture) {
        array_splice($cart, $i, 1);
        array_splice($count, $i, 1);
    }
}

$_SESSION['cart'] = $cart;
$_SESSION['count'] = $count;

header('Location: shop_cartlook.php');
exit();
?>