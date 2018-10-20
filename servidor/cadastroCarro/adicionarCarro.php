<?php

session_start();
include_once ('../conexao.php');

$cpf =  $_SESSION['cpfUsuario'];
$placa = pg_escape_string($_POST['placa']);
$cor = pg_escape_string($_POST['cor']);
$modelo = pg_escape_string($_POST['modelo']);
$ano = pg_escape_string($_POST['ano']);
$fabricante = pg_escape_string($_POST['fabricante']);



$query = 'INSERT INTO "schemaA".veiculos(
           "CpfUsuario", "PlacaVeiculo", "CorVeiculo", "Modelo", "Ano", 
            "Fabricante")
    VALUES ($1, $2, $3, $4, $5, $6);';


$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array($cpf, $placa, $cor, $modelo, $ano, $fabricante));
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
    $_SESSION['mensagemSucessoCadastroVeiculo'] = "O carro da placa " . $placa . " foi cadastrado com sucesso!";
    pg_close($db);
    header("Location:../../html/index.php");
}
?>
<a href=""></a>