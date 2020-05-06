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

$select = $db -> prepare('SELECT * FROM mst_product WHERE code=?');
$select -> execute([$_GET['product_code']]);
$rec = $select -> fetch(PDO::FETCH_ASSOC);
$product_name = $rec['name'];
$product_price = $rec['price'];
$db = null;

if($rec['image'] == '') {
    $image = '';
}else {
    $image = '<img src="../image/' . $rec['image'] . '" alt="" width="300px" height="300px">'; 
}

?>
<?php require('../header.php'); ?>
<body class="staff-product-page">
    <main>
        <h1>商品管理画面</h1>
        <p class="sub-title">商品情報参照</p>
        <p>商品コード：<?php echo h($_GET['product_code']); ?></p>

        <p>商品名：<?php echo h($product_name); ?></p>

        <p>価格：<?php echo h($product_price); ?></p>

        <?php echo $image; ?><br>

        <a href="product_delete.php?product_code=<?php echo h($_GET['product_code']); ?>">削除する</a><br>
        <a href="product_edit.php?product_code=<?php echo h($_GET['product_code']); ?>">編集する</a><br>

        <form>
        <input type="button" onclick="history.back()" value="戻る">
        </form>
    </main>
</body>
</html>