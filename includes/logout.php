<?php
    require_once "conexao.php";
    session_start();
    
    if(isset($_SESSION['usuario_id'])){
        $query = "update tb_usuarios_activos set state='off' where uid='".$_SESSION['usuario_id']."'";
        mysqli_query($db, $query);
    }

    session_unset();   // remove all session variables

    session_destroy();  // destroy the session

    echo " Log out success " ;

    header('Location: ../home');   //Redirect to login page

?>