<?php
require('../header.php'); 
require('shop_header.php');
require('../function.php');
?>
<body class="shop-page">
    <div class="wrapper">
        <?php

        $okFlg = true;

        if($_POST['name'] == '') {
            echo '<p class="error">' . 'お名前が入力されていません' . '</p>';
            $okFlg = false;
        }else {
            echo '<p>お名前：' . h($_POST['name']) . '</p>';
        }

        if(preg_match('/[^\s]+@[^\s]+\.\w+/', $_POST['email']) == 0) {
            echo '<p class="error">メールアドレスを正しく入力してください</p>';
            $okFlg = false;
        }else {
            echo '<p>メールアドレス：' . h($_POST['email']) . '</p>';
        }

        
        if($_POST['order'] == 'order_and_register') {
            require('../dbconnect.php');
            $select = $db -> prepare('SELECT COUNT(*) AS count FROM member WHERE email=?');
            $select -> execute([$_POST['email']]);
            $rec = $select -> fetch();

            if($rec['count'] > 0) {
                echo '<p class="error">入力されたメールアドレスはすでに登録されています</p>';
                $okFlg = false;
            }
        }

        if(preg_match('/\d{3}/', $_POST['post1']) == 0) {
            echo '<p class="error">郵便番号は半角数字で入力してください</p>';
            $okFlg = false;
        }else {
            echo '<p>郵便番号：' . h($_POST['post1']) . '-' . h($_POST['post2']) . '</p>';
        }

        if(preg_match('/\d{4}/', $_POST['post2']) == 0) {
            echo '<p class="error">郵便番号は半角数字で入力してください</p>';
            $okFlg = false;
        }

        if(strlen($_POST['post1']) > 3 || strlen($_POST['post2']) > 4) {
            echo '<p class="error">郵便番号を正しい桁数で入力してください</p>';
            $okFlg = false;
        }

        if($_POST['address'] == '') {
            echo '<p class="error">住所が入力されていません</p>';
            $okFlg = false;
        }else {
            echo '<p>住所：' . h($_POST['address']) . '</p>';
        }

        if(preg_match('/\d{2,5}-?\d{2,5}-?\d{4,5}/', $_POST['tel']) == 0) {
            echo '<p class="error">電話番号を正しく入力してください</p>';
            $okFlg = false;
        }else {
            echo '<p>電話番号：' . h($_POST['tel']) . '</p>';
        }

        if($_POST['order'] == 'order_and_register') {
            if($_POST['password'] == '') {
                echo '<p class="error">' . 'パスワードが入力されていません' . '</p>';
                $okFlg = false;
            }

            if($_POST['password'] !== $_POST['password2']) {
                echo '<p class="error">' . 'パスワードが一致しません' . '</p>';
                $okFlg = false;
            }

            echo '<br>';

            echo '性別：';
            if($_POST['gender'] == 'man') {
                echo '男性';
            }else {
                echo '女性';
            }
            echo '<br><br>';
        }

        echo '年代：' . $_POST['birth'] . '年';
        echo '<br><br>';

        if($okFlg == true) {
            echo '<form action="shop_form_done.php" method="post">';
            echo '<input type="hidden" name="name" value="' . h($_POST['name']) . '">';
            echo '<input type="hidden" name="email" value="' . h($_POST['email']) . '">';
            echo '<input type="hidden" name="post1" value="' . h($_POST['post1']) . '">';
            echo '<input type="hidden" name="post2" value="' . h($_POST['post2']) . '">';
            echo '<input type="hidden" name="address" value="' . h($_POST['address']) . '">';
            echo '<input type="hidden" name="tel" value="' . h($_POST['tel']) . '">';
            echo '<input type="hidden" name="order" value="' . h($_POST['order']) . '">';
            echo '<input type="hidden" name="password" value="' . h($_POST['password']) . '">';
            echo '<input type="hidden" name="gender" value="' . h($_POST['gender']) . '">';
            echo '<input type="hidden" name="birth" value="' . h($_POST['birth']) . '">';
            echo '<input type="button" onclick="history.back()" value="戻る"><br>';
            echo '<input type="submit" value="OK">';
            echo '</form>';
        }else {
            echo '<form>';
            echo '<input type="button" onclick="history.back()" value="戻る"><br>';
            echo '</form>';
        }

        ?>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>