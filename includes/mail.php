<?php 
    include("./conexao.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['btn_lembrete'])){

        $email = 'portal.colaborador@inacom.gov.ao';
        
                
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
                $mail->Subject = 'Lembrete de Avaliacao de Desempenho';
                
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
<td align="center" valign="top" style="padding:30px 0"><img data-imagetype="External" src="http://consultapublica.inacom.gov.ao/img/logo_branco.png" border="0" style="border:0; display:block; height:100%; line-height:100%; outline:none; text-decoration:none">
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
<td align="center" valign="bottom" colspan="2" cellpadding="3"><img data-imagetype="External" src="https://image.flaticon.com/icons/svg/1390/1390295.svg" alt="Coinbase" width="80">
</td>
</tr>
<tr>
<td height="20"></td>
</tr>
<tr>
<td align="center"><span style="color:#48545d; font-size:22px; line-height:24px; font-family: sans-serif;">Lembrete
</span></td>
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
    <td align="left" style="color:#03a9f4; font-size:30px; line-height:24px; font-family: sans-serif; font-weight:500;"><span>Olá prezado(a),</span></td>
</tr>
<tr>
    <td height="24"></td>
</tr>
<tr>
<td align="left"><span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Espero que estaja tudo bem. </span></td>
</tr>
<tr>
<td height="15"></td>
</tr>
<tr>
<td align="left"><span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">A equipe do INACOM vem por meio deste, informar que periodicamente são realizadas as avaliações de desempenho, que ajudam a identificar os pontos fortes da instituição para uma melhor organização. </span></td>
</tr>
<tr>
<td height="15"></td>
</tr>
<tr>
<td align="left"><span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Caso já tenha feito, por favor desconsiderar este e-mail.</span></td>
</tr>
<tr>
<td height="12"></td>
</tr>
<tr>
<td align="left"><span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Atencisamente,</span></td>
</tr>
<tr>
<td align="left"><span style="color:#48545d; font-size:14px; line-height:24px font-family: sans-serif;">Equipe INACOM</span></td>
</tr>
<tr>
</tr>
<tr>
<td height="20"></td>
</tr>
<tr>
</tr>
<tr>
<td align="center"><a href="http://192.178.1.196:8080" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="display:block; padding:15px 25px; background-color:#4A90E2; color:#ffffff; border-radius:3px; text-decoration:none; margin-top:20px">Ir Para o Portal</a> </td>
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
<td valign="top" align="center"><span style="color:#fefefe; font-size:10px">© <a href="http://www.inacom.gov.ao/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fefefe!important; text-decoration:none">
INACOM</a> 2020 </span><br>
<span style="color:#fefefe; font-size:10px">INSTITUTO ANGOLANO DAS COMUNICAÇOES
</span><br>
<span style="color:#fefefe; font-size:10px">Avenida Dr. António Agostinho Neto, nº 25 Zona C | Praia do Bispo | Luanda - Angola
</span></td>
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
</div></div>
</body>
</html>
';
                
                /*--------Servidor de SMTP-----------*/
                $mail->Host = '192.178.1.199'; /*'webmail.inacom.gov.ao'192.178.1.199*/
                
                /*--------Autenticação no SMTP--------*/
                $mail->SMTPAuth = false;
                    
                /*--------------Anexo------------------*/
                /*if(strlen($novo_nome_do_ficheiro > 0)){
                    $mail->addAttachment('../uploads/'.$novo_nome_do_ficheiro);
                }*/
                
                /*------Sistema de criptografia-------*/
                $mail->SMTPSecure = 'tls'; /*tls, ssl*/
                
                /*-Nome de usuário de autenticação do SMTP-*/
                $mail->Username = 'portal.colaborador@inacom.gov.ao';/*''*/
                
                /*-Palavra-passe de autenticação do SMTP-*/
                $mail->Password = '1n@k0nn';/*'sjfxmqdaqhelpeav'*/
                    
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
        header('location: ../admin/enviar-lembrete');
    }


?>