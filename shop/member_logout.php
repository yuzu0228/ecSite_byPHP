<?php
session_start();

require('../header.php');
require('shop_header_for_member.php');

$_SESSION = array();
if(isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
?>
<body class="shop-page">
    <div class="wrapper">
        <p>ログアウトしました</p>
        <a href="shop_list.php">商品一覧へ</a>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>