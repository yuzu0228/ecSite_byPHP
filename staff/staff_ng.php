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
<body class="staff-page">
    <main>
        <h1>スタッフ管理画面</h1>
        <p class="error">スタッフが選択されていません</p>
        <br><a class="back-btn" href="staff_list.php">戻る</a>
    </main>
</body>
</html>