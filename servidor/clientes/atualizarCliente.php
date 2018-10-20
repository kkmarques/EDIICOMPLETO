<?php
session_start();
include_once ('../conexao.php');

    $nome = pg_escape_string($_POST['modalnome']);
    $endereco = pg_escape_string($_POST['modalendereco']);
    $telefoneCelular = pg_escape_string($_POST['modaltelefoneCelular']);
    $cpf = pg_escape_string($_POST['modalcpf']);
    $bairro = pg_escape_string($_POST['modalbairro']);
    $dependencia = pg_escape_string($_SESSION['idDependenciaUsuario']);
    $email = pg_escape_string($_POST['modalemail']);
    $cidade = pg_escape_string($_POST['modalcidade']);
    $profissao = pg_escape_string($_POST['modalprofissao']);
    $telefoneResidencial = pg_escape_string($_POST['modaltelefoneResidencial']);
    
    
    
    $cpf = str_replace(".","",$cpf);
    $cpf = str_replace("-","",$cpf);
    
    $telefoneResidencial = str_replace("(","",$telefoneResidencial);
    $telefoneResidencial = str_replace(" ","",$telefoneResidencial);
    $telefoneResidencial = str_replace(")","",$telefoneResidencial);
    $telefoneResidencial = str_replace("-","",$telefoneResidencial);

    
    $telefoneCelular = str_replace("(","",$telefoneCelular);
    $telefoneCelular = str_replace(" ","",$telefoneCelular);
    $telefoneCelular = str_replace(")","",$telefoneCelular);
    $telefoneCelular = str_replace("-","",$telefoneCelular);
    
    
    
    
$query = 'UPDATE cliente SET "Celular"=$1, "Bairro"=$2, "Email"=$3, "Cidade"=$4, "Profissao"=$5, "Nome"=$6, "Endereco"=$7, "TelefoneResidencial"=$8 WHERE "Cpf"=$9;';
$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array(floatval($telefoneCelular), $bairro, $email, $cidade, strval($profissao), $nome, $endereco, floatval($telefoneResidencial), floatval($cpf)));
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
    $_SESSION['mensagemAdicionadoCliente'] = "O cliente ".$nome." foi atualizado com sucesso!";
    pg_close($db);
    header("Location:../../administrador/src/html/clientes.php");
}



?>