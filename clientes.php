<?php include("menu.php") ?>

<?php
    include('conexao.php');
    $sql_clientes = "SELECT * FROM clientes";
    $query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
    $num_clientes = mysqli_num_rows($query_clientes);
    echo "clientes:". $num_clientes;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de CLiente</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Clientes</h1>    
    
    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Cadastro</th>
            <th>Comandos</th>
        </thead>
        <tbody>

            <?php
                if($num_clientes <= 0) { ?>
                    <td>
                        <td colspan="7">BlaNenhum Cliente Cadastrado.</td>
                    </td>

                <?php }
                else {
                    while ($cliente = $query_clientes->fetch_assoc())
                    {
                        $telefone = "Não informado.";
                        if(!empty($cliente['telefone']))
                        {
                            $telefone = formatar_telefone($cliente['telefone']);
                        }

                        $nascimento = "Não informado.";
                        if(!empty($cliente['nascimento']))
                        {
                            $nascimento = formatar_data($cliente['nascimento']);
                        }

                        $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data_cadastro']));

                        ?>
                        <tr>
                            <td><?php echo($cliente['id']) ?></td>
                            <td><?php echo($cliente['nome']) ?></td>
                            <td><?php echo($cliente['email']) ?></td>
                            <td><?php echo($telefone) ?></td>
                            <td><?php echo($nascimento) ?></td>
                            <td><?php echo($data_cadastro) ?></td>
                            <td>
                                <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                                <a href="deletar_cliente.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
                            </td>
                        </tr>
                        <?php }
                    ?>
                <?php }
            ?>

        </tbody>

    </table>

</body>
</html>
