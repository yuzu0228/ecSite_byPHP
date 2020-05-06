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
    $oldImage = '';
}else {
    $oldImage = '<img src="../image/' . $rec['image'] . '" alt="" width="300px" height="300px">'; 
}

?>
<?php require('../header.php'); ?>
<body class="staff-product-page edit">
    <main>
        <h1>商品管理画面</h1>
        <p class="sub-title">商品情報修正</p>
        <p>商品コード：<?php echo h($_GET['product_code']); ?></p>

        <form action="product_edit_check.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="code" value="<?php echo h($_GET['product_code']); ?>">
        <input type="hidden" name="old_image_name" value="<?php echo h($rec['image']); ?>">
        <p>商品名</p>
        <input type="text" name="name" value="<?php echo h($product_name); ?>"><br>
        <p>価格</p>
        <input type="text" name="price" value="<?php echo h($product_price); ?>"><br><br>
        <?php echo $oldImage; ?><br>
        <p>画像を選択してください</p>
        <label for="image-select" class="image-select">選択→
        <input id="image-select" type="file" name="image" onchange="$('#fake_text_box').val($(this).val())">
        </label>
        <input type="text" id="fake_text_box" value="" size="35" readonly onClick="$('#file').click();"><br><br>

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        </form>
    </main>
</body>
</html>