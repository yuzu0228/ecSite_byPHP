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

$select = $db -> prepare('SELECT * FROM mst_staff WHERE code=?');
$select -> execute([$_GET['staff_code']]);
$rec = $select -> fetch(PDO::FETCH_ASSOC);
$staff_name = $rec['name'];
$db = null;

?>
<?php require('../header.php'); ?>
<body class="staff-page">
    <main>
        <h1>スタッフ管理画面</h1>
        <p class="sub-title">スタッフ情報参照</p>
        <p>スタッフコード：<?php echo h($_GET['staff_code']); ?></p>

        <p>スタッフ名：<?php echo h($staff_name); ?></p>

        <a href="staff_edit.php?staff_code=<?php echo h($_GET['staff_code']); ?>">修正する</a><br>
        <a href="staff_delete.php?staff_code=<?php echo h($_GET['staff_code']); ?>">削除する</a><br>
        <form>
        <input type="button" onclick="history.back()" value="戻る">
        </form>
    </main>
</body>
</html>