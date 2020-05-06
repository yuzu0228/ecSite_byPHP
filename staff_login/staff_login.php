
<?php
require('../function.php');
require('../header.php'); ?>
<body class="staff-page">
    <main>
        <h1>スタッフ用ログイン画面</h1>

        <form action="staff_login_check.php" method="post">
            <p>スタッフ名</p>
            <input type="text" name="name">
            <p>パスワード</p>
            <input type="password" name="password"><br><br>
            <input type="submit" value="ログイン">
        </form>
    </main>
</body>
</html>