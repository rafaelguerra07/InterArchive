<?php

    session_start();

    // captura erro vindo de outra página
    if(isset($_GET['erro'])) $erro = $_GET['erro'];

    // verifica se o utilizador fez login
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("location: login_index.php");
    }

?>
<!DOCTYPE html>
<!-- Template by Quackit.com -->

<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>InterArchive</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
</head>

<body>

    <!-- Botão Topo -->
    <button onclick="topoFuncao()" id="botaotopo" title="Volta para o topo">Topo</button>
    
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
					
                    <li>
                        <a href="#contacto1">Contacto</a>
                    </li>

					<li>
                        <a href="sobre.php">Sobre</a>
                    </li>
                    					
					<li>
                        <a href="login_reg.php">
						Login
						<span class="glyphicon glyphicon-log-in"></span>
						</a> 
                    </li>
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->      
    </nav>
    
	<!-- Header -->
    <header>
        <?php
            
            if(isset($_GET['logout_sucesso'])){
                echo '<br><br><br><div>';
                echo '<div class="alert alert-success alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Successo!</strong> Logout efetuado com succeso.
                     </div>';
                echo '</div>';
            }
        ?>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Arquivo de Dados</h1>
                <p>Guarda os teus contactos com um simples clique.<br> Poderás ter acesso a eles quando precisares, a qualquer momento.</p>
                <a href="reg_login.php" class="btn btn-primary btn-lg">Criar Conta</a>
            </div>
        </div>
    </header>

	<!-- Introdução -->
    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                	<span class="glyphicon glyphicon-cloud" style="font-size: 60px"></span>
                    <h2 class="section-heading">Guarda os contactos dos teus amigos e família.</h2>
                    <p class="text-light">No InterArchive tens a possibilidade de guardar todos os dados e informações de pessoas que conheças. Podes acessar a eles em qualquer dispositivo.</p>
                </div>
            </div>
        </div>
    </section>

	<!-- Resumo -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive img-circle center-block" src="images/writing.jpg" alt="">
                </div>
                <div class="col-sm-6">
                	<h2 class="section-header">Simples e Único</h2>
                	<p class="lead text-muted">O InterArchive, apesar de ser simples, é um website com uma finalidade inovadora, não havendo nenhum outro website que se possa comparar a este.<br>
					<br>Se quiseres saber mais sobre as finalidades do website ou a causa da sua criação, clica no botão abaixo.</p>
						<center><a href="sobre.php" class="btn btn-primary btn-lg">Sabe Mais</a></center>
                </div>                
                
            </div>
        </div>
    </section>
    
	<!-- Footer -->
    <footer class="page-footer">
    
    	<!-- Contactos -->
        <div class="contact">
        	<div class="container">
        	    <a name="contacto1"></a>
				<h2 class="section-heading">Contacta-nos</h2>
				<p><span class="glyphicon glyphicon-earphone"></span><br> 936363135 (PT)</p>
				<p><span class="glyphicon glyphicon-envelope"></span><br> a21560@esenviseu.net</p>
        	</div>
        </div>
        	
        <!-- Copyright  -->
        <div class="small-print">
        	<div class="container">
        		<p>Copyright &copy; InterArchive - 2018</p>
        	</div>
        </div>
        
    </footer>

    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    
    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/8651ef6299.js"></script>
    
    <!-- Script para fazer o botão topo funcionar. O design do botão encontra-se em custom.css -->
    <script>
        
        // Quando o utilizador der sroll de 20px para baixo na página, o botão aparece.
            window.onscroll = function() {scrollFuncao()};

            function scrollFuncao() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("botaotopo").style.display = "block";
                } else {
                    document.getElementById("botaotopo").style.display = "none";
                }
            }

       // Quando o user clicar no botão, vai automaticamente para o topo da página.
            function topoFuncao() {
                document.body.scrollTop = 0; // Para Safari
                document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE e Opera
            }
    </script>
    
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
