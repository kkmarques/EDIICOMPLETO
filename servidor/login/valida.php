<?php

session_start();
include_once ('../conexao.php');

if ((isset($_POST['usuario'])) && (isset($_POST['senha']))) {

    $usuario = pg_escape_string($db, $_POST['usuario']);
    $senha = pg_escape_string($db, $_POST['senha']);


    $query = 'SELECT * FROM "schemaA".usuarios WHERE "Usuario" = $1 and "Senha" = $2';

    $result = pg_prepare($db, "my_query", $query);
    $result = pg_execute($db, "my_query", array($usuario, $senha));

    $resultado = pg_fetch_assoc($result);
    
    echo $resultado;

    if (empty($resultado)) {
        $_SESSION['loginError'] = "Usuário ou senha inválido!";
        header("Location:../../index.php");
        
    } else {
        $_SESSION['usuario'] = $resultado['Usuario'];
         $_SESSION['cpfUsuario'] = $resultado['CpfUsuario'];
        $_SESSION['nomeUsuario'] = $resultado['Nome'];
        $_SESSION['cidade'] = $resultado['Cidade'];
        $_SESSION['bairro'] = $resultado['Bairro'];
        pg_close($db);
        header("Location: ../../html/index.php");
    }
} else {
    $_SESSION['loginError'] = "Usuário ou senha inválido!";
    header("Location:../../index.php");
}
?>
