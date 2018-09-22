<?php

    if(isset($_POST['username'])) $user  = $_POST['username'];
    if(isset($_POST['password'])) $pass  = $_POST['password'];

    require_once "ligaDB.php";

    $sql = "SELECT user_id, user_nome 
            FROM utilizadores 
            WHERE user_nome='$user' AND user_senha=SHA1('$pass')";

    $resultado = $con->query ($sql);
		
    if($con->errno) die($dbc->error);
  
    if ($resultado->num_rows == 1) {
        // utilizador está registado
        
        // Extrai o registo 
        $registo = $resultado->fetch_assoc();     //$registo = $result->fetch_array ();

        session_start();
        $_SESSION['loggedin']   = true; // indica que fez login
        $_SESSION['username'] 	= $user;
        $_SESSION['user_id']    = $registo['user_id'];

        $con->close();
        /*header("location:../dashboard.php?PHPSESSID=" . session_id());*/
        header("Location: login_index.php?login_sucesso");
        exit();

    } else {
            header("Location: login_reg.php?login_erro");
    }
        
?>
