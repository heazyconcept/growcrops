<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crops extends CI_Controller {


	public function index()
	{


	}
  public function view($slug = '')
  {
    if (empty($slug)) {
      redirect('/home/crops');
    }
    $slug = explode('-', $slug);
		$data['payment_details'] = $this->all_conn->select_data('payment_breakdown', '', 'crop_id', $slug[0]);
    $crop = $data['crop'] = $this->all_conn->select_data('crops', '', 'id', $slug[0] );
    $data['page_title'] = $crop[0]->crop_name.' - Grow Crops Online';
    $this->load->template('crop/index', $data);
  }
	public function checkout($slug = '')
  {
		// print_r()

		if (!$this->session->has_userdata('user_id')) {
			$redirect  = array(
				'url' => $this->uri->uri_string,
				'message' => 'login_first'
			);
			$this->session->set_userdata('redirect_data', $redirect);
			redirect('auth/login');
		}
    if (empty($slug)) {
      redirect('/home/crops');
    }
    $slug = explode('-', $slug);
    $crop = $data['crop'] = $this->all_conn->select_data('crops', '', 'id', $slug[0] );
    if( $crop[0]->is_full == 1){
        redirect("/");
    }
    $data['page_title'] = $crop[0]->crop_name.' - Grow Crops Online';
		$data['price'] = $this->all_conn->select_data('stage_one_payment', '', 'crop_id', $slug[0]);
    $this->load->template('crop/checkout', $data);
  }
	public function invoice($tran_id = '')
	{
		$query = "SELECT transactions.*, crops.crop_name  FROM transactions
		INNER JOIN crops ON transactions.crop_id = crops.id
		WHERE transactions.id = $tran_id";
		$data['invoice_details'] = $crop = $this->all_conn->custom_query('select', $query);
		$data['manual'] = $this->all_conn->select_data('manual_booking','', 'tran_id', $tran_id);
		$data['page_title'] = $crop[0]->crop_name.' - Grow Crops Online';
			$this->load->template('crop/invoice', $data);

	}
	public function thankyou($tran_id = '')
	{
		if (empty($tran_id)) {
			redirect('/home/earlybird');
		}
			$data['page_title'] = 'Transaction Acknowledged - Grow Crops Online';
			$this->load->template('crop/thankyou', $data);

	}

}
