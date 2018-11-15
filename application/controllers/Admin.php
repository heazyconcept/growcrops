<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function index(){
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
			$dbOption = array(
				"table_name" => "transactions",
				"my_query" => "SELECT SUM(Amount) as Paystack_amount FROM transactions where PaymentType = 'Paystack'",
				"query_action" => "select"
			);
			$paystack = $this->connectDb->custom_query(json_encode($dbOption));
			$data['paystack'] = $paystack[0]->Paystack_amount;
			$dbOption = array(
				"table_name" => "transactions",
				"my_query" => "SELECT SUM(Amount) as transfer_amount FROM transactions where PaymentType = 'bank_transfer'",
				"query_action" => "select"
			);
			$bankTransfer = $this->connectDb->custom_query(json_encode($dbOption));
			$data['bank_transfer'] = $bankTransfer[0]->transfer_amount;
			$dbOption = array(
				"table_name" => "transactions",
				"my_query" => "SELECT SUM(Amount) as dailyamount FROM transactions where DATE(DateCreated) = CURDATE()",
				"query_action" => "select"
			);
			$dailyAmount = $this->connectDb->custom_query(json_encode($dbOption));
			$data['dailyAmount'] = $dailyAmount[0]->dailyamount;
			$dbOption = array(
				"table_name" => "transactions",
				"my_query" => "SELECT SUM(Amount) as verifiedAmount FROM transactions where paymentStatus = 'Confirmed'",
				"query_action" => "select"
			);
			$verifiedAmount = $this->connectDb->custom_query(json_encode($dbOption));
			$data['verifiedAmount'] = $verifiedAmount[0]->verifiedAmount;
			$dbOption = array(
				"table_name" => "transactions",
				"my_query" => "SELECT SUM(Amount) as unverifiedAmount FROM transactions where paymentStatus = 'Not Confirmed'",
				"query_action" => "select"
			);
			$unverifiedAmount = $this->connectDb->custom_query(json_encode($dbOption));
			$data['unverifiedAmount'] = $unverifiedAmount[0]->unverifiedAmount;
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

			$transaction = $this->all_conn->select_data('transactions', '', 'Id', $tran_id);
			$crop_id = $transaction[0]->CropId;
			$user_id = $transaction[0]->UserId;

			$update_data  = array(
				'PaymentStatus' => 'Confirmed',
				'DateConfirmed' => $this->all_conn->fetch_time()
			);
			$affected =  $this->all_conn->modify_data('transactions', $update_data, 'id', $tran_id);
			if (!empty($affected)) {
				$dbOption = array(
					"table_name" => "transactions",
					"targets" => array("Id" => $tran_id)
				);
				$transaction = $this->connectDb->select_data(json_encode($dbOption));
					$mailOptions = array(
						"name" => "Finance Department",
						"to" => $this->connectDb->FetchUser($user_id, "email_address"),
						"subject" => "Receipt - Transaction " . $transaction[0]->TransactionRef,
						"fullName" => $this->connectDb->FetchUser($user_id, "first_name") . " " . $this->connectDb->FetchUser($user_id, "last_name"),
						"amount" => number_format($transaction[0]->Amount, 2),
						"transactionRef" => $transaction[0]->TransactionRef,
						"confirmedDate" => $this->utilities->formatDate($transaction[0]->DateConfirmed)
					);
					$this->load->library("receiptmail");
					$this->receiptmail->send_mail(json_encode($mailOptions));
					
					redirect('admin/transactions');
					

			} else {
				redirect('admin/transactions');
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
		$query_all = "SELECT SUM(Amount) as total_amount FROM transactions";
		$data['all_transaction'] = $this->all_conn->custom_query('select', $query_all );
		$query_pending = "SELECT SUM(Amount) as pending_amount FROM transactions WHERE PaymentStatus='Not Confirmed'";

		$data['pend_transaction'] = $this->all_conn->custom_query('select', $query_pending );

		$query_paid = "SELECT SUM(Amount) as paid_amount FROM transactions WHERE PaymentStatus='Confirmed'";
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
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'site_options';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin- Website Options - Grow Crops Online';
		$this->load->admin_template('admin/site_options', $data);
	}
	public function manage_banner()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['manage_banner'] = $this->all_conn->select_data('site_options', '', 'option_key', 'home_banner');
		$data['menu'] = 'site_options';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin - Website Options - Grow Crops Online';
		$this->load->admin_template('admin/manage_banner', $data);
	}
	public function info_banner()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['info_banner'] = $this->all_conn->select_data('site_options', '', 'option_key', 'info_banner');
		$data['menu'] = 'site_options';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin - Website Options - Grow Crops Online';
		$this->load->admin_template('admin/info_banner', $data);
	}
	public function userDashboard()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'user_dasboard';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin - User Dasboard - Grow Crops Online';
		$this->load->admin_template('admin/userDashboard', $data);
	} 
	public function CreateEmployees(){

		if (empty($this->session->userdata('user_id'))) {
			redirect('/admin');
		}elseif ($this->session->userdata('user_role') == 1) {
			redirect('/user');
		}
		$data['menu'] = 'employees';
		$data['user_extras'] = $this->all_conn->select_data('user_extra_details', '', 'user_id', $this->session->userdata('user_id'));
		$data['page_title'] = 'Admin - Employees - Grow Crops Online';
		$this->load->admin_template('admin/employees', $data);
	}

}
