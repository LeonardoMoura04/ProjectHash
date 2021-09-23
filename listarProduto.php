<?php
    require_once "conexao.php";
    $query = "SELECT * FROM produto";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    $produto = "";
    $produto_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pesquisa = $_POST['produto'];
        $query = "SELECT * FROM produto WHERE nomeProduto LIKE '%$pesquisa%' OR quantidade LIKE '%$pesquisa%' OR dataCadastro LIKE '%$pesquisa%'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Cripto - Listar Produtos</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload" style="text-align: center;">

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
                        <h1>Listagem de Produtos</h1>

                        <section>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: inline-block;">
                                
                                <label>Buscar Produto</label>
                                <div class="fields">
                                    <div class="field">
                                        <input type="text" name="produto" class="form-control <?php echo (!empty($produto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $produto; ?>">
                                        <span class="invalid-feedback"><?php echo $produto_err;?></span>
                                    </div>
                                </div>
                                
                                <ul class="actions">
                                    <li><input type="submit" class="primary" value="Buscar Produto" /></li>
                                    <li><input type="reset" value="Resetar Campos" /></li>
                                </ul>
                            </form>

                            <ul class="actions" style="display: block;">
                                <li><a href="criarProduto.php" class="button primary icon solid">Criar Produto</a></li>
                            </ul>

                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Id Criptografado</th>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Data de Cadastro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($produtosBanco = mysqli_fetch_array($result)) {
                                                echo "
                                                <tr>
                                                    <td>" . $produtosBanco['id'] . "</td>
                                                    <td>" . $produtosBanco['nomeProduto'] . "</td>
                                                    <td>" . $produtosBanco['quantidade'] . "</td>
                                                    <td>" . date("d/m/Y", strtotime($produtosBanco['dataCadastro'])) . "</td>
                                                </tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
