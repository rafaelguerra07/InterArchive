<?php

    session_start();

    // verifica se o utilizador fez login
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        
    }
    else{
        header("location: index.php");
    }

        
    // Verifica se o formulário foi enviado:
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

            // ligação ao servidor/base de dados MySQL
            require_once ('ligaDB.php');
            
            $nome       = $con->real_escape_string(trim($_POST['nome']));
            $email      = $con->real_escape_string(trim($_POST['email']));
            $tele      = $con->real_escape_string(trim($_POST['tele']));
            $morada     = $con->real_escape_string(trim($_POST['morada']));
            $idade     = $con->real_escape_string(trim($_POST['idade']));
            $genero      = $con->real_escape_string(trim($_POST['genero']));
            $user_id      = $_SESSION['user_id'];
            
            $sql = "SELECT contacto_tele, user_id FROM contactos WHERE contacto_tele ='$tele' AND user_id='$user_id'";
            $resultado = $con->query($sql);
            
            if($resultado->num_rows == 0)
            {
                
                // A função mysqli_real_escape_string evita problemas de SQL Injection.
                $sql = "INSERT INTO contactos (contacto_nome, contacto_email, contacto_tele, contacto_morada, contacto_idade, contacto_genero, contacto_dataregisto, user_id) ";
                $sql .= "VALUES (?, ?, ?, ?, ?, ?, NOW(), ? )";
        
                
                if($stmt = $con->prepare($sql))
                {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("ssssssi", $nome, $email, $tele, $morada, $idade, $genero, $user_id);


                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Records created successfully. Redirect to landing page
                        header("location: login_index.php?contacto_sucesso");
                        
                    } else{
                        header("location: criar_contacto.php?contacto_erro");
                        }


                }
                else{
                    header("location: criar_contacto.php?contacto_erro");
                }
        
            // Close statement
            $stmt->close();
            // Fecha aligação à base de dados
            $con->close();
            }
            else{ 
                header("location: criar_contacto.php?contacto_erro");
            } 

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
    
    <title>Criar Contacto</title>
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
                        <center><h2>Dados do Contacto</h2></center>
                    </div>
                    <?php
            
                        if(isset($_GET['contacto_erro'])){
                            echo '<div>';
                            echo '<center><div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Erro!</strong> Contacto não foi inserido.
                                </div></center>';
                            echo '</div>';
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" id="InputNome" placeholder="Nome" name="nome" size="15" maxlength="20" value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Número de Telemovel</label>
                            <input type="text" class="form-control" id="InputTele" placeholder="Ex: 936363135" name="tele" 
                            value="<?php if(isset($_POST['tele'])) echo $_POST['tele']; ?>" required>
                        </div>
                        <div class="form-group ">
                            <label>Email</label>
                            <input type="email" class="form-control" id="InputEmail" placeholder="Endereço de Email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
                        </div>
                        <div class="form-group ">
                            <label>Morada</label>
                            <textarea class="form-control" id="InputMorada" placeholder="Ex: Rua da Bica - Abraveses , Viseu" name="morada" 
                            value="<?php if(isset($_POST['morada'])) echo $_POST['morada']; ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Idade</label>
                            <input type="number" class="form-control" id="InputIdade" placeholder="Idade" name="idade" 
                            value="<?php if(isset($_POST['idade'])) echo $_POST['idade']; ?>" required>
                            
                        </div>
                        <center>
                          <input type="radio" name="genero" value="Rapaz"><i class="fa fa-male fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="genero" value="Rapariga"> <i class="fa fa-female fa-3x"></i>
                            <br><br>
                        <input type="submit" href="login_index.php" class="btn btn-primary" value="Gravar Contacto">
                            <a href="login_index.php" class="btn btn-default">Cancelar</a></center>
                    </form>
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