<?php
session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header_for_member.php');
require('../function.php');?>
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


        require('../dbconnect.php');
        $select = $db -> prepare('SELECT code FROM member WHERE email=?');
        $select -> execute([$_POST['email']]);
        $rec = $select -> fetch();

        if($rec['code'] == $_SESSION['member_code']) {
            $cnt = 0;
        }else {
            $cnt = 1;
        }

        if($cnt == 1) {
            echo '<p class="error">入力されたメールアドレスはすでに登録されています</p>';
            $okFlg = false;
        }


        if(preg_match('/\d{3}/', $_POST['post1']) == 0) {
            echo '<p class="error">郵便番号は半角数字で入力してください</p>';
            $okFlg = false;
        }else {
            echo '<p>郵便番号：' . h($_POST['post1']) . '-' . h($_POST['post2']) . '</p>';
        }

        if(strlen($_POST['post1']) > 3 || strlen($_POST['post2']) > 4) {
            echo '<p class="error">郵便番号を正しい桁数で入力してください</p>';
            $okFlg = false;
        }

        if(preg_match('/\d{4}/', $_POST['post2']) == 0) {
            echo '<p class="error">郵便番号は半角数字で入力してください</p>';
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

            if($_POST['password'] == '') {
                echo '<p class="error">' . 'パスワードが入力されていません' . '</p>';
                $okFlg = false;
            }

            if($_POST['password'] !== $_POST['password2']) {
                echo '<p class="error">' . 'パスワードが一致しません' . '</p>';
                $okFlg = false;
            }
        echo '<br><br>';

        if($okFlg == true) {
            echo '<form action="member_modify_done.php" method="post">';
            echo '<input type="hidden" name="name" value="' . h($_POST['name']) . '">';
            echo '<input type="hidden" name="email" value="' . h($_POST['email']) . '">';
            echo '<input type="hidden" name="post1" value="' . h($_POST['post1']) . '">';
            echo '<input type="hidden" name="post2" value="' . h($_POST['post2']) . '">';
            echo '<input type="hidden" name="address" value="' . h($_POST['address']) . '">';
            echo '<input type="hidden" name="tel" value="' . h($_POST['tel']) . '">';
            echo '<input type="hidden" name="password" value="' . h($_POST['password']) . '">';
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