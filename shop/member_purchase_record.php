<?php
session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header_for_member.php');
?>
<?php
require('../function.php');
require('../dbconnect.php');

$select = $db -> prepare('SELECT * FROM sales_product WHERE code_member=?');
$select -> execute([$_SESSION['member_code']]);

$count = $db -> prepare('SELECT COUNT(*) AS count FROM sales_product WHERE code_member=?');
$count -> execute([$_SESSION['member_code']]);
$rec = $count -> fetch();

$db = null;

?>
<body class="shop-page purchase-record">
    <div class="wrapper">
        <p class="sub-title">購入履歴</p>

        <?php if($rec['count'] > 0): ?>
            <?php foreach($select as $data): ?>
                <div class="record">
                    <p>購入日：<?php echo $data['date']; ?></p>
                    <p>商品名：<?php echo $data['product_name']; ?></p>
                    <p>価格：<?php echo $data['price']; ?></p>
                    <p>数量：<?php echo $data['quantity']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-record">購入履歴がございません</p>
        <?php endif; ?>

        

        <a href="shop_list.php">商品一覧に戻る</a><br><br>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>