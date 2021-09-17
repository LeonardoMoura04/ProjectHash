<!DOCTYPE html>
<html lang="en">

<head>
	<title>Cadastro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>
	<?php
	require("conexao.php");
	$query = "SELECT * FROM produto";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$msg = "nenhum produto encontrado";
	?>

	<form method="POST" action="">
		<input type="text" id="buscar" name="buscar" value=""><br>
		<input type="submit" value="Buscar">
	</form>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$Pesquisa = $_POST['buscar'];
		$query = "SELECT * FROM produto WHERE nomeProduto LIKE '%$Pesquisa%'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$msg = "nenhum produto encontrado";
	}
	?>



	<div class="limiter">
		<div class="">
			<div class="">

				<table class="table">
					<thead>
						<th> ID </th>
						<th> Produto </th>
						<th> Quantidade </th>
						<th> Data Cadastro </th>
					</thead>
					<tbody>
						<?php
						while ($produto = mysqli_fetch_array($result)) {
							echo "
                            <tr> 
                            <td>" . $produto['id'] . "</td>     
                            <td>" . $produto['nomeProduto'] . "</td>     
                            <td>" . $produto['quantidade'] . "</td>
                            <td>" . $produto['dataCadastro']  . "</td>
                            </tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>