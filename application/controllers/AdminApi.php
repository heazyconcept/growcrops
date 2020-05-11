<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminApi extends CI_Controller
{

    public function ResetPassword($userId)
    {

        $password= "1111";
        $user_data = $this->all_conn->custom_query('select', "SELECT * FROM users WHERE id = $userId");
        $salt = $user_data[0]->salt;
        $password = $salt . $password;
        $password = md5($password);
        $user_pass = array(
            'password' => $password,
        );
        $affected = $this->all_conn->modify_data('users', $user_pass, 'id', $this->session->userdata('user_id'));
        if ($affected > 0) {
            $other_values['email_address'] = $user_data[0]->email_address;
            $this->mail_lib->send_mail('GrowcropsOnline', $user_data[0]->email_address, 'Password Reset', 'reset_password_admin', $other_values, 'user');
            echo 1;
        } else {
            echo "-5";
        }

    }

}

/* End of file AdminApi.php */
