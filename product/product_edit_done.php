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

$insert = $db -> prepare('UPDATE mst_product SET name=?, price=?, image=? WHERE code=?');
$insert -> execute([$_POST['name'], $_POST['price'], $_POST['new_image_name'], $_POST['code']]);
$db = null;

if($_POST['old_image_name'] != $_POST['new_image_name']) {
    if($_POST['old_image_name'] != '') {
        unlink('../image/' . $_POST['old_image_name']);
    }
}
?>

<?php require('../header.php'); ?>
<body class="staff-product-page">
    <main>
        <h1>商品管理画面</h1>
        <p>修正しました</p>
        <a href="product_list.php">戻る</a>
    </main>
</body>
</html>