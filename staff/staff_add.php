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
<body class="staff-page add">
    <main>
        <h1>スタッフ管理画面</h1>
        <p class="sub-title">スタッフ追加</p><br>

        <form action="staff_add_check.php" method="post">
            <p>スタッフ名を入力してください</p>
            <input type="text" name="name">
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