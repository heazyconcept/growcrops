<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function index()
	{
    if (empty($this->session)) {
      redirect('/auth/login');
    }
    $user_id = $this->session->userdata('user_id');
    $query = "SELECT * FROM  invested_crop WHERE user_id = $user_id AND stage != 'four'";
    $data['invested_crop'] = $this->all_conn->custom_query('select', $query);
		if (empty($data['invested_crop'])) {
			$query = "SELECT * FROM  crop_invested WHERE user_id = $user_id AND stage != 'four'";
	    $data['invested_crop'] = $this->all_conn->custom_query('select', $query);
		}

		$query_transaction =  "SELECT * FROM transactions WHERE user_id	= $user_id AND status = 'paid' ORDER BY transaction_date DESC LIMIT 1";
    $data['transaction'] = $this->all_conn->custom_query('select', $query_transaction);
    $image_name = $this->all_conn->select_data('user_extra_details', 'image_name', 'user_id', $this->session->userdata('user_id'));
    if ($image_name) {
      $data['image_url'] = base_url('upload/profile_pic/').$image_name[0]->image_name;
    }else {
      $data['image_url'] = asset_url('img/agent-2.jpg');
    }
  		$data['page_title'] = 'User Dashboard - Grow Crops Online';
      $data['user_data'] = $this->session->userdata;
  		$this->load->template('user/dashboard', $data);

	}
  public function change_profile_details()
  {
    if (empty($this->session)) {
      redirect('/auth/login');
    }
    $states = $this->all_conn->selectd_data('location', 'state');
    $data['states'] = $states;
    $image_name = $this->all_conn->select_data('user_extra_details', 'image_name', 'user_id', $this->session->userdata('user_id'));
    if ($image_name) {
      $data['image_url'] = base_url('upload/profile_pic/').$image_name[0]->image_name;
    }else {
      $data['image_url'] = asset_url('img/agent-2.jpg');
    }
  		$data['page_title'] = 'User Profile Details - Grow Crops Online';
      $data['user_data'] = $this->session->userdata;
  		$this->load->template('user/profile', $data);
  }
  public function transaction_details()
  {
    if (empty($this->session)) {
      redirect('/auth/login');

    }
    $user_id = $this->session->userdata('user_id');
    $image_name = $this->all_conn->select_data('user_extra_details', 'image_name', 'user_id', $this->session->userdata('user_id'));
    if ($image_name) {
      $data['image_url'] = base_url('upload/profile_pic/').$image_name[0]->image_name;
    }else {
      $data['image_url'] = asset_url('img/agent-2.jpg');
    }
    $query = "SELECT transactions.*, crops.crop_name FROM transactions INNER JOIN crops ON transactions.crop_id = crops.id WHERE transactions.user_id = $user_id ORDER BY transactions.status ASC";
    $data['transaction_details']  = $this->all_conn->custom_query('select', $query);
    $data['page_title'] = 'User Transaction History - Grow Crops Online';
    $data['user_data'] = $this->session->userdata;
    $this->load->template('user/transaction_details', $data);
  }
  public function crops_planted()
  {
    if (empty($this->session)) {
      redirect('/auth/login');
    }
    $user_id = $this->session->userdata('user_id');
    $image_name = $this->all_conn->select_data('user_extra_details', 'image_name', 'user_id', $this->session->userdata('user_id'));
    if ($image_name) {
      $data['image_url'] = base_url('upload/profile_pic/').$image_name[0]->image_name;
    }else {
      $data['image_url'] = asset_url('img/agent-2.jpg');
    }
    $query = "SELECT invested_crop.*, crops.crop_name, crops.featured_image FROM invested_crop INNER JOIN crops ON invested_crop.crop_id = crops.id WHERE invested_crop.user_id = $user_id";
    $data['invested_crops']  = $this->all_conn->custom_query('select', $query);
		if (empty($data['invested_crops'])) {
			$query = "SELECT crop_invested.*, crops.crop_name, crops.featured_image FROM crop_invested INNER JOIN crops ON crop_invested.crop_id = crops.id WHERE crop_invested.user_id = $user_id";
			$data['invested_crops']  = $this->all_conn->custom_query('select', $query);
		}
    $data['page_title'] = 'My Invested Crops - Grow Crops Online';
    $data['user_data'] = $this->session->userdata;
    $this->load->template('user/invested_crops', $data);

  }
	public function invoice()
  {
    if (empty($this->session)) {
      redirect('/auth/login');
    }
    $user_id = $this->session->userdata('user_id');
    $image_name = $this->all_conn->select_data('user_extra_details', 'image_name', 'user_id', $this->session->userdata('user_id'));
    if ($image_name) {
      $data['image_url'] = base_url('upload/profile_pic/').$image_name[0]->image_name;
    }else {
      $data['image_url'] = asset_url('img/agent-2.jpg');
    }
		$query = "SELECT transactions.*, crops.crop_name FROM transactions INNER JOIN crops ON transactions.crop_id = crops.id WHERE transactions.user_id = $user_id AND transactions.status = 'paid'";
    $data['transactions']  = $this->all_conn->custom_query('select', $query);
    $data['page_title'] = 'My Invoice - Grow Crops Online';
    $data['user_data'] = $this->session->userdata;
    $this->load->template('user/invoice', $data);

  }
	public function pay($schedule_id = '')
  {
    if (empty($this->session)) {
      redirect('/auth/login');
    }
		if (empty($schedule_id)) {
			redirect('user');
		}
    $user_id = $this->session->userdata('user_id');
		$query = "SELECT payment_schedule.*, crops.crop_name, crops.featured_image, crops.admin_fee FROM payment_schedule INNER JOIN crops ON payment_schedule.crop_id = crops.id WHERE payment_schedule.user_id = $user_id AND payment_schedule.id = $schedule_id";
    $data['payment_schedule']  = $this->all_conn->custom_query('select', $query);
    $data['page_title'] = 'Pay now - Grow Crops Online';
    $data['user_data'] = $this->session->userdata;
    $this->load->template('user/pay', $data);

  }
	public function pending()
	{
		if (empty($this->session)) {
      redirect('/auth/login');

    }
    $user_id = $this->session->userdata('user_id');
    $image_name = $this->all_conn->select_data('user_extra_details', 'image_name', 'user_id', $this->session->userdata('user_id'));
    if ($image_name) {
      $data['image_url'] = base_url('upload/profile_pic/').$image_name[0]->image_name;
    }else {
      $data['image_url'] = asset_url('img/agent-2.jpg');
    }
    $query = "SELECT payment_schedule.*, crops.crop_name FROM payment_schedule INNER JOIN crops ON payment_schedule.crop_id = crops.id WHERE payment_schedule.user_id = $user_id";
    $data['payment_schedule']  = $this->all_conn->custom_query('select', $query);
    $data['page_title'] = 'User Pending Payment - Grow Crops Online';
    $data['user_data'] = $this->session->userdata;
    $this->load->template('user/pending', $data);
	}



}
