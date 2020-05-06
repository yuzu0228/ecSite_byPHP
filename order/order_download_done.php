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
        <?php
        $year = $_POST['year'];
        $month = $_POST['month'];
        if(strlen($_POST['month']) == 1) {
            $month = '0' . $_POST['month'];
        }
        $day = $_POST['day'];
        if(strlen($_POST['day']) == 1) {
            $day = '0' . $_POST['day'];
        }

        require('../dbconnect.php');

        $select = $db -> prepare('SELECT
        sales_customer.code,
        sales_customer.date,
        sales_customer.code_member,
        sales_customer.name AS customer_name,
        sales_customer.email,
        sales_customer.post1,
        sales_customer.post2,
        sales_customer.address,
        sales_customer.tel,
        sales_product.code_product,
        mst_product.name AS product_name,
        sales_product.price,
        sales_product.quantity
        FROM
        sales_product, sales_customer, mst_product
        WHERE
        sales_customer.code=sales_product.code_sales
        AND sales_product.code_product=mst_product.code
        AND substr(sales_customer.date, 1, 4) = ?
        AND substr(sales_customer.date, 6, 2) = ?
        AND substr(sales_customer.date, 9, 2) = ?
        ');
        $select -> execute([$year, $month, $day]);

        $count = $db -> prepare('SELECT COUNT(*) AS count FROM sales_customer WHERE substr(sales_customer.date, 1, 4) = ?
        AND substr(sales_customer.date, 6, 2) = ?
        AND substr(sales_customer.date, 9, 2) = ?');
        
        $count -> execute([$year, $month, $day]);
        $record = $count -> fetch();

        

        $db = null;

        $csv = '注文コード, 注文日時, 会員番号, お名前, メール, 郵便番号, 住所, TEL, 商品コード, 商品名, 価格, 数量';
        $csv .= "\n";

        while(true) {
            $rec = $select -> fetch(PDO::FETCH_ASSOC);
            if($rec == false) {
                break;
            }
            $csv .= $rec['code'];
            $csv .= ',';
            $csv .= $rec['date'];
            $csv .= ',';
            $csv .= $rec['code_member'];
            $csv .= ',';
            $csv .= $rec['customer_name'];
            $csv .= ',';
            $csv .= $rec['email'];
            $csv .= ',';
            $csv .= $rec['post1'] . '-' . $rec['post2'];
            $csv .= ',';
            $csv .= $rec['address'];
            $csv .= ',';
            $csv .= $rec['tel'];
            $csv .= ',';
            $csv .= $rec['code_product'];
            $csv .= ',';
            $csv .= $rec['product_name'];
            $csv .= ',';
            $csv .= $rec['price'];
            $csv .= ',';
            $csv .= $rec['quantity'];
            $csv .= ',';
            $csv .= "\n";
        }

        //echo nl2br($csv);

        $file = fopen('./order.csv', 'w');
        $csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
        fputs($file, $csv);
        fclose($file);
        ?>

        <?php
        if($record['count'] == 0) {
            echo '<p style="color: red;">指定された日の購入履歴はありません</p>';
        }else {
            echo '<a href="order.csv">注文データ(' . $_POST['year'] . '年' . $_POST['month'] . '月' . $_POST['day'] . '日' . ')のダウンロード</a><br>';
        }
        ?>
        <a href="order_download.php">日付選択へ</a><br>
        <a href="../staff_login/staff_top.php">トップメニューへ</a>
    </main>
</body>
</html>