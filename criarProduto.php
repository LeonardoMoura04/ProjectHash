<?php
    // Include config file
    require_once "conexao.php";
    
    // Define variables and initialize with empty values
    $produto = "";
    $quantidade = "";
    $dataCadastro = null;
    $produto_err = $quantidade_err = $dataCadastro_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validações
        $input_produto = trim($_POST["produto"]);
        if(empty($input_produto)){
            $produto_err = "Por favor, insira seu produto.";
        } else{
            $produto = $input_produto;
        }

        $input_quantidade = trim($_POST["quantidade"]);
        if(empty($input_quantidade)){
            $quantidade_err = "Por favor, insira sua quantidade.";
        } else{
            $quantidade = $input_quantidade;
        }
        
        // Check input errors before inserting in database
        if(empty($produto_err) && empty($quantidade_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO produto (id, nomeProduto, quantidade, dataCadastro) VALUES (?, ?, ?, ?);";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssis",$param_id, $param_produto, $param_quantidade, $param_dataCadastro);
                
                // Set parameters
                $param_id = sha1(bin2hex(random_bytes(90)));
                $param_produto = $produto;
                $param_quantidade = $quantidade;
                $param_dataCadastro = date("Y-m-d");
                
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
		<title>Criptografia PHP - Criar Produto</title>
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

                        <!-- Criar produto -->
                        <article id="criarProduto">
                            <h2 class="major">Criar Produto</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="fields">
                                    <div class="field half">
                                        <label>Nome Produto</label>
                                        <input type="text" name="produto" class="form-control <?php echo (!empty($produto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $produto; ?>">
                                        <span class="invalid-feedback"><?php echo $produto_err;?></span>
                                    </div>

                                    <div class="field half">
                                        <label>quantidade</label>
                                        <input type="text" name="quantidade" class="form-control <?php echo (!empty($quantidade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantidade; ?>">
                                        <span class="invalid-feedback"><?php echo $quantidade_err;?></span>
                                    </div>
                                </div>
                                
                                <ul class="actions">
                                    <li><input type="submit" class="primary" value="Cadastrar Produto"/></li>
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
