<?php

session_start();
session_regenerate_id(true);

require('../header.php');
require('shop_header_for_member.php');
require('../function.php');
?>
<body class="shop-page">
    <div class="wrapper">
        <?php
        echo '<p>' . h($_POST['name']) . '様</p>';
        echo '<p>ご注文ありがとうございました</p>';
        echo '<p>' . h($_POST['email']) . 'にメールをお送りいたしましたのでご確認ください</p>';
        echo '<p>商品は以下のご住所に発送させていただきます</p>';
        echo '<p>' . h($_POST['post1']) . '-' . h($_POST['post2']) . '</p>';
        echo '<p>' . h($_POST['address']) . '</p>';
        echo '<p>' . h($_POST['tel']) . '</p>';

        $emailBody = '';
        $emailBody .= $_POST['name'] . "様 \n\n この度はご注文ありがとうございました。\n";
        $emailBody .= "\n";
        $emailBody .= "ご注文商品 \n";
        $emailBody .= "------------------------ \n";
        
        $cart = $_SESSION['cart'];
        $count = $_SESSION['count'];
        $max = count($cart);

        require('../dbconnect.php');

        for($i = 0; $i < $max; $i++) {
            $select = $db -> prepare('SELECT * FROM mst_product WHERE code=?');
            $data[0] = $cart[$i];
            $select -> execute($data);

            $rec = $select -> fetch(PDO::FETCH_ASSOC);

            $product_name = $rec['name'];
            $product_price = $rec['price'];
            $product_count = $count[$i];
            $subTotal = $product_price * $product_count;

            $price_array[] = $product_price; //sales_productテーブル用

            $product_name_array[] = $product_name; //sales_productテーブル用

            $emailBody .= $product_name . '';
            $emailBody .= $product_price . '円 × ';
            $emailBody .= $product_count . '個 = ';
            $emailBody .= $subTotal . "円\n"; 
        }

        $emailBody .= "送料は無料です。\n";
        $emailBody .= "------------------------ \n";
        $emailBody .= "\n";
        $emailBody .= "代金は以下の口座にお振込みいただきますようお願いいたします。";
        $emailBody .= "〇〇銀行 〇〇支店 普通口座 1234566789 \n";
        $emailBody .= "入金確認後、商品を発送させていただきます。\n";
        $emailBody .= "\n";

        $emailBody .= "~~~~~~~~~~~~~~~~~~~~~~~~\n";
        $emailBody .= "〇〇商店\n";
        $emailBody .= "\n";
        $emailBody .= "〇〇県〇〇市・・\n";
        $emailBody .= "Tel: 090-1111-xxxx\n";
        $emailBody .= "Email: xxx@xxx.xxx\n";
        $emailBody .= "~~~~~~~~~~~~~~~~~~~~~~~~\n";
        
        //客先へのメール
        $title = 'ご注文ありがとうございます';
        $header = 'From: xxx@xxx.xxx';
        $emailBody = html_entity_decode($emailBody, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail($email, $title, $emailBody, $header);

        //自分宛へのメール
        $title = 'お客様からご注文がありました';
        $header = 'From:' . $email;
        $emailBody = html_entity_decode($emailBody, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail('xxx@xxx.xxx', $title, $emailBody, $header);

        $lock = $db -> prepare('LOCK TABLES sales_customer WRITE, sales_product WRITE, member WRITE');
        $lock -> execute();

        $lastMemberCode = $_SESSION['member_code'];

        $insert = $db -> prepare('INSERT INTO sales_customer (code_member, name, email, post1, post2, address, tel) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $insert -> execute([$lastMemberCode, $_POST['name'], $_POST['email'], $_POST['post1'], $_POST['post2'], $_POST['address'], $_POST['tel']]);

        $latestSelect = $db -> prepare('SELECT LAST_INSERT_ID()');
        $latestSelect -> execute();
        $latestRec = $latestSelect -> fetch(PDO::FETCH_ASSOC);
        $lastestCode = $latestRec['LAST_INSERT_ID()'];

        for($i = 0; $i < $max; $i++) {
            $insertProduct = $db -> prepare('INSERT INTO sales_product (code_sales, code_product, code_member, product_name, price, quantity) VALUES(?, ?, ?, ?, ?, ?)');
            $insertProduct -> execute([$lastestCode, $cart[$i], $_SESSION['member_code'], $product_name_array[$i], $price_array[$i], $count[$i]]);
        }

        $unlock = $db -> prepare('UNLOCK TABLES');
        $unlock -> execute();

        $db = null;


        $_SESSION['cart'] = array();
        $_SESSION['count'] = array();
        /*
        $_SESSION = array();
        if(isset($_COOKIE[session_name()]) == true) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();*/
        ?>

        <br><a href="shop_list.php">商品一覧へ</a>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>