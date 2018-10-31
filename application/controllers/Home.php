<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{
		$data['crops'] = $this->all_conn->select_data('crops', '', 'is_early', 0, '', '', '8');
		$data['home_banner'] =  $this->all_conn->select_data('site_options', '', 'option_key', 'home_banner');
		$data['early_option'] =  $this->all_conn->select_data('site_options', '', 'option_key', 'early_bird');
		$data['info_banner'] =  $this->all_conn->select_data('site_options', '', 'option_key', 'info_banner');
		$data['page_title'] = 'Home - Grow Crops Online';
		$this->load->template('home', $data);

	}
	public function about_us()
	{
		$data['page_title'] = 'About us - Grow Crops Online';
		$this->load->template('about', $data);
	}
	public function how_it_works()
	{
		$data['page_title'] = 'How it works - Grow Crops Online';
		$this->load->template('how_it_works', $data);
	}
	public function contact_us()
	{
		$data['page_title'] = 'Contact us - Grow Crops Online';
		$this->load->template('contact', $data);
	}
	public function faq()
	{
		$data['page_title'] = 'FAQ - Grow Crops Online';
		$this->load->template('faq', $data);
	}
	public function terms_and_condition()
	{
		$data['page_title'] = 'Terms and Condition - Grow Crops Online';
		$this->load->template('terms', $data);
	}
	public function crops()
	{
		$this->load->model('pagination_model');
		$this->load->library('pagination');
		$config = array();
$config["base_url"] = base_url('home/crops');
$total_row = $this->pagination_model->record_count('crops');

$config["total_rows"] = $total_row;
$config["per_page"] = 12;
$config['use_page_numbers'] = TRUE;
// $config['num_links'] = $total_row;
$config['cur_tag_open'] = '&nbsp;<a class="current">';
$config['cur_tag_close'] = '</a>';
$config['next_link'] = 'Next';
$config['prev_link'] = 'Previous';
$config['uri_segment'] = 3;
$choice = $config['total_rows']/$config['per_page'];
$config['num_links'] = round($choice);

$this->pagination->initialize($config);
$page = $this->uri->segment(3);
$offset = !$page?1:$page;
$real_off = ($offset - 1) * $config["per_page"];
// if($this->uri->segment(3)){
// $page = ($this->uri->segment(3)) ;
// }
// else{
// $page = 1;
// }
$data["crops"] = $this->pagination_model->fetch_data($config["per_page"], $real_off, 'crops');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links );



		// $data['crops'] = $this->all_conn->select_data('crops', '', '', '', '', '', '12');

		$data['page_title'] = 'Crops - Grow Crops Online';
		$this->load->template('crops', $data);
	}
	public function purchase_earlybird()
	{
		$early_options = $this->all_conn->select_data('site_options', '', 'option_key', 'early_bird');
		$early_o = json_decode($early_options[0]->option_value);
		if ($early_o[0]->is_early == 'false') {
			redirect('/home/crops');
		}
		$this->load->model('pagination_model');
		$this->load->library('pagination');
		$config = array();
$config["base_url"] = base_url('home/earlybird');
$total_row = $this->all_conn->count_data('crops', 'is_early', 1);

$config["total_rows"] = $total_row;
$config["per_page"] = 12;
$config['use_page_numbers'] = TRUE;
// $config['num_links'] = $total_row;
$config['cur_tag_open'] = '&nbsp;<a class="current">';
$config['cur_tag_close'] = '</a>';
$config['next_link'] = 'Next';
$config['prev_link'] = 'Previous';
$config['uri_segment'] = 3;
$choice = $config['total_rows']/$config['per_page'];
$config['num_links'] = round($choice);

$this->pagination->initialize($config);
$page = $this->uri->segment(3);
$offset = !$page?1:$page;
$real_off = ($offset - 1) * $config["per_page"];
// if($this->uri->segment(3)){
// $page = ($this->uri->segment(3)) ;
// }
// else{
// $page = 1;
// }
$data["crops"] = $this->pagination_model->fetch_data_specific($config["per_page"], $real_off, 'crops', 'is_early', 1);
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links );



		// $data['crops'] = $this->all_conn->select_data('crops', '', '', '', '', '', '12');

		$data['page_title'] = 'Buy Early Birds - Grow Crops Online';
		$this->load->template('early_birds', $data);
	}
	public function earlybird()
	{
		$early_options = $this->all_conn->select_data('site_options', '', 'option_key', 'early_bird');
		$early_o = json_decode($early_options[0]->option_value);
		if ($early_o[0]->is_early == 'false') {
			redirect('/home/crops');
		}
		$data['page_title'] = 'Early Birds  - Grow Crops Online';
		$this->load->template('early', $data);
	}
	public function blog()
	{
		$data['blog'] = $this->all_conn->select_data('posts');
		$data['page_title'] = 'Blog  - Grow Crops Online';
		$this->load->template('blog', $data);
	}
}
