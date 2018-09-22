<?php

    session_start();
    
    // Verifica se o utilizador fez login
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("location: login_index.php");
    }

    else{
        
    }
        // Verifica se o formulário foi enviado:
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {

            // ligação ao servidor/base de dados MySQL
            require_once ('ligaDB.php');
            
            $nome       = $con->real_escape_string(trim($_POST['nome']));
            $email      = $con->real_escape_string(trim($_POST['email']));
            
            if ($_POST['password'] != $_POST['password2']) {
                    // Fecha aligação à base de dados
                    $con->close();
                    header('location:reg_login.php?pass_erro');
            } else {
                
                    $p = $con->real_escape_string(trim($_POST['password']));
            }
            
            $sql = "SELECT user_nome FROM utilizadores WHERE user_nome ='$nome'";
            $resultado = $con->query($sql);
            if($resultado->num_rows == 0)
            {
                // A função mysqli_real_escape_string evita problemas de SQL Injection.
                // A função SHA1() calcula a hash sha1 de uma string (codifica).
                $sql = "INSERT INTO utilizadores (user_nome, user_email, user_senha, user_dataregisto) ";
                $sql .= "VALUES (?, ?, SHA1(?), NOW() )";

                if($stmt = $con->prepare($sql))
                {
                    $stmt->bind_param("sss", $nome, $email, $p);

                    if($stmt->execute()){
                        header('location: login_reg.php?registo_sucesso');
                        exit();
                    } else{
                        // Fecha aligação à base de dados
                        $con->close();
                        header('location: reg_login.php?registo_erro');
                        exit();
                    }
                }

                // Close statement
                $stmt->close();
                // Fecha aligação à base de dados
                $con->close();
            }
            else {
                $con->close();
                header('location:reg_login.php?existe_erro');
            }
            

        }
          

?>