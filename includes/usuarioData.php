<?php 
    
    //require("conexao.php");

    Class UsuarioDados{
        
        public function get_user_first_name($db, $id){
            $query = "select usuario_nome from tb_usuarios where usuario_id = '$id' ";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['usuario_nome'];
        }
        
        public function get_user_last_name($db, $id){
            $query = "select usuario_sobrenome from tb_usuarios where usuario_id = '$id' ";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['usuario_sobrenome'];
        }
        
        public function get_user_login($db, $id){
            $query = "select usuario_login from tb_usuarios where usuario_id = '$id' ";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['usuario_login'];
        }
        
        public function get_user_email($db, $id){
            $query = "select usuario_email from tb_usuarios where usuario_id = '$id' ";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['usuario_email'];
        }
        
        public function get_user_foto($db, $id){
            $query = "select usuario_foto from tb_usuarios where usuario_id = '$id' ";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['usuario_foto'];
        }
        
        public function get_user_categoria($db, $id){
            $query = "select categoria from tb_usuarios where usuario_id = '$id' ";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['categoria'];
        }
        
        public function get_user_media_geral($db, $id){
            $query = "select usuario_media_geral from tb_usuarios where usuario_id = '$id' ";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['usuario_media_geral'];
        }
        
        public function get_user_data($db, $id){
            $query = "select * from tb_usuarios where usuario_id = '$id'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
        }
        
        public function get_users_for_chat($db, $id){
            $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_id, tb_usuarios.usuario_foto, tb_chat.chat_mensagem, MAX(tb_chat.chat_time) FROM tb_usuarios INNER JOIN tb_chat WHERE tb_usuarios.usuario_id != '$id' AND ((tb_chat.chat_de='$id' AND tb_chat.chat_para=tb_usuarios.usuario_id) OR (tb_chat.chat_de=tb_usuarios.usuario_id AND tb_chat.chat_para = '$id')) AND usuario_departamento != 'MEDIA' and usuario_departamento != 'ADMIN' GROUP BY tb_usuarios.usuario_id ORDER BY MAX(tb_chat.chat_time) DESC";
            
            /*select usuario_id, usuario_nome, usuario_sobrenome, usuario_foto from tb_usuarios where usuario_id != '$id' and usuario_departamento != 'MEDIA' and usuario_departamento != 'ADMIN' */
            
            /*SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_id, tb_usuarios.usuario_foto, tb_chat.chat_mensagem FROM tb_usuarios INNER JOIN tb_chat WHERE tb_usuarios.usuario_id != '$id' AND ((tb_chat.chat_de='$id' AND tb_chat.chat_para=tb_usuarios.usuario_id) OR (tb_chat.chat_de=tb_usuarios.usuario_id AND tb_chat.chat_para = '$id')) AND usuario_departamento != 'MEDIA' and usuario_departamento != 'ADMIN' GROUP BY tb_usuarios.usuario_id ORDER BY tb_chat.chat_time DESC*/

            /*SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_id, tb_usuarios.usuario_foto, IF((tb_usuarios.usuario_id IN (SELECT tb_usuarios.usuario_id FROM tb_usuarios INNER JOIN tb_chat WHERE tb_usuarios.usuario_id != '$id' AND ((tb_chat.chat_de='$id' AND tb_chat.chat_para=tb_usuarios.usuario_id) OR (tb_chat.chat_de=tb_usuarios.usuario_id AND tb_chat.chat_para = '17')) AND usuario_departamento != 'MEDIA' and usuario_departamento != 'ADMIN' GROUP BY tb_usuarios.usuario_id ORDER BY tb_chat.chat_time DESC)) ,"S", "N" ) as contactou FROM tb_usuarios WHERE usuario_id != '$id' AND usuario_departamento != 'MEDIA' AND usuario_departamento != 'ADMIN'*/
            
            $result = mysqli_query($db, $query);
            $output = array();
            
            foreach($result as $row){
                $output[] = array(
                    "usuario_id" => $row['usuario_id'],
                    "usuario_nome" => $row['usuario_nome'],
                    "usuario_sobrenome" => $row['usuario_sobrenome'],
                    "usuario_foto" => $row['usuario_foto']
                );
            }
            
            $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_id, tb_usuarios.usuario_foto, IF((tb_usuarios.usuario_id IN (SELECT tb_usuarios.usuario_id FROM tb_usuarios INNER JOIN tb_chat WHERE tb_usuarios.usuario_id != '$id' AND ((tb_chat.chat_de='$id' AND tb_chat.chat_para=tb_usuarios.usuario_id) OR (tb_chat.chat_de=tb_usuarios.usuario_id AND tb_chat.chat_para = '$id')) AND usuario_departamento != 'MEDIA' and usuario_departamento != 'ADMIN' GROUP BY tb_usuarios.usuario_id ORDER BY tb_chat.chat_time DESC)) ,'S', 'N' ) as contactou FROM tb_usuarios WHERE usuario_id != '$id' AND usuario_departamento != 'MEDIA' AND usuario_departamento != 'ADMIN'";
            
            $result = mysqli_query($db, $query);
            
            foreach($result as $row){
                if($row['contactou']=='N'){
                    $output[] = array(
                        "usuario_id" => $row['usuario_id'],
                        "usuario_nome" => $row['usuario_nome'],
                        "usuario_sobrenome" => $row['usuario_sobrenome'],
                        "usuario_foto" => $row['usuario_foto']
                    );
                }
            }
            
            return $output;
        }
        
        public function get_user_last_activity($db, $id){
            $query="select state, status from tb_usuarios_activos where uid='$id'";
            $result = mysqli_query($db, $query);
            $output = array();
            
            foreach($result as $row){
                $output[] = array(
                    "state" => $row['state'],
                    "last_activity" => $row['status']
                );
            }
            
            return $output;
        }
        
        public function get_user_state($db, $id){
            $query="SELECT state FROM tb_usuarios_activos WHERE uid = '$id'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            return $row['state'];
        }
        
    }

?>