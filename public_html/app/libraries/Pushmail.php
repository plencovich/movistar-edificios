<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Pushmail Library
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

class Pushmail
{
    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function __construct()
    {
        set_time_limit(120);

        $this->mail = new PHPMailer\PHPMailer\PHPMailer;

        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->Host = gcfg('smtp_host','pushmail');
        $this->mail->SMTPAuth = TRUE;
        $this->mail->Username = gcfg('username','pushmail');
        $this->mail->Password = gcfg('password','pushmail');
        $this->mail->SMTPSecure = gcfg('secure','pushmail');
        $this->mail->Port = gcfg('port','pushmail');
        $this->mail->Timeout = 60;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    }

    /* Email de Bienvenida */

    public function welcome($email,$password,$full_name, $group)
    {
        $group_label = gcfg($group, 'user_group_label');

        $datamail = array(
            'email' => $email,
            'password' => $password,
            'full_name' => $full_name,
            'group' => $group_label
        );
        $mail_content = $this->load->view('template/email/welcome_'.$group_label, $datamail, TRUE);

        $this->mail->setFrom(gcfg('username','pushmail'), wmscp('project_name'));
        $this->mail->addAddress($email);
        $this->mail->isHTML(TRUE);
        $this->mail->Subject = utf8_decode(lang('mail_welcome'));
        $this->mail->msgHTML($mail_content);
        $this->mail->AltBody = lang('mail_welcome').' '.wmscp('project_name');

        $check = $this->mail->send();

        $status = ((bool) $check) ? lang('mail_send_ok') : lang('mail_send_fail').'<br>'.$this->mail->ErrorInfo;
        $this->mail->SmtpClose();
        return $status;
    }

    /* Envio de código de recupero */

    public function recovery($data)
    {
        $mail_content = $this->load->view('template/email/forgot_password', $data, TRUE);

        $this->mail->setFrom(gcfg('username','pushmail'), wmscp('project_name'));
        $this->mail->addAddress($data['identity']);
        $this->mail->isHTML(TRUE);
        $this->mail->Subject = utf8_decode(lang('mail_forgotten_password'));
        $this->mail->msgHTML($mail_content);
        $this->mail->AltBody = lang('email_forgotten_password_subject').' '.wmscp('project_name');

        $check = $this->mail->send();

        $status = ((bool) $check) ? lang('recovery_ok') : lang('mail_send_fail').'<br>'.$this->mail->ErrorInfo;
        $this->mail->SmtpClose();
        return $status;
    }

    /* Envio notificación */

    public function notification($type,$datamail)
    {
        $from_user_email = $datamail['email'];
        $from_user_name = $datamail['full_name'];

        $mail_content = $this->load->view('template/email/'.$type, $datamail, TRUE);

        $this->mail->setFrom(gcfg('username','pushmail'), wmscp('project_name'));
        $this->mail->addReplyTo($from_user_email, $from_user_name);
        $this->mail->addAddress(gcfg($type,'notification_email'));
        $this->mail->isHTML(TRUE);
        $this->mail->Subject = utf8_decode(lang('notification_'.$type));
        $this->mail->msgHTML($mail_content);
        $this->mail->AltBody = lang('notification_'.$type).' '.wmscp('project_name');

        $check = $this->mail->send();

        $status = ((bool) $check) ? TRUE : $this->mail->ErrorInfo;
        $this->mail->SmtpClose();
        return $status;
    }
}
