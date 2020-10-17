<?php 

    if(isset($_SESSION['usuario_id'])){
        echo $_SESSION['ultimo_login'];
        if((time() - $_SESSION['ultimo_login']) > 10){
            header("location: ./includes/logout.php");
        }else{
            $_SESSION['ultimo_login'] = time();
        }
    }

?>