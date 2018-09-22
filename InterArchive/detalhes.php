<?php

session_start();

// verifica se o utilizador fez login
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

}
else{
    header("location: index.php");
}

require_once "ligaDB.php";
$id = $_SESSION['user_id'];
$sql = ("SELECT user_email, user_senha, user_dataregisto FROM utilizadores WHERE user_id='$id' LIMIT 1");

    $result = $con->query($sql);

    while ($row = $result->fetch_assoc()) {
        $email = $row['user_email'];
        $pass = $row['user_senha'];
        $data = $row['user_dataregisto'];
    }

    $con->close(); 
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
    
    <title>Detalhes da Conta</title>
    
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
        <div class="container-fluid">
            <div class="row">
                
                    <div class="page-header"><br>
                        <center><h1>Detalhes da Conta</h1></center>
                    </div><br>
                    <center>
                        <h1 class="display-2">Olá <b><?php echo $_SESSION['username']?></b>,</h1>
                        <h1 class="display-4">aqui tens acesso aos detalhes da tua conta.</h1><br>
                        <h4>Nome de utilizador: <?php echo $_SESSION['username'] ?></h4>
                        <h4>Email: <?php echo $email ?></h4>
                        <h4>Palavra-Passe: <?php echo $pass ?> (Encriptada)</h4><br>
                        <h4>Data de Registo: <?php echo $data ?></h4>  
                        <h4>Sessão Atual: <?php echo session_id() ?></h4><br>
                        <a href="login_index.php" class="btn btn-info">Voltar</a>
                        <a href="alterar_passe.php" class="btn btn-success">Alterar Passe</a>
                </center>    
            </div>        
        </div>

</body>
</html>