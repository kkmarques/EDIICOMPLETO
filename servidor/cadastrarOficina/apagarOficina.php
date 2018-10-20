<?php
session_start();
include_once ('../conexao.php');

    
    $idOficina = pg_escape_string($_POST['idOficina']);
   $cpf =  $_SESSION['cpfUsuario'];
 

$query = 'DELETE FROM "schemaA".oficina
 WHERE "IdOficina" = $1 AND "CpfUsuario" = $2';


$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array(floatval($idOficina), $cpf));
//

$error = pg_last_error($db);

if ($result === false) { 
    
    //Mensagem de erros;
    if (preg_match('/duplicate/i', $error)) {
        $_SESSION['mensagemErrorCliente'] = "O cliente ".$nome." já existe em sua base de dados!";
        header("Location:../../html/index.php");
    }
    pg_close($db);
} else {
    $_SESSION['oficinaApagada'] = "Você apagou oficina.";
    pg_close($db);
    header("Location:../../html/index.php");
}



?>

