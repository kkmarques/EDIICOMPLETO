<?php
session_start();
include_once ('../servidor/conexao.php');


if (empty($_SESSION['nomeUsuario'])) {
    $_SESSION['loginError'] = "Por favor, faça seu login!";
    header("Location: ../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
        <?php include 'titulo.php'; ?>
        <!-- Bootstrap Core CSS -->
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Menu CSS -->
        <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <!-- animation CSS -->
        <link href="css/animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <!-- color CSS -->
        <link href="css/colors/default.css" id="theme" rel="stylesheet">
        <link href="bootstrap/dist/css/navbar.less" id="theme" rel="stylesheet">
        <link href="../resources/lib/datatables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body class="fix-header">
        <!-- ============================================================== -->
        <!-- Preloader -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Wrapper -->
        <!-- ============================================================== -->
        <div id="wrapper">


<!--            <input id="acessoAlterarClienteId" type="hidden" value="<?php echo $acessoAlterarCliente ?>">
<input id="acessoApagarClienteId" type="hidden" value="<?php echo $acessoApagarCliente ?>">-->

            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <?php include 'header.php'; ?>
            <!-- End Top Navigation -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <?php include 'menu.php'; ?>
            <!-- ============================================================== -->
            <!-- End Left Sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page Content -->
            <!-- ============================================================== -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Clientes</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Clientes</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- .row -->
                   
                    <form name="formulario" action="../servidor/clientes/adicionarCliente.php" method="POST" enctype="multipart/form-data" id="cadastroClientes" class="form-horizontal form-material">
                        <div class="row">

                            <div class="col-md-12 col-xs-12">
                                <div class="white-box">

                                    <h3>CADASTRO DE CLIENTES</h3>

                                    <br>
                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="fas fa-user"></i> Perfil</h2>
                                    <div class="form-group">
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>*CPF</label>
                                            <span id="mensagemCpf"></span>
                                            <input id="cpf"  name="cpf" required="" type="tel" class="form-control form-control-line"/><span id="resposta"></span>
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                            <br>
                                            <label>*Nome</label>
                                            <input type="text"  name="nome" required="" placeholder="" class="form-control form-control-line"> </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Idade</label>
                                            <input type="number"  name="idade" required="" placeholder="" class="form-control form-control-line"> 
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Data de Nascimento</label>
                                            <input type="date"  name="dataNascimento" required="" placeholder="" class="form-control form-control-line"> 
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Sexo</label>

                                            <select class="form-control form-control-line"  name="sexo">
                                                <option value="Feminino">Feminino</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Outros">Outros</option>
                                            </select>

                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Estado Civil</label>
                                            <select class="form-control form-control-line" name="estadoCivil" id="estado_civil">
                                                <option value="Solteiro">Solteiro</option>
                                                <option value="Casado">Casado</option>
                                                <option value="Separado">Separado</option>
                                                <option value="Divorciado">Divorciado</option>
                                                <option value="Viúvo">Viúvo</option>
                                                <option value="Amasiado">Amasiado</option>
                                            </select>
                                        </div>


                                    </div>

                                    <div class="form-group">




                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Filhos</label>
                                            <input type="number"  name="filhos"  class="form-control form-control-line"> 

                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Escolaridade</label>
                                            <select class="form-control form-control-line" name="escolaridade" id="escolaridade">
                                                <option value="Ensino Fundamental">Ensino Fundamental</option>
                                                <option value="Ensino Medio">Ensino Medio</option>
                                                <option value="Ensino Superior">Ensino Superior</option>
                                                <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
                                                <option value="Ensino Medio Incompleto">Ensino Medio Incompleto</option>
                                                <option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Profissão</label>
                                            <input type="text"  name="profissao"  class="form-control form-control-line"> 
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <br>
                                            <label>Renda mensal</label>
                                            <select class="form-control form-control-line" name="rendaMensal" id="escolaridade">
                                                <option value="100 a 600">De 100 a 600</option>
                                                <option value="600 a 1200">De 600 a 1200</option>
                                                <option value="1200 a 2000">De 1200 a 2000</option>
                                                <option value="2000 a 3000">De 2000 a 3000</option>
                                                <option value="3000 a 4000">De 3000 a 4000</option>
                                                <option value="4000 a 8000">De 4000 a 8000</option>
                                                <option value="8000 a 15000">De 8000 a 15000</option>
                                                <option value="maior que 15000">Maior que 15000</option>

                                            </select>
                                        </div>

                                    </div>


                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="fas fa-language"></i> Idiomas</h2>
                                    <br/>
                                    <div class="form-group">
                                        <div class="col-md-2 col-xs-12">
                                            <br>
                                            <input name="portuguesHabilitado" value="Habilitado" type="checkbox"/><label> Português</label>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <br>
                                            <input name="inglesHabilitado" value="Habilitado" type="checkbox"/><label> Inglês</label>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <br>
                                            <input name="espanholHabilitado" value="Habilitado" type="checkbox"/><label> Espanhol</label>
                                        </div>

                                        <div class="col-md-2 col-xs-12">
                                            <br>
                                            <input name="francesHabilitado" value="Habilitado" type="checkbox"/><label> Francês</label>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <br>
                                            <input name="italianoHabilitado" value="Habilitado" type="checkbox"/><label> Italiano</label>
                                        </div>

                                    </div>
                                    <br/>
                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="fas fa-phone"></i> Contato</h2>

                                    <br/>

                                    <div class="form-group">
                                        <div class="col-md-3  col-xs-12">
                                            <br>
                                            <label>*Telefone Principal</label>
                                            <input type="tel"  name="telefonePrincipal" id="telefonePrincipal" required=""  placeholder="" class="form-control form-control-line">
                                        </div>
                                        <div class="col-md-3  col-xs-12">
                                            <br>
                                            <label>Telefone Secundário</label>
                                            <input type="tel" id="telefoneSecundario"  name="telefoneSecundario"  maxlength="9" minlength="8" placeholder="" class="form-control form-control-line">
                                        </div>
                                        <div class="col-md-3  col-xs-12">
                                            <br>
                                            <label>*Cidade</label>
                                            <input  name="cidade" required="" minlength="5" maxlength="80" class="form-control form-control-line"/>
                                        </div>
                                        <div class="col-md-3  col-xs-12">
                                            <br>
                                            <label>*Bairro</label>
                                            <input type="text" name="bairro" minlength="5"  required="" class="form-control form-control-line"/>
                                        </div>

                                        <div class="col-md-6">
                                            <br>
                                            <label for="example-email">E-mail</label>
                                            <input type="email"  name="email"  placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email"> 
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <br>
                                            <label>Endereço</label>
                                            <input type="text"  name="endereco" minlength="10" placeholder="" class="form-control form-control-line"> 
                                        </div>

                                    </div>

                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="fab fa-instagram"></i> Redes sociais</h2>  
                                    <div class="form-group">

                                        <div class="col-md-4 col-xs-12">
                                            <br>
                                            <label>Facebook</label>
                                            <input type="text"  name="facebook" minlength="10" placeholder="" class="form-control form-control-line"> 
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <br>
                                            <label>Instagram</label>
                                            <input type="text"  name="instagram" minlength="10" placeholder="" class="form-control form-control-line"> 
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <br>
                                            <label>Outras</label>
                                            <input type="text"  name="outrasRedes" minlength="10" placeholder="" class="form-control form-control-line"> 
                                        </div>

                                    </div>

                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="far fa-smile"></i> Interesses</h2>  
                                    <div class="form-group">

                                        <div class="col-md-6 col-xs-12">
                                            <br>
                                            <label>Principal estilo musical</label>
                                            <select name="principaisEstilosMusicais" class="form-control form-control-line">
                                                <option value="Alternativo">Alternativo</option>
                                                <option value="Axé">Axé</option>
                                                <option value="Clássico">Clássico</option>
                                                <option value="Country">Country</option>
                                                <option value="Eletrônica">Eletrônica</option>
                                                <option value="Forró">Forró</option>
                                                <option value="Funk">Funk</option>
                                                <option value="Funk Internacional">Funk Internacional</option>
                                                <option value="Gospel/Religioso">Gospel/Religioso</option>
                                                <option value="Gótico">Gótico</option>
                                                <option value="Hardcore">Hardcore</option>
                                                <option value="Hip Hop/Rap">Hip Hop/Rap</option>
                                                <option value="House">House</option>
                                                <option value="MPB">MPB</option>
                                                <option value="Pagode">Pagode</option>
                                                <option value="Pop">Pop</option>
                                                <option value="Pop Rock">Pop Rock</option>
                                                <option value="Rock">Rock</option>
                                                <option value="Rock and Roll">Rock and Roll</option>
                                                <option value="Romântico">Romântico</option>
                                                <option value="Salsa">Salsa</option>
                                                <option value="Samba">Samba</option>
                                                <option value="Sertanejo">Sertanejo</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <br>
                                            <label>Que tipo de informação busca/gosta</label>
                                            <input type="text"  name="informacoesPreferenciais" minlength="10" placeholder="" class="form-control form-control-line"> 
                                        </div>


                                    </div>

                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="fas fa-grin-beam-sweat"></i> Comportamento</h2>  
                                    <div class="form-group">

                                        <div class="col-md-6 col-xs-12">
                                            <br>
                                            <label>Você se classificaria uma pessoa</label>
                                            <select name="classificacaoPessoal" class="form-control form-control-line">

                                                <option value="Feliz">Feliz</option>
                                                <option value="Espontanea">Espontânea</option>
                                                <option value="Afetiva">Afetiva</option>
                                                <option value="Agitada">Agitada</option>
                                                <option value="Calma">Calma</option>
                                                <option value="Carinhosa">Carinhosa</option>
                                                <option value="Curisa">Curiosa</option>
                                                <option value="Grata">Grata</option>
                                                <option value="Ansiosa">Ansiosa</option>
                                                <option value="Antipatica">Antipatica</option>
                                                <option value="Ciumenta">Ciumenta</option>
                                                <option value="Depressiva">Depressiva</option>
                                                <option value="Desanimada">Desanimada</option>
                                                <option value="Invejosa">Invejosa</option>
                                                <option value="Medrosa">Medrosa</option>
                                                <option value="Orgulhosa">Orgulhosa</option>
                                                <option value="Triste">Triste</option>
                                                <option value="Introvertida">Introvertida</option>
                                                <option value="Agressiva">Agressiva</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <br>
                                            <label>Você pratica alguma atividade física?</label>
                                            <select name="atividadesFisicas" class="form-control form-control-line">
                                                <option value="Caminhada">Caminhada</option>
                                                <option value="Futebol">Futebol</option>
                                                <option value="Ciclismo">Ciclismo</option>
                                                <option value="Corrida">Corrida</option>
                                                <option value="Academia">Academia</option>
                                                <option value="Natação">Natação</option>
                                                <option value="Musculação">Musculação</option>
                                                <option value="Voleibol">Voleibol</option>
                                                <option value="Ginásticas">Ginásticas</option>
                                                <option value="Artes Marciais">Artes Marciais</option>
                                            </select>
                                        </div>


                                    </div>

                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="fas fa-chart-line"></i> Fluxo</h2> 


                                    <div class="form-group">

                                        <div class="col-md-12 col-xs-12">
                                            <br>
                                            <label>Como a pessoa chegou até o Instituto:</label>
                                            <select name="comoChegouAteNos" class="form-control form-control-line">
                                                <option value="Instagram Orgânico">Instagram Orgânico</option>
                                                <option value="Instagram Patrocinado">Instagram Patrocinado</option>
                                                <option value="Facebook Orgânico">Facebook Orgânico</option>
                                                <option value="Facebook Patrocinado">Facebook Patrocinado</option>
                                                <option value="Promoção">Promoção</option>
                                                <option value="Pesquisa Google">Pesquisa Google</option>
                                                <option value="Soundcloud/Podcast">Soundcloud/Podcast</option>
                                                <option value="Outros">Outros</option>

                                            </select>
                                        </div>


                                    </div>

                                    <h2 style="background-color: #2f323e; color: #fff;"> <i class="fas fa-plus-square"></i> Observações</h2>

                                    <div class="form-group">

                                        <div class="col-md-12 col-xs-12">
                                            <div class="col-md-12 col-xs-12">
                                                <br/>
                                                <label>Já realizou algum curso conosco?</label>
                                                <p><input type="radio"  name="realizouCurso"  class=""> <label>Sim</label></p>
                                                <p><input type="radio"  name="realizouCurso"  class=""> <label>Não</label></p>
                                            </div>
                                            <br>


                                            <div class="col-md-6 col-xs-12">
                                                <br/>
                                                <label>Qual?</label>

                                                <input type="text"  name="cursoRealizado"  class="form-control form-control-line"> 
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <br/>
                                                <label>Investimento</label>
                                                <select class="form-control form-control-line" name="investimentoRealizado" id="escolaridade">
                                                <option value=""></option>
                                                <option value="100 a 600">De 100 a 600</option>
                                                <option value="600 a 1200">De 600 a 1200</option>
                                                <option value="1200 a 2000">De 1200 a 2000</option>
                                                <option value="2000 a 3000">De 2000 a 3000</option>
                                                <option value="3000 a 4000">De 3000 a 4000</option>
                                                <option value="4000 a 8000">De 4000 a 8000</option>
                                                <option value="8000 a 15000">De 8000 a 15000</option>
                                                <option value="maior que 15000">Maior que 15000</option>

                                            </select>
                                            </div>


                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" id="submitCliente" disabled class="btn btn-default">Adicionar</button>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">


                                </div>


                                <?php
                                if (!empty($_SESSION['mensagemAdicionadoCliente'])) {
                                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['mensagemAdicionadoCliente'] . '</div>';
                                    unset($_SESSION['mensagemAdicionadoCliente']);
                                }

                                if (!empty($_SESSION['mensagemErrorCliente'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['mensagemErrorCliente'] . '</div>';
                                    unset($_SESSION['mensagemErrorCliente']);
                                }
                                ?>
                            </div>

                        </div>
                    </form>


<!--                        <div class="col-md-12 col-xs-12">
                            <div style="min-height:100%; overflow-y:auto;" class="white-box">
                                <h3>CONSULTA DE CLIENTES</h3>
                                <table id="tabela-clientes" style="width: 100%;"  class="table table-bordered">
                                    <thead>
                                    <th>CPF</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>

                                    <th>Cidade</th>
                                    <th>Bairro</th>
                                    <th>Email</th>
                                    <th>Profissão</th>
                                    <th>Telefone Residencial</th>
                                    <th>Celular</th>
                                    <th>Alterar</th>
                                    <th>Apagar</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = pg_query($db, 'SELECT * FROM cliente;');

                                        while ($row = pg_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td style='white-space: nowrap;  width='200'>" . $row['Cpf'] . "</td>";
                                            echo "<td style='white-space: nowrap;  width='200'>" . $row['Nome'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Endereco'] . "</td>";

                                            echo "<td  width='200'>" . $row['Cidade'] . "</td>";
                                            echo "<td  width='200'>" . $row['Bairro'] . "</td>";
                                            echo "<td style='white-space: nowrap;  width='200'>" . $row['Email'] . "</td>";
                                            echo "<td  width='200'>" . $row['Profissao'] . "</td>";
                                            echo "<td  width='200'>" . $row['TelefoneResidencial'] . "</td>";
                                            echo "<td  width='200'>" . $row['Celular'] . "</td>";
                                            echo "<td>  <button type='button' class='btn btn-default alterar-cliente' data-nome='" . $row['Nome'] . "' data-endereco='" . $row['Endereco'] . "' data-cidade='" . $row['Cidade'] . "' data-bairro='" . $row['Bairro'] . "' data-profissao='" . $row['Profissao'] . "' data-telefoneresidencial='" . $row['TelefoneResidencial'] . "' data-telefonecelular='" . $row['Celular'] . "' data-cpf='" . $row['Cpf'] . "'  data-nome ='" . $row['Nome'] . "' data-email='" . $row['Email'] . "' data-toggle='modal' data-target='#alterar-clientes-modal'>Alterar</button> </td>";
                                            echo "<td>  <button type='button' class='btn btn-danger apagar-cliente' data-nome='" . $row['Nome'] . "' data-endereco='" . $row['Endereco'] . "' data-cidade='" . $row['Cidade'] . "' data-bairro='" . $row['Bairro'] . "' data-profissao='" . $row['Profissao'] . "' data-telefoneresidencial='" . $row['TelefoneResidencial'] . "' data-telefonecelular='" . $row['Celular'] . "' data-cpf='" . $row['Cpf'] . "'  data-nome ='" . $row['Nome'] . "' data-email='" . $row['Email'] . "' data-toggle='modal' data-target='#modalApagarCliente'>Apagar</button> </td>";
                                            echo "</tr>";
                                        }
                                        pg_close($db);
                                        ?>
                                    <tbody>
                                </table>


                            </div>

                        </div>-->


                </div>
                </form>
                <div id="alterar-clientes-modal" class="modal fade" role="dialog">
                    <form action="../../servidor/clientes/atualizarCliente.php" method="post">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Alterar cadastro de clientes</h4>
                                </div>
                                <div style="padding: 0px;" class="modal-body">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="white-box">

                                            <h3 id="nome-cliente"></h3>
                                            <br>
                                            <div class="col-md-3 col-xs-12">
                                                <br>
                                                <label>*CPF</label>
                                                <span id="mensagemCpf"></span>
                                                <input id="cpfhidden" name="modalcpf" required="" type="hidden" class="form-control form-control-line"/>
                                                <input id="cpfmodal" disabled=""  name="democpf" required="" type="tel" class="form-control form-control-line"/>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-9 col-xs-12">
                                                    <br>
                                                    <label>*Nome</label>
                                                    <input id="nomemodal" type="text"  name="modalnome" required="" placeholder="" class="form-control form-control-line"> </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <br>
                                                    <label>*Telefone Residencial</label>
                                                    <input id="telefoneResidencialmodal" type="tel"  name="modaltelefoneResidencial" id="telefoneResidencial" required=""  placeholder="" class="form-control form-control-line">
                                                </div>
                                                <div class="col-md-3">
                                                    <br>
                                                    <label>Celular</label>
                                                    <input id="celularmodal" type="tel" id="telefoneCelular"  name="modaltelefoneCelular"  maxlength="9" minlength="8" placeholder="" class="form-control form-control-line">
                                                </div>

                                                <div class="col-md-3">
                                                    <br>
                                                    <label>*Cidade</label>
                                                    <input id="cidademodal" name="modalcidade" required="" minlength="5" maxlength="80" class="form-control form-control-line"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <br>
                                                    <label>*Bairro</label>
                                                    <input id="bairromodal" type="text" name="modalbairro" minlength="5"  required="" class="form-control form-control-line"/>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <div class="col-md-6">
                                                    <br>
                                                    <label for="example-email">E-mail</label>
                                                    <input id="emailmodal" type="email"  name="modalemail"  placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email"> 
                                                </div>

                                                <div class="col-md-6">
                                                    <br>
                                                    <label>Profissão</label>
                                                    <input id="profissaomodal"  name="modalprofissao"  type="text" class="form-control form-control-line"/>
                                                </div>

                                            </div>


                                            <div class="form-group">

                                            </div>                                     
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button style="margin-top: 10px;"  type="submit" class="btn btn-success" >Salvar</button>
                                    <button style="margin-top: 10px;"  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <form action="../servidor/clientes/apagarCliente.php" method="post">
                    <div class="modal fade" id="modalApagarCliente" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Excluir cliente</h4>
                                </div>
                                <div class="modal-body">
                                    <input name="cpf" id="cpfApagarUsuarioInput" type="hidden"/>
                                    <input name="nome" id="nomeApagarUsuarioInput" type="hidden"/>
                                    <p>Você tem certeza que deseja apagar <p>Nome: <label id="nome-apagarcliente"></label></p> <p>CPF: <label id="cpf-apagarcliente"></label></p> da sua base de dados de clientes? </p>
                                </div>
                                <div class="modal-footer">
                                    <button style="margin-top: 10px;"  type="submit" class="btn btn-success" >Confirmar</button>
                                    <button style="margin-top: 10px;" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        <?php include 'footer.php'; ?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../resources/lib/jqueryvalidate/js/jquery.validate.js" type="text/javascript"></script>
<script src="../resources/lib/maskinput/jquery.maskedinput.js" type="text/javascript"></script>
<script src="../resources/lib/datatables/js/jquery.dataTables.min_1.js" type="text/javascript"></script>
<script src="js/custom.min.js"></script>
<script src="../resources/page/clientes/js/cliente.js" type="text/javascript"></script>
</body>

</html>
