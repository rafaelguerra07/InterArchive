<?php

    session_start();

    // verifica se o utilizador fez login
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        
    }
    else{
        header("location: index.php");
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
    
    <title>Editar Contacto</title>
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

<?php

    session_start();

    // verifica se o utilizador fez login
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        
    }
    else{
        header("location: index.php");
    }
    
        if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
            
            $id = $_GET['id'];

        } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
            
            $id = $_POST['id'];

        } else {
            
            echo '<p class="erro"> não é acessível.</p>';
            
        }
        
        require_once ('ligaDB.php');

        if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['enviado'])) {

                
            
            $nome       = $con->real_escape_string(trim($_POST['nome']));
            $email      = $con->real_escape_string(trim($_POST['email']));
            $tele      = $con->real_escape_string(trim($_POST['tele']));
            $morada     = $con->real_escape_string(trim($_POST['morada']));
            $idade     = $con->real_escape_string(trim($_POST['idade']));
            $genero      = $con->real_escape_string(trim($_POST['genero']));       

            // atualiza o registo
            $q = "UPDATE contactos SET contacto_nome='?', contacto_email='?', contacto_tele='?', contacto_morada='?', contacto_idade='?', contacto_genero='?' WHERE contacto_id=? LIMIT 1";
            $r = $con->query ($q);
            
            if ($stmt = $con->prepare($sql))
            {
                $stmt->bind_param("ssssssi", $nome, $email, $tele, $morada, $idade, $genero,  $id);
                
                if($stmt->execute())
                {
                    header("location: login_index.php?erro=O utilizador foi atualizado");
                    exit();
                }
                else 
                {

                    header("location: login_index.php?erro=O utilizador não foi alterado. As nossas desculpas.");
                }
            }

            $stmt->close();
        }  
        
        // Mostra sempre o formulário
        $sql = "SELECT contacto_nome, contacto_email, contacto_tele, contacto_morada, contacto_idade, contacto_genero, FROM contactos WHERE contacto_id=$id";
        $result = $con->query ($sql);
        
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_array();

            echo '<div class="row">';
            echo '<div class="col-md-10">';
                if(isset($erro)){
                    echo '<div class="alert alert-warning" role="alert">';
                    echo "<strong>" . $erro . "</strong>"; 
                }
                echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
                    echo '<div class="form-group">';
                        echo '<label>Nome</label>';
                        echo '<input type="text" class="form-control" id="InputNome" name="nome" value="' . $row[0] . '" required>';
                    echo '</div>';
                    echo '<div class="form-group">';
                        echo '<label>Número de Telemovel</label>';
                        echo '<input type="email" class="form-control" id="InputTele" name="tele" value="' . $row[1] . '" required>';
                    echo '</div>';
                    echo '<div class="form-group">';
                        echo '<label>Email</label>';
                        echo '<input type="email" class="form-control" id="InputEmail"  name="email" value="' . $row[2] . '" required>';
                    echo '</div>';
                    echo '<div class="form-group">';
                        echo '<label>Morada</label>';
                        echo '<textarea class="form-control" id="InputMorada" name="morada" placeholder="' . $row[3] . '" required>';
                    echo '</div>';
                    echo '<div class="form-group">';
                        echo '<label>Idade</label>';
                        echo '<input type="number" class="form-control" id="InputIdade"  name="idade" value="' . $row[4] . '" required>';
                    echo '</div>';        
                    echo '<center>';
                        echo '<input type="radio" name="genero" value="' . $row[5] . '"><i class="fa fa-male fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo '<input type="radio" name="genero" value="' . $row[5] . '"><i class="fa fa-female fa-3x"></i>';
                    echo '</center>';    
                    echo '<button type="submit" class="btn btn-success" name="submit">Enviar</button>';
                    echo '<a class="btn btn-primary" href="login_index.php" role="button">Voltar</a>';
                    echo '<input type="hidden" name="enviado" value="TRUE" />';
                    echo '<input type="hidden" name="id" value="' . $id . '" />';
                echo "</form>";
            echo "</div>";
            echo "</div>";

        } 

        $con->close();
?>

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