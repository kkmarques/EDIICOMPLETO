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


                        <div class="col-md-12 col-xs-12">
                            <div style="min-height:100%; overflow-y:auto;" class="white-box">
                                <h3>CONSULTA DE CLIENTES</h3>
                                
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
                                <table id="tabela-clientes" style="width: 100%;"  class="table table-bordered">
                                    <thead>
                                    <th>CPF</th>
                                    <th>Nome</th>
                                    <th>Idade</th>
                                    <th>Data de Nascimento</th>
                                    <th>Sexo</th>
                                    <th>Estado Civil</th>
                                    <th>Profissão</th>
                                    <th>Filhos</th>
                                    <th>Escolaridade</th>
                                    <th>Renda Mensal</th>
                                    <th>Inglês</th>
                                    <th>Espanhol</th>
                                    <th>Português</th>
                                    <th>Francês</th>
                                    <th>Italiano</th>
                                    <th>Endereço</th>
                                    <th>Cidade</th>
                                    <th>Bairro</th>
                                    <th>E-mail</th>
                                    <th>Telefone Principal</th>
                                    <th>Telefone Secundario</th>
                                    <th>Facebook</th>
                                    <th>Instagram</th>
                                    <th>Outras Redes</th>
                                    <th>Estilo Musical</th>
                                    <th>Preferências</th>
                                    <th>Classificação Pessoal</th>
                                    <th>Atividade Fisica</th>
                                    <th>Como chegou até nós?</th>
                                    <th>Efetuou Curso?</th>
                                    <th>Qual curso?</th>
                                    <th>Investimento Curso</th> 
                                    <th>Apagar</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = pg_query($db, 'SELECT * FROM cliente;');

                                        while ($row = pg_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td style='white-space: nowrap;  width='200'>" . $row['Cpf'] . "</td>";
                                            echo "<td style='white-space: nowrap;  width='200'>" . $row['Nome'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Idade'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['DataNascimento'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Sexo'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['EstadoCivil'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Profissao'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Filhos'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Escolaridade'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['RendaMensal'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Ingles'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Espanhol'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Portugues'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Frances'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Italiano'] . "</td>";
                                            echo "<td>" . $row['Endereco'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Cidade'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Bairro'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Email'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['TelefonePrincipal'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['TelefoneSecundario'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Facebook'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Instagram'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Outras'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['EstiloMusical'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['InformaçõesPreferenciais'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['ClassificacaoPessoal'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['PraticanteDeAtividade'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['ChegouAteNos'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['CursoInstituto'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['CursoQual'] . "</td>";
                                            echo "<td style='white-space: nowrap;' width='200'>" . $row['Investimento'] . "</td>";
                                           echo "<td>  <button type='button' class='btn btn-danger apagar-cliente' data-nome='" . $row['Nome'] . "' data-endereco='" . $row['Endereco'] . "' data-cidade='" . $row['Cidade'] . "' data-bairro='" . $row['Bairro'] . "' data-profissao='" . $row['Profissao'] . "' data-cpf='" . $row['Cpf'] . "'  data-nome ='" . $row['Nome'] . "' data-email='" . $row['Email'] . "' data-toggle='modal' data-target='#modalApagarCliente'>Apagar</button> </td>";
                                            echo "</tr>";
                                        }
                                        pg_close($db);
                                        ?>
                                    <tbody>
                                </table>


                            </div>

                        </div>


                </div>
                
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
