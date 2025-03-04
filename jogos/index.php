<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CyberWin</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
            <a class="navbar-brand" href="index.php">Cassino CyberWin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">

                    <?php
                    session_start();

                    if (isset($_SESSION['UsuarioLogado'])) {
                        $username = $_SESSION['User'];
                        echo '<li class="nav-item"><span class="nav-link">Bem-vindo, ' . $username . '</span></li>';
                        echo '  <form method="post">
                                <input class="btn btn-primary btn-x2 rounded-pill mt-0" type="submit" name="finan" value="Financeiro">
                                <input class="btn btn-primary btn-x2 rounded-pill mt-0" type="submit" name="logout" value="Encerrar Sessão">
                                </form>     ';
                        if (isset($_POST['finan'])) {
                            header("Location: ../financeiro/index.php");
                            exit(); // Certifique-se de sair após redirecionar
                        }
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
        <!--
        <div class="masthead-content">
            <div class="container px-5">
                <h1 class="masthead-heading mb-0">jogos</h1>
                <h2 class="masthead-subheading mb-0">asdasdasdasdasdasd </h2>
                <a class="btn btn-primary btn-xl rounded-pill mt-5" href="jogos/index.php">JOGAR Agora</a>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
        -->
    
    <!-- jogo 1-->
    <section id="scroll">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="../assets/img/jackpotslot.jpg" alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Jackpot Slot</h2>
                        <p>O jogo de caça-níqueis online que pode transformar sua sorte. Cada giro oferece a chance de ganhar prêmios extraordinários. Aproveite esta oportunidade agora!</p>
                        <a class="btn btn-primary btn-xl rounded-pill mt-5" href="/jogos/Jackpot/index.php">JOGAR</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jogo 2-->
    <section>
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="../assets/img/.." alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Blackjack / Vinte e um:</h2>
                        <p>em desenvolvimento</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </header>
    <!-- Footer -->
    <footer class="py-5 bg-black">
        <div class="container px-5">
            <p class="m-0 text-center text-white small">Desenvolvido por © 2023 gabrielrtl</p>
            <p class="m-0 text-center text-white small"><a href="../admin/index.php">Area de Administração</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--JS-->
    <script src="js/scripts.js"></script>
</body>

</html>