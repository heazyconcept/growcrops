<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class NotificationMail
{
  public function send_mail($mailOptions)
  {
    
    $mailOptions = json_decode($mailOptions);
    
    $CI =& get_instance();

    $config['protocol'] ='smtp';
    $config['smtp_port'] ='587';
    // $config['smtp_crypto'] ='ssl';
    $config['priority'] ='1';
    $config['smtp_host'] ='mail.growcropsonline.com';
    $config['smtp_user'] ='no-reply@growcropsonline.com';
    $config['smtp_pass'] = 'Growcrops_2018';
    $config['mailtype'] = 'html';
    $CI->email->initialize($config);
  $CI->email->from('no-reply@growcropsonline.com', $mailOptions->name);
  $CI->email->to($mailOptions->to);
  if (isset($mailOptions->cc) && !empty($mailOptions->cc)) {
    $CI->email->cc($mailOptions->$cc);
  }
  if (isset($mailOptions->bcc) && !empty($mailOptions->bcc)) {
    $CI->email->bcc($mailOptions->bcc);
  }
  if (isset($mailOptions->attachment) && !empty($mailOptions->attachment)) {
      $CI->email->attach($mailOptions->attachment);
  }
  $CI->email->subject($mailOptions->subject);
  $replace = array('{{fullName}}', '{{Amount}}', '{{link}}');
  $with = array($mailOptions->fullName, $mailOptions->Amount, $mailOptions->link);
  $template = file_get_contents('mails/notification.html', true);
  $mail_body =  str_replace($replace, $with, $template);
  $CI->email->message($mail_body);
  if ($CI->email->send()) {
     return $CI->email->print_debugger();
    //  true;
     
  }else {
    return $CI->email->print_debugger();
    //  false;
  }

  
  }
  


}
