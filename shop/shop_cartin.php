<?php
session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header.php');
require('../function.php');
require('../dbconnect.php');

$select = $db -> prepare('SELECT * FROM mst_product WHERE code=?');
$select -> execute([$_GET['product_code']]);
$rec = $select -> fetch(PDO::FETCH_ASSOC);
$product_code = $rec['code'];
$product_name = $rec['name'];
$product_price = $rec['price'];
$db = null;

if(isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $count = $_SESSION['count'];

    if(in_array($product_code, $cart) == true) {
        echo '<p class="error">その商品はすでにカートに入っています</p>';
        echo '<a href="shop_list.php">商品一覧に戻る</a><br>';
        echo '<a href="shop_cartlook.php" style="font-weight: bold;">こちら</a>からカート内の商品の数量を変更できます';
        exit();
    }
}
$cart[] = $_GET['product_code'];
$count[] = 1;
$_SESSION['cart'] = $cart;
$_SESSION['count'] = $count;

?>
<body class="shop-page">
    <div class="wrapper">
        <p>カートに追加しました</p>
        <a href="shop_list.php">商品一覧に戻る</a><br>
        <a href="shop_cartlook.php">カートの中身を見る</a>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>