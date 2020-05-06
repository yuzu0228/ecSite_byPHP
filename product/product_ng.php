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
        <p>商品名が選択されていません</p>
        <a href="product_list.php">戻る</a>
    </main>
</body>
</html>