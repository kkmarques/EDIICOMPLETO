<?php

session_start();
include_once ('../conexao.php');

$cpf = $_SESSION['cpfUsuario'];
$cidade = pg_escape_string($_POST['cidade']);
$bairro = pg_escape_string($_POST['bairro']);
$usuario = pg_escape_string($_POST['usuario']);


$query = 'UPDATE "schemaA".usuarios
       SET "Cidade"= $1, "Bairro"= $2, "Usuario" =$3 WHERE "CpfUsuario"=$4 ;';


$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array($cidade,  $bairro,$usuario, $cpf));
//

$error = pg_last_error($db);

if ($result === false) {

    //Mensagem de erros;
    if (preg_match('/duplicate/i', $error)) {
        $_SESSION['mensagemErrorCliente'] = "Você já está cadastrado " . $nome . "";
        header("Location:../../cadastro.php");
    }
    pg_close($db);
} else {
    $_SESSION['mensagemContacriada'] = "Cidade e bairro atualizado com sucesso! Entre novamente " . $nome . " ";
    pg_close($db);
    header("Location:../../index.php");
}
?>
