<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])) {
    echo '<p>' . $_SESSION['staff_name'] . 'さんログイン中</p>';
}else {
    echo 'ログインされていません';
    echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
    exit();
}
?>
<?php
require('../function.php');
require('../header.php'); ?>
<body class="staff-product-page">
    <main>
        <h1>商品管理画面</h1>
        <?php
        if($_POST['name'] == '') {
            echo '<p>商品名が入力されていません</p>';
        }else {
            echo '<p>商品名：' . h($_POST['name']) . '</p>';
        }

        if(!preg_match('/\d+/', $_POST['price'])) {
            echo '価格を正しく入力してください';
        } else {
            echo '<p>価格：' . h($_POST['price']) . '円' . '</p>';
        }

        if($_FILES['image']['size'] > 0) {
                move_uploaded_file($_FILES['image']['tmp_name'], '../image/' . $_FILES['image']['name']);
                echo '<img src="../image/' . $_FILES['image']['name'] . '" alt="" width="300px" height="300px">';
        }

        if($_POST['name'] == '' || !preg_match('/\d+/', $_POST['price'])) {
            echo '<form><input type="button" onclick="history.back()" value="戻る"></form>'; 
        } else {
            echo '<p>上記の商品を追加します</p>';
            echo '<form action="product_add_done.php" method="post">';
            echo '<input type="hidden" name="name" value="' . h($_POST['name']) . '">';
            echo '<input type="hidden" name="price" value="' . h($_POST['price']) . '">';
            echo '<input type="hidden" name="image" value="' . $_FILES['image']['name'] . '">';
            echo '<input type="button" onclick="history.back()" value="戻る">';
            echo '<input type="submit" value="OK">';
            echo '</form>';
        }

        ?>
    </main>
</body>
</html>