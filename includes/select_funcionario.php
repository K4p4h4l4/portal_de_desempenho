<?php 
    include("./conexao.php");   
    $output = '';
    $query = '';
    if(isset($_GET['departamento'])){
        
        if($_GET['departamento'] != ''){
            $dpto = $_GET['departamento'];
            $query = "select * from tb_usuarios where usuario_departamento = '{$dpto}' and usuario_tipo ='tecnico'";
        }else{
            $query = "select * from tb_usuarios where usuario_tipo ='tecnico'";
        }
        
        $result = mysqli_query($db, $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $user_name = $row['usuario_nome'];
            $user_surname = $row['usuario_sobrenome'];
            $user_id = $row['usuario_id'];
            $output .= '<option value="'.$row["usuario_id"].'">'.$row["usuario_nome"].' '.$row["usuario_sobrenome"].'</option>';
        }
        
        echo $output;
    }
?>
