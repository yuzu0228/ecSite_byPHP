<?php
require('../header.php'); 
require('shop_header_for_member.php');
require('../function.php');
?>
<body class="shop-page">
    <div class="wrapper">
        <?php
        echo '<p>会員登録が完了しました</p>';
        echo '<p>次回から登録されたメースアドレスとパスワードでログインしてください</p>';
        echo '<p>ご注文が簡単にできるようになります</p><br>';

        require('../dbconnect.php');

        $lock = $db -> prepare('LOCK TABLES member WRITE');
        $lock -> execute();

            $insert = $db -> prepare('INSERT INTO member (date, password, name, email, post1, post2, address, tel, gender, birth) VALUES(NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            if($_POST['gender'] == 'man') {
                $gender = 1;
            }else {
                $gender = 2;
            }
            $insert -> execute([sha1($_POST['password']), $_POST['name'], $_POST['email'], $_POST['post1'], $_POST['post2'], $_POST['address'], $_POST['tel'], $gender, $_POST['birth']]);

        $unlock = $db -> prepare('UNLOCK TABLES');
        $unlock -> execute();

        $db = null;
        ?>

        <br><a href="shop_list.php">商品一覧へ</a>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>