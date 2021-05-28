<?php
if($_SESSION["username"] != 1) {
    header("Location: index.php");
    exit();
}
?>