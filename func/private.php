<?php
include_once("../../func/function.php");
$username = $_SESSION['User'];



$result = DBQuery('ficha', 'usuario', "WHERE username = '$username'");
$row = mysqli_fetch_assoc($result);
$numFicha = $row['ficha'];


// Verifique se o usuário está autenticado
if (!isset($_SESSION["UsuarioLogado"]) || $_SESSION["UsuarioLogado"] !== true) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: ../../user/login.php");
    exit();
}

// Verifica se o usuario logado tenha fichas, caso nao  tenha, direciona ele para o financeiro
if ($numFicha <=0) {
    header("Location: ../../financeiro/index.php");
    exit();
}

?>