<body class="staff-page">
<main>
<?php
require('../function.php');
require('../header.php');
require('../dbconnect.php');

$password = sha1($_POST['password']);
$name = h($_POST['name']);

$select = $db -> prepare('SELECT * FROM mst_staff WHERE name=? AND password=?');
$select -> execute([$name, $password]);

$rec = $select -> fetch();

if($rec) {
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['staff_code'] = $rec['code'];
    $_SESSION['staff_name'] = $rec['name'];
    header('Location: staff_top.php');
    exit();
}else {
    echo '<p class="error">スタッフ名またはパスワードが違います</p>';
    echo '<br><a class="back-btn" href="staff_login.php">戻る</a>';
}
?>
</main>
</body>