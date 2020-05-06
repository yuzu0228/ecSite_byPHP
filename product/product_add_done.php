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
require('../dbconnect.php');

$insert = $db -> prepare('INSERT INTO mst_product (name, price, image) VALUES (?, ?, ?)');
$insert -> execute([$_POST['name'], $_POST['price'], $_POST['image']]);
$db = null;
?>

<?php require('../header.php'); ?>
<body  class="staff-product-page">
    <main>
        <h1>商品管理画面</h1>
        商品名：<?php echo h($_POST['name']) . 'を追加しました'; ?><br>
        <a href="product_list.php">戻る</a>
    </main>
</body>
</html>