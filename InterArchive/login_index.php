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
                        <a href="login_sobre.php">Sobre</a>
                    </li>
					<li>
                        
                        <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']?> <span class="glyphicon glyphicon-user"></span>
                        <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li class="dropdown-header">Conta</li>
                              <li><a href="detalhes.php">Detalhes da Conta</a></li>
                              <li><a href="alterar_passe.php">Alterar Palavra-Passe</a></li>
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
       <?php
            
            if(isset($_GET['contacto_sucesso'])){
                echo '<br><br><br><div id="myWish">';
                echo '<div class="alert alert-success alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Successo!</strong> O Contacto foi inserido com sucesso.
                     </div>';
                echo '</div>';
            }
            if(isset($_GET['login_sucesso'])){
                echo '<br><br><br><div>';
                echo '<div class="alert alert-success alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Successo!</strong> O Login foi efetuado com sucesso.
                     </div>';
                echo '</div>';
            }
            if(isset($_GET['passe_sucesso'])){
                echo '<br><br><br><div>';
                echo '<div class="alert alert-success alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Successo!</strong> A Palavra-Passe foi alterada com sucesso.
                     </div>';
                echo '</div>';
            }
            if(isset($_GET['eliminar_sucesso'])){
                echo '<br><br><br><div>';
                echo '<div class="alert alert-success alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Successo!</strong> O Contacto foi eliminado com sucesso.
                     </div>';
                echo '</div>';
            }      
            if(isset($_GET['eliminar_erro'])){
                echo '<br><br><br><div>';
                echo '<div class="alert alert-danger alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Erro!</strong> O Contacto não foi eliminado.
                     </div>';
                echo '</div>';
            }  
            if(isset($_GET['existe_erro'])){
                echo '<br><br><br><div>';
                echo '<div class="alert alert-danger alert-dismissable">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Erro!</strong> O Contacto não existe na base de dados.
                     </div>';
                echo '</div>';
            }                 
        ?>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Adiciona contactos</h1>
                <p>Guarda os teus contactos.<br> A lista onde estão inseridos todos os teus contactos encontra-se <a href="#lista">aqui.</a></p>
                <a href="criar_contacto.php" class="btn btn-primary btn-lg">Adicionar Contacto</a>
            </div>
        </div>
        <a name="lista"></a>
    </header>
    

	<!-- Lista -->
    <section class="content">
        <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <center><h2>Lista de Contactos:</h2></center>
                        <button onclick="ordenaContactos()">Ordem Alfabética</button>
                        <input type="text" id="Input" onkeyup="myFunction()" placeholder="Procurar Contacto..">
                    </div>
                    <?php
                    // Include config file
                    require_once 'ligaDB.php';
                    
                            $id = $_SESSION['user_id'];
                    // Attempt select query execution
                    $sql = "SELECT * FROM contactos WHERE user_id = '$id'";
                    
                    if($result = $con->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table id='minhaTabela' class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";               
                                        echo "<th>Nome</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Telemóvel</th>";
                                        echo "<th>Morada</th>";
                                        echo "<th>Idade</th>";
                                        echo "<th>Género</th>";
                                        echo "<th>Data Contacto Inserido</th>";
                                        echo "<th>Definições</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                            
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['contacto_nome'] . "</td>";
                                        echo "<td>" . $row['contacto_email'] . "</td>";
                                        echo "<td>" . $row['contacto_tele'] . "</td>";
                                        echo "<td>" . $row['contacto_morada'] . "</td>";
                                        echo "<td>" . $row['contacto_idade'] . "</td>";
                                        echo "<td>" . $row['contacto_genero'] . "</td>";
                                        echo "<td>" . $row['contacto_dataregisto'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='ver_contacto.php?id=". $row['contacto_id'] ."' title='Ver Contacto' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;&nbsp;"; 
                                            echo "<a href='editar_contacto.php?id=". $row['contacto_id'] ."' title='Editar Contacto' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;";
                                            echo "<a href='eliminar_contacto.php?id=". $row['contacto_id'] ."' title='Eliminar Contacto' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>&nbsp;&nbsp;";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>Não existe nenhum contacto.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $con->error;
                    }
                    
                    // Close connection
                    $con->close();
?>
                </div>
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
    
    <!-- Script para fazer fazer com que os nomes dos contactos da tabela fiquem ordenados por ordem alfabética. -->
    <script>
            
        function ordenaContactos() {
            var tabela, rows, trocar, i, x, y, deveTrocar;                            //Variáveis
            
            tabela = document.getElementById("minhaTabela");                          //Vai buscar a minha tabela, neste caso o seu id é minhaTabela.
            trocar = true;   

            while (trocar) {                                                          // Começa o loop e continua até que nenhuma troca seja feita.
        
                trocar = false;                                                       // Diz que nenhuma troca foi feita.
                rows = tabela.getElementsByTagName("TR");

                for (i = 1; i < (rows.length - 1); i++) {
                    
                    deveTrocar = false;
                    x = rows[i].getElementsByTagName("TD")[0];                      // Vai buscar os dois contactos a serem comparados.
                    y = rows[i + 1].getElementsByTagName("TD")[0];                      

                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {    // Vê se os dois contactos deviam ser trocados de lugar.
                        
                    deveTrocar= true;                         
                    break;                                                          // Se houver troca de contactos o loop para.
                    }
                }   
                
                if (deveTrocar) {                                                   // Sabe que houve troca de contactos.
                    
                  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);            // Finalmente faz a troca de contactos e marca que a mesma aconteceu
                  trocar = true;
                }
            }
        }
    </script>
    
    <!-- Script para pesquisar os contactos da tabela por nome. -->
    <script>
        
        function myFunction() {
          
             
              var input, filtro, tabela, tr, td, i;                                //Variáveis

              input = document.getElementById("Input");
              filtro = input.value.toUpperCase();
              tabela = document.getElementById("minhaTabela");                     //Vai buscar a minha tabela, neste caso o seu id é minhaTabela.
              tr = tabela.getElementsByTagName("tr");


              for (i = 0; i < tr.length; i++) {                                    // Faz um loop por todos os nomes dos contactos e esconde os que não correspondem á pesquisa.

                  td = tr[i].getElementsByTagName("td")[0];

                  if (td) {

                      if (td.innerHTML.toUpperCase().indexOf(filtro) > -1) {

                          tr[i].style.display = "";

                      } else {

                          tr[i].style.display = "none";                       
                      }
                 } 
             }
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
