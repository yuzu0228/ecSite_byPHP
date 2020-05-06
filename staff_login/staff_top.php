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
<body class="staff-page">
    <main>
        <h1>ショップ管理トップメニュー</h1>
        <a href="../staff/staff_list.php">スタッフ管理</a><br>
        <a href="../product/product_list.php">商品管理</a><br>
        <a href="../order/order_download.php">注文ダウンロード</a><br>
        <a href="staff_logout.php" id="logout">ログアウト</a>
    </main>
</body>
</html>