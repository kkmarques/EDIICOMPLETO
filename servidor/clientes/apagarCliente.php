<?php
session_start();
include_once ('../conexao.php');

    $nome = pg_escape_string($_POST['nome']);
    $cpf = pg_escape_string($_POST['cpf']);
   
 

$query = 'DELETE FROM cliente WHERE "Cpf" = $1;';
$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array(floatval($cpf)));
//

$error = pg_last_error($db);

if ($result === false) { 
    
    //Mensagem de erros;
    if (preg_match('/duplicate/i', $error)) {
        $_SESSION['mensagemErrorCliente'] = "O cliente ".$nome." já existe em sua base de dados!";
        header("Location:../../administrador/src/html/clientes.php");
    }
    pg_close($db);
} else {
    $_SESSION['mensagemAdicionadoCliente'] = "O cliente ".$nome." foi apagado com sucesso!";
    pg_close($db);
    header("Location:../../html/relatorioClientes.php");
}



?>