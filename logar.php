<?php
session_start();

$chave_acesso = "admin";
if(isset($_POST['chave_acesso']) && $_POST['chave_acesso'] == $chave_acesso) {
    $_SESSION['user'] = true;
} else {
    $_SESSION['msg'] = "Chave inválida";
    header("Location: login.php");
    exit;
}

header("Location: index.php");