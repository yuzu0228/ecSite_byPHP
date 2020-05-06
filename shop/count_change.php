<?php
session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header.php');

echo '<body class="shop-page">';
echo '<div class="wrapper">';


require('../function.php');

$max = $_POST['max'];
for($i=0; $i < $max; $i++) {
    if(preg_match("/\d+/", $_POST['count' . $i]) == 0) {
        echo '<p class="error">数量を正しく入力してください</p>';
        echo '<a href="shop_cartlook.php">カートに戻る</a>';
        exit();
    }
    if($_POST['count' . $i] < 1 || 100 <= $_POST['count' . $i]) {
        echo '<p class="error">数量は1個以上100個以下で入力してください</p>';
        echo '<p class="error">100個以上注文される方はお問い合わせください</p>';
        echo '<a href="shop_cartlook.php">カートに戻る</a>';
        exit();
    }
    $count[] = $_POST['count' . $i];
}

$cart = $_SESSION['cart'];
for($i = $max; 0 <= $i; $i--) {
    if(isset($_POST['delete' . $i]) == ture) {
        array_splice($cart, $i, 1);
        array_splice($count, $i, 1);
    }
}

$_SESSION['cart'] = $cart;
$_SESSION['count'] = $count;

echo '</div>';

header('Location: shop_cartlook.php');
exit();
?>