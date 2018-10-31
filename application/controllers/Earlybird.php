<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earlybird extends CI_Controller {

	function __construct() {
	    parent::__construct();
	    $early_options = $this->all_conn->select_data('site_options', '', 'option_key', 'early_bird');
			$early_o = json_decode($early_options[0]->option_value);
			if ($early_o[0]->is_early == 'false') {
				redirect('/home/crops');
			}
	}
	public function index()
	{


	}
  public function view($slug = '')
  {

    if (empty($slug)) {
      redirect('/home/earlybird');
    }
    $slug = explode('-', $slug);
		$data['price'] = $this->all_conn->select_data('early_bird', '', 'crop_id', $slug[0]);
    $crop = $data['crop'] = $this->all_conn->select_data('crops', '', 'id', $slug[0] );
    $data['page_title'] = $crop[0]->crop_name.' - Grow Crops Online';
    $this->load->template('earlybird/index', $data);
  }
	public function checkout($slug = '')
  {

		if (!$this->session->has_userdata('user_id')) {
			$redirect  = array(
				'url' => $this->uri->uri_string,
				'message' => 'login_first'
			);
			$this->session->set_userdata('redirect_data', $redirect);
			redirect('auth/login');
		}
    if (empty($slug)) {
      redirect('/home/purchase_earlybird');
    }
    $slug = explode(',', $slug);
    $crop = $data['crop'] = $this->all_conn->select_data('crops', '', 'id', $slug[0] );
    $data['page_title'] = $crop[0]->crop_name.' - Grow Crops Online';
		$data['price'] = $this->all_conn->select_data('early_bird', '', 'crop_id', $slug[0]);
    $this->load->template('earlybird/checkout', $data);
  }
	public function invoice($tran_id = '')
	{
		if (empty($tran_id)) {
			redirect('/home/earlybird');
		}
		$query = "SELECT transactions.*, crops.crop_name FROM transactions INNER JOIN crops ON transactions.crop_id = crops.id WHERE transactions.id = $tran_id";
		$data['invoice_details'] = $crop = $this->all_conn->custom_query('select', $query);
		if (empty($data['invoice_details'])) {
				redirect('/home/earlybird');
		}
		$data['price'] = $this->all_conn->select_data('early_bird', '', 'crop_id', $crop[0]->crop_id);
		  $data['page_title'] = $data['invoice_details'][0]->crop_name.' - Grow Crops Online';
			$this->load->template('earlybird/invoice', $data);

	}
	public function thankyou($tran_id = '')
	{
		if (empty($tran_id)) {
			redirect('/home/earlybird');
		}
		  $data['page_title'] = 'Transaction Acknowledged - Grow Crops Online';
			$this->load->template('earlybird/thankyou', $data);

	}

}
