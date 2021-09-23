<?php

    require_once "conexao.php";
    
    $nomeProduto = "";
    $quantidade = 1;
    $dataCadastro = '';
    $produto_err = $quantidade_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $input_nomeProduto = trim($_POST["nomeProduto"]);
        if(empty($input_nomeProduto)){
            $produto_err = "Por favor, insira um produto.";
        } else{
            $nomeProduto = $input_nomeProduto;
        }

        $input_quantidade = trim($_POST["quantidade"]);
        if(empty($input_quantidade)){
            $quantidade_err = "Por favor, insira uma quantidade.";
        } else{
            $quantidade = $input_quantidade;
        }
        
        if(empty($produto_err) && empty($quantidade_err)){
            $sql = "INSERT INTO produto (id, nomeProduto, quantidade, dataCadastro) VALUES (?, ?, ?, ?);";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "ssis", $param_id, $param_nomeProduto, $param_quantidade, $param_dataCadastro);
                
                $param_id = sha1(bin2hex(random_bytes(90)));
                $param_nomeProduto = $nomeProduto;
                $param_dataCadastro = date("Y-m-d");
                $param_quantidade = $quantidade;
                
                if(mysqli_stmt_execute($stmt)){
                    echo "<script>alert('Você criou um produto com sucesso!')</script>";
                    header("location: listarProduto.php");
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
    <title>Cripto - Criar Produto</title>
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
                    <span class="fas fa-list fa-2x"></span>
                </div>
                
                <div class="content">
                    <div>
                        </br>
                        <h1>Criar Produto</h1>

                        <section>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="fields">
                                    <div class="field half">
                                        <label>Nome do produto</label>
                                        <input type="text" name="nomeProduto" class="form-control <?php echo (!empty($produto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nomeProduto; ?>">
                                        <span class="invalid-feedback"><?php echo $produto_err;?></span>
                                    </div>

                                    <div class="field half">
                                        <label>Quantidade</label>
                                        <input type="text" name="quantidade" class="form-control <?php echo (!empty($quantidade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantidade; ?>">
                                        <span class="invalid-feedback"><?php echo $quantidade_err;?></span>
                                    </div>
                                </div>
                                
                                <ul class="actions" style="display: inline-flex;">
                                    <li><input type="submit" class="primary" value="Criar Produto" /></li>
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
