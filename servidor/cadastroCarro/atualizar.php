<?php

session_start();
include_once ('../conexao.php');

$cpf =  $_SESSION['cpfUsuario'];
$cor = pg_escape_string($_POST['cor']);
$id = pg_escape_string($_POST['id']);
$placa = pg_escape_string($_POST['placa']);



$query = 'UPDATE "schemaA".veiculos
   SET "CorVeiculo"=$1, "PlacaVeiculo"=$2
 WHERE "Id" = $3 and "CpfUsuario" = $4;';


$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array($cor,$placa, $id, $cpf));
//

$error = pg_last_error($db);

if ($result === false) {

    //Mensagem de erros;
    if (preg_match('/duplicate/i', $error)) {
        $_SESSION['mensagemErroCadastroVeiculo'] = "Carro já está cadastrado " . $placa . "";
        header("Location:../../html/index.php");
    }
    pg_close($db);
} else {
    $_SESSION['carroAtualizadoComSucesso'] = "Cor do veiculo atualizada com sucesso!";
    pg_close($db);
    header("Location:../../html/index.php");
}
?>
<a href=""></a>