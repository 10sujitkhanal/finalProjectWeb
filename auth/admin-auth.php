<?php
if($_SESSION["user_type"] != 1) {
    header("Location: index.php");
    exit();
}
?>