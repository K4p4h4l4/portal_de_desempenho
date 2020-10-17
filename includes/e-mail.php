<?php 
    include("./conexao.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $host = '192.178.1.199'; /* webmail.inacom.gov.ao ou 192.178.1.199 */
    $username = 'portal.colaborador@inacom.gov.ao';
    $password = '1n@k0nn';

    function checklist($db, $id){
        $output = '';
        $query = "select * from tb_checklist where checklist_tid='".$id."' ";
        $result = mysqli_query($db, $query);

        while($row = mysqli_fetch_assoc($result)){
            $output .= '<li>   
                            <b><p>'.$row['checklist_nome'].'</p></b>
                        </li>';
        }

        return $output;
    }

    function members($db, $id){
        $output = '';
        $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_usuarios INNER JOIN tb_membrostpc WHERE tb_usuarios.usuario_id = tb_membrostpc.membroTPC_uid and tb_membrostpc.membroTPC_tid='".$id."'";
        $result = mysqli_query($db, $query);

        while($row = mysqli_fetch_assoc($result)){
            $output .= '<li>
                            <b><p>'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</p></b>
                        </li>';
        }

        return $output;
    }
    

    /******************************************
    *Método Post para enviar e-mail de notifi-*
    *cação de nova tarefa                     *
    ******************************************/
    if(isset($_POST['work_id'])){
        
        $query = "select * from tb_tarefas where tarefa_id = '".$_POST['work_id']."' ";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $tarefa_nome = $row['tarefa_nome'];
        $tarefa_inicio = $row['tarefa_inicio'];
        $tarefa_fim = $row['tarefa_fim'];
        $tarefa_prioridade = $row['tarefa_prioridade'];
        $checklist = checklist($db,$_POST['work_id']);
        $members = members($db,$_POST['work_id']);

        $query = "SELECT tb_usuarios.usuario_email FROM tb_usuarios INNER JOIN tb_membrostpc WHERE tb_usuarios.usuario_id = tb_membrostpc.membroTPC_uid and tb_membrostpc.membroTPC_tid = '".$_POST['work_id']."'";
        
        $result = mysqli_query($db, $query);
        
        while($row = mysqli_fetch_assoc($result)){
        
            $email = ''.$row['usuario_email'].'';

            require '../composer/vendor/autoload.php';

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail = new PHPMailer(true);

                    try{

                    $mail->isSMTP();

                    /*--------------De ------------------*/
                    $mail->setFrom('portal.colaborador@inacom.gov.ao');

                    /*---------------Para----------------*/
                    $mail->addAddress($email);

                    /*--------caracteres especiais--------*/
                    $mail->CharSet  = 'UTF-8';

                    /*-----Habilitando HTML---------------*/
                    $mail->isHTML(true);

                    /*---------------Tema----------------*/
                    $mail->Subject = 'Notificação de Nova Tarefa';

                    /*--------------Corpo----------------*/
                    $mail->Body = '<!DOCTYPE html>
                                    <html lang="pt-PT">
                                        <head>
                                            <meta charset="utf-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title></title>
                                            <style>
                                                .body{
                                                    margin: 12px 16px 10px 52px;
                                                }
                                            </style>
                                        </head>

                                    <body>
                                        <div class="body">

                                        </div>   
                                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" align="center" bgcolor="3b4a69" style="padding: 0 15px"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="_2zOpJb7ZbCN0X1DoeFyiYw JWNdg1hee9_Rz6bIGvG1c allowTextSelection"><div><div class="rps_d981">
                                            <div style="">
                                                <div style="color: rgb(254, 254, 254); display: none; font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                                            </div>
                                            <table id="x_main" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="center" bgcolor="#3b4a69" style="padding:0 15px">
                                                            <table class="x_innermain" cellpadding="0" width="100%" cellspacing="0" border="0" align="center" style="margin:0 auto; table-layout:fixed; border-collapse:collapse!important; max-width:600px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" width="100%">
                                                                            <table class="x_logo" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" valign="top" style="padding:30px 0">
                                                                                            <img data-imagetype="External" src="http://consultapublica.inacom.gov.ao/img/logo_branco.png" border="0" style="border:0; display:block; height:100%; line-height:100%; outline:none; text-decoration:none">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:4px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                    <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px">
                                                                                        <td class="x_content" colspan="2" valign="top" align="center" style="padding-left:40px; padding-right:40px">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="bottom" colspan="2" cellpadding="3">
                                                                                                            <img data-imagetype="External" src="https://image.flaticon.com/icons/svg/1545/1545213.svg" alt="Coinbase" width="80">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <span style="color:#48545d; font-size:22px; line-height:24px; font-family: sans-serif;">Notificação
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="1" bgcolor="#DAE1E9"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="40"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" style="color:#03a9f4; font-size:30px; line-height:24px; font-family: sans-serif; font-weight:500;">
                                                                                                            <span>Olá prezado(a),</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Espero que este e-mail o encontre bem. </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;"><strong>O Portal do Colaborador,</strong> vem pelo presente e-mail informar que você possuí uma nova tarefa <strong>'.$tarefa_nome.'</strong>, que vai de <strong>'.$tarefa_inicio.'</strong> á <strong>'.$tarefa_fim.'</strong> com prioridade <strong>'.$tarefa_prioridade.'</strong>.</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Esta mesma tarefa possuí a seguinte checklist: 
                                                                                                        </td>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <ul>'.$checklist.'</ul>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Os membros desta tarefa são: 
                                                                                                        </td>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <ul>'.$members.'</ul>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Caso já tenha feito, por favor desconsiderar este e-mail.</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="12"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Atenciosamente,</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Portal do Colaborador</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <a href="http://myinacom.gov.ao" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="display:block; padding:15px 25px; background-color:#4A90E2; color:#ffffff; border-radius:3px; text-decoration:none; margin-top:20px">Ir Para o Portal</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <p style="color:#48545d; font-size:12px; line-height:12px">Realçando que o portal só poderá ser acessado dentro da Instituição.
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="10">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="center">
                                                                                            <span style="color:#fefefe; font-size:10px">
                                                                                                © <a href="http://www.inacom.gov.ao/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fefefe!important; text-decoration:none">
                                                                                                INACOM</a> 2020 
                                                                                            </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">INSTITUTO ANGOLANO DAS COMUNICAÇOES
                                                                                                </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">Avenida Dr. António Agostinho Neto, nº 25 Zona C | Praia do Bispo | Luanda - Angola
                                                                                                </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="50">&nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
                                    ';

                    /*--------Servidor de SMTP-----------*/
                    $mail->Host = $host; /*'webmail.inacom.gov.ao'192.178.1.199*/

                    /*--------Autenticação no SMTP--------*/
                    $mail->SMTPAuth = false;

                    /*--------------Anexo------------------*/
                    /*if(strlen($novo_nome_do_ficheiro > 0)){
                        $mail->addAttachment('../uploads/'.$novo_nome_do_ficheiro);
                    }*/

                    /*------Sistema de criptografia-------*/
                    $mail->SMTPSecure = 'tls'; /*tls, ssl*/

                    /*-Nome de usuário de autenticação do SMTP-*/
                    $mail->Username = $username;/*''*/

                    /*-Palavra-passe de autenticação do SMTP-*/
                    $mail->Password = $password;/*'sjfxmqdaqhelpeav'*/

                    /*-------Com cópia oculta-------------*/
                    /*$mail->addBCC('consulta.publica.inacom@gmail.com');*/

                    /*----Configurando a porta do SMTP----*/
                    $mail->Port = 25; //587;

                    /*----Configurar linguagem-----*/
                    $mail->setLanguage('pt');

                    /*---------Debugg--------------*/
                    $mail->SMTPDebug = 3;

                    $mail->smtpConnect(
                                array(
                                    "ssl" => array(
                                        "verify_peer" => false,
                                        "verify_peer_name" => false,
                                        "allow_self_signed" => true
                                    )
                                )
                            );

                    /*------------Enviar E-mail------------*/
                    $mail->Send();

                    }catch (Exception $e){

                        /* PHPMailer exception. */
                        echo $e->errorMessage();

                    }catch (\Exception $e){

                       /* PHP exception (note the backslash to select the global namespace Exception class). */
                       echo $e->getMessage();

                    }
                }else{

                    echo("$email não é um e-mail válido");

                }
            }
    }

    /******************************************
    *Método Post para enviar e-mail de notifi-*
    *cação da existência de um novo Projecto  *
    ******************************************/
    if(isset($_POST['projecto_id'])){
        
        $query = "select * from tb_projectos where projecto_id = '".$_POST['projecto_id']."' ";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $projecto_nome = $row['projecto_nome'];
        $projecto_inicio = $row['projecto_inicio'];
        $projecto_fim = $row['projecto_fim'];

        $query = "SELECT tb_usuarios.usuario_email FROM tb_usuarios INNER JOIN tb_membrosproject WHERE tb_usuarios.usuario_id = tb_membrosproject.membrosproject_uid and tb_membrosproject.membrosproject_pid = '".$_POST['projecto_id']."'";
        
        $result = mysqli_query($db, $query);
        
        while($row = mysqli_fetch_assoc($result)){
        
            $email = ''.$row['usuario_email'].'';

            require '../composer/vendor/autoload.php';

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail = new PHPMailer(true);

                    try{

                    $mail->isSMTP();

                    /*--------------De ------------------*/
                    $mail->setFrom('portal.colaborador@inacom.gov.ao');

                    /*---------------Para----------------*/
                    $mail->addAddress($email);

                    /*--------caracteres especiais--------*/
                    $mail->CharSet  = 'UTF-8';

                    /*-----Habilitando HTML---------------*/
                    $mail->isHTML(true);

                    /*---------------Tema----------------*/
                    $mail->Subject = 'Novo Projecto';

                    /*--------------Corpo----------------*/
                    $mail->Body = '<!DOCTYPE html>
                                    <html lang="pt-PT">
                                        <head>
                                            <meta charset="utf-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title></title>
                                            <style>
                                                .body{
                                                    margin: 12px 16px 10px 52px;
                                                }
                                            </style>
                                        </head>

                                    <body>
                                        <div class="body">

                                        </div>   
                                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" align="center" bgcolor="3b4a69" style="padding: 0 15px"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="_2zOpJb7ZbCN0X1DoeFyiYw JWNdg1hee9_Rz6bIGvG1c allowTextSelection"><div><div class="rps_d981">
                                            <div style="">
                                                <div style="color: rgb(254, 254, 254); display: none; font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                                            </div>
                                            <table id="x_main" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="center" bgcolor="#3b4a69" style="padding:0 15px">
                                                            <table class="x_innermain" cellpadding="0" width="100%" cellspacing="0" border="0" align="center" style="margin:0 auto; table-layout:fixed; border-collapse:collapse!important; max-width:600px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" width="100%">
                                                                            <table class="x_logo" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" valign="top" style="padding:30px 0">
                                                                                            <img data-imagetype="External" src="http://consultapublica.inacom.gov.ao/img/logo_branco.png" border="0" style="border:0; display:block; height:100%; line-height:100%; outline:none; text-decoration:none">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:4px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                    <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px">
                                                                                        <td class="x_content" colspan="2" valign="top" align="center" style="padding-left:40px; padding-right:40px">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="bottom" colspan="2" cellpadding="3">
                                                                                                            <img data-imagetype="External" src="https://image.flaticon.com/icons/svg/1001/1001265.svg" alt="Coinbase" width="80">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <span style="color:#48545d; font-size:22px; line-height:24px; font-family: sans-serif;">Novo Projecto
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="1" bgcolor="#DAE1E9"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="40"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" style="color:#03a9f4; font-size:30px; line-height:24px; font-family: sans-serif; font-weight:500;">
                                                                                                            <span>Olá prezado(a),</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Espero que este e-mail o encontre bem. </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;"><strong>O Portal do Colaborador,</strong> vem por este meio informar que você faz parte do novo projecto <strong>'.$projecto_nome.'</strong>, que começa no dia <strong>'.$projecto_inicio.'</strong> e que possui uma previsão de término dia <strong>'.$projecto_fim.'</strong>.
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                                                                        
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Caso já tenha dado início aos trabalhos, queira por favor desconsiderar este e-mail.</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="12"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Atenciosamente,</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Portal do Colaborador</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <a href="http://myinacom.gov.ao" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="display:block; padding:15px 25px; background-color:#4A90E2; color:#ffffff; border-radius:3px; text-decoration:none; margin-top:20px">Ir Para o Portal</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <p style="color:#48545d; font-size:12px; line-height:12px">Realçando que o portal só poderá ser acessado dentro da Instituição.
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="10">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="center">
                                                                                            <span style="color:#fefefe; font-size:10px">
                                                                                                © <a href="http://www.inacom.gov.ao/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fefefe!important; text-decoration:none">
                                                                                                INACOM</a> 2020 
                                                                                            </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">INSTITUTO ANGOLANO DAS COMUNICAÇOES
                                                                                                </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">Avenida Dr. António Agostinho Neto, nº 25 Zona C | Praia do Bispo | Luanda - Angola
                                                                                                </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="50">&nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
                                    ';

                    /*--------Servidor de SMTP-----------*/
                    $mail->Host = $host; /*'webmail.inacom.gov.ao' 192.178.1.199*/

                    /*--------Autenticação no SMTP--------*/
                    $mail->SMTPAuth = false;

                    /*--------------Anexo------------------*/
                    /*if(strlen($novo_nome_do_ficheiro > 0)){
                        $mail->addAttachment('../uploads/'.$novo_nome_do_ficheiro);
                    }*/

                    /*------Sistema de criptografia-------*/
                    $mail->SMTPSecure = 'tls'; /*tls, ssl*/

                    /*-Nome de usuário de autenticação do SMTP-*/
                    $mail->Username = $username;/*''*/

                    /*-Palavra-passe de autenticação do SMTP-*/
                    $mail->Password = $password;/*'sjfxmqdaqhelpeav'*/

                    /*-------Com cópia oculta-------------*/
                    /*$mail->addBCC('consulta.publica.inacom@gmail.com');*/

                    /*----Configurando a porta do SMTP----*/
                    $mail->Port = 25; //587;

                    /*----Configurar linguagem-----*/
                    $mail->setLanguage('pt');

                    /*---------Debugg--------------*/
                    $mail->SMTPDebug = 3;

                    $mail->smtpConnect(
                                array(
                                    "ssl" => array(
                                        "verify_peer" => false,
                                        "verify_peer_name" => false,
                                        "allow_self_signed" => true
                                    )
                                )
                            );

                    /*------------Enviar E-mail------------*/
                    $mail->Send();

                    }catch (Exception $e){

                        /* PHPMailer exception. */
                        echo $e->errorMessage();

                    }catch (\Exception $e){

                       /* PHP exception (note the backslash to select the global namespace Exception class). */
                       echo $e->getMessage();

                    }
                }else{

                    echo("$email não é um e-mail válido");

                }
            }
    }

    /******************************************
    *Email para informar de um projecto parado*
    ******************************************/
    if(isset($_POST['stopped_project'])){
        $stopped_project = $_POST['stopped_project'];
        $emails = array();
        
        $query = "SELECT tb_usuarios.usuario_email, tb_projectos.projecto_nome, tb_projectos.projecto_status, tb_projectos.projecto_dpto FROM tb_usuarios INNER JOIN tb_membrosproject INNER JOIN tb_projectos WHERE tb_usuarios.usuario_id=tb_membrosproject.membrosproject_uid and tb_membrosproject.membrosproject_pid=tb_projectos.projecto_id AND tb_projectos.projecto_id='$stopped_project';";
        
        $result = mysqli_query($db, $query);
        
        $row = mysqli_fetch_assoc($result);
        $projecto_nome = $row['projecto_nome'];
        $projecto_status = $row['projecto_status'];
        $projecto_dpto = $row['projecto_dpto'];
        
        while( $row = mysqli_fetch_assoc($result) ){
            array_push($emails, $row['usuario_email']);
        }
        
        $query = "select usuario_email from tb_usuarios where usuario_tipo='chefe' and usuario_departamento='$projecto_dpto'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        array_push($emails, $row['usuario_email']);
              
        $body = '<!DOCTYPE html>
                                    <html lang="pt-PT">
                                        <head>
                                            <meta charset="utf-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title></title>
                                            <style>
                                                .body{
                                                    margin: 12px 16px 10px 52px;
                                                }
                                            </style>
                                        </head>

                                    <body>
                                        <div class="body">

                                        </div>   
                                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" align="center" bgcolor="3b4a69" style="padding: 0 15px"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="_2zOpJb7ZbCN0X1DoeFyiYw JWNdg1hee9_Rz6bIGvG1c allowTextSelection"><div><div class="rps_d981">
                                            <div style="">
                                                <div style="color: rgb(254, 254, 254); display: none; font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                                            </div>
                                            <table id="x_main" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="center" bgcolor="#3b4a69" style="padding:0 15px">
                                                            <table class="x_innermain" cellpadding="0" width="100%" cellspacing="0" border="0" align="center" style="margin:0 auto; table-layout:fixed; border-collapse:collapse!important; max-width:600px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" width="100%">
                                                                            <table class="x_logo" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" valign="top" style="padding:30px 0">
                                                                                            <img data-imagetype="External" src="http://consultapublica.inacom.gov.ao/img/logo_branco.png" border="0" style="border:0; display:block; height:100%; line-height:100%; outline:none; text-decoration:none">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:4px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                    <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px">
                                                                                        <td class="x_content" colspan="2" valign="top" align="center" style="padding-left:40px; padding-right:40px">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="bottom" colspan="2" cellpadding="3">
                                                                                                            <img data-imagetype="External" src="https://image.flaticon.com/icons/svg/747/747967.svg" alt="Coinbase" width="80">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <span style="color:#48545d; font-size:22px; line-height:24px; font-family: sans-serif;">Projecto Parado
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="1" bgcolor="#DAE1E9"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="40"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" style="color:#03a9f4; font-size:30px; line-height:24px; font-family: sans-serif; font-weight:500;">
                                                                                                            <span>Olá prezado(a),</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Espero que este e-mail o encontre bem. </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;"><strong>O Portal do Colaborador,</strong> vem por este meio informar que o projecto <strong>'.$projecto_nome.'</strong>, encontra-se actualmente <strong>'.$projecto_status.'</strong>. Enquanto o projecto estiver em curso não se esqueça de inserir o ponto de situação todas as semanas.
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                                                                        
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Caso já tenha dado o ponto de situação, queira por favor desconsiderar este e-mail.</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="12"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Atenciosamente,</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Portal do Colaborador</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <a href="http://myinacom.gov.ao" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="display:block; padding:15px 25px; background-color:#4A90E2; color:#ffffff; border-radius:3px; text-decoration:none; margin-top:20px">Ir Para o Portal</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <p style="color:#48545d; font-size:12px; line-height:12px">Realçando que o portal só poderá ser acessado dentro da Instituição.
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="10">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="center">
                                                                                            <span style="color:#fefefe; font-size:10px">
                                                                                                © <a href="http://www.inacom.gov.ao/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fefefe!important; text-decoration:none">
                                                                                                INACOM</a> 2020 
                                                                                            </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">INSTITUTO ANGOLANO DAS COMUNICAÇOES
                                                                                                </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">Avenida Dr. António Agostinho Neto, nº 25 Zona C | Praia do Bispo | Luanda - Angola
                                                                                                </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="50">&nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
                                    ';
        
        for($i=0;i<count($emails);$i++){
            
            require '../composer/vendor/autoload.php';
            
            if(filter_var($emails[$i],FILTER_SANITIZE_EMAIL)){
                
                $mail = new PHPMailer(true);
                
                try{
                    $mail->isSMTP();

                    /*--------------De ------------------*/
                    $mail->setFrom('portal.colaborador@inacom.gov.ao');

                    /*---------------Para----------------*/
                    $mail->addAddress($emails[$i]);

                    /*--------caracteres especiais--------*/
                    $mail->CharSet  = 'UTF-8';

                    /*-----Habilitando HTML---------------*/
                    $mail->isHTML(true);

                    /*---------------Tema----------------*/
                    $mail->Subject = 'Projecto Parado';

                    /*--------------Corpo----------------*/
                    $mail->Body = $body;
                    
                    /*--------Servidor de SMTP-----------*/
                    $mail->Host = $host; /*'webmail.inacom.gov.ao' 192.178.1.199*/

                    /*--------Autenticação no SMTP--------*/
                    $mail->SMTPAuth = false;

                    /*--------------Anexo------------------*/
                    /*if(strlen($novo_nome_do_ficheiro > 0)){
                        $mail->addAttachment('../uploads/'.$novo_nome_do_ficheiro);
                    }*/

                    /*------Sistema de criptografia-------*/
                    $mail->SMTPSecure = 'tls'; /*tls, ssl*/

                    /*-Nome de usuário de autenticação do SMTP-*/
                    $mail->Username = $username;/*''*/

                    /*-Palavra-passe de autenticação do SMTP-*/
                    $mail->Password = $password;/*'sjfxmqdaqhelpeav'*/

                    /*-------Com cópia oculta-------------*/
                    /*$mail->addBCC('consulta.publica.inacom@gmail.com');*/

                    /*----Configurando a porta do SMTP----*/
                    $mail->Port = 25; //587;

                    /*----Configurar linguagem-----*/
                    $mail->setLanguage('pt');

                    /*---------Debugg--------------*/
                    $mail->SMTPDebug = 3;

                    $mail->smtpConnect(
                                array(
                                    "ssl" => array(
                                        "verify_peer" => false,
                                        "verify_peer_name" => false,
                                        "allow_self_signed" => true
                                    )
                                )
                            );

                    /*------------Enviar E-mail------------*/
                    $mail->Send();
                }catch (Exception $e){

                    /* PHPMailer exception. */
                    echo $e->errorMessage();

                }catch (\Exception $e){

                   /* PHP exception (note the backslash to select the global namespace Exception class). */
                   echo $e->getMessage();

                }
                
            }else{

                echo("$emails[$i] não é um e-mail válido");

            }
        }
    }

    /*************************************************************
    *Email para notificar chefe de departamento da necessidade de*
    *revisar uma tarefa                                          *
    *************************************************************/
    if(isset($_POST['task_forRevision'])){
        $tarefa_id = $_POST['task_forRevision'];
        
        $query = "select tb_tarefas.tarefa_nome, tb_tarefas.tarefa_dpto FROM tb_tarefas WHERE tb_tarefas.tarefa_id = '$tarefa_id';";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $tarefa_nome = $row['tarefa_nome'];
        $tarefa_dpto = $row['tarefa_dpto'];
        
        $query = "select usuario_email from tb_usuarios where usuario_tipo='chefe' and usuario_departamento='$tarefa_dpto';";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $email = $row['usuario_email'];
        
        $body = '<!DOCTYPE html>
                                    <html lang="pt-PT">
                                        <head>
                                            <meta charset="utf-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title></title>
                                            <style>
                                                .body{
                                                    margin: 12px 16px 10px 52px;
                                                }
                                            </style>
                                        </head>

                                    <body>
                                        <div class="body">

                                        </div>   
                                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" align="center" bgcolor="3b4a69" style="padding: 0 15px"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="_2zOpJb7ZbCN0X1DoeFyiYw JWNdg1hee9_Rz6bIGvG1c allowTextSelection"><div><div class="rps_d981">
                                            <div style="">
                                                <div style="color: rgb(254, 254, 254); display: none; font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                                            </div>
                                            <table id="x_main" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="center" bgcolor="#3b4a69" style="padding:0 15px">
                                                            <table class="x_innermain" cellpadding="0" width="100%" cellspacing="0" border="0" align="center" style="margin:0 auto; table-layout:fixed; border-collapse:collapse!important; max-width:600px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" width="100%">
                                                                            <table class="x_logo" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" valign="top" style="padding:30px 0">
                                                                                            <img data-imagetype="External" src="http://consultapublica.inacom.gov.ao/img/logo_branco.png" border="0" style="border:0; display:block; height:100%; line-height:100%; outline:none; text-decoration:none">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:4px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                    <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px">
                                                                                        <td class="x_content" colspan="2" valign="top" align="center" style="padding-left:40px; padding-right:40px">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="bottom" colspan="2" cellpadding="3">
                                                                                                            <img data-imagetype="External" src="https://image.flaticon.com/icons/svg/1545/1545570.svg" alt="Coinbase" width="80">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <span style="color:#48545d; font-size:22px; line-height:24px; font-family: sans-serif;">Tarefa para revisão
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="1" bgcolor="#DAE1E9"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="40"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" style="color:#03a9f4; font-size:30px; line-height:24px; font-family: sans-serif; font-weight:500;">
                                                                                                            <span>Olá prezado(a),</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Espero que este e-mail o encontre bem. </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;"><strong>O Portal do Colaborador,</strong> vem por este meio informar que a tarefa  <strong>'.$tarefa_nome.'</strong>, carece de uma <strong>revisão</strong> da sua parte.
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                                                                        
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Caso já tenha revisado a mesma, queira por favor desconsiderar este e-mail.</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="12"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Atenciosamente,</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Portal do Colaborador</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <a href="http://myinacom.gov.ao" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="display:block; padding:15px 25px; background-color:#4A90E2; color:#ffffff; border-radius:3px; text-decoration:none; margin-top:20px">Ir Para o Portal</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <p style="color:#48545d; font-size:12px; line-height:12px">Realçando que o portal só poderá ser acessado dentro da Instituição.
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="10">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="center">
                                                                                            <span style="color:#fefefe; font-size:10px">
                                                                                                © <a href="http://www.inacom.gov.ao/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fefefe!important; text-decoration:none">
                                                                                                INACOM</a> 2020 
                                                                                            </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">INSTITUTO ANGOLANO DAS COMUNICAÇOES
                                                                                                </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">Avenida Dr. António Agostinho Neto, nº 25 Zona C | Praia do Bispo | Luanda - Angola
                                                                                                </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="50">&nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
                                    ';
        
        require '../composer/vendor/autoload.php';
        
        if(filter_var($email,FILTER_SANITIZE_EMAIL)){
                
                $mail = new PHPMailer(true);
                
                try{
                    $mail->isSMTP();

                    /*--------------De ------------------*/
                    $mail->setFrom('portal.colaborador@inacom.gov.ao');

                    /*---------------Para----------------*/
                    $mail->addAddress($email);

                    /*--------caracteres especiais--------*/
                    $mail->CharSet  = 'UTF-8';

                    /*-----Habilitando HTML---------------*/
                    $mail->isHTML(true);

                    /*---------------Tema----------------*/
                    $mail->Subject = 'Tarefa para Revisão';

                    /*--------------Corpo----------------*/
                    $mail->Body = $body;
                    
                    /*--------Servidor de SMTP-----------*/
                    $mail->Host = $host; /*'webmail.inacom.gov.ao' 192.178.1.199*/

                    /*--------Autenticação no SMTP--------*/
                    $mail->SMTPAuth = false;

                    /*--------------Anexo------------------*/
                    /*if(strlen($novo_nome_do_ficheiro > 0)){
                        $mail->addAttachment('../uploads/'.$novo_nome_do_ficheiro);
                    }*/

                    /*------Sistema de criptografia-------*/
                    $mail->SMTPSecure = 'tls'; /*tls, ssl*/

                    /*-Nome de usuário de autenticação do SMTP-*/
                    $mail->Username = $username;/*''*/

                    /*-Palavra-passe de autenticação do SMTP-*/
                    $mail->Password = $password;/*'sjfxmqdaqhelpeav'*/

                    /*-------Com cópia oculta-------------*/
                    /*$mail->addBCC('consulta.publica.inacom@gmail.com');*/

                    /*----Configurando a porta do SMTP----*/
                    $mail->Port = 25; //587;

                    /*----Configurar linguagem-----*/
                    $mail->setLanguage('pt');

                    /*---------Debugg--------------*/
                    $mail->SMTPDebug = 3;

                    $mail->smtpConnect(
                                array(
                                    "ssl" => array(
                                        "verify_peer" => false,
                                        "verify_peer_name" => false,
                                        "allow_self_signed" => true
                                    )
                                )
                            );

                    /*------------Enviar E-mail------------*/
                    $mail->Send();
                }catch (Exception $e){

                    /* PHPMailer exception. */
                    echo $e->errorMessage();

                }catch (\Exception $e){

                   /* PHP exception (note the backslash to select the global namespace Exception class). */
                   echo $e->getMessage();

                }
        }else{
            echo("$email não é um e-mail válido");
        }
    }

