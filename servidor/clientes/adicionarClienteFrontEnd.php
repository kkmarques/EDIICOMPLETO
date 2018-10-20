<?php
session_start();
include_once ('../conexao.php');
    $cpf = pg_escape_string($_POST['cpf']);
    $cpf = str_replace(".","",$cpf);
    $cpf = str_replace("-","",$cpf);
    
    $nome = pg_escape_string($_POST['nome']);
    $idade = pg_escape_string($_POST['idade']);
    
    $datanascimento = pg_escape_string($_POST['dataNascimento']);
    $sexo = pg_escape_string($_POST['sexo']);
    $estadoCivil = pg_escape_string($_POST['estadoCivil']);
    $filhos = pg_escape_string($_POST['filhos']);
    $escolaridade = pg_escape_string($_POST['escolaridade']);
    $profissao = pg_escape_string($_POST['profissao']);
    $rendaMensal = pg_escape_string($_POST['rendaMensal']);
    
    
    $portugues = pg_escape_string($_POST['portuguesHabilitado']);
    $ingles = pg_escape_string($_POST['inglesHabilitado']);
    $espanhol = pg_escape_string($_POST['espanholHabilitado']);
    $frances = pg_escape_string($_POST['francesHabilitado']);
    $italiano = pg_escape_string($_POST['italianoHabilitado']);
    
    
    $telefonePrincipal = pg_escape_string($_POST['telefonePrincipal']);
    $telefonePrincipal = str_replace("(","",$telefonePrincipal);
    $telefonePrincipal = str_replace(" ","",$telefonePrincipal);
    $telefonePrincipal = str_replace(")","",$telefonePrincipal);
    $telefonePrincipal = str_replace("-","",$telefonePrincipal);
    
    
    $telefoneSecundario = pg_escape_string($_POST['telefoneSecundario']);
    $telefoneSecundario = str_replace("(","",$telefoneSecundario);
    $telefoneSecundario = str_replace(" ","",$telefoneSecundario);
    $telefoneSecundario = str_replace(")","",$telefoneSecundario);
    $telefoneSecundario = str_replace("-","",$telefoneSecundario);
    
    
    $cidade = pg_escape_string($_POST['cidade']);
    $endereco = pg_escape_string($_POST['endereco']);
    $email = pg_escape_string($_POST['email']);
    $bairro = pg_escape_string($_POST['bairro']);
    
    
    $facebook = pg_escape_string($_POST['facebook']);
    $instagram = pg_escape_string($_POST['instagram']);
    $outrasRedes = pg_escape_string($_POST['outrasRedes']);
    
    $principaisEstilosMusicais = pg_escape_string($_POST['principaisEstilosMusicais']);
    $informacoesPreferenciais = pg_escape_string($_POST['informacoesPreferenciais']);
    
    
    $classificacaoPessoal = pg_escape_string($_POST['classificacaoPessoal']);
    $atividadesFisicas = pg_escape_string($_POST['atividadesFisicas']);
    
    
    $comoChegouAteNos = pg_escape_string($_POST['comoChegouAteNos']);
    $realizouCurso = pg_escape_string($_POST['realizouCurso']);
    $cursoRealizado = pg_escape_string($_POST['cursoRealizado']);
    $investimento = pg_escape_string($_POST['investimentoRealizado']);
    

    
    
    
$query = 'INSERT INTO public.cliente("Cpf", "Nome", "Idade", "DataNascimento", "Sexo", "EstadoCivil", 
            "Profissao", "Filhos", "Escolaridade", "RendaMensal", "Ingles", 
            "Espanhol", "Portugues", "Frances", "Italiano", "Endereco", "Email", 
            "TelefonePrincipal", "TelefoneSecundario", "Facebook", "Instagram", 
            "Outras", "EstiloMusical", "InformaçõesPreferenciais", "ClassificacaoPessoal", 
            "PraticanteDeAtividade", "ChegouAteNos", "CursoInstituto", "CursoQual", 
            "Investimento", "Cidade", "Bairro")
    VALUES ($1, $2, $3, $4, $5, $6, 
            $7, $8, $9, $10, $11, 
            $12, $13, $14, $15, $16, $17, 
            $18, $19, $20, $21, 
            $22, $23, $24, $25, 
            $26, $27, $28, $29, 
            $30, $31, $32);
';
$result = pg_prepare($db, "my_query", $query);
$result = pg_execute($db, "my_query", array(floatval($cpf), $nome,  $idade, $datanascimento, $sexo, $estadoCivil, $profissao, $filhos, $escolaridade, $rendaMensal, 
    $ingles, $espanhol, $portugues, $frances, $italiano, $endereco, $email, $telefonePrincipal, 
    $telefoneSecundario,$facebook, $instagram,$outrasRedes, $principaisEstilosMusicais, $informacoesPreferenciais, 
    $classificacaoPessoal, $atividadesFisicas, $comoChegouAteNos, $realizouCurso, $cursoRealizado, $investimento, $cidade, $bairro ));
//

$error = pg_last_error($db);

if ($result === false) { 
    
    //Mensagem de erros;
    if (preg_match('/duplicate/i', $error)) {
        $_SESSION['mensagemErrorCliente'] = "Ops! Você já está cadastrado na base de dados!";
        header("Location:../../../pesquisa.php");
    }
    pg_close($db);
} else {
    $_SESSION['mensagemAdicionadoCliente'] = "Parabéns!  ".$nome." você se cadastrou com sucesso!";
    pg_close($db);
    header("Location:../../../pesquisa.php");
}



?>
