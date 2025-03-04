<?php
include_once("../func/function.php");
#       conecta e consulta os membros no banco
//$conn = DBConnect();
$dado = DBQuery("*", "usuario", "");

if (!isset($_SESSION["UsuarioLogado"]) || $_SESSION["UsuarioLogado"] !== true) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: ../../user/login.php");
    exit();
}


   
$t = 1;
$s = $_SESSION['adminTrue'];

if ($t != $s) {
   header("Location: ../index.php");
   //header("Location: /../../user/login.php");
   exit();
}

/*
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
*/

if (isset($_GET['dell'])) {
    $d = $_GET['dell'];
    $ex = DBDellReg('usuario', $d);

    if ($ex == true) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Erro de Login')</script>";
    }
}

if (isset($_GET['edit'])) {
    $iduseredit = (int) $_GET['edit'];
    $consult = DBQuery("*", "usuario", "WHERE id='$iduseredit'");
    $usuario_edit = $consult->fetch_array();
};

if (isset($_GET['id'])) {
    $iduseredit = $_GET['id'];
}

if (isset($_GET['alt'])) {
    $conn = DBConnect();
    // Obtenha os valores do formulário e escape para evitar SQL injection
    $adminAlt = mysqli_escape_string($conn, $_GET['admin']);
    $nomeAlt = mysqli_escape_string($conn, $_GET['username']);
    $senhaAlt = mysqli_escape_string($conn, $_GET['senha']);
    $fichaAlt = mysqli_escape_string($conn, $_GET['ficha']);

    // Efetua a alteração no banco
    $cadast = DBUpdMembro('usuario', "admin = '$adminAlt', username = '$nomeAlt', senha = '$senhaAlt', ficha = '$fichaAlt'", $iduseredit);

    // Redireciona após a alteração
    header("Location: index.php");
    exit(); // Certifique-se de sair após redirecionar
}

if (isset($_GET['add'])){
    $conn = DBConnect();
    $adminAdd = mysqli_escape_string($conn, $_GET['adadmin']);
    $nomeAdd = mysqli_escape_string($conn, $_GET['adusername']);
    $senhaAdd = mysqli_escape_string($conn, $_GET['adsenha']);
    $fichaAdd = mysqli_escape_string($conn, $_GET['adficha']);

#       Efetua o cadastro
    $cadast = DBCad('usuario',"admin,username,senha,ficha","'$adminAdd','$nomeAdd','$senhaAdd','$fichaAdd'");
    if($cadast == true){
        header("Location: index.php");
	} else {
	echo "<script>alert('Erro de Cadastro')</script>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CyberWin</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Fonte-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google Fonte-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- CSS (com Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Barra superior-->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
            <a class="navbar-brand" href="index.php">Área de administração</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">

                    <?php
                    /*
                    if (isset($_SESSION['UsuarioLogado'])) {
                        $username = $_SESSION['User'];
                        echo '<li class="nav-item"><span class="nav-link">Bem-vindo, ' . $username . '</span></li>';
                        echo '  <form method="post">
                                <input class="btn btn-primary btn-x2 rounded-pill mt-0" type="submit" name="logout" value="Encerrar Sessão">
                                </form>     ';
                        if (isset($_POST['logout'])) {
                            // Destrua todas as variáveis de sessão
                            session_destroy();

                            // Redirecione para a página de login ou qualquer outra página desejada
                            header("Location: index.php");
                            exit(); // Certifique-se de sair após redirecionar
                        }
                    } else {
                        // Se o usuário não estiver logado, exiba os links de registro e login
                        echo '<li class="nav-item"><a class="nav-link" href="user/registro.php">Registrar</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="user/login.php">Logar</a></li>';
                    }
                    */
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <header class="masthead text-center text-white">
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>
    <!-- Conteudo-->
    <section id="scroll">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <h2>Editar usuario</h2>
                    <form action="" method="GET">
                        <?php if (isset($usuario_edit)) : ?>
                            <input type="hidden" name="id" value="<?php echo $usuario_edit['id']; ?>">
                            <p>
                                <label for="ficha">Admin:</label>
                                <input type="text" name="admin" id="admin" value="<?php echo htmlspecialchars($usuario_edit['admin']); ?>">
                            </p>
                            <p>
                                <label for="username">Nome:</label>
                                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($usuario_edit['username']); ?>">
                            </p>
                            <p>
                                <label for="senha">Senha:</label>
                                <input type="text" name="senha" id="senha" value="<?php echo htmlspecialchars($usuario_edit['senha']); ?>">
                            </p>
                            <p>
                                <label for="ficha">Ficha:</label>
                                <input type="text" name="ficha" id="ficha" value="<?php echo htmlspecialchars($usuario_edit['ficha']); ?>">
                            </p>
                            <p>
                                <input type="submit" name="alt" value="Salvar">
                            </p>
                        <?php else : ?>
                            <!-- Exibir uma mensagem ou outro conteúdo se nenhum ID de usuário for fornecido -->
                        <?php endif; ?>
                        
                    </form>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2>Lista de todos os membros</h2>
                        <table border="1">
                            <!-- Lista os dados dos membros -->
                            <tr>
                                <td>ID</td>
                                <td>Admin</td>
                                <td>Nome</td>
                                <td>Senha</td>
                                <td>Ficha</td>
                            </tr>
                            <?php while ($dados = $dado->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $dados['id']; ?></td>
                                    <td><?php echo $dados['admin']; ?></td>
                                    <td><?php echo $dados['username']; ?></td>
                                    <td><?php echo $dados['senha']; ?></td>
                                    <td><?php echo $dados['ficha']; ?></td>
                                    <td>
                                        <a href="?edit=<?php echo $dados['id']; ?>">Editar</a>
                                        <a href="?dell=<?php echo $dados['id']; ?>">Excluir</a>
                                    </td>
                                </tr>
                            <?php  } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Conteudo 2-->
    <section>
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <!-- <div class="p-5"><img class="img-fluid rounded-circle" src="....................." alt="..." /></div> -->
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2>Adicionar usuario</h2>
                        <form action="" method="GET">
                            <input type="hidden" name="id" value="">
                            <p>
                                <label for="username">Nome:</label>
                                <input type="text" name="adusername" id="username" value="">
                            </p>
                            <p>
                                <label for="senha">Senha:</label>
                                <input type="text" name="adsenha" id="senha" value="">
                            </p>
                            <p>
                                <label for="ficha">Ficha:</label>
                                <input type="text" name="adficha" id="ficha" value="">
                            </p>
                            <p>
                            <label for="ficha">Conseder Privilegios ADMIN</label></br>
                            <input type="radio" name="adadmin" value="1">
                            <label for="1">Sim</label><br>
                            <input type="radio" name="adadmin" value="0">
                            <label for="0">Nao</label><br>
                            </p>
                            <p>
                                <input type="submit" name="add" value="Salvar">
                            </p>
                            <p>
                                <a href="../index.php"><button type="button"> Voltar </button></a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-black">
        <div class="container px-5">
            <p class="m-0 text-center text-white small">Desenvolvido por © 2023 gabrielrtl</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--JS-->
    <script src="js/scripts.js"></script>
</body>

</html>

<?php

?>