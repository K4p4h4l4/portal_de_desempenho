<?php 
    include('conexao.php');
    
    $now = date('Y-m-d H:i:s');

    if(isset($_SESSION['usuario_id'])){
        $query = "update tb_usuarios_activos set status='$now' where uid='".$_SESSION['usuario_id']."'";
        
        mysqli_query($db, $query);
    }
    
?>