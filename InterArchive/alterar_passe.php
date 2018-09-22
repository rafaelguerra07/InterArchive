<?php

session_start();

    // verifica se o utilizador fez login
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

    }
    else{
        header("location: index.php");
    }

    require_once ('ligaDB.php');

    // Verifica se o formulário foi enviado:
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {

        require_once ('ligaDB.php'); // Connect to the db.

        $p = $con->real_escape_string(trim($_POST['pass']));

        $id = $_SESSION['user_id'];


        // verifica se a senha antiga está correta
        $sql = "SELECT user_id FROM utilizadores WHERE (user_id='$id' AND user_senha=SHA1('$p') )";
        $result = $con->query($sql);

        if ($result->num_rows == 1 && $_POST['pass1'] == $_POST['pass2']) {
             $np = $con->real_escape_string(trim($_POST['pass1']));

             $row = $result->fetch_array();

            // atualiza a senha com o novo valor inserido
            $q = "UPDATE utilizadores SET user_senha=SHA1('$np') WHERE user_id=$row[0]";        
            $r = $con->query($q);

            if ($con->affected_rows == 1) { // Se foi afetada/atualizada uma linha

                header("location: login_index.php?passe_sucesso");

            } else {

                 header("location: alterar_passe.php?passe_erro");
            }

            exit();
        } else {

             header("location: alterar_passe.php?passe_erro");
        }

            $con->close(); // fecha a ligação à base de dados.

        }
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/8651ef6299.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
    <title>Alterar Palavra-Passe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <!-- Navegação -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                	<span class="glyphicon glyphicon-fire"></span> 
                	InterArchive
                </a>
            </div>
            <!-- Navbar -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="index.php">Home</a>
                    </li>					
                    
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->      
    </nav>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header"><br> 
                        <center><h2>Alterar Palavra-Passe</h2></center>
                    </div>
                <?php
            
                    if(isset($_GET['passe_erro'])){
                        echo '<div>';
                        echo '<center><div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Erro!</strong> Palavra-Passe não foi alterada.
                            </div></center>';
                        echo '</div>';
                    }
                ?>
                    <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="InputPasse">Palavra-Passe Atual</label><br>
                            <input class="form-control" id="InputPasse" name="pass" required="required" type="password" />
                        </div>
                        <div class="form-group">
                            <label for="InputPasse">Nova Palavra-Passe</label><br>
                            <input class="form-control" id="InputPasse" name="pass1" required="required" type="password" />
                        </div>
                        <div class="form-group">
                            <label for="InputPasse">Confirmar Palavra-Passe</label><br>
                            <input class="form-control" id="InputPasse" name="pass2" required="required" type="password" />
                        </div>
                        <input type="submit" name="send" class="btn btn-primary" value="Alterar">
                            <a href="login_index.php" class="btn btn-default">Cancelar</a>
                        </form><br><br><br>
                        <p>Boas <b><?php echo $_SESSION['username']?></b>, aqui poderás alterar a tua palavra-passe. </p></center>
            
                </div>        
            </div>
        </div>
    </div>
    
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/8651ef6299.js"></script>
    <!-- Bootstrap -->
    
    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    
    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>
    
    <!-- Script para fazer desaparecer os avisos(alertas) após 2 segundos. -->
    <script>

            $(document).ready(function () {
 
                window.setTimeout(function() {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                    });
                }, 2000);
 
            });
    </script>
</body>
</html>