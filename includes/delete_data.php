<?php
/*******************************************************************************************
Neste pedaço de código é onde todos os eventos relacionados com a eliminação de dados serão
realizados
*******************************************************************************************/


    require("conexao.php");

    $query = "";

    function deletar_av($db, $del_id){
        $query = "delete from tb_av_usuarios where id = '$del_id'";
        
        return mysqli_query($db, $query);
    }

    function eliminar_user($db, $del_usr_id){
        $query = "delete from tb_usuarios where usuario_id = '$del_usr_id'";
        return mysqli_query($db, $query);
    }

/*****************************************
    Eliminar a avaliação do usuário
******************************************/
    if(isset($_POST['deletar_av'])){
        $del_id = $_POST['delAv'];
        
        $status = deletar_av($db, $del_id);
        
        if($status == 1){
            header("location: ../admin/users.php");
        }
    }

/****************************************
        Eliminar o colaborador
****************************************/

    if(isset($_POST['deletar_usr'])){
        $del_usr_id = $_POST['delUsr'];
        
        $status = eliminar_user($db, $del_usr_id);
        
        if($status == 1){
            header("location: ../admin/users.php");
        }
    }

    if(isset($_POST['delete_dica_saude'])){
        $id = $_POST['delete_dica_id'];
        
        $query = "select * from tb_dicas_saude where id ='$id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $target = "../imagens/saude/".$row['dica_imagem'];
        
        unlink($target);
        
        $query = "delete from tb_dicas_saude where id='$id'";
        $result = mysqli_query($db, $query);
        
        header('location: ../admin/saude');
    }

    /**********************************************
    Eliminar ideia
    **********************************************/

    if(isset($_POST['delete_ideia'])){
        $query = "delete from tb_ideias where ideia_id='".$_POST['delete_ideia_id']."'";
        mysqli_query($db,$query);

        header("location: ../col/col_ideias");
    }

    /*****************************************
    *Eliminar Tarefa                         *
    *****************************************/
    if(isset($_POST['deletar_task'])){
        $task_id = $_POST['delTask'];
        $query = "delete from tb_tarefas where tarefa_id='$task_id' ";
        mysqli_query($db, $query);
        
        if($_SESSION['usuario_tipo']=='chefe'){
            header("location: ../chef/tarefas");
        }elseif($_SESSION['usuario_tipo']=='admin'){
            header("location: ../ca/ca_tarefas");
        }elseif($_SESSION['usuario_tipo']=='tecnico'){
            header("location: ../col/col_tarefas");
        }
        
    }

    /*************************************
    *Eliminar Projecto pelo chefe de dpto*
    *************************************/
    if(isset($_POST['deletar_projecto'])){
        $projecto_id = $_POST['delProject'];
        
        $query = "select projecto_imagem from tb_projectos where projecto_id='$projecto_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        unlink("../imagens/projectos/".$row['projecto_imagem']);
        
        $query = "delete from tb_projectos where projecto_id='$projecto_id'";
        mysqli_query($db, $query);
        
        if($_SESSION['usuario_tipo']=='admin'){
            header("location: ../ca/ca_projectos");
        }elseif($_SESSION['usuario_tipo']=='chefe'){
            header("location: ../chef/projectos");
        }
    }
        
    /*****************************************
    *Eliminar Tarefa                         *
    *****************************************/
    if(isset($_POST['deletar_formacao'])){
        $formacao_id = $_POST['delFormation'];
        $query = "delete from tb_formacoes where formacao_id='$formacao_id'";
        mysqli_query($db, $query);

        header("location: ../chef/formacoes");
    }

/*************************
*Eliminar notícia        *
*************************/
if(isset($_POST['delNews'])){
    $noticia_id = $_POST['delNews'];
    
    $query = "select noticia_imagem from tb_noticias where noticia_id='$noticia_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    unlink("../imagens/noticias/".$row['noticia_imagem']);

    $query = "delete from tb_noticias where noticia_id='$noticia_id'";
    mysqli_query($db, $query);
    
    header("location: ../media/media_noticias");
}
?>