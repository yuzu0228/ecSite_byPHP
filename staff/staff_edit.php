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

$select = $db -> prepare('SELECT name FROM mst_staff WHERE code=?');
$select -> execute([$_GET['staff_code']]);
$rec = $select -> fetch(PDO::FETCH_ASSOC);
$staff_name = $rec['name'];
$db = null;

?>
<?php require('../header.php'); ?>
<body class="staff-page edit">
    <main>
        <h1>スタッフ管理画面</h1>
        <p class="sub-title">スタッフ情報修正</p>
        <p>スタッフコード：<?php echo h($_GET['staff_code']); ?></p>

        <form action="staff_edit_check.php" method="post">
        <input type="hidden" name="code" value="<?php echo h($_GET['staff_code']); ?>">
        <p>スタッフ名</p>
        <input type="text" name="name" value="<?php echo h($staff_name); ?>"><br>
        <p>パスワードを入力してください</p>
        <input type="password" name="password">
        <p>パスワードをもう一度入力してください</p>
        <input type="password" name="password2"><br><br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        </form>
    </main>
</body>
</html>