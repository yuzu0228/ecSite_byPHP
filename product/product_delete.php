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
        <p class="sub-title">商品削除</p>
        <p>商品コード：<?php echo h($_GET['product_code']); ?></p>

        <p>商品名</p>
        <?php echo h($product_name); ?>

        <p>価格</p>
        <?php echo h($product_price); ?><br>

        <?php echo $image; ?><br>

        <p>この商品を削除してもよろしいですか？</p>

        <form action="product_delete_done.php" method="post">
        <input type="hidden" name="code" value="<?php echo $_GET['product_code']; ?>">
        <input type="hidden" name="image" value="<?php echo $rec['image']; ?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        </form>
    </main>
</body>
</html>