<?php
    if(isset($_POST['confirmar']))
    {
        include("conexao.php");
        $id = $_GET['id'];
        $sql_code = "DELETE FROM clientes WHERE id = '$id'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

        if($sql_query)
        {
            ?>
                <link rel="stylesheet" href="style.css">
                <h1>Cliente deletado com sucesso.</h1>
                <a href="clientes.php">Retornar.</a>
            <?php
            die();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tem certeza que deseja deletar esse cliente?</h1>
    <a href="clientes.php"><button>Não</button></a>
    <form action="" method="post">
        <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
</body>
</html>