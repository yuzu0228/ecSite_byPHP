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

$select = $db -> prepare('SELECT * FROM mst_staff WHERE 1');
$select -> execute([]);
$db = null;

?>

<?php require('../header.php'); ?>
<body class="staff-page">
    <main>
        <h1>スタッフ管理画面</h1>
        <p class="sub-title">スタッフ一覧</p>
        <form action="staff_branch.php" method="post">
        <?php
        foreach($select as $data) {
            echo '<input type="radio" name="staff_code" value="' . $data['code'] . '">';
            echo h($data['name']) . '<br>';
        }
        ?>
        <input type="submit" name="disp" value="参照">
        <input type="submit" name="add" value="追加">
        <input type="submit" name="edit" value="修正">
        <input type="submit" name="delete" value="削除">
        </form>

        <a href="../staff_login/staff_top.php">トップメニューへ</a>
    </main>
</body>
</html>