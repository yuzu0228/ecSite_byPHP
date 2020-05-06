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

$insert = $db -> prepare('DELETE FROM mst_product WHERE code=?');
$insert -> execute([$_POST['code']]);
$db = null;

if($_POST['image'] != '') {
    unlink('../image/' . $_POST['image'] );
}

?>

<?php require('../header.php'); ?>
<body class="staff-product-page">
    <main>
        <h1>商品管理画面</h1>
        <p>削除しました</p>
        <a href="product_list.php">戻る</a>
    </main>
</body>
</html>