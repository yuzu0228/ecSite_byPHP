<?php
try{
        $db = new PDO('mysql:dbname=shop;host=localhost;charset=utf8', 'root', '');
    } catch (PDOexception $e) {
        echo '接続エラー' . $e->getMassage();
    }
?>