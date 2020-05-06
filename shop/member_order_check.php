<?php
session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header_for_member.php');
/*
require('shop_header.php');
if(isset($_SESSION['member_login']) == false) {
    echo '<p class="error">ログインされていません</p>';
    echo '<a href="shop_list.php">商品一覧へ</a><br><br>';
    exit();
}*/
require('../function.php');
 ?>
<body class="shop-page">
    <div class="wrapper">
        <?php
        require('../dbconnect.php');

        $select = $db -> prepare('SELECT * FROM member WHERE code=?');
        $select -> execute([$_SESSION['member_code']]);
        $rec = $select -> fetch(PDO::FETCH_ASSOC);

        $db = null;

        echo 'お名前：' . h($rec['name']) . '<br>';
        echo 'メールアドレス：' . h($rec['email']) . '<br>';
        echo '郵便番号：' . h($rec['post1']) . '-' . h($rec['post2']) . '<br>';
        echo 'ご住所：' . h($rec['address']) . '<br>';
        echo '電話番号：' . h($rec['tel']) . '<br><br>';
        echo '<form action="member_order_done.php" method="post">';
        echo '<input type="hidden" name="name" value="' . $rec['name'] . '">';
        echo '<input type="hidden" name="email" value="' . $rec['email'] . '">';
        echo '<input type="hidden" name="post1" value="' . $rec['post1'] . '">';
        echo '<input type="hidden" name="post2" value="' . $rec['post2'] . '">';
        echo '<input type="hidden" name="address" value="' . $rec['address'] . '">';
        echo '<input type="hidden" name="tel" value="' . $rec['tel'] . '">';
        echo '<input type="button" onclick="history.back()" value="戻る"><br>';
        echo '<input type="submit" value="OK">';
        echo '</form>';

        ?>

    </div>

<?php require('footer.php'); ?>
</body>
</html>