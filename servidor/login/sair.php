<?php

session_start();

unset(
         $_SESSION['usuario'],
         $_SESSION['cpfUsuario'],
        $_SESSION['nomeUsuario'],
        $_SESSION['cidade'],
        $_SESSION['bairro']
        
);
    header ("Location: ../../index.php")
?>