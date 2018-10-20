<?php

session_start();
include_once ('../conexao.php');

$cpf = pg_escape_string($_POST['cpf']);
$nome = pg_escape_string($_POST['nome']);
$endereco = pg_escape_string($_POST['endereco']);
$cidade = pg_escape_string($_POST['cidade']);
$telefonePrincipal = pg_escape_string($_POST['telefoneresidencial']);
$bairro = pg_escape_string($_POST['bairro']);
$email = pg_escape_string($_POST['email']);
$usuario = pg_escape_string($_POST['usuario']);
$senha = pg_escape_string($_POST['senha']);



$query = 'INSERT INTO "schemaA".usuarios(
            "CpfUsuario", "Nome", "Endereco", "TelefoneResidencial", "Cidade", 
            "Bairro", "Email", "Usuario", "Senha")
    VALUES ($1, $2, $3, $4, $5, 
            $6, $7, $8, $9);';


$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array($cpf, $nome, $endereco, $telefonePrincipal, $cidade, $bairro, $email, $usuario, $senha));
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
    $_SESSION['mensagemContacriada'] = "Você " . $nome . " já pode logar no sistema!";
    pg_close($db);
    header("Location:../../index.php");
}
?>
<a href="../../index.php"></a>
<a href=""></a>