if(isset($_POST['formacao_criada'])){
    $formacao_id = $_POST['formacao_criada'];
    
    $query = "SELECT tb_formacoes.formacao_nome, tb_formacoes.formacao_entidade, tb_formacoes.formacao_local, tb_formacoes.formacao_inicio, tb_formacoes.formacao_hinicio, tb_formacoes.formacao_hfim, tb_formacoes.formacao_duracao, tb_formacoes.formacao_dpto, tb_usuarios.usuario_email FROM tb_formacoes INNER JOIN tb_usuarios INNER JOIN tb_formacoes_membros WHERE tb_usuarios.usuario_id = tb_formacoes_membros.formacoes_membros_uid AND tb_formacoes_membros.formacoes_membros_fid = tb_formacoes.formacao_id AND tb_formacoes.formacao_id = '$formacao_id';";
    
    $result = mysqli_query($db, $query);
    $emails = array();
    $row = mysqli_fetch_assoc($result);
    $formacao_nome = $row['formacao_nome'];
    $formacao_entidade = $row['formacao_entidade'];
    $formacao_local = $row['formacao_local'];
    $formacao_inicio = $row['formacao_inicio'];
    $formacao_hinicio = $row['formacao_hinicio'];
    $formacao_hfim = $row['formacao_hfim'];
    $formacao_duracao = $row['formacao_duracao'];
    $formacao_dpto = $row['formacao_dpto'];
    
    $query = "SELECT tb_usuarios.usuario_email FROM tb_formacoes INNER JOIN tb_usuarios INNER JOIN tb_formacoes_membros WHERE tb_usuarios.usuario_id = tb_formacoes_membros.formacoes_membros_uid AND tb_formacoes_membros.formacoes_membros_fid = tb_formacoes.formacao_id AND tb_formacoes.formacao_id = '$formacao_id';";
    
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        array_push($emails, $row['usuario_email']);
    }
    
    $query = "select usuario_email from tb_usuarios where usuario_tipo='chefe' and usuario_departamento='$formacao_dpto';";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    array_push($emails, $row['usuario_email']);
    
    $body = '<!DOCTYPE html>
                                    <html lang="pt-PT">
                                        <head>
                                            <meta charset="utf-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title></title>
                                            <style>
                                                .body{
                                                    margin: 12px 16px 10px 52px;
                                                }
                                            </style>
                                        </head>

                                    <body>
                                        <div class="body">

                                        </div>   
                                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" align="center" bgcolor="3b4a69" style="padding: 0 15px"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="_2zOpJb7ZbCN0X1DoeFyiYw JWNdg1hee9_Rz6bIGvG1c allowTextSelection"><div><div class="rps_d981">
                                            <div style="">
                                                <div style="color: rgb(254, 254, 254); display: none; font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                                            </div>
                                            <table id="x_main" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="center" bgcolor="#3b4a69" style="padding:0 15px">
                                                            <table class="x_innermain" cellpadding="0" width="100%" cellspacing="0" border="0" align="center" style="margin:0 auto; table-layout:fixed; border-collapse:collapse!important; max-width:600px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" width="100%">
                                                                            <table class="x_logo" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" valign="top" style="padding:30px 0">
                                                                                            <img data-imagetype="External" src="http://consultapublica.inacom.gov.ao/img/logo_branco.png" border="0" style="border:0; display:block; height:100%; line-height:100%; outline:none; text-decoration:none">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:4px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                    <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px">
                                                                                        <td class="x_content" colspan="2" valign="top" align="center" style="padding-left:40px; padding-right:40px">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="bottom" colspan="2" cellpadding="3">
                                                                                                            <img data-imagetype="External" src="https://image.flaticon.com/icons/svg/1001/1001271.svg" alt="Coinbase" width="80">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <span style="color:#48545d; font-size:22px; line-height:24px; font-family: sans-serif;">Nova Formação
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="1" bgcolor="#DAE1E9"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="40"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" style="color:#03a9f4; font-size:30px; line-height:24px; font-family: sans-serif; font-weight:500;">
                                                                                                            <span>Olá prezado(a),</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Espero que este e-mail o encontre bem. </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">O<strong> Portal do Colaborador,</strong> vem por este meio informar que você possuí uma nova formação <strong>'.$formacao_nome.'</strong>, que começará no dia <strong>'.$formacao_inicio.'</strong> com uma duração de <strong>'.$formacao_duracao.'</strong> dias das <strong>'.$formacao_hinicio.'</strong> ás <strong>'.$formacao_hfim.'</strong>, pela <strong>'.$formacao_entidade.'</strong> com a seguinte localização <strong>'.$formacao_local.'</strong>.
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                                                                        
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Caso já tenha começado a mesma, queira por favor desconsiderar este e-mail.</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="12"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Atenciosamente,</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Portal do Colaborador</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <a href="http://myinacom.gov.aof" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="display:block; padding:15px 25px; background-color:#4A90E2; color:#ffffff; border-radius:3px; text-decoration:none; margin-top:20px">Ir Para o Portal</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <p style="color:#48545d; font-size:12px; line-height:12px">Realçando que o portal só poderá ser acessado dentro da Instituição.
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="10">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="center">
                                                                                            <span style="color:#fefefe; font-size:10px">
                                                                                                © <a href="http://www.inacom.gov.ao/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fefefe!important; text-decoration:none">
                                                                                                INACOM</a> 2020 
                                                                                            </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">INSTITUTO ANGOLANO DAS COMUNICAÇOES
                                                                                                </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">Avenida Dr. António Agostinho Neto, nº 25 Zona C | Praia do Bispo | Luanda - Angola
                                                                                                </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="50">&nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
                                    ';
    
    require '../composer/vendor/autoload.php';
        $i = 0 ;
        
        while($i < count($emails)){
            
            if(filter_var($emails[$i],FILTER_SANITIZE_EMAIL)){
                
                $mail = new PHPMailer(true);
                
                try{
                    $mail->isSMTP();

                    /*--------------De ------------------*/
                    $mail->setFrom('portal.colaborador@inacom.gov.ao');

                    /*---------------Para----------------*/
                    $mail->addAddress($emails[$i]);

                    /*--------caracteres especiais--------*/
                    $mail->CharSet  = 'UTF-8';

                    /*-----Habilitando HTML---------------*/
                    $mail->isHTML(true);

                    /*---------------Tema----------------*/
                    $mail->Subject = 'Nova Formação';

                    /*--------------Corpo----------------*/
                    $mail->Body = $body;
                    
                    /*--------Servidor de SMTP-----------*/
                    $mail->Host = $host; /*'webmail.inacom.gov.ao' 192.178.1.199*/

                    /*--------Autenticação no SMTP--------*/
                    $mail->SMTPAuth = false;

                    /*--------------Anexo------------------*/
                    /*if(strlen($novo_nome_do_ficheiro > 0)){
                        $mail->addAttachment('../uploads/'.$novo_nome_do_ficheiro);
                    }*/

                    /*------Sistema de criptografia-------*/
                    $mail->SMTPSecure = 'tls'; /*tls, ssl*/

                    /*-Nome de usuário de autenticação do SMTP-*/
                    $mail->Username = $username;/*''*/

                    /*-Palavra-passe de autenticação do SMTP-*/
                    $mail->Password = $password;/*'sjfxmqdaqhelpeav'*/

                    /*-------Com cópia oculta-------------*/
                    /*$mail->addBCC('consulta.publica.inacom@gmail.com');*/

                    /*----Configurando a porta do SMTP----*/
                    $mail->Port = 25; //587;

                    /*----Configurar linguagem-----*/
                    $mail->setLanguage('pt');

                    /*---------Debugg--------------*/
                    $mail->SMTPDebug = 3;

                    $mail->smtpConnect(
                                array(
                                    "ssl" => array(
                                        "verify_peer" => false,
                                        "verify_peer_name" => false,
                                        "allow_self_signed" => true
                                    )
                                )
                            );

                    /*------------Enviar E-mail------------*/
                    $mail->Send();
                    
                }catch (Exception $e){

                    /* PHPMailer exception. */
                    echo $e->errorMessage();

                }catch (\Exception $e){

                   /* PHP exception (note the backslash to select the global namespace Exception class). */
                   echo $e->getMessage();

                }
                
            }else{

                echo("$emails[$i] não é um e-mail válido");

            }
            
            $i++;
        }
    
}

