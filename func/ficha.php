<?php
define('HOSTNAME', 'sql207.infinityfree.com');
define('USERNAME', 'if0_35917565');
define('PASSWORD', 'XuWubOvZWouJk');
define('DATABASE', 'if0_35917565_cassinodb');
define('CHARSET', 'utf8');
session_start();


if(isset($_SESSION['User'])){
    $username = $_SESSION['User'];
    $result = DBQuery('id', 'usuario', "WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
};

function DBExecute($sql)
{
    $conn = DBConnect();

    $resultado = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    DBClose($conn);

    return $resultado;
}

function DBClose($sql)
{
    @mysqli_close($sql) or die(mysqli_error($sql));
}

function DBConnect()
{
    $sql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die(mysqli_error($sql));
    mysqli_set_charset($sql, CHARSET) or die(mysqli_error($sql));

    return $sql;
}

function DBQuery($colunas, $tabela, $parametro)
{
    $parametro = ($parametro) ? " {$parametro}" : null;
    $tabela = ($tabela) ? " {$tabela}" : null;
    $colunas = ($colunas) ? " {$colunas}" : null;

    $sql = "SELECT {$colunas} FROM {$tabela} {$parametro}";

    $res = DBExecute($sql);
    return $res;
}

$result = DBQuery('ficha', 'usuario', "WHERE username = '$username'");
$row = mysqli_fetch_assoc($result);
$fichaAtual = $row['ficha'];

$numFicha = $fichaAtual;

if ($numFicha <=0) {
    header("Location: ../../financeiro/index.php");
    exit();
}

header('Content-Type: application/json');
echo json_encode([
    'numFicha' => $numFicha
]);



?>