<?php
include_once("../func/function.php");

if (!isset($_SESSION["UsuarioLogado"]) || $_SESSION["UsuarioLogado"] !== true) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: ../../user/login.php");
    exit();
}


if(isset($_SESSION['User'])){
    $username = $_SESSION['User'];
    $result = DBQuery('id', 'usuario', "WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $iduseredit = $id;
    $consult = DBQuery("*", "usuario", "WHERE id='$iduseredit'");
    $usuario_edit = $consult->fetch_array();
};


if (isset($_GET['pag'])) {
    $conn = DBConnect();
    // Obtenha os valores do formulário e escape para evitar SQL injection
    $qficha = mysqli_escape_string($conn, $_GET['qficha']);
    $fpag = mysqli_escape_string($conn, $_GET['fpag']);

    if ($fpag == "PIX") {
        $_SESSION['quantidadeFicha'] = $qficha;
        header("Location: ../../financeiro/pix.php#scroll");
    }
    exit(); // Certifique-se de sair após redirecionar
}

    

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CyberWin</title>
    <link rel="icon" type="image/x-icon" href="/../assets/favicon.ico" />
    <!-- Fonte-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google Fonte-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- CSS (com Bootstrap)-->
    <link href="/../css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Barra superior-->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
            <a class="navbar-brand" href="../index.php">Cassino CyberWin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">

                    <?php
                    session_start();

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
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container px-5">
                <h1 class="masthead-heading mb-0">Área financeira</h1>
                <h2 class="masthead-subheading mb-0">Compre ou troque fichas abaixo!</h2>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>
    <!-- Conteudo 1-->
    <section id="scroll">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4">Compre fichas:</h2>
                            <p>Por favor, preencha o formulario disponível ao lado. É importante ressaltar que cada real enviado será convertido em uma ficha.</p>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <form action="" method="GET">
                            <input type="hidden" name="id" value="<?php echo $usuario_edit['id']; ?>">
                            <p>
                                <label for="username">Nome:</label>
                                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($usuario_edit['username']); ?>" disabled>
                            </p>
                            <p>
                                <label for="ficha">Fichas Atuais:</label>
                                <input type="text" name="ficha" id="ficha" value="<?php echo htmlspecialchars($usuario_edit['ficha']); ?>" disabled>
                            </p>
                            <p>
                                <label for="qficha">Comprar quantas fichas:</label>
                                <input type="number" name="qficha" id="qficha">
                            </p>
                            <p>
                                <label for="fpag">Forma de pagamento:</label>
                                <select name="fpag" id="fpag">
                                    <option value="PIX">PIX</option>
                                </select>
                            </p>
                            <p>
                                <input type="submit" name="pag" value="Avançar">
                            </p>                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Conteudo 2-->
    <section>
        <div class="container px-5" id="tf">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="p-5">
                    <h2 class="display-4">Troque as fichas:</h2>
                        <p>Para solicitar a conversão das fichas em dinheiro, é necessário enviar uma mensagem ao Telegram <a href="https://t.me/CCA469?text=Trocar fichas">@CCA469<a> requisitando a troca.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        ...
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