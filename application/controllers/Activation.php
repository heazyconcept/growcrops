<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {


	public function index()
	{
    foreach ($_GET as $key => $value) {
		$$key = $value;
		}

    $check_data = array(
      'email_address' => $e,
      'token' => $t,
    );
    $check_exist = $this->all_conn->check_exist('users', $check_data, 'AND');
    if ($check_exist > 0) {
      $update_data = array('token' => '' );
      $row = $this->all_conn->modify_data('users', $update_data, 'email_address', $e);
      redirect('/auth/login/success');
    }else {
    redirect('/auth/login/error');
    }



	}


}
