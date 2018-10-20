<?php
session_start();
include_once ('../conexao.php');

    
    $cpf = $_SESSION['cpfUsuario'];
   
 $idcarro = pg_escape_string($_POST['idcarro']);

$query = 'DELETE FROM "schemaA".veiculos
 WHERE "CpfUsuario" = $1 and "Id" = $2;
';
$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array(floatval($cpf), floatval($idcarro)));
//

$error = pg_last_error($db);

if ($result === false) { 
    
    //Mensagem de erros;
    if (preg_match('/duplicate/i', $error)) {
        $_SESSION['carroApagado'] = "O carro ".$nome." já existe em sua base de dados!";
        header("Location:../../html/index.php");
    }
    pg_close($db);
} else {
    $_SESSION['carroApagado'] = "Você apagou seu veiculo com sucesso!";
    pg_close($db);
    header("Location:../../html/index.php");
}



?>
