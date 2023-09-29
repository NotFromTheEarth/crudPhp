<?php
    function retornar_somente_numeros($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }
    
    $erro = false;
    include('conexao.php');
    $id = intval($_GET['id']);

    if(count($_POST) > 0)
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];

        if(strlen($nome) < 2 || empty($nome))
        {
            $erro = "Preencha o nome";
        }
        
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $erro = "Preencha o e-mail";
        }
        
        if(!empty($nascimento))
        {
            $pedacos = explode ('/', $nascimento);
            if(count($pedacos) == 3)
            {
                $nascimento = implode('-', array_reverse($pedacos));
            }
            else
            {
                $erro = "A data de nascimento deve seguir o padrão dia/mes/ano.";
            }
        }

        if(!empty($telefone))
        {
            $telefone = retornar_somente_numeros($telefone);
            if(strlen($telefone) != 11)
            {
                $erro = "O telefone deve ser preenchido no padrão (11) 98888-1234.";
            }
        }

        if($erro)
        {
            echo "<p><b>$erro</b></p>";
        }
        else
        {
            $sql_code = "UPDATE clientes
            SET nome = '$nome',
            email = '$email',
            telefone = '$telefone',
            nascimento = '$nascimento'
            WHERE id = '$id'
            ";

            $mysqli->query($sql_code) or die($mysqli->error);
            echo "<b>Cliente alterado com sucesso</b>";
            unset($_POST);
        }
    }

    $sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
    $query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
    $cliente = $query_cliente->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <H1>Editar Cliente</H1>
    <a href="clientes.php">Voltar para a lista</a>
    <br><br>

    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $cliente['nome']?>">
        <br><br>

        <label>E-mail:</label>
        <input type="text" name="email" value="<?php echo $cliente['email']?>">
        <br><br>

        <label>Telefone:</label>
        <input placeholder="(11) 98888-1234" type="text" name="telefone" value="<?php echo formatar_telefone($cliente['telefone']) ?>">
        <br><br>

        <label>Nascimento:</label>
        <input type="text" name="nascimento" value="<?php echo formatar_data($cliente['nascimento']); ?>">
        <br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>