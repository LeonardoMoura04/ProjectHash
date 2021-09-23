<?php
    require_once "conexao.php";
    
    $usuario = $senha = "";
    $usuario_err = $senha_err = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $input_usuario = trim($_POST["usuario"]);
        if(empty($input_usuario)){
            $usuario_err = "Por favor, insira seu usuario.";
        } else{
            $usuario = $input_usuario;
        }

        $input_senha = trim($_POST["senha"]);
        if(empty($input_senha)){
            $senha_err = "Por favor, insira sua Senha.";
        } else{
            $senha = $input_senha;
        }
        
        if(empty($usuario_err) && empty($senha_err)){
            $sql = "SELECT * FROM login WHERE usuario = ?";
        
            if($stmt = mysqli_prepare($link, $sql)){

                mysqli_stmt_bind_param($stmt, "s", $param_usuario);
                $param_usuario = $usuario;
                
                if(mysqli_stmt_execute($stmt)){

                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        $usuarioBanco = $row["usuario"];
                        $senhaBanco = $row["senha"];
                        $saltBanco = $row["salt"];

                        if(hash('sha256', $senha . $saltBanco) == $senhaBanco){
                            echo "<script>alert('Você logou com sucesso!')</script>";
                            header("location: menu.php");
                        } else{
                            echo "<script>alert('Senha incorreta.')</script>";
                        }
                    } else{
                        echo "<script>alert('Erro. Algo deu errado. Por favor, tente novamente.')</script>";
                    }
                    
                } else{
                    echo "<script>alert('Erro. Algo deu errado. Por favor, tente novamente.')</script>";
                }
            }
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($link);
        }
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Cripto</title>
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
								<h1>Projeto Cripto</h1>
								<p>Aqui neste site, iremos exemplificar e colocar em prática os ensinamentos que foram apresentados <br></br>
                                    pelo Prof. Gregory Oliveira, do UNASP. Clique na aba "Cripto" abaixo para saber mais!
                                </p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#cripto">Cripto</a></li>
                                <li><a href="criarUsuario.php#criarUsuario">Criar Usuário</a></li>
								<li><a href="#login">Login</a></li>
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
                                O projeto foi composto pelo alunos: Débora Alessandra, Leonardo Moura e Matheus Bonotto.</p>
                            <p> O objetivo do nosso projeto foi deixá-lo com uma criptografia única. Para alcançar este objetivo, utilizamos alguns métodos randômicos e a utilização de salt para deixar as nossas senhas únicas.
                                Inicialmente, criamos nosso salt sendo ele randômico, utilizando o random_bytes, com 90 dígitos de tamanho. Logo após o convertemos de binário para hexadecimal, e por fim, finalizamos ele
                                com a criptografia SHA1.
                                Após isso concatenamos a senha do usuário com este salt criptografado, e novamente criptografamos eles dois juntos com outra criptografia, o SHA256.
                                Com isso em mente, temos uma senha extremamente difícil de ser descoberta ou hackeada, pois ela está randomizada, concatenada com textos internos e criptografada por três níveis.
                            </p>
                        </article>

                        <!-- Login -->
                        <article id="login">
                            <h2 class="major">Login</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="fields">
                                    <div class="field half">
                                        <label>Usuário</label>
                                        <input type="text" name="usuario" class="form-control <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>">
                                        <span class="invalid-feedback"><?php echo $usuario_err;?></span>
                                    </div>

                                    <div class="field half">
                                        <label>Senha</label>
                                        <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                                        <span class="invalid-feedback"><?php echo $senha_err;?></span>
                                    </div>
                                </div>
                                
                                <ul class="actions">
                                    <li><input type="submit" class="primary" value="Verificar Login" /></li>
                                    <li><input type="reset" value="Resetar Campos" /></li>
                                </ul>
                            </form>
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
