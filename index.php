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
    
        <a  href="cadastro.php" ><h3 style="color: #fff; margin-left: 15px;">Quero me cadastrar</h3></a> 
        <div class="container">

            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
                   


                <div class="panel panel-default" >
                    <div class="panel-heading">
                        <div class="panel-title text-center">Seja bem vindo(a)!</div>
                    </div>     
                    <a href=""></a>
                    <div class="panel-body" >
                        

                        <form name="form" action="servidor/login/valida.php" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="user" type="text" required="" class="form-control" name="usuario" value="" placeholder="Usuário">                                        
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" required="" class="form-control" name="senha" placeholder="Senha">
                            </div>                                                                  

                            <div class="form-group">
                                
                                    <?php
                                    if (isset($_SESSION['loginError'])) {
                                        echo '<div class="alert alert-danger">'.$_SESSION['loginError'].'</div>';
                                        unset($_SESSION['loginError']);
                                    }
                                    ?>
                                <?php
                                    if (isset($_SESSION['mensagemContacriada'])) {
                                        echo '<div class="alert alert-success">'.$_SESSION['mensagemContacriada'].'</div>';
                                        unset($_SESSION['mensagemContacriada']);
                                    }
                                    ?>
                                
                                 <?php
                                    if (isset($_SESSION['contaApagada'])) {
                                        echo '<div class="alert alert-success">'.$_SESSION['contaApagada'].'</div>';
                                        unset($_SESSION['contaApagada']);
                                    }
                                    ?>
                                
                                
                          
                                
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                      
                                    
                                    <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Login</button>                          
                                </div>
                                
                            </div>
                             </form>
                        

                           

                    </div>                     
                </div>  
                
                
                
            </div>
        </div>
        
        
        

     

        
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        
    </body>
</html>
