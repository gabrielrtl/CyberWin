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

#	Conecta ao banco
function DBConnect()
{
    $sql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die(mysqli_error($sql));
    mysqli_set_charset($sql, CHARSET) or die(mysqli_error($sql));

    return $sql;
}

#	Fecha a coneção com o banco
function DBClose($sql)
{
    @mysqli_close($sql) or die(mysqli_error($sql));
}

#	Função de consulta no banco de dados
function DBQuery($colunas, $tabela, $parametro)
{
    $parametro = ($parametro) ? " {$parametro}" : null;
    $tabela = ($tabela) ? " {$tabela}" : null;
    $colunas = ($colunas) ? " {$colunas}" : null;

    $sql = "SELECT {$colunas} FROM {$tabela} {$parametro}";

    $res = DBExecute($sql);
    return $res;
}

#       Função de alteração
function DBUpdMembro($tabela, $colunaevalor, $parametro)
{
    $conn = DBConnect();
    $sql = "UPDATE {$tabela} SET {$colunaevalor} WHERE id={$parametro}";

    $res = DBExecute($sql);
    if (!$res) {
        die('Erro MySQL: ' . mysqli_error($conn));
    }

    $res = DBExecute($sql);
    return $res;
};

#	Função de cadastro no banco de dados
function DBCad($tabela, $coluna, $parametro)
{
    $tabela = ($tabela) ? " {$tabela}" : null;
    $coluna = ($coluna) ? " {$coluna}" : null;
    $parametro = ($parametro) ? " {$parametro}" : null;

    $sql = "INSERT INTO {$tabela} ({$coluna}) VALUES ({$parametro});";

    $resultado = DBExecute($sql);
    return $resultado;
}

#	Função de exclusão no banco
function DBDellReg($tabela, $parametro)
{
    $parametro = ($parametro) ? " {$parametro}" : null;
    $tabela = ($tabela) ? " {$tabela}" : null;

    $sql = "DELETE from {$tabela} WHERE id={$parametro};";

    $resultado = DBExecute($sql);
    return $resultado;
}

#	Função de execução de comandos SQL
function DBExecute($sql)
{
    $conn = DBConnect();

    $resultado = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    DBClose($conn);

    return $resultado;
}


function DBUpdateficha($valor,$id)
{
    $sql = "UPDATE `usuario` SET `ficha` = '{$valor}' WHERE `usuario`.`id` = '{$id}';";
    DBExecute($sql);
}


if (isset($_POST['ficha'])) {
    $fichaRecebida = $_POST['ficha'];
    $result = DBQuery('ficha', 'usuario', "WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);
    $fichaAtual = $row['ficha'];

    echo "alert('fichaR = {$fichaRecebida} / fichaA = {$fichaAtual}')";

    switch ($fichaRecebida) {
        case $fichaRecebida == 10:
            $fichaNova = $fichaAtual + 10;
            DBUpdateficha($fichaNova,$id);
            break;
        case $fichaRecebida == 25:
            $fichaNova = $fichaAtual + 25;
            DBUpdateficha($fichaNova,$id);
            break;
        case $fichaRecebida == 5:
            $fichaNova = $fichaAtual + 5;
            DBUpdateficha($fichaNova,$id);
            break;
        case $fichaRecebida == -1:
            if ($fichaAtual <= 0) {
                echo "erro ficha abaixo de 0";
                header("Location: ../index.php");
                break;
            }
            $fichaNova = $fichaAtual -1;
            DBUpdateficha($fichaNova,$id);
            break;
        default:
            echo "erro inserir ficha DB";
    }
    
}
