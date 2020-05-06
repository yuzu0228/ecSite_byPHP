<?php
require('../header.php');
require('shop_header.php');
echo '<body class="shop-page">';
echo '<div class="wrapper">';
require('../function.php');
require('../dbconnect.php');

$password = sha1($_POST['password']);

$select = $db -> prepare('SELECT * FROM member WHERE email=? AND password=?');
$select -> execute([$_POST['email'], $password]);

$rec = $select -> fetch();



if($rec) {
    session_start();
    $_SESSION['member_login'] = 1;
    $_SESSION['member_code'] = $rec['code'];
    $_SESSION['member_name'] = $rec['name'];
    header('Location: shop_list.php');
    exit();
}else {
    echo '<p class="error">メールアドレスまたはパスワードが違います</p>';
    echo '<form>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '</form>';
}
?>
</div>

<?php require('footer.php'); ?>