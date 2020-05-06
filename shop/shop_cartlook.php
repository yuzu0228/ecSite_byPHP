<?php
session_start();
session_regenerate_id(true);
require('../header.php'); 
require('shop_header.php');

if(isset($_SESSION['cart'])== true) {
    $cart= $_SESSION['cart'];
    $count = $_SESSION['count'];
    $max = count($cart);
}else {
    $max = 0;
}

require('../function.php');
require('../dbconnect.php');

foreach($cart as $key => $val) {
    $select = $db -> prepare('SELECT * FROM mst_product WHERE code=?');
    $data[0] = $val;
    $select -> execute($data);

    $rec = $select -> fetch(PDO::FETCH_ASSOC);

    $product_name[] = $rec['name'];
    $product_price[] = $rec['price'];

    if($rec['image'] == '') {
        $product_image[] = '';
    }else {
        $product_image[] = '<img src="../image/' . $rec['image'] . '" alt="" width="300px" height="300px">';
    }
}

$db = null;

?>
<body class="shop-page cartlook">
    <div class="wrapper">
        <p class="sub-title">カートの中身</p>

        <?php
        if($max == 0) {
            echo '<p class="error no-cart">カートに商品が入っていません</p>';
            echo '<a href="shop_list.php">商品一覧へ戻る</a>';
            exit();
        }
        ?>

        <form action="count_change.php" method="post">
        <?php for($i=0; $i < $max; $i++): ?>
            <p><?php echo $product_name[$i]; ?></p>
            <?php echo $product_image[$i]; ?>
            <div class="product-info">
                <?php echo $product_price[$i]; ?>円
                <input type="text" id="count-change" size="1" name="count<?php echo $i; ?>" value="<?php echo $count[$i]; ?>">個
                <?php echo '小計' . $product_price[$i] * $count[$i]; ?>円
                <!--<span class="delete">削除</span><input type="checkbox" name="delete<?php echo $i; ?>">-->
                <a href="product_delete.php?max=<?php echo $max; ?>" id="delete">削除</a>
            </div><br>
            <?php $price_sum +=  $product_price[$i] * $count[$i]; ?>
        <?php endfor; ?>

        <p>合計：<?php echo $price_sum; ?>円</p>

        <input type="hidden" name="max" value="<?php echo $max; ?>">
        <input type="submit" value="数量変更"><br>
        </form>

        <?php if(isset($_SESSION['member_login']) == false) {
            echo '<a href="shop_form.php">ご購入手続きへ進む</a><br>';
        }
        ?>

        <?php if(isset($_SESSION['member_login']) == true) {
            echo '<a href="member_order_check.php">会員かんたん注文へ進む</a><br>';
        }
        ?>
        <a href="shop_list.php">商品一覧へ戻る</a>

    </div>

    <?php require('footer.php'); ?>

</body>
</html>