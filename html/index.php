<?php
session_start();

include_once ('../servidor/conexao.php');

if (empty($_SESSION['nomeUsuario'])) {
    $_SESSION['loginError'] = "Por favor, faça seu login!";
    header("Location: ../../../index.php");
}

?>

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
<!--        <link href="../../../resources/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <!-- animation CSS -->
        <link href="css/animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <!-- color CSS -->
        <link href="css/colors/default.css" id="theme" rel="stylesheet">
        <link href="bootstrap/dist/css/navbar.less" id="theme" rel="stylesheet">
        
        
        <link href="css/custom-menu.css" rel="stylesheet" type="text/css"/>
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
                            <h4 class="page-title">Dashboard</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            
                            <ol class="breadcrumb">
                                <li><a href="#">Dashboard</a></li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->
                    <!-- .row -->
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">SOLICITAR SERVIÇO</h3>
                                                <H3>Todas as oficinas a baixo estão a disposição para solicitar serviço.</h3>
<!--                                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCadastroOficina">
                                                    Gerenciar oficina
                                                </button>-->
                                                <ul class="list-inline two-part">
                                                    <li>
                                                        <div id="sparklinedash">
                                                            <table style="width: 100%;"  class="table table-bordered">
                                                            <thead>
                                                                <th>Identificador oficina</th>
                                                                <th>Nome</th>
                                                                <th>Descrição</th>
                                                                
                                                            </thead>
                                                                <tbody>
                                                                    
                                                                    <?php
                                                                    $cpfUsuario = (floatval($_SESSION['cpfUsuario']));
                                                                    
                                                                    $query = 'SELECT "IdOficina", "NomeOficina", "DescricaoServicos", "CpfUsuario"
                                                                              FROM "schemaA".oficina ';
                                                                    $result = pg_prepare($db, "my_query2", $query);
                                                                    $result = pg_execute($db, "my_query2", array());
                                                                    while ($row = pg_fetch_assoc($result)) {
                                                                        echo "<tr>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['IdOficina'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['NomeOficina'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['DescricaoServicos'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'><button  type='button' class=' btnSolicitar btn btn-success' data-toggle='modal' data-cpfUsuario='".$row['CpfUsuario']."' data-idOficina='".$row['IdOficina']."' data-target='#modalPedido'>SOLICITAR MECÂNICO DESSA OFICINA</BUTTON></td>";
                                                                        echo "</tr>";
                                                                    }
                                                                    
                                                                    ?>
                                                                <tbody>
                                                            </table>
                                                        </div>
                                                    </li>
                                                       
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">Meus veículos</h3>
                                                 <?php
                                                if (!empty($_SESSION['carroAtualizadoComSucesso'])) {
                                                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['carroAtualizadoComSucesso'] . '</div>';
                                                    unset($_SESSION['carroAtualizadoComSucesso']);
                                                }

                                                if (!empty($_SESSION['mensagemAtualizarVeiculo'])) {
                                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['mensagemErroCadastroVeiculo'] . '</div>';
                                                    unset($_SESSION['mensagemErroCadastroVeiculo']);
                                                }
                                                ?>
                                                <?php
                                                if (!empty($_SESSION['mensagemSucessoCadastroVeiculo'])) {
                                                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['mensagemSucessoCadastroVeiculo'] . '</div>';
                                                    unset($_SESSION['mensagemSucessoCadastroVeiculo']);
                                                }

                                                if (!empty($_SESSION['mensagemErroCadastroVeiculo'])) {
                                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['mensagemErroCadastroVeiculo'] . '</div>';
                                                    unset($_SESSION['mensagemErroCadastroVeiculo']);
                                                }
                                                ?>
                                                <?php
                                                if (!empty($_SESSION['carroApagado'])) {
                                                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['carroApagado'] . '</div>';
                                                    unset($_SESSION['carroApagado']);
                                                }

                                                if (!empty($_SESSION['carroApagado'])) {
                                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['carroApagado'] . '</div>';
                                                    unset($_SESSION['carroApagado']);
                                                }
                                                ?>
                                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                                                    Gerenciar veiculos
                                                </button>
                                                <ul class="list-inline two-part">
                                                    <li>
                                                        <div id="sparklinedash">
                                                            <table style="width: 100%;"  class="table table-bordered">
                                                            <thead>
                                                                <th>ID</th>
                                                                <th>Placa</th>
                                                                <th>Cor</th>
                                                                <th>Fabricante</th>
                                                                <th>Modelo</th>
                                                                <th>Ano</th>
                                                                
                                                            </thead>
                                                           
                                                                <tbody>
                                                                    <?php
                                                                    $cpfUsuario = (floatval($_SESSION['cpfUsuario']));
                                                                    
                                                                    $query = 'SELECT *FROM "schemaA".veiculos WHERE "CpfUsuario" = $1';
                                                                    $result = pg_prepare($db, "my_query", $query);
                                                                    $result = pg_execute($db, "my_query", array($cpfUsuario));
                                                                    while ($row = pg_fetch_assoc($result)) {
                                                                        echo "<form action='../servidor/cadastroCarro/apagarCarro.php' method='post'>";
                                                                        echo "<input type='hidden'  name='idcarro' value='".$row['Id']."' required=''  placeholder='' class='form-control form-control-line'>";
                                                                        echo "<tr>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['Id'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['PlacaVeiculo'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['CorVeiculo'] . "</td>";
                                                                        echo "<td  width='200'>" . $row['Fabricante'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;' width='200'>" . $row['Modelo'] . "</td>";

                                                                        echo "<td  width='200'>" . $row['Ano'] . "</td>";
                                                                        echo "<td><button type='submit' class='btn btn-danger'>APAGAR</button></td>";
                                                                        echo "</tr>";
                                                                        echo "</form>";
                                                                    }
                                                                  
                                                                    ?>
                                                                <tbody>
                                                            </table>
                                                        </div>
                                                    </li>
                                                       
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">Tem uma oficina ? cadastre ela agora</h3>
                                                 
                                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCadastroOficina">
                                                    Gerenciar oficina
                                                </button>
                                                <ul class="list-inline two-part">
                                                    <li>
                                                        <div id="sparklinedash">
                                                            <table style="width: 100%;"  class="table table-bordered">
                                                            <thead>
                                                                <th>Identificador oficina</th>
                                                                <th>Nome</th>
                                                                <th>Descrição</th>
                                                                
                                                            </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $cpfUsuario = (floatval($_SESSION['cpfUsuario']));
                                                                    
                                                                    $query = 'SELECT "IdOficina", "NomeOficina", "DescricaoServicos"
                                                                              FROM "schemaA".oficina WHERE "CpfUsuario" = $1';
                                                                    $result = pg_prepare($db, "my_query1", $query);
                                                                    $result = pg_execute($db, "my_query1", array($cpfUsuario));
                                                                    while ($row = pg_fetch_assoc($result)) {
                                                                        echo "<form action='../servidor/cadastrarOficina/apagarOficina.php' method='post'>";
                                                                        echo "<input type='hidden'  name='idOficina' id=' required='' value='". $row['IdOficina'] ."'  placeholder='' class='form-control form-control-line'>";
                                                                        echo "<tr>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['IdOficina'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['NomeOficina'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['DescricaoServicos'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'><button type='submit' class='btn btn-danger'>APAGAR</button></td>";
                                                                        echo "</tr>";
                                                                        echo "</form>";
                                                                    }
                                                                    
                                                                    ?>
                                                                <tbody>
                                                            </table>
                                                        </div>
                                                    </li>
                                                       
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">S.O.S SOLICITADOS DE SUAS OFICINAS</h3>
                                                <H3>Todas as solicitações de "socorro" estão a baixo, atenda todas por favor! </h3>
<!--                                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCadastroOficina">
                                                    Gerenciar oficina
                                                </button>-->
                                                <ul class="list-inline two-part">
                                                    <li>
                                                        <div id="sparklinedash">
                                                            <table style="width: 100%;"  class="table table-bordered">
                                                            <thead>
                                                                <th>Protocolo do pedido</th>
                                                                <th>Descrição</th>
                                                                <th>Status</th>
                                                                
                                                            </thead>
                                                                <tbody>
                                                                    
                                                                    <?php
                                                                    $cpfUsuario = (floatval($_SESSION['cpfUsuario']));
                                                                    
                                                                    $query = 'SELECT "ProtocoloPedido", "CpfUsuario", "IdOficina", "DescricaoSolicitacao","Status" FROM "schemaA"."Pedido" WHERE "CpfUsuario" = $1;';
                                                                    $result = pg_prepare($db, "my_query4", $query);
                                                                    $result = pg_execute($db, "my_query4", array($cpfUsuario));
                                                                    while ($row = pg_fetch_assoc($result)) {
                                                                        echo "<tr>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['ProtocoloPedido'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['DescricaoSolicitacao'] . "</td>";
                                                                        echo "<td style='white-space: nowrap;  width='200'>" . $row['Status'] . "</td>";
//                                                                        echo "<td style='white-space: nowrap;  width='200'><button type='button' class='btn btn-success' data-toggle='modal' data-target='#modalPedido'>SOLICIONADO</BUTTON></td>";
                                                                        echo "</tr>";
                                                                    }
                                                                   
                                                                    ?>
                                                                <tbody>
                                                            </table>
                                                        </div>
                                                    </li>
                                                       
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                        

<!-- Modal -->


<div id="modalPedido" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Solicitar pedido de mecânico.</h4>
      </div>
      <div class="modal-body">
          <form action="../servidor/solicitarPedido/adicionarPedido.php" method="post">
                                                              <br>
                                                            <label>Descreva o problema do veículo e coloque o seu telefone, caso não saiba deixe apenas o telefone para entrarmos em contato!</label>
                                                            <textarea type="text"  name="descricao" id="" required=""  placeholder="" class="form-control form-control-line"></textarea>
                                                            
                                                              <br>
                                                              <input type="hidden" id="cpfUsuarioFinal" name="cpf"/>
                                                              <input type="hidden" id="idOficina" name="idOficina"/>
                                                            
                                                            <button type="submit" class="btn btn-success">SOLICITAR </button>
                                                    </form>
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>




<div id="modalCadastroOficina" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Oficina</h4>
      </div>
      <div class="modal-body">
          <form action="../servidor/cadastrarOficina/adicionarOficina.php" method="post">
                                                            <br>
                                                            <label>Nome</label>
                                                            <input type="text"  name="nomeOficina" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                            <label>Descrição</label>
                                                            <textarea type="text"  name="descricao" id="" required=""  placeholder="" class="form-control form-control-line"></textarea>
                                                            
                                                              <br>
                                                            
                                                            <button type="submit" class="btn btn-success">CADASTRAR</button>
                                                    </form>
          
          <h4 class="modal-title">Atualizar oficina</h4>
          <form action="../servidor/cadastrarOficina/atualizarOficina.php" method="post">
                                                            <br>
                                                            
                                                            
                                                            
                                                            
                                                            <label>Selecione a oficina que deseja atualizar!</label>
                                                            
                                                            <select class="form-control form-control-line" name="id" >
                                                             <?php
                                                                    $cpfUsuario = (floatval($_SESSION['cpfUsuario']));
                                                                    
                                                                    $query = 'SELECT "IdOficina", "NomeOficina", "DescricaoServicos"
                                                                              FROM "schemaA".oficina WHERE "CpfUsuario" = $1';
                                                                    $result = pg_prepare($db, "my_query6", $query);
                                                                    $result = pg_execute($db, "my_query6", array($cpfUsuario));
                                                                    while ($row = pg_fetch_assoc($result)) {
                                                                        echo "<option value='". $row['IdOficina'] . "'>". $row['NomeOficina'] ."</option>";}
                                                                    
                                                            ?>
                                                                </select>
                                                            
                                                              <br>
                                                            <label>Nome</label>
                                                            <input type="text"  name="nomeOficina" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                            
                                                              <br>
                                                            
                                                            <button type="submit" class="btn btn-success">Atualizar</button>
                                                    </form>
<!--          <form action="../servidor/cadastrarOficina/apagarOficina.php" method="post">
                                                            <br>
                                                            <label>Digite o id da oficina que deseja apagar</label>
                                                            <input type="number"  name="idOficina" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                            
                                                              <br>
                                                            
                                                            <button type="submit" class="btn btn-danger">APAGAR</button>
                                                    </form>-->
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                        
                                        
                                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">Cadastrar Veículos</h3>
                                                  
                                                <ul class="list-inline two-part">
                                                    <form action="../servidor/cadastroCarro/adicionarCarro.php" method="post">
                                                            <br>
                                                            <label>Placa</label>
                                                            <input type="text"  name="placa" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                            <label>Cor</label>
                                                            <input type="text"  name="cor" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                              <label>Fabricante</label>
                                                            <select name="fabricante" class="form-control form-control-line"  required=""  id="marcas"></select>
<!--                                                            <input type="text"  name="fabricante" id="" required=""  placeholder="" class="form-control form-control-line">-->
                                                             <br>
                                                            <label>Modelo</label>
                                                            <select  name="modelo" class="form-control form-control-line" required="" id="veiculos">
                                                                <option>AGUARDANDO FABRICANTE SER SELECIONADO</option>
                                                            </select>
<!--                                                            <input type="text"  name="modelo" id="" required=""  placeholder="" class="form-control form-control-line">-->
                                                              <br>
                                                            <label>Ano</label>
                                                            <select name="ano" required=""  placeholder="" class="form-control form-control-line" id="ano">
                                                                 <option>AGUARDANDO FABRICANTE SER SELECIONADO</option>
                                                            </select>
<!--                                                            <input type="text"  name="ano" id="" required=""  placeholder="" class="form-control form-control-line">-->
                                                            <br>
                                                            
                                                            <button type="submit" class="btn btn-success">CADASTRAR</button>
                                                    </form>
                                                    
                                                </ul>
                                            </div>
                                        </div>
          
<!--           <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">Apagar Veiculo</h3>
                                                  
                                                <ul class="list-inline two-part">
                                                    <form action="../servidor/cadastroCarro/apagarCarro.php" method="post">
                                                            
                                                            <label>Digite o Identificador do veiculo</label>
                                                            <input type="text"  name="idcarro" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                            
                                                            <button type="submit" class="btn btn-danger">APAGAR</button>
                                                    </form>
                                                    
                                                </ul>
                                            </div>
                                        </div>-->
          
          
          <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">Atualizar veiculo</h3>
                                                 
                                                <ul class="list-inline two-part">
                                                    <form action="../servidor/cadastroCarro/atualizar.php" method="post">
                                                            <br>
                                                            <label>Selecione a placa do veiculo que deseja atualizar!</label>
                                                            <select class="form-control form-control-line"  name="id">
                                                            <?php
                                                                    $cpfUsuario = (floatval($_SESSION['cpfUsuario']));
                                                                    
                                                                    $query = 'SELECT *FROM "schemaA".veiculos WHERE "CpfUsuario" = $1';
                                                                    $result = pg_prepare($db, "my_query10", $query);
                                                                    $result = pg_execute($db, "my_query10", array($cpfUsuario));
                                                                    while ($row = pg_fetch_assoc($result)) {
                                                                        echo "<option value='".$row['Id']."'>". $row['PlacaVeiculo'] ."</option>";
                                                                       
                                                                    }
                                                                  
                                                                    ?>
                                                            </select>
                                                            
                                                              <br>
                                                              <label>Placa</label>
                                                              <input type="text"  name="placa" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                              <label>Cor</label>
                                                              <input type="text"  name="cor" id="" required=""  placeholder="" class="form-control form-control-line">
                                                              <br>
                                                              
                                                              <button type="submit" class="btn btn-success">ATUALIZAR</button>
                                                    </form>
                                                    
                                                </ul>
                                            </div>
                                        </div>
         
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
                                         
                                         
</div>
                                        
                                       
<!--                                        <div class="col-lg-4 col-sm-6 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">Total Page Views</h3>
                                                <ul class="list-inline two-part">
                                                    <li>
                                                        <div id="sparklinedash2"></div>
                                                    </li>
                                                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">869</span></li>
                                                </ul>
                                            </div>
                                        </div>-->
<!--                                        <div class="col-lg-4 col-sm-6 col-xs-12">
                                            <div class="white-box analytics-info">
                                                <h3 class="box-title">Unique Visitor</h3>
                                                <ul class="list-inline two-part">
                                                    <li>
                                                        <div id="sparklinedash3"></div>
                                                    </li>
                                                    <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">911</span></li>
                                                </ul>
                                            </div>
                                        </div>-->
                                    </div>
                    <!--/.row -->
                    <!--row -->
                    <!-- /.row -->
                    <!--                <div class="row">
                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            <div class="white-box">
                                                <h3 class="box-title">Products Yearly Sales</h3>
                                                <ul class="list-inline text-right">
                                                    <li>
                                                        <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
                                                    <li>
                                                        <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5> </li>
                                                </ul>
                                                <div id="ct-visits" style="height: 405px;"></div>
                                            </div>
                                        </div>
                                    </div>-->
                    <!-- ============================================================== -->
                    <!-- table -->
                    <!-- ============================================================== -->
                    <!--                <div class="row">
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <div class="white-box">
                                                <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                                                    <select class="form-control pull-right row b-none">
                                                        <option>March 2017</option>
                                                        <option>April 2017</option>
                                                        <option>May 2017</option>
                                                        <option>June 2017</option>
                                                        <option>July 2017</option>
                                                    </select>
                                                </div>
                                                <h3 class="box-title">Recent sales</h3>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>NAME</th>
                                                                <th>STATUS</th>
                                                                <th>DATE</th>
                                                                <th>PRICE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td class="txt-oflo">Elite admin</td>
                                                                <td>SALE</td>
                                                                <td class="txt-oflo">April 18, 2017</td>
                                                                <td><span class="text-success">$24</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td class="txt-oflo">Real Homes WP Theme</td>
                                                                <td>EXTENDED</td>
                                                                <td class="txt-oflo">April 19, 2017</td>
                                                                <td><span class="text-info">$1250</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td class="txt-oflo">Ample Admin</td>
                                                                <td>EXTENDED</td>
                                                                <td class="txt-oflo">April 19, 2017</td>
                                                                <td><span class="text-info">$1250</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td class="txt-oflo">Medical Pro WP Theme</td>
                                                                <td>TAX</td>
                                                                <td class="txt-oflo">April 20, 2017</td>
                                                                <td><span class="text-danger">-$24</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td class="txt-oflo">Hosting press html</td>
                                                                <td>SALE</td>
                                                                <td class="txt-oflo">April 21, 2017</td>
                                                                <td><span class="text-success">$24</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td class="txt-oflo">Digital Agency PSD</td>
                                                                <td>SALE</td>
                                                                <td class="txt-oflo">April 23, 2017</td>
                                                                <td><span class="text-danger">-$14</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>7</td>
                                                                <td class="txt-oflo">Helping Hands WP Theme</td>
                                                                <td>MEMBER</td>
                                                                <td class="txt-oflo">April 22, 2017</td>
                                                                <td><span class="text-success">$64</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                    <!-- ============================================================== -->
                    <!-- chat-listing & recent comments -->
                    <!-- ============================================================== -->
                    <!--                <div class="row">
                                         .col 
                                        <div class="col-md-12 col-lg-8 col-sm-12">
                                            <div class="white-box">
                                                <h3 class="box-title">Recent Comments</h3>
                                                <div class="comment-center p-t-10">
                                                    <div class="comment-body">
                                                        <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle">
                                                        </div>
                                                        <div class="mail-contnet">
                                                            <h5>Pavan kumar</h5><span class="time">10:20 AM   20  may 2016</span>
                                                            <br/><span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. Aenean commodo dui pellentesque molestie feugiat</span> <a href="javacript:void(0)" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-success m-r-5"></i>Approve</a><a href="javacript:void(0)" class="btn-rounded btn btn-default btn-outline"><i class="ti-close text-danger m-r-5"></i> Reject</a>
                                                        </div>
                                                    </div>
                                                    <div class="comment-body">
                                                        <div class="user-img"> <img src="../plugins/images/users/sonu.jpg" alt="user" class="img-circle">
                                                        </div>
                                                        <div class="mail-contnet">
                                                            <h5>Sonu Nigam</h5><span class="time">10:20 AM   20  may 2016</span>
                                                            <br/><span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. Aenean commodo dui pellentesque molestie feugiat</span>
                                                        </div>
                                                    </div>
                                                    <div class="comment-body b-none">
                                                        <div class="user-img"> <img src="../plugins/images/users/arijit.jpg" alt="user" class="img-circle">
                                                        </div>
                                                        <div class="mail-contnet">
                                                            <h5>Arijit singh</h5><span class="time">10:20 AM   20  may 2016</span>
                                                            <br/><span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. Aenean commodo dui pellentesque molestie feugiat</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="panel">
                                                <div class="sk-chat-widgets">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            CHAT LISTING
                                                        </div>
                                                        <div class="panel-body">
                                                            <ul class="chatonline">
                                                                <li>
                                                                    <div class="call-chat">
                                                                        <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                                        <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                                    </div>
                                                                    <a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                                                </li>
                                                                <li>
                                                                    <div class="call-chat">
                                                                        <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                                        <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                                    </div>
                                                                    <a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                                                </li>
                                                                <li>
                                                                    <div class="call-chat">
                                                                        <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                                        <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                                    </div>
                                                                    <a href="javascript:void(0)"><img src="../plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                                                </li>
                                                                <li>
                                                                    <div class="call-chat">
                                                                        <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                                        <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                                    </div>
                                                                    <a href="javascript:void(0)"><img src="../plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                                                </li>
                                                                <li>
                                                                    <div class="call-chat">
                                                                        <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                                        <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                                    </div>
                                                                    <a href="javascript:void(0)"><img src="../plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                                                </li>
                                                                <li>
                                                                    <div class="call-chat">
                                                                        <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                                        <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                                    </div>
                                                                    <a href="javascript:void(0)"><img src="../plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                                                </li>
                                                                <li>
                                                                    <div class="call-chat">
                                                                        <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                                        <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                                    </div>
                                                                    <a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         /.col 
                                    </div>-->
                </div>
                <!-- /.container-fluid -->
                <?php include 'footer.php'; ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
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
        <script src="../resources/lib/font-awesome/js/all.js" type="text/javascript"></script>
        <script src="js/custom.min.js"></script>
        <script src="../resources/page/clientes/js/cliente.js" type="text/javascript"></script>
        <script>
        
        $(".btnSolicitar").click(function (){
            $("#cpfUsuarioFinal").val(this.getAttribute("data-cpfUsuario"));
            $("#idOficina").val(this.getAttribute("data-idOficina"));
})

        $(document).ready(function () {
            var urlBase = "http://fipeapi.appspot.com/api/1/carros/";
            $.getJSON(urlBase + "marcas.json", function (data) {
                var items = ["<option value=\"\">ESCOLHA UMA MARCA</option>"];
                $.each(data, function (key, val) {
                    items += ("<option  value='" + val.name+ "' dataid='"+val.id+"' >" + val.name + "</option>");
                });
                $("#marcas").html(items);
            });
            $("#marcas").change(function () {
              
                $.getJSON(urlBase + "veiculos/" + $("#marcas option:selected" ).attr('dataid') + ".json", function (data) {
                    var items = ["<option value=\"\">ESCOLHA UM VEICULO</option>"];
                    $.each(data, function (key, val) {
                        items += ("<option dataid='"+val.id+"' value='" + val.name+ "'>" + val.name + "</option>");
                    });
                    $("#veiculos").html(items);
                });
            });
            $("#veiculos").change(function () {
                $.getJSON(urlBase + "veiculo/" + $("#marcas option:selected" ).attr('dataid') + "/" + $("#veiculos option:selected" ).attr('dataid') + ".json", function (data) {
                    var items = ["<option value=\"\">ESCOLHA O ANO</option>"];
                    $.each(data, function (key, val) {
                    
                     items += ("<option value='" +val.name.substring(0,4)+ "'>" + val.name.substring(0,4) + "</option>");
                        
                    });
                    $("#ano").html(items);
                });
            });
        });

    
        </script>
    </body>

</html>
