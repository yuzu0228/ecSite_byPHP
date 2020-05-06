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
<body class="staff-product-page add">
    <main>
        <h1>商品管理画面</h1>
        <p class="sub-title">商品追加</p><br>
        <form action="product_add_check.php" method="post" enctype="multipart/form-data">
            <p>商品名を入力してください</p>
            <input type="text" name="name">
            <p>価格を入力してください</p>
            <input type="text" name="price">円
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