<?php
    // Include config file
    require_once "conexao.php";
    
    // Define variables and initialize with empty values
    $usuario = $senha = "";
    $usuario_err = $senha_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validações
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
        
        // Check input errors before inserting in database
        if(empty($usuario_err) && empty($senha_err)){
            $sql = "SELECT * FROM login WHERE usuario = ?";
        
            if($stmt = mysqli_prepare($link, $sql)){

                mysqli_stmt_bind_param($stmt, "s", $param_usuario);
                $param_usuario = $usuario;
                
                if(mysqli_stmt_execute($stmt)){

                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        echo "Usuário Banco: " . $row["usuario"] . "</br>";
                        echo "Senha Banco: " . $row["senha"] . "</br>";
                        echo "Salt Banco: " . $row["salt"] . "</br>";
                        echo "Senha Raw: " . $senha . "</br>";
                        echo "Senha com Salt: " . hash('sha256', $senha . $row["salt"]) . "</br>";
                        
                        $usuarioBanco = $row["usuario"];
                        $senhaBanco = $row["senha"];
                        $saltBanco = $row["salt"];

                        if(password_verify(hash('sha256', $senha . $saltBanco), $senhaBanco)){
                            echo "DEU CERTO";

                            // header("location: index.php");
                            // exit();
                        }

                        
                        

                    } else{
                        header("location: ERROR_TO_DEFINE.php");
                        exit();
                    }
                    
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
            
            // Close connection
            mysqli_close($link);
        }
    }
?>

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
								<h1>FOI LOGADO COM SUCESSO!</h1>
								<p>Aqui neste site, iremos exemplificar e colocar em prática os ensinamentos que foram apresentados <br></br>
                                    pelo Prof. Gregory Oliveira, do UNASP. Clique na aba "Cripto" abaixo para saber mais.
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
                            <span class="image main"><img src="images/pic01.jpg" alt="" /></span>
                            <p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. By the way, check out my <a href="#work">awesome work</a>.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus rutrum facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tristique libero eu nibh porttitor fermentum. Nullam venenatis erat id vehicula viverra. Nunc ultrices eros ut ultricies condimentum. Mauris risus lacus, blandit sit amet venenatis non, bibendum vitae dolor. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In non lorem sit amet elit placerat maximus. Pellentesque aliquam maximus risus, vel sed vehicula.</p>
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
