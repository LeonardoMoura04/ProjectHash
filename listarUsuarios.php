<?php
    require_once "conexao.php";
    $query = "SELECT * FROM login";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    $usuario = "";
    $usuario_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pesquisa = $_POST['usuario'];
        $query = "SELECT * FROM login WHERE usuario LIKE '%$pesquisa%'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Cripto - Listar Usuários</title>
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
                    <span class="icon fa-user"></span>
                </div>
                
                <div class="content">
                    <div>
                        </br>
                        <h1>Listagem de Usuários</h1>

                        <section>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: inline-block; ">
                                
                                <label>Buscar Usuário</label>
                                <div class="fields">
                                    <div class="field">
                                        <input type="text" name="usuario" class="form-control center <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>">
                                        <span class="invalid-feedback"><?php echo $usuario_err;?></span>
                                    </div>
                                </div>
                                
                                <ul class="actions">
                                    <li><input type="submit" class="primary" value="Buscar Usuário" /></li>
                                    <li><input type="reset" value="Resetar Campos" /></li>
                                </ul>
                            </form>

                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuário</th>
                                            <th>Senha</th>
                                            <th>Salt</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($usuariosBanco = mysqli_fetch_array($result)) {
                                                echo "
                                                <tr> 
                                                    <td>" . $usuariosBanco['id'] . "</td>     
                                                    <td>" . $usuariosBanco['usuario'] . "</td>     
                                                    <td>" . str_repeat("*", strlen($usuariosBanco['senha'])) . "</td>
                                                    <td>" . str_repeat("*", strlen($usuariosBanco['salt'])) . "</td>
                                                    <td>";
                                                       echo '<a href="alterarUsuario.php?id='. $usuariosBanco['id'] .'" class="mr-3" title="Atualizar Registro" data-toggle="tooltip"><span class="fa fa-pencil-alt" style="margin-right: 15px"></span></a>';
                                                       echo "</td>";
                                                    echo "</tr>";
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
