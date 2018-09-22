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
    
    <title>Apagar Contacto</title>
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
                        <br><br><br><h2>Olá <b><?php echo $_SESSION['username']?></b>,</h2>
                    </div>
<?php
    
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) 
    {

        $id = $_GET['id'];

    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // submissão do form deste ficheiro
        
        $id = $_POST['id'];

    } else { // o id não é válido
        
        header("location: login_index.php?existe_erro");
        
    }

                        
    require_once ('ligaDB.php');
    $user_id = $_SESSION['user_id'];
                        
    if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['enviado'])) {

        // eliminação do registo
        if ($_POST['confirma'] == 'Sim') {
                      
            // Apaga p utilizador com o $id
            $sql = "DELETE FROM contactos WHERE contacto_id= ? AND user_id ='$user_id'";
           
            if($stmt = $con->prepare($sql))
            {
                $stmt->bind_param("i", $id);
                
                if($stmt->execute())
                {
                    
                    header("location: login_index.php?eliminar_sucesso");
                    
                } else{
                   
                    header("location: login_index.php?eliminar_erro");

                }
            }

            $stmt->close();
    
        } 
        else // $_POST['confirma'] == 'Nao'
        {
        
            header("location: login_index.php");
        }

    } else { // Mostra formulário

        // a função CONCAT junta o apelido e o nome do utilizador
       $sql = "SELECT contacto_nome, user_id FROM contactos WHERE contacto_id=? AND user_id='$user_id'";
        
        if($stmt = $con->prepare($sql))
        {
            $stmt->bind_param("i", $id);
            
            if($stmt->execute())
            {
                $result = $stmt->get_result();
                if($result->num_rows == 1){
                    $row = $result->fetch_array();
                    echo '<form class="form-horizontal" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';

                    echo '<div class="form-group">';
                        echo '<p><h4>Pretendes eliminar o contacto  ' . $row[0] . '?</h4></p></center>';
                    echo '</div>';

                    echo '<div class="form-group">';
                        echo '<div class="col-sm-offset-2 col-sm-12">';
                            echo '<label class="radio-inline">';
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="confirma" value="Sim"> Sim';
                            echo '</label>';
                            echo '<label class="radio-inline">';
                            echo '<input type="radio" name="confirma" value="Não" checked="checked"> Não';
                            echo '</label>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                        echo '<div class="col-sm-offset-2 col-sm-12">';
                            echo '<input type="submit" class="btn btn-info" name="submit" value="Resposta" />&nbsp;&nbsp;';
                            echo '<a class="btn btn-success" href="login_index.php" role="button">Voltar</a>';
                            echo '<input type="hidden" name="enviado" value="TRUE" />';
                            echo '<input type="hidden" name="id" value="' . $id . '" />';
                        echo '</div>';
                    echo '</div>';
                echo '</form>';
                }
            } else {
                
                $stmt->close();
                $con->close();
                 
                header("location: login_index.php?eliminar_erro");
            }
        }
        else{
            
            header("location: login_index.php?eliminar_erro");
        }
        
    }


    $stmt->close();
    $con->close();

?>

                    