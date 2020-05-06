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

require('../function.php');

if(isset($_POST['disp']) == true) {

    if(isset($_POST['staff_code']) == false) {
        header('Location: staff_ng.php');
        exit();
    }

    header('Location: staff_disp.php?staff_code=' . $_POST['staff_code']);
    exit();
}


if(isset($_POST['add']) == true) {

    header('Location: staff_add.php');
    exit();
}

if(isset($_POST['edit']) == true) {

    if(isset($_POST['staff_code']) == false) {
        header('Location: staff_ng.php');
        exit();
    }

    header('Location: staff_edit.php?staff_code=' . $_POST['staff_code']);
    exit();
}

if(isset($_POST['delete']) == true) {

    if(isset($_POST['staff_code']) == false) {
        header('Location: staff_ng.php');
        exit();
    }

    header('Location: staff_delete.php?staff_code=' . $_POST['staff_code']);
    exit();
}