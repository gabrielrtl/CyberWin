<!DOCTYPE html>
<?php
include_once("../../func/private.php");

$username = $_SESSION['User'];


?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./src/icon.ico">
	<title>CyberWin</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<html>

<body onload="main()" id="body">
	
	<div class="usuario" id="usuarioBox">
	<p id="userName">
     Olá, <?php echo $username; ?> - Você possui: <span id="numFicha"> <?php echo $numFicha; ?> </span> Fichas</p>
	</p>
		<!--
		<div class="login-buttons">
			<div id="loginButton">
				<button id="login">Log in</button>
			</div>
			<div id="dashboard">
				<button id="logout">Log out</button>
			</div> 
		</div>  -->
	</div> 
	<!--
	<div class="stats">
		<table>
			<td>
				<tr>
					<h1 class="stats-title">STATS 📊</h1>
				</tr>
				<tr>
					<div class="stats-group">
						<h3 id="score">Score: 0</h3>
						<h3 id="wins">Wins: 0</h3>
					</div>
				</tr>
			</td>
		</table>
	</div>
	-->
	<main>
		<div id="game">
			<section id="status">
				<h3 id="text">WELCOME!</h3>
			</section>
			<section id="Slots">
				<div id="slot1" class="a1"></div>
				<div id="slot2" class="a1"></div>
				<div id="slot3" class="a1"></div>
			</section>
			<div class="bottom">
				<img src="src/icons/audioOn.png" id="audio" class="option" onclick="toggleAudio()" />
				<section onclick="doSlot()" id="Gira">GIRAR</section>
			</div>
			<canvas id="my-canvas"></canvas>
		</div>
	</main>
	<!--
<div class="leaderboard">
	<table>
		<td>
			<tr>
				<h1 class="leader-title">LEADERBOARD 🏆</h1>
			</tr>
			<tr>
				<div id="leader-group">
					<div class="first">
						<h3 class="leader-num" style="background-color: #d8a114;">1º</h3><h3 id="score1">Dout: 4600</h3>
					</div>
					<div class="second">
						<h3 class="leader-num" style="background-color: #a6a6a6;">2º</h3><h3 id="score2">Pedro: 2500</h3>
					</div>
					<div class="third">
						<h3 class="leader-num" style="background-color: #7a3619;">3º</h3><h3 id="score3">Player395: 2300</h3>
					</div>
					<h3 class="scores" id="score4">The Joker: 2100</h3>
					<h3 class="scores" id="score5">Bob: 1900</h3>
					<h3 class="scores" id="score6">xXTonyXx: 1500</h3>
					<h3 class="scores" id="score7">Santiago: 1300</h3>
					<h3 class="scores" id="score8">Alexia Mine: 900</h3>
					<h3 class="scores" id="score9">Mike: 500</h3>
					<h3 class="scores" id="score10">Alex: 200</h3>
				</div>
			</tr>
		</td>
	</table>
</div> -->
<script>
function atualizarFichas() {
    var xhr = new XMLHttpRequest(); // Definindo o objeto XMLHttpRequest
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Atualiza o valor exibido na página
                var response = JSON.parse(xhr.responseText);
                if (response.numFicha !== undefined) {
                    document.getElementById("numFicha").textContent = response.numFicha;
                } else {
                    console.error('Erro ao atualizar o número de fichas.');
                }
                console.log(xhr.responseText);
            	} else {
                console.error('Erro na requisição AJAX:', xhr.status, xhr.statusText);
            }
        }
    };
    xhr.open('GET', '../../func/ficha.php', true);
    xhr.send();
}

setInterval(() => atualizarFichas(), 1000); // 1000 milissegundos = 1 segundo
</script>
	<script src="./confetti.js"></script>
	<script src="./main.min.js"></script>
	<script src="./auth.js"></script>
</body>

</html>