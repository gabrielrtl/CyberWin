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
    <link href="css/styles.css" rel="stylesheet" />
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
                            header("Location: financeiro/index.php");
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
        <div class="masthead-content">
            <div class="container px-5">
                <h1 class="masthead-heading mb-0">CyberWin</h1>
                <h2 class="masthead-subheading mb-0">Plataforma exclusiva para alcançar vitórias financeiras </h2>
                <a class="btn btn-primary btn-xl rounded-pill mt-5" href="jogos/index.php">JOGAR Agora</a>
            </div>
        </div>
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
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Facilidade de Vitória:</h2>
                        <p>Descomplicamos o processo para que todos possam desfrutar de vitórias instantâneas. No CyberWin, a sorte está do seu lado, tornando a experiência de jogo fácil e empolgante. </p>
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
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/02.jpg" alt="..." /></div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4">Variedade de Jogos Eletrizantes:</h2>
                        <p>Explore uma ampla gama de jogos que vão desde clássicos de cassino até as últimas novidades tecnológicas. Nossos jogos são projetados para entreter e recompensar, garantindo uma experiência única a cada rodada.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Conteudo 3-->
    <section>
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/03.jpg" alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Comunidade Vencedora:</h2>
                        <p>Junte-se a uma comunidade vibrante de jogadores que compartilham a paixão por ganhar. Troque dicas, participe de eventos especiais e descubra estratégias para aumentar suas chances de sucesso.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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