<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function index()
	{
		if (!empty($this->session->userdata('user_id'))) {
      		redirect('/admin/dashboard');
    	}
    	$data['page_title'] = 'Admin Login - Grow Crops Online';
    	$this->load->view('admin/index', $data);
    	$this->load->view('templates/footer', $data);


  	}
  public function dashboard()
  {
    if (empty($this->session->userdata('user_id'))) {
      redirect('/admin');
    }elseif ($this->session->userdata('user_role') == 1) {
      redirect('/user');
    }
		$data['menu'] = 'dashboard';
		$query_recent = "SELECT users.first_name, users.last_name, user_extra_details.image_name FROM users INNER JOIN user_extra_details on users.id = user_extra_details.user_id ORDER BY users.date_created LIMIT 5";
		$data['recent_users'] =  $this->all_conn->custom_query('select', $query_recent);
		$data['all_users'] = $this->all_conn->count_data('users');
		$data['crops'] = $this->all_conn->count_data('crops');
		// $transactions = $this->all_conn->select_data('transactions', '', 'status', 'paid');
		$data['total_transaction'] = 0;
		// foreach ($transactions as $tran) {
		// 	$data['total_transaction'] += $tran->amount;

		// }
		$today = date("Y-m-d");
		$query = "SELECT * FROM users WHERE date_created  LIKE  '%$today%'";
		$data['daily_user'] = $this->all_conn->custom_query('select', $query);
    $data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
    $data['page_title'] = 'Admin dashboard - Grow Crops Online';
    $this->load->admin_template('admin/dashboard', $data);
  }
	public function profile()
	{
		if (empty($this->session->userdata('user_id'))) {
      redirect('/admin');
    }elseif ($this->session->userdata('user_role') == 1) {
      redirect('/user');
    }
		$data['menu'] = 'profile';
		$states = $this->all_conn->selectd_data('location', 'state');
    $data['states'] = $states;
		$data['user_data'] =  $this->session->userdata();
		$data['user_extras'] = $user_extras = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		if ($user_extras) {
      $data['image_url'] = base_url('upload/profile_pic/').$user_extras[0]->image_name;
    }else {
      $data['image_url'] = asset_url('img/agent-2.jpg');
    }
    $data['page_title'] = 'Admin Profile - Grow Crops Online';
    $this->load->admin_template('admin/profile', $data);
	}
  public function crops()
  {
    if (empty($this->session->userdata('user_id'))) {
      redirect('/admin');
    }elseif ($this->session->userdata('user_role') == 1) {
      redirect('/user');
    }
		$data['menu'] = 'crops';
    $data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
    $data['all_crops'] = $this->all_conn->select_data('crops');
    $data['page_title'] = 'Admin Crops Management - Grow Crops Online';
    $this->load->admin_template('admin/crops_view', $data);
  }
  public function crop_new()
  {
    if (empty($this->session->userdata('user_id'))) {
      redirect('/admin');
    }elseif ($this->session->userdata('user_role') == 1) {
      redirect('/user');
    }
		$data['menu'] = 'crops';
    $data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
    $data['page_title'] = 'Admin New Crop - Grow Crops Online';
    $this->load->admin_template('admin/crop_add', $data);
  }
	public function crop_edit($id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		if (!$id) {
		   redirect('admin/crops');
		}
		$data['menu'] = 'crops';
		$data['crop_data'] =  $this->all_conn->select_data('crops', '', 'id', $id);
		$data['payment_details'] = $this->all_conn->select_data('payment_breakdown', '', 'crop_id', $id);
		$data['initial_payment'] = $this->all_conn->select_data('stage_one_payment', '', 'crop_id', $id);
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin Edit Crop - Grow Crops Online';
		$this->load->admin_template('admin/crop_edit', $data);
	}
	public function crop_remove($id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		if (!$id) {
		   redirect('admin/crops');
		}
		$data['menu'] = 'crops';
		if ($this->all_conn->delete_data('crops', 'id', $id)) {
			$this->all_conn->delete_data('stage_one_attributes',  'crop_id', $id);
			$this->all_conn->delete_data('stage_two_attributes',  'crop_id', $id);
			$this->all_conn->delete_data('stage_three_attributes',  'crop_id', $id);
	 		$this->all_conn->delete_data('stage_four_attributes',  'crop_id', $id);
			redirect('admin/crops');
		}

	}
	public function invoice_schedule()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'invoice_schedule';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['all_crops'] = $this->all_conn->select_data('crops');
		$data['page_title'] = 'Admin Invoice Schedule - Grow Crops Online';
		$this->load->admin_template('admin/invoice', $data);

	}
	public function invoice_view($crop_id = '', $filter = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		if (!$crop_id) {
			 redirect('admin/invoice_schedule');
		}
		$data['menu'] = 'invoice_schedule';
		if ($filter == 'earlybird' || $filter == 'one' || $filter == 'two' || $filter == 'three') {
			$segment = $this->uri->segment(5);
			$segment_no = 5;
			$paginate_url = base_url('admin/invoice_view/').$crop_id.'/'.$filter;
			if ($filter == 'earlybird') {
				$sub_query = "SELECT transactions.id, transactions.transaction_ref, transactions.stage, transactions.slot,
				users.first_name, users.last_name, users.phone_number, users.email_address FROM transactions
				INNER JOIN users ON users.id = transactions.user_id
				WHERE transactions.crop_id = $crop_id AND transactions.status = 'paid' AND  transactions.stage = 'early bird' AND transactions.user_id NOT IN (SELECT user_id FROM payment_schedule)";
			}else {
				$sub_query = "SELECT crop_invested.*, users.first_name, users.last_name, users.phone_number, users.email_address FROM crop_invested INNER JOIN users on crop_invested.user_id = users.id WHERE crop_invested.stage = '$filter' ";
			}
		}else {
			$segment = $this->uri->segment(4);
			$segment_no = 4;
			$paginate_url = base_url('admin/invoice_view/').$crop_id;
			$sub_query = "SELECT transactions.id, transactions.transaction_ref, transactions.stage, transactions.slot, users.first_name, users.last_name, users.phone_number, users.email_address FROM transactions INNER JOIN users ON users.id = transactions.user_id WHERE transactions.crop_id = $crop_id AND transactions.status = 'paid' ";
		}

		$query = $sub_query;
		$p_transaction = $this->all_conn->custom_query('select', $query);
		$this->load->model('pagination_model');
		$this->load->library('pagination');
		$config = array();
		$config["base_url"] = $paginate_url;
		$total_row = count($p_transaction);
		$config["total_rows"] = $total_row;
		$config["per_page"] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['cur_tag_open'] = '&nbsp;<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '&nbsp;<li>' ;
		$config['num_tag_close'] = '</li>' ;
$config['next_link'] = 'Next';
$config['prev_link'] = 'Previous';
$config['uri_segment'] = $segment_no;
$choice = $config['total_rows']/$config['per_page'];
$config['num_links'] = round($choice);

$this->pagination->initialize($config);
$page = $segment;
$offset =  $data['offset'] = !$page?1:$page;
$real_off = ($offset - 1) * $config["per_page"];
$perpage = $config["per_page"];
// if($this->uri->segment(3)){
// $page = ($this->uri->segment(3)) ;
// }
// else{
// $page = 1;
// }
$query_page = $sub_query . "LIMIT $perpage OFFSET $real_off";
$data['all_transaction'] = $this->all_conn->custom_query('select', $query_page);
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links );
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['crop_id'] = $crop_id;
		$data['page_title'] = 'Admin Invoice Schedule - Grow Crops Online';
		$this->load->admin_template('admin/invoice_view', $data);

	}
	public function book($tran_id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
      redirect('/admin');
    }elseif ($this->session->userdata('user_role') == 1) {
      redirect('/user');
    }
		$data['menu'] = 'invoice_schedule';
		if (empty($tran_id)) {
			if (!empty($_POST['tran_id'])) {
				$this->session->set_userdata('tran_id', $_POST['tran_id']);

			}else {
				redirect('admin/invoice_schedule');
			}

		}else {

			$tran = explode('_', $tran_id);
			if ($tran[1] == 'earlybird' || $tran[1] == 'early bird') {
				$transaction  = $data['transaction'] = $this->all_conn->select_data('transactions', '', 'id', $tran[0]);
			}else {
				$transaction  = $data['transaction'] = $this->all_conn->select_data('crop_invested', '', 'id', $tran[0]);
			}
			$user_id = $transaction[0]->user_id;
			$crop_id = $transaction[0]->crop_id;
			$crop_invested = $this->all_conn->select_data('crop_invested', 'id', $tran[0]);
			if (!$crop_invested) {
				$query_cr = "SELECT * FROM invested_crop WHERE user_id = $user_id AND crop_id = $crop_id";
				$prev_investment = $this->all_conn->custom_query('select', $query_cr);
				$count_investment = count($prev_investment);
				if ($count_investment) {
					$query_tran = "SELECT * FROM transactions WHERE user_id = $user_id ORDER BY transaction_date DESC LIMIT $count_investment";
					$user_tran = $this->all_conn->custom_query('select', $query_tran);
					if ($user_tran) {
						$slot = 0;
						foreach ($user_tran as $us) {
							$slot = $slot+ $us->slot;
						}
					}
				}
			}else {
				$slot = $crop_invested[0]->slot;
			}
			$data['user_details'] = $this->all_conn->select_data('users', '', 'id', $transaction[0]->user_id);
			$this->session->set_userdata('tran_id', $tran_id);

		}
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin Invoice Schedule - Grow Crops Online';
		$this->load->admin_template('admin/invoice_book', $data);

	}
	public function early_bird()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'early_bird';

		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['early_option'] =  $this->all_conn->select_data('site_options', '', 'option_key', 'early_bird');
		$data['all_early'] = $this->all_conn->select_data('crops');
		$data['page_title'] = 'Admin Early Bird - Grow Crops Online';
		$this->load->admin_template('admin/early_view', $data);

	}
	public function earlybird_activate($crop_id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		if (empty($crop_id)) {
			redirect('admin/early_bird');
		}
		$data['crop_data'] = $this->all_conn->select_data('crops', '', 'id', $crop_id);

		$data['menu'] = 'early_bird';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin Activate Early Bird - Grow Crops Online';
		$this->load->admin_template('admin/earlybird_activate', $data);

	}
	public function earlybird_deactivate($crop_id='')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		if (empty($crop_id)) {
			redirect('admin/early_bird');
		}
		$modify_data = array(
			'is_early' => '0',
		);
		$this->all_conn->modify_data('crops', $modify_data, 'id', $crop_id);
		redirect('admin/early_bird');
	}
	public function payment_approval()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'payment_approval';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- Approve Payment - Grow Crops Online';

		$this->load->admin_template('admin/pending_payment', $data);
	}
	public function payment_approve($tran_id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'payment_approval';
		if (empty($tran_id)) {
			redirect('admin/payment_approval');
		}else {
			$transaction = $this->all_conn->select_data('transactions', '', 'id', $tran_id);
			$crop_id = $transaction[0]->crop_id;
			$user_id = $transaction[0]->user_id;

			$update_data  = array(
				'status' => 'paid',
			);
			$affected =  $this->all_conn->modify_data('transactions', $update_data, 'id', $tran_id);
			if ($affected) {
				$query_check =  "SELECT * FROM crop_invested WHERE user_id = $user_id AND crop_id = $crop_id";
				$pre_investment  = $this->all_conn->custom_query('select', $query_check);
				if ($pre_investment) {
					$update_inv  = array(
						'stage' => $transaction[0]->stage,
						'slot'  => $transaction[0]->slot
					);
					$investment = $this->all_conn->modify_data('crop_invested',$update_inv, 'id', $pre_investment[0]->id );
				}else {
					$investment_data  = array(
						'crop_id' => $crop_id,
						'user_id' => $user_id,
						'stage' => $transaction[0]->stage,
						'slot'  => $transaction[0]->slot
					);
					$investment = $this->all_conn->insert_data('crop_invested', $investment_data);
				}
				if ($investment) {
					redirect('admin/payment_approval');
				}

			}else {
				redirect('admin/payment_approval');
			}
		}
	}
	public function transactions()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'transactions';
		$query_all = "SELECT SUM(amount) as total_amount FROM transactions";
		$data['all_transaction'] = $this->all_conn->custom_query('select', $query_all );
		$query_pending = "SELECT SUM(amount) as pending_amount FROM transactions WHERE status='pending'";

		$data['pend_transaction'] = $this->all_conn->custom_query('select', $query_pending );

		$query_paid = "SELECT SUM(amount) as paid_amount FROM transactions WHERE status='paid'";
		$data['paid_transaction'] = $this->all_conn->custom_query('select', $query_paid );


		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- All transaction - Grow Crops Online';
		$this->load->admin_template('admin/transaction', $data);
	}
	public function users()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'users';


		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- All Users - Grow Crops Online';
		$this->load->admin_template('admin/users', $data);
	}
	public function manual_booking()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'manual_booking';
		$data['all_crops'] = $this->all_conn->select_data('crops');
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- Manual Booking - Grow Crops Online';
		$this->load->admin_template('admin/manual_booking', $data);
	}
	public function post($post_id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'post';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- All Post - Grow Crops Online';
		if (empty($post_id)) {
			$data['posts'] = $this->all_conn->select_data('posts');
		}else {
			$data['posts'] = $this->all_conn->select_data('posts', '', 'id', $post_id);

		}
		$this->load->admin_template('admin/post', $data);

	}
	public function new_post()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'post';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- New Post - Grow Crops Online';
		$this->load->admin_template('admin/new_post', $data);
	}
	public function post_delete($post_id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'post';
		if (empty($post_id)) {
			redirect('admin/post');
		}
		$affected =  $this->all_conn->delete_data('posts', 'id', $post_id);
		if ($affected) {
				redirect('admin/post');
		}

	}
	public function edit_post($post_id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'post';
		$data['post'] = $post = $this->all_conn->select_data('posts', '', 'id', $post_id);
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- '.$post[0]->post_title.' - Grow Crops Online';
		$this->load->admin_template('admin/edit_post', $data);
	}
	public function testimonials()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'testimonials';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- Testimonials - Grow Crops Online';
		$data['testimonials'] = $this->all_conn->select_data('testimonials');

		$this->load->admin_template('admin/testimonials', $data);

	}
	public function new_testimonial()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'testimonials';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- New Testimonial - Grow Crops Online';
		$this->load->admin_template('admin/new_testimonial', $data);
	}
	public function site_options()
	{
		$data['menu'] = 'site_options';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- Website Options - Grow Crops Online';
		$this->load->admin_template('admin/site_options', $data);
	}
	public function manage_banner()
	{
		$data['manage_banner'] = $this->all_conn->select_data('site_options', '', 'option_key', 'home_banner');
		$data['menu'] = 'site_options';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin - Website Options - Grow Crops Online';
		$this->load->admin_template('admin/manage_banner', $data);
	}
	public function info_banner()
	{
		$data['info_banner'] = $this->all_conn->select_data('site_options', '', 'option_key', 'info_banner');
		$data['menu'] = 'site_options';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin - Website Options - Grow Crops Online';
		$this->load->admin_template('admin/info_banner', $data);
	}


}
