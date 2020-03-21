<?php

session_start();

function add_cart($id){
    $_SESSION['Cart'].array_push($id);
    header("Location: store.php");
    exit();
}