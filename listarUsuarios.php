<?php
require("conexao.php");
$query = "SELECT * FROM login";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$msg = "nenhum usuario encontrado";
?>

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!--===============================================================================================-->
</head>

<body>
<form method="POST" action="">
        <input type="text" id="buscar" name="buscar" value=""><br>
        <input type="submit" value="Buscar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $Pesquisa = $_POST['buscar'];
        $query = "SELECT * FROM login WHERE usuario LIKE '%$Pesquisa%'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $msg = "nenhum usuario encontrado";
    }
    ?>
    <table class="table table-striped">
        <tbody>
            <table class="table">
                <thead>
                    <th> ID </th>
                    <th> usuario </th>
                    <th> senha </th>
                </thead>
                <tbody>
                    <?php
                    while ($usuario = mysqli_fetch_array($result)) {
                        echo "
                            <tr> 
                            <td>" . $usuario['id'] . "</td>     
                            <td>" . $usuario['usuario'] . "</td>        
                            <td> •••••••••••••••••••••••••</td>
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