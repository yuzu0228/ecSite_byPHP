<?php
require('../header.php'); 
require('shop_header.php');
require('../function.php');
?>
<body class="shop-page login">
    <div class="wrapper">
        <p class="sub-title">ログイン画面</p>

        <form action="member_login_check.php" method="post">
            <p>メールアドレス</p>
            <input type="text" name="email">
            <p>パスワード</p>
            <input type="password" name="password"><br><br>
            <input type="submit" value="ログイン"><br>
            <a href="shop_list.php">商品一覧に戻る</a><br>
        </form>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>