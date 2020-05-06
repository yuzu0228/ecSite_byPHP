<?php
session_start();
$_SESSION = array();
if(isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
?>
<?php require('../header.php'); ?>
<body class="staff-page">
    <main>
        <h1>スタッフ管理画面</h1>
        <p>ログアウトしました</p>
        <a href="staff_login.php">ログイン画面へ</a><br>
        <a href="../shop/shop_list.php">ECサイトへ</a>
    </main>
</body>
</html>