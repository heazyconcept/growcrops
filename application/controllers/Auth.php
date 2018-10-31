<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function index()
	{
    redirect('/auth/login');

	}
	public function login($activation = '')
	{
		if ($this->session->has_userdata('user_id')) {
			redirect('/user');
		}
		if ($activation == 'success') {
			$data['activation'] = 1;
		}elseif ($activation == 'error') {
			$data['activation'] = 0;
		}

		$data['page_title'] = 'Login - Grow Crops Online';
		$this->load->template('auth/login', $data);
	}
	public function register()
	{
    $data['page_title'] = 'Register - Grow Crops Online';
		$states = $this->all_conn->selectd_data('location', 'state');
		$data['states'] = $states;
    $this->load->template('auth/register', $data);
	}
	public function forgot_password($token='')
	{
		if (empty($token)) {
			$data['page_title'] = 'Password Reset - Grow Crops Online';
	    $this->load->template('auth/forgot_password', $data);
		}else {
				$data['page_title'] = 'Password Reset - Grow Crops Online';
				$reset_data = explode('_', $token);
				$token = $reset_data[0];
				$user_id = $reset_data[1];
				$bench_mark  = array(
					'id' => $user_id,
					'token' => $token
				);
				$valid_email = $this->all_conn->check_exist('users', $bench_mark, 'AND');
				if ($valid_email) {
						$data['user_id'] = $user_id;
						$data['page_title'] = 'Password Reset - Grow Crops Online';
					$this->load->template('auth/reset', $data);
				}else {
					redirect('auth/login');
				}
		}
	}
	public function logout()
	{
		if ($this->session->userdata('user_role') == 2) {
				$this->session->sess_destroy();
				redirect('admin');
		}else {
			$this->session->sess_destroy();
			redirect('/');
		}

		// $this->session->unset_userdata();


	}

}
