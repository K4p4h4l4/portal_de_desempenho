<?php
    //include("conexao.php");
    //if(isset($_GET["teste"])){
        $output = array();
        if(isset($_SESSION['usuario_id'])){
            $query = "select token from tb_usuarios_activos where uid = '".$_SESSION['usuario_id']."'";

            $result = mysqli_query($db, $query);

            $row = mysqli_fetch_assoc($result);

            $token = $row['token'];

            if($_SESSION['token'] != $token){
                $output['resposta'] = 1;
                json_encode($output);
                header('Location: ../includes/logout.php');
                //session_unset();   // remove all session variables

                //session_destroy();  // destroy the session
                
                
                
            }else{
                $output['resposta'] = 0;
                json_encode($output);
            }
        }
        
        $query = "select * from tb_usuarios_activos where state='on'";
        $result = mysqli_query($db, $query);

        while($row = mysqli_fetch_assoc($result)){
            $hoje = date('d-m-Y');
            $data_on = date('d-m-Y', strtotime($row['status']));
            
            if(strtotime($data_on) < strtotime($hoje)){
                $query = "update tb_usuarios_activos set state='off' where id='".$row['id']."'";
                mysqli_query($db, $query);
            }
        }
    //}
?>