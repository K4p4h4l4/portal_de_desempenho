<?php

Class FormacaoInfo{
    
    //Função para retornar as formações de um determinado departamento
    public function get_formation_dtpo($db, $dpto){
        $output = array();
        $query = "select * from tb_formacoes where formacao_dpto = '$dpto' and formacao_chefdpto = 'Aprovada' and formacao_admin = 'Aprovada' and formacao_rh = 'Aprovada' order by formacao_id desc limit 100";
        $result = mysqli_query($db , $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output[] = array(
                "formacao_id" => $row['formacao_id'],
                "formacao_nome" => $row['formacao_nome'],
                "formacao_entidade" => $row['formacao_entidade'],
                "formacao_local" => $row['formacao_local'],
                "formacao_custo" => $row['formacao_custo'],
                "formacao_tipo" => $row['formacao_tipo'],
                "formacao_grupos" => $row['formacao_grupos'],
                "formacao_inicio" => $row['formacao_inicio'],
                "formacao_duracao" => $row['formacao_duracao'],
                "formacao_fim" => $row['formacao_fim'],
                "formacao_hinicio" => $row['formacao_hinicio'],
                "formacao_hfim" => $row['formacao_hfim'],
                "formacao_dpto" => $row['formacao_dpto'],
                "formacao_uid" => $row['formacao_uid'],
                "formacao_chefdpto" => $row['formacao_chefdpto'],
                "formacao_admin" => $row['formacao_admin'],
                "formacao_rh" => $row['formacao_rh']
            );
        }
        
        return $output;
        
    }
    
    //Função para retornar as formações a serem aprovadas pelo chefe de departamento
    public function get_formation_for_chef_aproval($db, $dpto){
        $output = array();
        $query = "select * from tb_formacoes where formacao_dpto = '$dpto' and formacao_chefdpto = 'Em analise' order by formacao_id desc limit 100";
        $result = mysqli_query($db , $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output[] = array(
                "formacao_id" => $row['formacao_id'],
                "formacao_nome" => $row['formacao_nome'],
                "formacao_entidade" => $row['formacao_entidade'],
                "formacao_local" => $row['formacao_local'],
                "formacao_custo" => $row['formacao_custo'],
                "formacao_tipo" => $row['formacao_tipo'],
                "formacao_grupos" => $row['formacao_grupos'],
                "formacao_inicio" => $row['formacao_inicio'],
                "formacao_duracao" => $row['formacao_duracao'],
                "formacao_fim" => $row['formacao_fim'],
                "formacao_hinicio" => $row['formacao_hinicio'],
                "formacao_hfim" => $row['formacao_hfim'],
                "formacao_dpto" => $row['formacao_dpto'],
                "formacao_uid" => $row['formacao_uid'],
                "formacao_chefdpto" => $row['formacao_chefdpto'],
                "formacao_admin" => $row['formacao_admin'],
                "formacao_rh" => $row['formacao_rh']
            );
        }
        
        return $output;
        
    }
    
    //Função para retornar as formações que precisam ser aprovadas pelo RH de outros departamentos
    public function get_formation_for_aproval_other($db){
        $output = array();
        $query = "select * from tb_formacoes where (formacao_dpto = 'DEETI' || formacao_dpto = 'DACA' || formacao_dpto = 'DAFSG' || formacao_dpto = 'DEC' || formacao_dpto = 'DRMSU' || formacao_dpto = 'DFM' || formacao_dpto = 'DFMCR' || formacao_dpto = 'DEGER') and formacao_chefdpto = 'Aprovada' and formacao_admin = 'Aprovada' and formacao_rh = 'Em analise' order by formacao_id desc limit 100";
        $result = mysqli_query($db , $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output[] = array(
                "formacao_id" => $row['formacao_id'],
                "formacao_nome" => $row['formacao_nome'],
                "formacao_entidade" => $row['formacao_entidade'],
                "formacao_local" => $row['formacao_local'],
                "formacao_custo" => $row['formacao_custo'],
                "formacao_tipo" => $row['formacao_tipo'],
                "formacao_grupos" => $row['formacao_grupos'],
                "formacao_inicio" => $row['formacao_inicio'],
                "formacao_duracao" => $row['formacao_duracao'],
                "formacao_fim" => $row['formacao_fim'],
                "formacao_hinicio" => $row['formacao_hinicio'],
                "formacao_hfim" => $row['formacao_hfim'],
                "formacao_dpto" => $row['formacao_dpto'],
                "formacao_uid" => $row['formacao_uid'],
                "formacao_chefdpto" => $row['formacao_chefdpto'],
                "formacao_admin" => $row['formacao_admin'],
                "formacao_rh" => $row['formacao_rh']
            );
        }
        
        return $output;
        
    }
    
    //Função para retornar as formações a serem aprovadas pelo chefe de departamento
    public function get_formation_for_admin_aproval($db, $dpto){
        $output = array();
        $query = "select * from tb_formacoes where formacao_dpto = '$dpto' and formacao_chefdpto = 'Aprovada' and formacao_admin = 'Em analise' order by formacao_id desc limit 100";
        $result = mysqli_query($db , $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output[] = array(
                "formacao_id" => $row['formacao_id'],
                "formacao_nome" => $row['formacao_nome'],
                "formacao_entidade" => $row['formacao_entidade'],
                "formacao_local" => $row['formacao_local'],
                "formacao_custo" => $row['formacao_custo'],
                "formacao_tipo" => $row['formacao_tipo'],
                "formacao_grupos" => $row['formacao_grupos'],
                "formacao_inicio" => $row['formacao_inicio'],
                "formacao_duracao" => $row['formacao_duracao'],
                "formacao_fim" => $row['formacao_fim'],
                "formacao_hinicio" => $row['formacao_hinicio'],
                "formacao_hfim" => $row['formacao_hfim'],
                "formacao_dpto" => $row['formacao_dpto'],
                "formacao_uid" => $row['formacao_uid'],
                "formacao_chefdpto" => $row['formacao_chefdpto'],
                "formacao_admin" => $row['formacao_admin'],
                "formacao_rh" => $row['formacao_rh']
            );
        }
        
        return $output;
        
    }
    
    //Função para retornar as formações de um determinado departamento
    public function get_formation_dtpo_acompanhamento($db, $dpto){
        $output = array();
        $query = "select * from tb_formacoes where formacao_dpto = '$dpto' order by formacao_id desc limit 100";
        $result = mysqli_query($db , $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output[] = array(
                "formacao_id" => $row['formacao_id'],
                "formacao_nome" => $row['formacao_nome'],
                "formacao_entidade" => $row['formacao_entidade'],
                "formacao_local" => $row['formacao_local'],
                "formacao_custo" => $row['formacao_custo'],
                "formacao_tipo" => $row['formacao_tipo'],
                "formacao_grupos" => $row['formacao_grupos'],
                "formacao_inicio" => $row['formacao_inicio'],
                "formacao_duracao" => $row['formacao_duracao'],
                "formacao_fim" => $row['formacao_fim'],
                "formacao_hinicio" => $row['formacao_hinicio'],
                "formacao_hfim" => $row['formacao_hfim'],
                "formacao_dpto" => $row['formacao_dpto'],
                "formacao_uid" => $row['formacao_uid'],
                "formacao_chefdpto" => $row['formacao_chefdpto'],
                "formacao_admin" => $row['formacao_admin'],
                "formacao_rh" => $row['formacao_rh']
            );
        }
        
        return $output;
        
    }
    
    //Função para retornar formações da qual um usuário faz parte
    public function get_user_formation($db, $uid){
        $output = array();
        $query = "SELECT * FROM tb_formacoes INNER JOIN tb_formacoes_membros WHERE tb_formacoes.formacao_id = tb_formacoes_membros.formacoes_membros_fid AND tb_formacoes_membros.formacoes_membros_uid = '$uid' order by tb_formacoes.formacao_id desc limit 100";
        $result = mysqli_query($db , $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output[] = array(
                "formacao_id" => $row['formacao_id'],
                "formacao_nome" => $row['formacao_nome'],
                "formacao_entidade" => $row['formacao_entidade'],
                "formacao_local" => $row['formacao_local'],
                "formacao_custo" => $row['formacao_custo'],
                "formacao_tipo" => $row['formacao_tipo'],
                "formacao_grupos" => $row['formacao_grupos'],
                "formacao_inicio" => $row['formacao_inicio'],
                "formacao_duracao" => $row['formacao_duracao'],
                "formacao_fim" => $row['formacao_fim'],
                "formacao_hinicio" => $row['formacao_hinicio'],
                "formacao_hfim" => $row['formacao_hfim'],
                "formacao_dpto" => $row['formacao_dpto'],
                "formacao_uid" => $row['formacao_uid'],
                "formacao_chefdpto" => $row['formacao_chefdpto'],
                "formacao_admin" => $row['formacao_admin'],
                "formacao_rh" => $row['formacao_rh']
            );
        }
        
        return $output;
    }
    
    public function get_formation_members($db, $fid){
        $output = array();
        $query = "SELECT tb_usuarios.usuario_id, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_departamento from tb_formacoes_membros INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_id = tb_formacoes_membros.formacoes_membros_uid AND tb_formacoes_membros.formacoes_membros_fid='$fid'";
        $result = mysqli_query($db , $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output[] = array(
                "usuario_id" => $row['usuario_id'],
                "usuario_nome" => $row['usuario_nome'],
                "usuario_sobrenome" => $row['usuario_sobrenome'],
                "usuario_departamento" => $row['usuario_departamento']
            );
        }
        
        return $output;
    }
    
    //Função para retornar apenas os detalhes de uma formação
    public function get_formation_details($db,$fid){
        $output = array();
        $query = "select * from tb_formacoes where formacao_id = '$fid' order by formacao_id desc limit 100";
        $result = mysqli_query($db , $query);
        $row = mysqli_fetch_assoc($result);
        
        $output[] = array(
            "formacao_id" => $row['formacao_id'],
            "formacao_nome" => $row['formacao_nome'],
            "formacao_entidade" => $row['formacao_entidade'],
            "formacao_local" => $row['formacao_local'],
            "formacao_custo" => $row['formacao_custo'],
            "formacao_tipo" => $row['formacao_tipo'],
            "formacao_grupos" => $row['formacao_grupos'],
            "formacao_nmembros" => $row['formacao_nmembros'],
            "formacao_inicio" => $row['formacao_inicio'],
            "formacao_inicio_especial" => date('Y-m-d',strtotime($row['formacao_inicio'])),
            "formacao_duracao" => $row['formacao_duracao'],
            "formacao_fim" => $row['formacao_fim'],
            "formacao_hinicio" => $row['formacao_hinicio'],
            "formacao_hfim" => $row['formacao_hfim'],
            "formacao_dpto" => $row['formacao_dpto'],
            "formacao_uid" => $row['formacao_uid'],
            "formacao_chefdpto" => $row['formacao_chefdpto'],
            "formacao_admin" => $row['formacao_admin'],
            "formacao_rh" => $row['formacao_rh'],
            "formacao_exame" => $row['formacao_exame'],
            "formacao_exame_data" => $row['formacao_exame_data']
        );
        
        return $output;
        
    }   
    
}
 
?>