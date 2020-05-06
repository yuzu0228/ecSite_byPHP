<?php
session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header_for_member.php');
require('../function.php');
require('../dbconnect.php');

$update = $db -> prepare('UPDATE member SET modified=NOW(), password=?, name=?, email=?, post1=? , post2=?, address=?, tel=? WHERE code=?');
$update -> execute([sha1($_POST['password']), $_POST['name'], $_POST['email'], $_POST['post1'], $_POST['post2'], $_POST['address'], $_POST['tel'], $_SESSION['member_code']]);

$select = $db -> prepare('SELECT name FROM member WHERE code=?');
$select -> execute([$_SESSION['member_code']]);
$rec = $select -> fetch(PDO::FETCH_ASSOC);

$_SESSION['member_name'] = $rec['name'];

$db = null;
?>
<body class="shop-page">
    <div class="wrapper">
        <p>会員情報を以下のように変更しました</p>
        
        <p>お名前：<?php echo h($_POST['name']); ?></p>
        <p>メールアドレス：<?php echo h($_POST['email']); ?></p>
        <p>郵便番号：<?php echo h($_POST['post1']) . '-' . h($_POST['post2']); ?></p>
        <p>ご住所：<?php echo h($_POST['address']); ?></p>
        <p>電話番号：<?php echo h($_POST['tel']); ?></p>

        <a href="shop_list.php">商品一覧へ</a>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>