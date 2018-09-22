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
    

    <title>Sobre</title>

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
                    <li>
                        <a href="index.php">Home</a>
                    </li>
					
                    <li>
                        <a href="#contacto1">Contacto</a>
                    </li>
					
					<li class="active">
                        <a href="#">Sobre</a>
                    </li>
                    
					<li>
                        <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']?> <span class="glyphicon glyphicon-user"></span>
                        <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li class="dropdown-header">Conta</li>
                              <li><a href="detalhes.php">Dados da Conta</a></li>
                              <li><a href="mudar_passe.php">Alterar Palavra-Passe</a></li>
                              <li class="divider"></li>
                              <li><a href="logout.php">Terminar Sessão</a></li>
                            </ul> 
                    </li>
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

	<!-- Header -->
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>InterArchive</h1>
                <p>Clicla nos botões abaixo para seres transportado para as diferentes partes desta página <i class="fa fa-smile-o" aria-hidden="true"></i> </p>
                <a href="#ideia" class="btn btn-info btn-lg text-left" style="float:left">Como Surgiu a Ideia</a>
                <a href="#finalidade" class="btn btn-warning btn-lg ">Para que Serve</a>
                <a href="#equipa" class="btn btn-danger btn-lg" style="float:right" >Equipa &nbsp; <i class="fa fa-users" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        
    </header><a name="ideia"></a>

    <!-- Separador -->
    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                
                </div>
            </div>
        </div>
    </section>
    
	<!-- Ideia -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive img-circle center-block" src="images/ideia.jpg" alt="">
                </div>
                <div class="col-sm-6">
                	<h2 class="section-header">Como Surgiu esta Ideia.</h2><br>
                	<p class="lead text-muted"> Esta ideia surgiu quando estava a pensar num website que podia ser útil a um público de todas as idades. Comecei a imaginar um website onde conseguisse guardar os dados e informações dos meus entes queridos. &nbsp; <i class="fa fa-smile-o" aria-hidden="true"></i>
					<br><br>E assim inventei o nome InterArchive, sendo Inter de Internet e Archive de arquivo (em inglês).</p>
                </div>                
                
            </div>
        </div>
    </section>
    
    <!-- Separador -->
    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                
                </div><a name="finalidade"></a>
            </div>
        </div>
    </section>
    
    
    
    <!-- Finalidade -->
    
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                	<center><h2 class="section-header">Para que serve (Finalidade).</h2></center><br>
                	<p class="lead text-muted">O Rafael saiu de casa. Foi "pra night" cons uns amigos e partiu o seu smartphone.<br>Ele queria ligar a 
                	alguém para o vir buscar, mas não sabia o número de cor.<br>E agora? &#x2639; <br>O Rafael teve que gastar dinheiro num uber para voltar a <i class="fa fa-home" aria-hidden="true"></i>, porque perdeu os contactos que estavam no seu smartphone. Pode-te acontecer o mesmo.<br></p>
                	<h3>OU ENTÃO, dás login na tua conta do InterArchive onde tens todos os teus contactos!
                    Estás safo.</h3>
                    <p class="lead text-muted">O InterArchive é uma base de dados dos teus contactos, um "backup" caso percas os teus contactos noutras plataformas/dispositivos. Podes adicionar e guardar informação sobre quem quiseres. Número de telemóvel, email, morada, data de nascimento, etc.<br></p>
                </div>                
                
            </div><a name="equipa"></a>
        </div>
    </section>
    
    <!-- Separador -->
    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                
                </div>
            </div>
        </div>
    </section>
    
    <!-- Equipa -->
    
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive" src="images/equipa.png" alt="">
                </div>
                <div class="col-sm-6">
                	<h2 class="section-header">Equipa do InterArchive.</h2><br>
                    <p class="lead text-muted"> De momento o único membro da equipa é o senhor Rafael Guerra, um "developer" milionário que foi crescendo no mundo da programação, estando associado á fundação da google e á criação do SO Windows...<br><br>
                    <span class="txtescondido"> Não, nem por isso! É só o Rafael do 11ºH de GPSI &nbsp; <i class="fa fa-smile-o" aria-hidden="true"></i></span></p> 
                	
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
    
</body>

</html>
