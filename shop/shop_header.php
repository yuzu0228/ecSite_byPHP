<a class="shop-page-header" href="shop_list.php">なんでも出前サイト</a>
<?php
if(isset($_SESSION['member_login'])) {
    echo '<p>ようこそ' . $_SESSION['member_name'] . '様</p>';
    echo '<ul class="nav">';
    echo '<li><a href="member_purchase_record.php">購入履歴</a></li>';
    echo '<li><a href="member_modify.php">会員情報変更</a></li>';
    echo '<li><a id="shopLogout" href="member_logout.php">ログアウト</a></li>';
    echo '<li><a href="shop_cartlook.php"><i class="fas fa-shopping-cart"></i>カートの中身を見る</a></li>';
    echo '<li><a href="../staff_login/staff_login.php">管理画面（スタッフ専用）</a></li>';
    echo '</ul>';
}else {
    echo '<p>ようこそゲスト様</p>';
    echo '<ul class="nav">';
    echo '<li><a href="member_login.php">会員ログイン</a></li>';
    echo '<li><a href="member_register.php">新規会員登録</a></li>';
    echo '<li><a href="shop_cartlook.php"><i class="fas fa-shopping-cart"></i>カートの中身を見る</a></li>';
    echo '<li><a href="../staff_login/staff_login.php">管理画面（スタッフ専用）</a></li>';
    echo '</ul>';
}
?>