if(isset($_POST['ideia_criada'])){
    $ideia_id = $_POST['ideia_criada'];
    
    $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_ideias.ideia_assunto, tb_ideias.ideia_descricao FROM tb_ideias INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_id = tb_ideias.ideia_uid AND tb_ideias.ideia_id = '$ideia_id';";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    $usuario_nome = $row['usuario_nome'];
    $usuario_sobrenome = $row['usuario_sobrenome'];
    $assunto = $row['ideia_assunto'];
    $descricao = $row['ideia_descricao'];
    
    $body = '<!DOCTYPE html>
                                    <html lang="pt-PT">
                                        <head>
                                            <meta charset="utf-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title></title>
                                            <style>
                                                .body{
                                                    margin: 12px 16px 10px 52px;
                                                }
                                            </style>
                                        </head>

                                    <body>
                                        <div class="body">

                                        </div>   
                                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" align="center" bgcolor="3b4a69" style="padding: 0 15px"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="_2zOpJb7ZbCN0X1DoeFyiYw JWNdg1hee9_Rz6bIGvG1c allowTextSelection"><div><div class="rps_d981">
                                            <div style="">
                                                <div style="color: rgb(254, 254, 254); display: none; font-family: &quot;Open Sans&quot;, Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                                            </div>
                                            <table id="x_main" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="center" bgcolor="#3b4a69" style="padding:0 15px">
                                                            <table class="x_innermain" cellpadding="0" width="100%" cellspacing="0" border="0" align="center" style="margin:0 auto; table-layout:fixed; border-collapse:collapse!important; max-width:600px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" width="100%">
                                                                            <table class="x_logo" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" valign="top" style="padding:30px 0">
                                                                                            <img data-imagetype="External" src="http://consultapublica.inacom.gov.ao/img/logo_branco.png" border="0" style="border:0; display:block; height:100%; line-height:100%; outline:none; text-decoration:none">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:4px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                    <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px">
                                                                                        <td class="x_content" colspan="2" valign="top" align="center" style="padding-left:40px; padding-right:40px">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="bottom" colspan="2" cellpadding="3">
                                                                                                            <img data-imagetype="External" src="https://image.flaticon.com/icons/svg/1001/1001300.svg" alt="Ideia" width="80">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <span style="color:#48545d; font-size:22px; line-height:24px; font-family: sans-serif;">Ideia
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="1" bgcolor="#DAE1E9"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="40"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" style="color:#03a9f4; font-size:30px; line-height:24px; font-family: sans-serif; font-weight:500;">
                                                                                                            <span>Olá prezado(a),</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Espero que este e-mail o encontre bem. </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">O<strong> Portal do Colaborador,</strong> serve-se do presente e-mail para informar que o colaborador <strong>'.$usuario_nome.' '.$usuario_sobrenome.'</strong> possuí uma nova ideia <strong>'.$assunto.'</strong> com a seguinte descrição:
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                     
                                                                                                     <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;"> 
                                                                                                            '.$descricao.'.
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Caso já tenha tomado nota desta ideia, queira por favor desconsiderar este e-mail.</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="12"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Atenciosamente,</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left">
                                                                                                            <span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Portal do Colaborador</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <a href="http://myinacom.gov.aof" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="display:block; padding:15px 25px; background-color:#4A90E2; color:#ffffff; border-radius:3px; text-decoration:none; margin-top:20px">Ir Para o Portal</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center">
                                                                                                            <p style="color:#48545d; font-size:12px; line-height:12px">Realçando que o portal só poderá ser acessado dentro da Instituição.
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20"></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="40"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td height="10">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="center">
                                                                                            <span style="color:#fefefe; font-size:10px">
                                                                                                © <a href="http://www.inacom.gov.ao/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fefefe!important; text-decoration:none">
                                                                                                INACOM</a> 2020 
                                                                                            </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">INSTITUTO ANGOLANO DAS COMUNICAÇOES
                                                                                                </span>
                                                                                            <br>
                                                                                                <span style="color:#fefefe; font-size:10px">Avenida Dr. António Agostinho Neto, nº 25 Zona C | Praia do Bispo | Luanda - Angola
                                                                                                </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="50">&nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>
                                    ';
    
    $email = 'ideia@inacom.gov.ao';
    require '../composer/vendor/autoload.php';
    
    $mail = new PHPMailer(true);
                
    try{
        $mail->isSMTP();

        /*--------------De ------------------*/
        $mail->setFrom('portal.colaborador@inacom.gov.ao');

        /*---------------Para----------------*/
        $mail->addAddress($email);

        /*--------caracteres especiais--------*/
        $mail->CharSet  = 'UTF-8';

        /*-----Habilitando HTML---------------*/
        $mail->isHTML(true);

        /*---------------Tema----------------*/
        $mail->Subject = 'Nova Ideia';

        /*--------------Corpo----------------*/
        $mail->Body = $body;

        /*--------Servidor de SMTP-----------*/
        $mail->Host = $host; /*'webmail.inacom.gov.ao' 192.178.1.199*/

        /*--------Autenticação no SMTP--------*/
        $mail->SMTPAuth = false;

        /*--------------Anexo------------------*/
        /*if(strlen($novo_nome_do_ficheiro > 0)){
            $mail->addAttachment('../uploads/'.$novo_nome_do_ficheiro);
        }*/

        /*------Sistema de criptografia-------*/
        $mail->SMTPSecure = 'tls'; /*tls, ssl*/

        /*-Nome de usuário de autenticação do SMTP-*/
        $mail->Username = $username;/*''*/

        /*-Palavra-passe de autenticação do SMTP-*/
        $mail->Password = $password;/*'sjfxmqdaqhelpeav'*/

        /*-------Com cópia oculta-------------*/
        /*$mail->addBCC('consulta.publica.inacom@gmail.com');*/

        /*----Configurando a porta do SMTP----*/
        $mail->Port = 25; //587;

        /*----Configurar linguagem-----*/
        $mail->setLanguage('pt');

        /*---------Debugg--------------*/
        $mail->SMTPDebug = 3;

        $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );

        /*------------Enviar E-mail------------*/
        $mail->Send();

    }catch (Exception $e){

        /* PHPMailer exception. */
        echo $e->errorMessage();

    }catch (\Exception $e){

       /* PHP exception (note the backslash to select the global namespace Exception class). */
       echo $e->getMessage();

    }
}

?>