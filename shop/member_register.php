<?php
require('../header.php'); 
require('shop_header.php');
require('../function.php');
?>
<body class="shop-page">
    <div class="wrapper">
        <p>お客様情報を入力してください</p>

        <form action="member_register_check.php" method="post">
            <p>お名前</p>
            <input type="text" name="name"><br>
            <p>メールアドレス</p>
            <input type="text" name="email"><br>
            <p>郵便番号</p>
            <input type="text" name="post1" size="4">-<input type="text" name="post2" size="4"><br>
            <p>住所</p>
            <input type="text" name="address"><br>
            <p>電話番号(ハイフンあり、市外局番含む、携帯番号可)</p>
            <input type="text" name="tel"><br>
            <p>パスワードを入力してください</p>
            <input type="password" name="password"><br>
            <p>パスワードをもう一度入力してください</p>
            <input type="password" name="password2"><br>
            <p>性別</p>
            <input type="radio" name="gender" value="man" checked>男性<br>
            <input type="radio" name="gender" value="woman">女性<br><br>
            <p>年代</p>
            <select name="birth">
                <?php for($i = 1910; $i <= 2010; $i= $i + 10) {
                    echo '<option value="' . $i . '">' . $i . '年代';
                }
                ?>
            </select><br><br>

            <a href="shop_list.php">商品一覧に戻る</a><br>
            <input type="submit" value="OK">
        </form>

    </div>

    <?php require('footer.php'); ?>
</body>
</html>