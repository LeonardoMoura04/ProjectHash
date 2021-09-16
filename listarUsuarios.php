<?php
require("conexao.php");
$query = "SELECT * FROM usuario";
$result = mysqli_query($conexao, $query) or die(mysqli_error($conexao));
$msg = "nenhum usuario encontrado";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cadastro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
	
	<div class="limiter">
		<div class="">
			<div class="">

            <table class="table">
                <thead>
                    <th> ID </th>
                    <th> usuario </th>
                    <th> bcript </th>
                </thead>
                <tbody>   
                    <?php 

                        while($usuario = mysqli_fetch_array($result)){
                            echo"
                            <tr> 
                            <td>" . $usuario['ID . '] . "</td>     
                            <td>" . $usuario['usuario'] . "</td>     
                            <td>" . Password_hash($usuario['senha'], PASSWORD_BCRYPT, ['cost' => 8, 'salt' => 'asdfgwerwasdqweasdasda']). "</td>
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
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>