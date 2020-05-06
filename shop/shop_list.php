<?php
session_start();
session_regenerate_id(true);
require('../header.php');
require('shop_header.php');
require('../function.php');
require('../dbconnect.php');


if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    $page= $_REQUEST['page'];
} else {
    $page = 1;
}
$start = 5 * ($page - 1);

$select = $db -> prepare('SELECT * FROM mst_product ORDER BY code LIMIT ?,5');
$select -> bindParam(1, $start, PDO::PARAM_INT);
$select -> execute();


$product_name = h($_REQUEST['product_name']);

$search = $db -> prepare('SELECT * FROM mst_product WHERE name LIKE "%' . $product_name . '%" ORDER BY code LIMIT ?,5');
$search -> bindParam(1, $start, PDO::PARAM_INT);
$search -> execute();

?>

<body class="shop-page shoplist">
    
    <div class="wrapper">
        <p class="sub-title">商品一覧</p>

        <div class="search-form clearfix">
            <form action="" method="post">
                <input type="text" name="product_name">
                <input type="submit" value="検索">
            </form>
        </div>
        
        <?php
        if(isset($_REQUEST['product_name']) == false ) {
            echo '<section class="product-list">';
            foreach($select as $data) {
                echo '<div class="product-part">';
                echo '<a href="shop_product.php?product_code=' . $data['code'] . '">';
                echo '<img src="../image/' . $data['image'] . '" alt="写真が設定されていません" width="300px" height="300px">';
                echo '<p>' . $data['name'] . '---' . $data['price'] . '円</p></a><br>';
                echo '</div>';
            }
            echo '</section>';
        }
        if(isset($_REQUEST['product_name'])) {

            if($_REQUEST['product_name'] == '') {
                echo '<p class="search-result-message">検索エラー：検索フォームが未入力でした</p>';
                echo '<section class="product-list">';
                foreach($select as $data) {
                    echo '<div class="product-part">';
                    echo '<a href="shop_product.php?product_code=' . $data['code'] . '">';
                    echo '<img src="../image/' . $data['image'] . '" alt="写真が設定されていません" width="300px" height="300px">';
                    echo '<p>' . $data['name'] . '---' . $data['price'] . '円</p></a><br>';
                    echo '</div>';
                }
                echo '</section>';
            }else {
                echo '<p class="search-result-message">「' . $product_name . '」の検索結果</p>';
                echo '<section class="product-list">';
                foreach($search as $data) {
                    echo '<div class="product-part">';
                    echo '<a href="shop_product.php?product_code=' . $data['code'] . '">';
                    echo '<img src="../image/' . $data['image'] . '" alt="写真が設定されていません" width="300px" height="300px">';
                    echo '<p>' . $data['name'] . '---' . $data['price'] . '円</p></a><br>';
                    echo '</div>';
                    }
                echo '</section>';
                if($data == null) {
                    echo '<p>該当する商品がありません</p>';
                }
            }
        }
        ?>

        <div class="pagination">
            <?php if($page>= 2): ?>
                <?php if(isset($_REQUEST['product_name']) == false ): ?>
                    <a href="shop_list.php?page=<?php echo $page - 1;?>"><?php echo $page - 1;?>ページ目へ</a>
                <?php else: ?>
                    <a href="shop_list.php?page=<?php echo $page - 1;?>&product_name?=<?php echo $product_name; ?>"><?php echo $page - 1;?>ページ目へ</a>
                <?php endif; ?>
            <?php endif; ?>
            |
            <?php
            if(isset($_REQUEST['product_name']) == false ){
                $counts = $db -> query('SELECT COUNT(*) AS count FROM mst_product');
                $count = $counts -> fetch();
                $max_page = ceil($count['count'] / 5);
            }else {
                $counts = $db -> query('SELECT COUNT(*) AS count FROM mst_product WHERE name LIKE "%' . $product_name . '%"');
                $count = $counts -> fetch();
                $max_page = ceil($count['count'] / 5);
            }
            if($page < $max_page): ?>
                <?php if(isset($_REQUEST['product_name']) == false ): ?>
                    <a href="shop_list.php?page=<?php echo $page + 1;?>"><?php echo $page + 1;?>ページ目へ</a>
                <?php else: ?>
                    <a href="shop_list.php?page=<?php echo $page + 1;?>&product_name?=<?php echo $product_name; ?>"><?php echo $page + 1;?>ページ目へ</a>
                <?php endif; ?>
            <?php endif;
            $db = null; ?>
        </div>

    </div>

    <?php require('footer.php'); ?>
    
</body>
</html>