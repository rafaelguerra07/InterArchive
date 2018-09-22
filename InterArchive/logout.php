<?php

// Inicializa sessão
session_start();

// Verifica se o utilizador fez login
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

}
else{
    header("location: index.php");
}
// Apaga a sessão
unset($_SESSION['username']);
session_destroy();

// Vai para a página inicial.
header("location: index.php?logout_sucesso");

?>
