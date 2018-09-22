<?php

    session_start();

    // verifica se o utilizador fez login
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        
    }
    else{
        header("location: index.php");
    }

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    // Include config file
    require_once 'ligaDB.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM contactos WHERE contacto_id = ?";
    
    $stmt = $con->prepare($sql);
    
    if($stmt){
        
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
           
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $nome = $row["contacto_nome"];
                $email = $row["contacto_email"];
                $tele = $row["contacto_tele"];
                $morada = $row["contacto_morada"];
                $idade = $row["contacto_idade"];
                $genero = $row["contacto_genero"];
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Um problema ocorreu, tente mais tarde.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $con->close();
    
} else{
    
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Contacto</title>
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" id="InputNome" name="nome" value="<?php echo $row["contacto_nome"]; ?>" required disabled>
                        </div>
                        <div class="form-group">
                            <label>Número de Telemovel</label>
                            <input type="text" class="form-control" id="InputTele" name="tele" 
                            value="<?php echo $row["contacto_tele"]; ?>" required disabled>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="InputEmail" name="email" value="<?php echo $row["contacto_email"]; ?>" required disabled>
                        </div>
                        <div class="form-group">
                            <label>Morada</label>
                            <textarea class="form-control" id="InputMorada" name="morada" 
                                      placeholder="<?php echo $row["contacto_morada"]; ?>" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label>Idade</label>
                            <input type="number" class="form-control" id="InputIdade" name="idade" 
                            value="<?php echo $row["contacto_idade"]; ?>" required disabled>
                            
                        </div>
                        <center>
                          <input <?php if($row['contacto_genero']=="Rapaz") {echo "checked";}?> type="radio" name="genero" value="<?php echo $row["contacto_genero"]; ?>" disabled><i class="fa fa-male fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input <?php if($row['contacto_genero']=="Rapariga") {echo "checked";}?> type="radio" name="genero" value="<?php echo $row["contacto_genero"]; ?>" disabled> <i class="fa fa-female fa-3x"></i>
                            <br><br>
                          <a href="login_index.php" class="btn btn-primary">Voltar</a></center>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/8651ef6299.js"></script>

</body>
</html>