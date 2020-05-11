<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthAjax extends CI_Controller
{

    public function ValidateCert()
    {
        foreach ($_POST as $key => $value) {
            $$key = $value;
        }
        $other_values = array(
            'email_address' => $email_address,
        );

        $this->mail_lib->send_mail(
            'Growcropsonline',
            $email_address,
            'Certificate Validated',
            'certificate',
            $other_values,
            'user'
        );
        $response = array(
            'responseCode' => 1,
            'responseValue' => '',
        );
        echo json_encode($response);


    }
}

/* End of file AuthAjax.php */
