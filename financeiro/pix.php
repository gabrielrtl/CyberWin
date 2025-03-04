<?php
include_once("../func/function.php");

$username = $_SESSION['User'];
$qficha = $_SESSION['quantidadeFicha'];

// API
$url = "https://gerarqrcodepix.com.br/api/v1?nome=Gabriel&cidade=null&valor={$qficha}&saida=br&chave=756b4b37-51a9-47e5-aae2-8a5b963ee2dd&tamanho=256";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch,CURLOPT_HTTPHEADER, array('Key: ps1hho71drg1bqjs1apa46fkjpym8qrlp543q9nbesvubrxt','User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'));
ob_start();
curl_exec($ch); 
curl_close($ch);
$file_contents = "";
$file_contents = ob_get_contents();
ob_end_clean();
// ----------------------------------------------------------


if ($obj = json_decode($file_contents)) {
$obj->brcode;      
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CyberWin</title>
    <link rel="icon" type="image/x-icon" href="/../../assets/favicon.ico" />
    <!-- Fonte-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google Fonte-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- CSS (com Bootstrap)-->
    <link href="/../../css/styles.css" rel="stylesheet" />
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
                <h1 class="masthead-heading mb-0">Pagamento por pix</h1>
                <h2 class="masthead-subheading mb-0">Estamos quase lá! A diversão está chegando!</h2>
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
                        <p>Pague pelo pix abaixo, o recebimento das fichas sera em ate 2 horas</p>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <form style="text-align: center;">
                            <input type="button" id="copy" value="Copiar Chave PIX">
                        </form>
                        <img id="qrcode" src="https://gerarqrcodepix.com.br/api/v1?nome=Gabriel&cidade=null&valor=<?php echo $qficha; ?>&saida=qr&chave=756b4b37-51a9-47e5-aae2-8a5b963ee2dd&tamanho=256" alt="qrcode" width="100%" height="100%">
                        
                        <!--
                        <form method="post" action="" style="text-align: center;">
                        <input type="submit" name="submit" value="Pago!">
                        </form>
                -->


                    </div>
                </div>
            </div>
        </div>
        
    </section>
            <!-- Conteudo 2-->
            <section id="scroll">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="p-5">

                    <p>Se a recarga demorar mais do que o previsto, entre em contato conosco através do Telegram, usuário <a href="https://t.me/CCA469?text=Preciso de suporte">@CCA469<a>. Agradecemos pela sua confiança.</p>

                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">

                    <p></p>

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

    <script>
        document.getElementById("copy").addEventListener("click", function() {
            var texto = "<?php echo $obj->brcode; ?>";
            navigator.clipboard.writeText(texto).then(function() {
                alert("Chave PIX copiado com sucesso!");
            }, function(err) {
                console.error('Erro ao copiar: ', err);
            });
        });
    </script>
</body>

</html>
