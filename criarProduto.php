<?php
    // Include config file
    require_once "conexao.php";
    
    // Define variables and initialize with empty values
    $nomeProduto = "";
    $quantidade = 0;
    $dataCadastro = 0;
    $msg = "";
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validações
        $input_nomeProduto = trim($_POST["nomeProduto"]);
        if(empty($input_nomeProduto)){
            $msg = "Por favor, insira um produto.";
        } else{
            $nomeProduto = $input_nomeProduto;
        }

        $input_quantidade = trim($_POST["quantidade"]);
        if(empty($input_quantidade)){
            $msg = "Por favor, insira uma quantidade.";
        } else{
            $quantidade = $input_quantidade;
        }
        
        // Check input errors before inserting in database
        if(empty($msg)){
            // Prepare an insert statement
            $sql = "INSERT INTO produto (nomeProduto, quantidade, dataCadstro) VALUES (?, ?, ?);";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_nomeProduto, $param_quantidade, $param_dataCadastro);
                
                // Set parameters
                $param_nomeProduto = $nomeProduto;
                $param_dataCadastro = 0;
                $param_quantidade =$quantidade;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records created successfully. Redirect to landing page
                    header("location: criarProdutoSucesso.php");
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

                        <!-- Criar nomeProduto -->
                        <article id="criarnomeProduto">
                            <h2 class="major">Criar Produto</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="fields">
                                    <div class="field half">
                                        <label>Nome produto</label>
                                        <input type="text" name="nomeProduto" class="form-control <?php echo (!empty($msg)) ? 'is-invalid' : ''; ?>" value="<?php echo $nomeProduto; ?>">
                                        <span class="invalid-feedback"><?php echo $msg;?></span>
                                    </div>

                                    <div class="field half">
                                        <label>quantidade</label>
                                        <input type="password" name="quantidade" class="form-control <?php echo (!empty($msg)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantidade; ?>">
                                        <span class="invalid-feedback"><?php echo $msg;?></span>
                                    </div>
                                </div>
                                
                                <ul class="actions">
                                    <li><input type="submit" class="primary" value="Criar Usuário" /></li>
                                    <li><input type="reset" value="Resetar Campos" /></li>
                                    <li><input type="button" value="Voltar" class="button_active" onclick="location.href='index.php';" /></li>
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
