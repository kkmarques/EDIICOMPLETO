<?php
//Aqui colocamos o servidor em que está o nosso banco de dados, no nosso exemplo é a conexão com um servidor local, portanto localhost
$servidor = "hugoricchino.com.br";
//Aqui é o nome de usuário do seu banco de dados, root é o servidor inicial e básico de todo servidor, mas recomenda-se não usar o usuario root e sim criar um novo usuário
$usuario = "hugoricc_usuariotcc";
//Aqui colocamos a senha do usuário, por padrão o usuário root vem sem senha, mas é altamente recomendável criar uma senha para o usuário root, visto que ele é o que tem mais privilégios no servidor
$senha ="wDIwD][e{~ic";


//Aqui criamos a conexão utilizando o servidor, usuario e senha, caso dê erro, retorna um erro ao usuário.
$db = pg_connect("host=$servidor port=5432 dbname=hugoricc_tcc user=$usuario password=$senha ") or die ("Não foi possível conectar ao servidor PostGreSQL");
//caso a conexão seja efetuada com sucesso, exibe uma mensagem ao usuário
