<?php
session_start();
include_once ('../conexao.php');

    
    $cpf = $_SESSION['cpfUsuario'];
   
 

$query = 'DELETE FROM "schemaA".usuarios
 WHERE "CpfUsuario" = $1;
';
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
    $_SESSION['contaApagada'] = "Você apagou sua conta com sucesso!";
    pg_close($db);
    header("Location:../../index.php");
}



?>
