<?php
    // Include config file
    require_once "conexao.php";
    
    // Define variables and initialize with empty values
    $usuarioCriar = $senhaCriar = $usuario = $senha = "";
    $usuarioCriar_err = $senhaCriar_err = $usuario_err = $senha_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validações
        $input_usuario = trim($_POST["usuarioCriar"]);
        if(empty($input_usuario)){
            $usuarioCriar_err = "Por favor, insira seu usuario.";
        } else{
            $usuarioCriar = $input_usuario;
        }

        $input_senha = trim($_POST["senhaCriar"]);
        if(empty($input_senha)){
            $senhaCriar_err = "Por favor, insira sua Senha.";
        } else{
            $senhaCriar = $input_senha;
        }
        
        // Check input errors before inserting in database
        if(empty($usuarioCriar_err) && empty($senhaCriar_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO login (usuario, senha, salt) VALUES (?, ?, ?);";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_usuario, $param_senha, $param_salt);

                echo "Senha Raw:" . $senha;
                
                // Set parameters
                $param_usuario = $usuarioCriar;
                $param_salt = sha1(bin2hex(random_bytes(90)));
                $param_senha = hash('sha256', $senha . $param_salt);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records created successfully. Redirect to landing page
                    header("location: index.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($link);
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Criptografia PHP - Criar Usuário</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">

                        <!-- Criar Usuario -->
                        <article id="criarUsuario">
                            <h2 class="major">Criar usuário</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="fields">
                                    <div class="field half">
                                        <label>Usuário</label>
                                        <input type="text" name="usuarioCriar" class="form-control <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>">
                                        <span class="invalid-feedback"><?php echo $usuario_err;?></span>
                                    </div>

                                    <div class="field half">
                                        <label>Senha</label>
                                        <input type="password" name="senhaCriar" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                                        <span class="invalid-feedback"><?php echo $senha_err;?></span>
                                    </div>
                                </div>
                                
                                <ul class="actions">
                                    <li><input type="submit" class="primary" value="Criar Usuário" /></li>
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
