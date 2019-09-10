<?php
if(isset($_GET['id']) && isset($_SESSION['tmpPic'][$_GET['id']])){
    header("Content-Type: " . $_SESSION['tmpPic'][$_GET['id']]['type']); 
    echo $_SESSION['tmpPic'][$_GET['id']]['content'];
}
?>