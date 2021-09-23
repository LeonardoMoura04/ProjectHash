<?php
    require_once "conexao.php";
    
    $usuario = $senha = "";
    $usuario_err = $senha_err = "";
    
    if(isset($_POST["id"]) && !empty($_POST["id"])){

        $id = $_POST["id"];
        
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

        echo "teste variaveis";
        
        if(empty($usuario_err) && empty($senha_err)){
            $sql = "UPDATE login
                    SET 
                        usuario = ?, 
                        senha = ?, 
                        salt = ?
                    WHERE
                        id = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sssi", $param_usuario, $param_senha, $param_salt, $param_id);
                
                $param_usuario = $usuario;
                $param_salt = sha1(bin2hex(random_bytes(90)));
                $param_senha = hash('sha256', $senha . $param_salt);
                $param_id = $id;
                
                if(mysqli_stmt_execute($stmt)){
                    echo "<script>alert('Você alterou seu usuário com sucesso!')</script>";
                    header("location: listarUsuarios.php");
                } else{
                    echo "<script>alert('Erro. Algo deu errado. Por favor, tente novamente.')</script>";
                }
            }
            
            mysqli_stmt_close($stmt);
        }
        
        mysqli_close($link);
    } else{
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            $id =  trim($_GET["id"]);
            
            $sql = "SELECT * FROM login WHERE id = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                $param_id = $id;
                
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
        
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        $usuario = $row["usuario"];
                    } else{
                        echo "<script>alert('Erro. Algo deu errado. Por favor, tente novamente.')</script>";
                    }
                    
                } else{
                    echo "<script>alert('Erro. Algo deu errado. Por favor, tente novamente.')</script>";
                }
            }
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($link);

        }  else{
            echo "<script>alert('Erro. Algo deu errado. Por favor, tente novamente.')</script>";
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Cripto - Alterar Usuário</title>
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
                        <h1>Alterar Usuário</h1>

                        <section>
                            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                                <div class="fields">
                                    <div class="field half">
                                        <label>Usuário</label>
                                        <input type="text" name="usuario" class="form-control <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>">
                                        <span class="invalid-feedback"><?php echo $usuario_err;?></span>
                                    </div>

                                    <div class="field half">
                                        <label>Senha Nova</label>
                                        <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                                        <span class="invalid-feedback"><?php echo $senha_err;?></span>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                </div>
                                
                                <ul class="actions">
                                    <li><input type="submit" class="primary" value="Alterar Usuário" /></li>
                                    <li><input type="reset" value="Resetar Campos" /></li>
                                </ul>
                            </form>
                        </section>
                    </div>
                </div>

                <nav>
                    <ul>
                        <li><a href="listarUsuarios.php">Voltar</a></li>
                    </ul>
                </nav>

            </header>                

            <!-- Footer -->
            <footer id="footer">
                <p class="copyright">&copy; DLM. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
            </footer>

        </div>
			<div id="wrapper">

				<!-- Main -->
					<div id="main">

                        <!-- Criar nomeProduto -->
                        
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
