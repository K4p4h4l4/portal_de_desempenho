<?php
    require __DIR__."/conexao.php";

    function getToken($length){
        $token = "";
        $alfanumerico = "ABCDEFGHIJKLMNOPQRSTUVXWYZ";
        $alfanumerico .= "abcdefghijqlmnopqrstuvxwyz";
        $alfanumerico .= "1234567890";
        $max = strlen($alfanumerico);
        
        for($i=0; $i < $length; $i++){
            $token .= $alfanumerico[random_int(0, $max-1)];
        }
        
        return $token;
    }
    
    if( isset($_POST['login'])){
        $usuario_login = mysqli_real_escape_string($db, filter_var($_POST['usuario_login'],FILTER_SANITIZE_STRING));
        $usuario_senha = mysqli_real_escape_string($db, filter_var($_POST['usuario_senha'],FILTER_SANITIZE_STRING));
        
        $usuario_login = strip_tags($usuario_login);
        $usuario_senha = strip_tags($usuario_senha);
        
        $query = "select * from tb_usuarios where usuario_login = '$usuario_login'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        $senha = $row['usuario_senha'];
        if((mysqli_num_rows($result) == 1) && password_verify($usuario_senha, $senha)){
            
            $token = getToken(10);
            
            $_SESSION['usuario_id'] = $row['usuario_id'];
            $_SESSION['usuario_login'] = $row['usuario_login'];
            $_SESSION['usuario_nome'] = $row['usuario_nome'];
            $_SESSION['usuario_sobrenome'] = $row['usuario_sobrenome'];
            $_SESSION['usuario_tipo'] = $row['usuario_tipo'];
            $_SESSION['usuario_dpto'] = $row['usuario_departamento'];
            $_SESSION['usuario_foto'] = $row['usuario_foto'];
            $_SESSION['ultimo_login'] = time(); 
            $_SESSION['token'] = $token;
            
            $query2 = "select uid from tb_usuarios_activos where uid='".$_SESSION['usuario_id']."'";
            $result2 = mysqli_query($db, $query2);
            $now = date('Y-m-d H:i:s');
            
            if(mysqli_num_rows($result2) == 1){
                $query2 = "update tb_usuarios_activos set status='$now', state='on', token='$token' where uid='".$_SESSION['usuario_id']."'";
        
                mysqli_query($db, $query2);
            }else{
                $query2 = "insert into tb_usuarios_activos (uid, state, token) values ( '".$_SESSION['usuario_id']."', 'on', '$token')";
            
                mysqli_query($db, $query2);
            }
            
            
            if($row['usuario_tipo'] == 'tecnico'){
                array_push($erros, "Sem permissão para aceder ao portal");
                //header("location: ./login.php");
            }else if(($row['usuario_departamento'] == 'CA') && ($row['usuario_tipo'] == 'admin')){
                header("location: ./ca/ca_projectos");
            }else if(($row['usuario_departamento'] == 'DRHTI') && ($row['usuario_tipo'] == 'chefe')){
                header("location: ./drhti/avaliacao");
            }else if(($row['usuario_departamento'] == 'ADMIN') && ($row['usuario_tipo'] == 'manager')){
                header("location: ./admin/control");
            }else if(($row['usuario_departamento'] != 'ADMIN') && ($row['usuario_departamento'] != 'DRHTI') && ($row['usuario_tipo'] == 'tecnico')){
                header("location: ./col/col_home");
            }else if(($row['usuario_departamento'] == 'MEDIA') && ($row['usuario_tipo'] == 'media')){
                header("location: ./media/media_noticias");
            }else{
                header("location: ./chef/avaliacao");
            }    
        }else{
            array_push($erros, "Usuário ou Senha incorreta");
        }
        
    }
?>
