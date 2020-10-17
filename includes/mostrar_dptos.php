<?php 
    require_once "conexao.php";
    
    function inserir_dptos($db){
        $output = '';
        $query = "select * from tb_departamentos";
        $result = mysqli_query($db, $query);

        while($row = mysqli_fetch_assoc($result)){
            $output .= '<option value="'.$row["dpto_sigla"].'">'.$row["dpto_sigla"].'</option>';
        }
        
        return $output;
    }

    function inserir_funcionarios($db){
        $output = '';
        $query = "select * from tb_usuarios";
        $result = mysqli_query($db, $query);
        
        $query = "select * from tb_usuarios where usuario_departamento !='DRHTI' and usuario_tipo ='tecnico'";
        $result = mysqli_query($db, $query);
        while($row = mysqli_fetch_assoc($result)){
            $user_name = $row['usuario_nome'];
            $user_surname = $row['usuario_sobrenome'];
            $user_id = $row['usuario_id'];
            $output .= '<option value="'.$row["usuario_id"].'">'.$row["usuario_nome"].' '.$row["usuario_sobrenome"].'</option>';
        }
        
        return $output;
    }
?>
