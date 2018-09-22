<?php

    session_start();
    
    // Verifica se o utilizador fez login
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("location: login_index.php");
    }

    else{
        
    }
?>

<!DOCTYPE html>

<html lang="pt" >

<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Registo / Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  
    <!-- CSS -->
    <link rel="stylesheet" href="css/style_register.css">
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
					
				    <!--<li>
                        <a href="login_reg.php">
						Login
						<span class="glyphicon glyphicon-log-in"></span>
						</a> 
                    </li> -->
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
      <?php
        if(isset($_GET['login_erro'])){
                echo '<br><br><br><div>';
                echo '<center><div class="alert alert-danger alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Erro!</strong> Login não foi efetuado.
                     </div></center>';
                echo '</div>';
            }
        if(isset($_GET['registo_erro'])){
                echo '<br><br><br><div>';
                echo '<center><div class="alert alert-danger alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Erro!</strong> Registo não foi efetuado.
                     </div></center>';
                echo '</div>';
            }
        if(isset($_GET['pass_erro'])){
                echo '<br><br><br><div>';
                echo '<center><div class="alert alert-danger alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Erro!</strong> As palavras-passe não coincidem.
                     </div></center>';
                echo '</div>';
            }
        if(isset($_GET['existe_erro'])){
                echo '<br><br><br><div>';
                echo '<center><div class="alert alert-danger alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Erro!</strong> Registo não efetuado. Utilizador já existe.
                     </div></center>';
                echo '</div>';
            }
        if(isset($_GET['registo_sucesso'])){
                echo '<br><br><br><div>';
                echo '<center><div class="alert alert-success alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Sucesso!</strong> Registo efetuado com sucesso.
                     </div></center>';
                echo '</div>';
            }
    ?>
    <div class="login-page">
       <div class="form">
          <form class="register-form" action="regista_login.php" method="post">
            <input id="usernamesignup" name="nome" type="text" required oninvalid="this.setCustomValidity('Por favor preencha o campo Utilizador.')"
	        oninput="setCustomValidity('')" placeholder="Utilizador"/>
            <input id="passwordsignup" name="password" type="password" required oninvalid="this.setCustomValidity('Por favor preencha o campo Palavra-Passe.')"
	        oninput="setCustomValidity('')" placeholder="Palavra-Passe" />
             <input id="passwordsignup" name="password2" type="password" required oninvalid="this.setCustomValidity('Por favor confirme a Palavra-Passe.')"
	        oninput="setCustomValidity('')" placeholder="Confirmar Palavra-Passe" />
            <input id="emailsignup" name="email" type="email" required oninvalid="this.setCustomValidity('Insira um email válido.')"
	        oninput="setCustomValidity('')" placeholder="Email"/>
            <button>C r i a r</button>
            <p class="message">Já estás registado(a)? <a href="#">Entrar</a></p>
          </form>
           
          <form class="login-form" action="valida_login.php" method="post">
            <input id="usernamesignup" name="username" type="text" required oninvalid="this.setCustomValidity('Por favor preencha o campo Utilizador.')"
	        oninput="setCustomValidity('')"placeholder="Utilizador"/>
            <input id="passwordsignup" name="password" type="password" required oninvalid="this.setCustomValidity('Por favor preencha o campo Palavra-Passe.')"
	        oninput="setCustomValidity('')" placeholder="Palavra-Passe"/>
            <button>E n t r a r</button>
            <p class="message">Não estás registado(a)? <a href="#">Criar uma conta.</a></p>
            <!--<p class="message">Esqueceste-te da palavra passe? <a href="#">Recuperação.</a></p> -->
          </form>
       </div>
    </div>
    
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>
    
    <!-- Separador -->
    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                
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
