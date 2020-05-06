<?php
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES);
}
error_reporting(E_ALL & ~E_NOTICE);
?>