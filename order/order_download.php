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
<body class="download-page">
        <main>
        <p>ダウンロードしたい注文日を選択してください</p>
        <form action="order_download_done.php" method="post">
            <select name="year">
                <option value="2020">2020</option>
            </select>年

            <select name="month">
                <?php for($i=1; $i <= 12; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>月

            <select name="day">
                <?php for($i=1; $i <= 31; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>日<br><br>
            <input type="submit" value="ダウンロードへ"><br>
            <a href="../staff_login/staff_top.php">トップメニューへ</a>
        </form>
    </main>
</body>
</html>