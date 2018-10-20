<?php
session_start();
include_once ('servidor/conexao.php');
?>
<html>
    <head>
        <title>SIOSA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>



        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 



            <div class="panel panel-default" >
                <div class="panel-heading">
                    <div class="panel-title text-center">Cadastre-se</div>
                </div>     
                <a href=""></a>
                <div class="panel-body" >

                    <!------ Include the above in your HEAD tag ---------->

                  

                        <div class="">

                            <form role="form" method="post" action="servidor/cadastro/adicionarUsuario.php">
                               
                                <hr class="colorgraph">
                                <div class="form-group">
                                    <input type="number" name="cpf" id="display_name" required="" class="form-control input" placeholder="CPF" tabindex="1">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="nome" id="display_name"  required=""class="form-control input" placeholder="Nome" tabindex="1">
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="endereco" id="display_name" required="" class="form-control input" placeholder="Endereço" tabindex="2">
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="telefoneresidencial" id="display_name" class="form-control input" placeholder="Telefone Residencial" tabindex="3">
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="cidade" id="display_name" required="" class="form-control input" placeholder="Cidade" tabindex="4">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="bairro" id="display_name" required="" class="form-control input" placeholder="Bairro" tabindex="5">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" id="display_name" required="" class="form-control input" placeholder="E-mail" tabindex="5">
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="usuario" autocomplete="off" required="" id="display_name" class="form-control input" placeholder="Usuario" tabindex="5">
                                </div>
                                <div class="form-group">
                                    <input type="password" autocomplete="off" name="senha" required="" id="display_name" class="form-control input" placeholder="Senha" tabindex="5">
                                </div>
                                
                               
                                <hr class="colorgraph">
                                    <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Cadastrar</button>
                                
                            </form>
                            
                                    <?php
                                    if (isset($_SESSION['mensagemErrorCliente'])) {
                                        echo '<div class="alert alert-danger">'.$_SESSION['mensagemErrorCliente'].'</div>';
                                        unset($_SESSION['mensagemErrorCliente']);
                                    }
                                    ?>

                        </div>


                                       
                </div>  



            </div>
        </div>







        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>

    </body>
</html>
