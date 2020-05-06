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
    <?php
    if($_POST['name'] == '') {
        echo '<p class="error">スタッフ名が入力されていません</p>';
    }else {
        echo '<p>スタッフ名：' . h($_POST['name']) . '</p>';
    }

    if($_POST['password'] == '') {
        echo '<p class="error">パスワードが未入力です</p>';
    }

    if(strlen($_POST['password']) < 4) {
        echo '<p class="error">パスワードは4文字以上入力してください</p>';
    }

    if($_POST['password'] !== $_POST['password2']) {
        echo '<p class="error">パスワードが一致しません</p>';
    }

    if($_POST['name'] == '' || $_POST['password'] == '' || $_POST['password'] !== $_POST['password2']) {
        echo '<form><input type="button" onclick="history.back()" value="戻る"></form>'; 
    } else {
        echo '<form action="staff_edit_done.php" method="post">';
        echo '<input type="hidden" name="code" value="' . h($_POST['code']) . '">';
        echo '<input type="hidden" name="name" value="' . h($_POST['name']) . '">';
        echo '<input type="hidden" name="password" value="' . sha1($_POST['password']) . '">';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="OK">';
        echo '</form>';
    }

    ?>
    </main>
</body>
</html>