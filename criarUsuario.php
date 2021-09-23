<?php
    require_once "conexao.php";
    
    $usuario = $senha = "";
    $usuario_err = $senha_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $input_usuario = trim($_POST["usuario"]);
        if(empty($input_usuario)){
            $usuario_err = "Por favor, insira seu usuário.";
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
            $sql = "INSERT INTO login (usuario, senha, salt) VALUES (?, ?, ?);";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sss", $param_usuario, $param_senha, $param_salt);
                
                // Set parameters
                $param_usuario = $usuario;
                $param_salt = sha1(bin2hex(random_bytes(90)));
                $param_senha = hash('sha256', $senha . $param_salt);
                
                if(mysqli_stmt_execute($stmt)){
                    echo "<script>alert('Você criou um usuário com sucesso!')</script>";
                    header("location: menu.php");
                    exit();
                } else{
                    echo "<script>alert('Erro. Algo deu errado. Por favor, tente novamente.')</script>";
                }

                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($link);
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Cripto - Criar Usuário</title>
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
                    <span class="icon fas fa-user"></span>
                </div>
                
                <div class="content">
                    <div>
                        </br>
                        <h1>Criar usuário</h1>

                        <section>
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
                                
                                <ul class="actions" style="display: inline-flex;">
                                    <li><input type="submit" class="primary" value="Criar Usuário" /></li>
                                    <li><input type="reset" value="Resetar Campos" /></li>
                                </ul>
                            </form>
                        </section>
                    </div>
                </div>

                <nav>
                    <ul>
                        <li><a href="menu.php">Voltar</a></li>
                    </ul>
                </nav>

            </header>                

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
