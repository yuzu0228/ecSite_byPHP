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

if($rec['image'] == '') {
    $image = '';
}else {
    $image = '<img src="../image/' . $rec['image'] . '" alt="" width="300px" height="300px">'; 
}

?>
<body class="shop-page">

    <div class="wrapper">
        <?php echo $image; ?><br>
        <p>商品コード：<?php echo h($_GET['product_code']); ?></p>

        <p>商品名：<?php echo h($product_name); ?></p>

        <p>価格：<?php echo h($product_price); ?></p>

        <i class="fas fa-cart-plus"></i><a href="shop_cartin.php?product_code=<?php echo $product_code; ?>">カートに入れる</a><br>

        <form>
        <a href="shop_list.php">商品一覧に戻る</a><br>
        </form>

    </div>
    <?php require('footer.php'); ?>
</body>
</html>