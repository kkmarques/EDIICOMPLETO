<?php

session_start();
include_once ('../conexao.php');

$cpf =  pg_escape_string($_POST['cpf']);
$idOficina = pg_escape_string($_POST['idOficina']);
$descricao = pg_escape_string($_POST['descricao']);




$query = 'INSERT INTO "schemaA"."Pedido"(
             "CpfUsuario", "IdOficina", "DescricaoSolicitacao", 
            "Status")
    VALUES ($1, $2, $3, 
            $4);
;
';


$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array($cpf, $idOficina , $descricao, "false" ));
//

$error = pg_last_error($db);

if ($result === false) {

    //Mensagem de erros;
    if (preg_match('/duplicate/i', $error)) {
        $_SESSION['mensagemErroOficina'] = "Você já está cadastrado " . $nome . "";
        header("Location:../../html/index.php");
    }
    pg_close($db);
} else {
    $_SESSION['mensagemOficina'] = "A oficina " . $nome . " já esta cadastrada.";
    pg_close($db);
    header("Location:../../html/index.php");
}

?>