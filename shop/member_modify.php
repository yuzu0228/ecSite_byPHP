<?php
session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header_for_member.php');
require('../function.php');
require('../dbconnect.php');

//member_code

?>
<body class="shop-page">
    <div class="wrapper">
        <p class="sub-title">会員情報変更画面</p>

        <form action="member_modify_check.php" method="post">
            <p>お名前</p>
            <input type="text" name="name"><br>
            <p>パスワード</p>
            <input type="password" name="password"><br>
            <p>パスワードをもう一度入力してください</p>
            <input type="password" name="password2"><br>
            <p>メールアドレス</p>
            <input type="text" name="email"><br>
            <p>郵便番号</p>
            <input type="text" name="post1" size="4">-<input type="text" name="post2" size="4"><br>
            <p>ご住所</p>
            <input type="text" name="address"><br>
            <p>電話番号</p>
            <input type="text" name="tel"><br>
            <input type="submit" value="OK"><br>
            <a href="shop_list.php">商品一覧に戻る</a><br><br>
        </form>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>