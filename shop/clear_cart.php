<?php
session_start();
$_SESSION = array();
if(isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
?>
<?php
require('../function.php');
require('../header.php'); ?>
<body class="shop-page">
    <p>カートを空にしましたしました</p>
    <a href="staff_login.php">ログイン画面へ</a>
</body>
</html>