<!DOCTYPE HTML>
<html>
	<head>
		<title>Criptografia PHP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-gem"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>O PRODUTO FOI CRIADA COM SUCESSO!</h1>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#cripto">Cripto</a></li>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="index.php#login">Logar</a></li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

                        <!-- Cripto -->
                        <article id="cripto">
                            <h2 class="major">Cripto</h2>
                            <span class="image main"><img src="images/cripto.jpg" alt="" /></span>
                            <p>"Cripto" foi um projeto criado para conseguir demonstrar para o Prof. Gregory Oliveira as nossas técnicas de criptografia em PHP. 
                                O projeto foi composto pelo alunos: Débora, Leonardo Moura e Matheus Bonotto.</p>
                            <p>O objetivo do nosso projeto foi deixá-lo com uma criptografia única. Para alcançar este objetivo, utilizamos alguns métodos randômicos e a utilização de salt para deixar as nossas senhas únicas.
                                Inicialmente, criamos nosso salt sendo ele randômico, utilizando o random_bytes, com 90 dígitos de tamanho. Logo após o convertemos de binário para hexadecimal, e por fim, finalizamos ele
                                com a criptografia SHA1.
                                Após isso concatenamos a senha do usuário com este salt criptografado, e novamente criptografamos eles dois juntos com outra criptografia, o SHA256.
                                Com isso em mente, temos uma senha extremamente difícil de ser descoberta ou hackeada, pois ela está randomizada, concatenada com textos internos e criptografada por três níveis.
                            </p>
                        </article>
					</div>
                    

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; DLM. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
