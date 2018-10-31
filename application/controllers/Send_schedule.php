<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_schedule extends CI_Controller {


	public function index()
	{
    $data['page_title'] = 'Send my schedule - Grow Crops Online';
		$this->load->template('schedule/index', $data);

	}
  public function comit()
  {
    foreach ($_POST as $key => $value) {
		$$key = $value;
		}

    $attachment = base_url('upload/new%20schedule%20and%20cookies%20information%206.0.pdf');
    $other_values = array(
      'email_address' => $email_address
    );
    if ($this->mail_lib->send_mail('Growcropsonline', $email_address, 'Your Schedule', 'send_schedule',  $other_values, 'user', $attachment )) {
      $response  = array(
        'responseCode' => 1,
        'responseValue' => '',
      );
    }else {
      $response  = array(
        'responseCode' => 0,
        'responseValue' => 'Your mail could not be send at this time',
      );
    }
    echo json_encode($response);
  }
	public function send_mail()
	{
		$users = $this->all_conn->select_data('users', '', '', '', '', '', 200);
		foreach ($users as $obj) {
			$insert_data = array(
				'email_address' => $obj->email_address, 
			);
			$this->all_conn->insert_data('send_email_log', $insert_data);
			$other_values['link'] = '<a href="'.base_url('send_schedule').'" target="_blank">click here</a>';
			$other_values['email_address'] = $obj->email_address;
			$this->mail_lib->send_mail('Growcropsonline', $obj->email_address, 'Your Schedule', 'bulk_schedule',  $other_values, 'user' );
		}
		echo 1;
	}


}
