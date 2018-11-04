<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_call extends CI_Controller {

	public function lga_call($state)
	{
		$lga = $this->all_conn->select_data('location', 'local_government', 'state', $state);
		$lga = json_encode($lga);
		echo $lga;


	}
	public function register()
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		$check_data = array(
			'username' => $username,
			'email_address' => $email_address,
			'phone_number' => $phone_number,
		);
		$exist = $this->all_conn->check_exist('users', $check_data, 'OR' );
		if ($exist > 0) {
			$return_data = array(
				'mess_type' => '-5'
			);
			$return_data = json_encode($return_data);
			echo $return_data;
			return;

		}
		$salt = sha1($password);
		$password = $salt.$password;
		$password = md5($password);
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		$user_data = array(
			'username' => $username,
			'user_role' => 1,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email_address' => $email_address,
			'phone_number' => $phone_number,
			'user_address' => $user_address,
			'city' => $city,
			'state' => $state,
			'token' => $token,
			'password' => $password,
			'salt' => $salt,
			'date_created' => date("Y-m-d H:i:s"),
		);
		$user_id =  $this->all_conn->insert_data('users', $user_data);
		if ($user_id) {
			$activation = '<a href="'.base_url('activation/').'?t='.$token.'&e='.$email_address.'" target="_blank">click here</a>';
			$other_values = array(
				'username' => $username,
				'activation' => $activation,
				'email_address' => $email_address,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'last_name' => $last_name,
			);
			$user_data = $this->all_conn->select_data('users', '', 'id', $user_id);
		// $this->mail_lib->send_mail('no-reply@growcropsonline.com', 'growcropsonline', $email_address, 'User Registration', 'registration', $other_values, 'user');
		$redirect = $this->session->userdata('redirect_data');
		$return_url = $redirect['url'];
		$return_data = array(
			'mess_type' => '1',
			'redirect_url' => base_url($return_url)
		);
		$user_meta = array(
			'user_id' =>$user_data[0]->id,
			'username' =>$user_data[0]->username,
			'first_name' =>$user_data[0]->first_name,
			'last_name' =>$user_data[0]->last_name,
			'user_address' =>$user_data[0]->user_address,
			'state' =>$user_data[0]->state,
			'city' =>$user_data[0]->city,
			'user_role' =>$user_data[0]->user_role,
			'email_address' =>$user_data[0]->email_address,
			'phone_number' =>$user_data[0]->phone_number,
		);
		if ($this->session->has_userdata('redirect_data')) {
			$this->session->unset_userdata('redirect_data');
		}
		$this->session->set_userdata($user_meta);
		$return_data = json_encode($return_data);
		echo $return_data;
		}else {
			echo 0;
		}

	}
	public function login()
	{
		foreach ($_POST as $key => $value) {
		$$key = $value;
		}
		if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
			$user_data = $this->all_conn->select_data('users', '', 'email_address', $username);
		}
    	else {
			$user_data = $this->all_conn->select_data('users', '', 'username', $username);
    	}

		if (empty($user_data)) {
			$return_data = array(
				'mess_type' => '-5'
			);
			$return_data = json_encode($return_data);
			echo $return_data;
			return;
		}
		$salt = $user_data[0]->salt;
		$password = $salt.$password;
		$password = md5($password);
		if ($password != $user_data[0]->password) {
			$return_data = array(
				'mess_type' => '-3'
			);
			$return_data = json_encode($return_data);
			echo $return_data;
			return;

		}else {
			$user_meta = array(
				'user_id' =>$user_data[0]->id,
				'username' =>$user_data[0]->username,
				'first_name' =>$user_data[0]->first_name,
				'last_name' =>$user_data[0]->last_name,
				'user_address' =>$user_data[0]->user_address,
				'state' =>$user_data[0]->state,
				'city' =>$user_data[0]->city,
				'user_role' =>$user_data[0]->user_role,
				'email_address' =>$user_data[0]->email_address,
				'phone_number' =>$user_data[0]->phone_number,
			);
			if ($this->session->has_userdata('redirect_data')) {
				$this->session->unset_userdata('redirect_data');
			}
			$this->session->set_userdata($user_meta);
			if (!empty($return_url)) {
				$return_url = urldecode($return_url);
				$return_url = base_url($return_url);
			}else {
				if ($user_data[0]->user_role == 1) {
					$return_url = base_url('user');
				}elseif ($user_data[0]->user_role == 2) {
					$return_url = base_url('admin/dashboard');
				}

			}
			$return_data = array(
				'mess_type' => '1',
				'redirect_url' => $return_url
			);
			$return_data = json_encode($return_data);
			echo $return_data;

		}


	}
	public function save_picture()
	{
		$this->load->helper('form');
		$config['upload_path']          = './upload/profile_pic/';
		$config['allowed_types']        = 'jpg|png|gif|';
		$config['max_size']             = 10000;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('profile_pics'))
		{
			$error = array('error' => $this->upload->display_errors());
			echo "-5";
			return;
		}else
		{
			$data =  $this->upload->data();
			$check_exist = $this->all_conn->count_data('user_extra_details', 'user_id', $this->session->userdata('user_id') );
			if ($check_exist > 0) {
				$image_data  = array(
					'image_name' => $data['file_name'],
				);
				$this->all_conn->modify_data('user_extra_details', $image_data, 'user_id', $this->session->userdata('user_id') );
			}else {
				$image_data  = array(
					'user_id' => $this->session->userdata('user_id'),
					'image_name' => $data['file_name'],
				);
				$this->all_conn->insert_data('user_extra_details', $image_data);
			}

			echo "1";
		}
	}
	public function profile_edit()
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		$user_data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email_address' => $email_address,
			'phone_number' => $phone_number,
			'user_address' => $user_address,
			'city' => (isset($city))? $city: $this->session->userdata('city'),
			'state' => $state,
		);
		$this->all_conn->modify_data('users', $user_data, 'id', $this->session->userdata('user_id'));

		$user_meta = array(
			'first_name' =>$first_name,
			'last_name' =>$last_name,
			'user_address' =>$user_address,
			'state' =>$state,
			'city' => (isset($city))? $city: $this->session->userdata('city'),
			'email_address' =>$email_address,
			'phone_number' =>$phone_number,
		);
		$this->session->set_userdata($user_meta);
		echo "1";


	}
	public function change_password()
	{
		foreach ($_POST as $key => $value) {
		$$key = $value;
		}

		$user_id = $this->session->userdata('user_id');
			$user_data = $this->all_conn->custom_query('select', "SELECT * FROM users WHERE id = $user_id");


		$salt = $user_data[0]->salt;
		$password_old = $salt.$password_old;
		$password_old = md5($password_old);
		if ($password_old != $user_data[0]->password) {
			echo "-4";
			return;
		}
		$salt = $user_data[0]->salt;
		$password = $salt.$password;
		$password = md5($password);

		$user_pass = array(
			'password' => $password,
		);

		$affected = $this->all_conn->modify_data('users', $user_pass, 'id', $this->session->userdata('user_id'));
		if ($affected > 0) {
			echo "1";
		}else {
			echo "-5";
		}



	}
	public function transaction()
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		// print_r($_POST);
		// die();
		if($payment_type == "bank_transfer"){
			$insertData = array(
				"UserId" => $this->session->userdata("user_id"),
				"TransactionRef" => $reference,
				"Amount" => $amount,
				"PaymentType" => $payment_type,
				"CropId" => $crop_id,
				"Slot" => $slot_amount,
				"PaymentStatus" => $status,
				"DateCreated" => $this->all_conn->fetch_time(),
			);

		}elseif($payment_type == "Paystack"){
			$insertData = array(
				"UserId" => $this->session->userdata("user_id"),
				"TransactionRef" => $reference,
				"Amount" => $amount,
				"PaymentType" => $payment_type,
				"CropId" => $crop_id,
				"Slot" => $slot_amount,
				"PaymentStatus" => $status,
				"DateCreated" => $this->all_conn->fetch_time(),
				"DateConfirmed" => $this->all_conn->fetch_time(),
			);


		}
		

		$transactionOption = array(
			"table_name" => "transactions",
			"process_data" => $insertData,
		);
		$response = $this->connectDb->insert_data(json_encode($transactionOption));
		if($response > 0 ){
			$mailOptions = array(
				"name" => "Finance Department",
				"to" => $this->session->userdata("email_address"),
				"subject" => "Invoice Generated",
				"fullName" => $this->session->userdata("first_name") . " " . $this->session->userdata("last_name"),
				"Amount" => number_format($amount, 2),
				"link" => base_url("receipt/view/" . $reference)
			);
			$this->load->library("notificationMail");
			$this->notificationmail->send_mail(json_encode($mailOptions));
			if($payment_type == "Paystack"){
				$mailOptions = array(
					"name" => "Finance Department",
					"to" => $this->session->userdata('email_address'),
					"subject" => "Receipt - Transaction " . $reference,
					"fullName" => $this->session->userdata("first_name") . " " . $this->session->userdata("last_name"),
					"amount" => number_format($amount, 2),
					"transactionRef" => $reference,
					"confirmedDate" => $this->utilities->formatDate($this->all_conn->fetch_time())
				);
				$this->load->library("receiptMail");
				$this->receiptmail->send_mail(json_encode($mailOptions));
			}
			echo 1;

		}else{
			echo 0;
		}
	}
	public function add_crop()
	{
		foreach ($_POST as $key => $value) {
		$$key = $value;
		}
		$this->load->helper('form');
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|png|gif|';
		$config['max_size']             = 10000;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('featured_image'))
		{

			$featured_image_data = $this->upload->data();
			if ($this->upload->do_upload('alternative_image')) {
			$alternative_image_data = $this->upload->data();
				$crop_data = array(
					'crop_name' => $crop_name,
					'featured_image' => $featured_image_data['file_name'],
					'alternative_image' => $alternative_image_data['file_name'],
					'content' => $content,
					'is_full' => 0,
					'slug' => '',
					'is_early' => 0,
					'admin_fee' => $admin_fee,
					'projected_income' => $min_projected.'-'.$max_projected,
				);
				$crop_id = $this->all_conn->insert_data('crops', $crop_data);

				if ($crop_id) {

					$slug = $crop_id.'-'.str_replace(' ', '-', 	strtolower($crop_name));
					$update_data  = array(
						'slug' => $slug,
					);
					$this->all_conn->modify_data('crops', $update_data, 'id', $crop_id);
					for ($i=0; $i < count($payment_details) ; $i++) {
						$attribute_data = array(
							'crop_id' => $crop_id,
							'payment_details' => $payment_details[$i],
							'quantity' => $quantity[$i],
							'cost_per_unit' => $cost_per_unit[$i],
							'total_cost' => $cost_per_unit[$i] * $quantity[$i],
						);
						$att_id = $this->all_conn->insert_data('payment_breakdown', $attribute_data );

					}
					if ($att_id) {
						$initial_amount  = array(
							'crop_id' => $crop_id,
							'amount' => $stage_one_amount
						);
						$initial_id =  $this->all_conn->insert_data('stage_one_payment', $initial_amount);
						if ($initial_id) {
							echo "1";
						}else {
							$this->all_conn->delete_data('stage_one_payment', 'crop_id', $crop_id);
							$this->all_conn->delete_data('payment_breakdown', 'crop_id', $crop_id);
							$this->all_conn->delete_data('crops', 'id', $crop_id);
							echo "-5";
						}
					}else {
						$this->all_conn->delete_data('payment_breakdown', 'crop_id', $crop_id);
						$this->all_conn->delete_data('crops', 'id', $crop_id);
						echo "-5";
					}
				}else {
					echo "-5";
				}


			}else {
				$error = array('error' => $this->upload->display_errors());
				echo "-5";
				return;
			}

		}else
		{
			$error = array('error' => $this->upload->display_errors());
			echo "-5";
			return;

		}

	}
	public function modify_crop()
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		$this->load->helper('form');
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|png|gif|';
		$config['max_size']             = 10000;
		$this->load->library('upload', $config);

		if (isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
		{
			if ($this->upload->do_upload('featured_image'))
			{
				$featured_image_data = $this->upload->data();
			}else {
				echo "-1";
				$error = array('error' => $this->upload->display_errors());
				return;
			}

		}
		if (isset($_FILES['alternative_image']) && !empty($_FILES['alternative_image']['name'])) {
			if ($this->upload->do_upload('alternative_image'))
			{
				$alternative_image_data = $this->upload->data();
			}else {
				echo "-2";
				$error = array('error' => $this->upload->display_errors());
				return;
			}

		}


		$update_data  = array(
			'crop_name' => $crop_name,
			'featured_image' => (!isset($featured_image_data)) ? $featured_image_old : $featured_image_data['file_name'],
			'alternative_image' => (!isset($alternative_image_data)) ? $alternative_image_old : $alternative_image_data['file_name'],
			'content' => $content,
			'admin_fee' => $admin_fee,
			'projected_income' => $min_projected.'-'.$max_projected,
		);
		$this->all_conn->modify_data('crops', $update_data, 'id', $crop_id);
		$check_details = $this->all_conn->select_data('payment_breakdown', '', 'crop_id', $crop_id);
		if ($check_details) {
			$this->all_conn->delete_data('payment_breakdown', 'crop_id', $crop_id );
		}
		if (isset($payment_details)) {
			for ($i=0; $i < count($payment_details) ; $i++) {
				if (!empty($payment_details[$i])) {
					$attribute_data = array(
						'crop_id' => $crop_id,
						'payment_details' => $payment_details[$i],
						'quantity' => $quantity[$i],
						'cost_per_unit' => $cost_per_unit[$i],
						'total_cost' => $cost_per_unit[$i] * $quantity[$i],
					);
					$att_id = $this->all_conn->insert_data('payment_breakdown', $attribute_data );
  				 }

  			 }
		}
		$check_initials = $this->all_conn->select_data('stage_one_payment', '', 'crop_id', $crop_id);
		if ($check_initials) {
			$update_initials = array(
				'amount' => $stage_one_amount,
			);
			$this->all_conn->modify_data('stage_one_payment', $update_initials,  'crop_id', $crop_id );
		}else {
			$update_initials = array(
				'crop_id' => $crop_id,
				'amount' => $stage_one_amount,
				'description' => '',
			);
			$this->all_conn->insert_data('stage_one_payment', $update_initials);
		}
		echo "1";



	}
	public function activate_earlybird($crop_id ='')
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		if (empty($crop_id)) {
			echo "-5";
			return;
		}
		$bench_mark = array(
			'crop_id' => $crop_id,
		);
		$check_exist =  $this->all_conn->check_exist('early_bird', $bench_mark, 'AND');
		if ($check_exist) {
			$update_data = array(
				'amount' => $amount,
				'date_modified' => $this->all_conn->fetch_time(),
			);
			$this->all_conn->modify_data('early_bird', $update_data, 'crop_id', $crop_id);
			$modify_crop = array(
				'is_early' => '1',
			);
			$this->all_conn->modify_data('crops', $modify_crop, 'id', $crop_id);
			echo "1";
		}else {
			$early_data  = array(
				'crop_id' => $crop_id,
				'amount' => $amount,
				'date_modified' => $this->all_conn->fetch_time(),
			);
			$insert_id = $this->all_conn->insert_data('early_bird', $early_data);
			if ($insert_id) {
				$modify_crop = array(
					'is_early' => '1',
				);
				$this->all_conn->modify_data('crops', $modify_crop, 'id', $crop_id);
				echo "1";
			}else {
				echo "-5";
			}
		}

	}
	public function reset_password()
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}

		$valid_email = $this->all_conn->select_data('users', '',  'email_address',  $email_address);
		if ($valid_email) {
			$token = bin2hex(openssl_random_pseudo_bytes(16));
			$update_data = array(
				'token' => $token,
			);
			$affected = $this->all_conn->modify_data('users', $update_data, 'email_address', $email_address);
			if ($affected) {
				$other_values['email_address'] = $email_address;
				$other_values['reset_link'] = '<a href="'.base_url('auth/forgot_password/').$token.'_'.$valid_email[0]->id.'" target="_blank">click here</a>';
				$this->mail_lib->send_mail('GrowcropsOnline', $email_address, 'Password Reset', 'reset_password', $other_values, 'user');
				echo "1";
			}
			else {
				echo "-5";
			}
		}else {
			echo "-5";
		}

	}
	public function reset_pass()
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		$user_data = $this->all_conn->select_data('users', '', 'id', $user_id);
		if ($user_data) {
			$password = $user_data[0]->salt.$password;
			$password = md5($password);
			$update_data  = array(
				'password' => $password,
			);
			$affected = $this->all_conn->modify_data('users', $update_data, 'id', $user_id);
			if ($affected) {
				echo "1";
			}else {
				echo "1";
			}
		}else {
			echo "-5";
		}

	}
	public function filter_email()
	{
		$email = $_POST['email_address'];
		if (isset($_POST['link_it'])) {
		$link_it = $_POST['link_it'];
		}

		$query = "SELECT * FROM users where email_address like '%$email%' LIMIT 3";

		$all_user = $this->all_conn->custom_query('select', $query );
		if ($all_user) {
			$user_filter = '';
			foreach ($all_user as $user) {
				if (isset($link_it) && $link_it == 'No') {
					$user_filter .= '<div class="option_item">'.$user->email_address.'</div>';
				}else {
					$user_filter .= '<div class="option_item"><a href="'.base_url('admin/payment_approval/').$user->id.'">'.$user->email_address.'</a></div>';
				}
			}
			// $user_filter .='</ul>';
			echo $user_filter;
		}

	}
	public function filter_post()
	{
		$post_title = $_POST['post_title'];


		$query = "SELECT * FROM posts where post_title like '%$post_title%' LIMIT 3";

		$all_post = $this->all_conn->custom_query('select', $query );
		if ($all_post) {
			$post_filter = '';
			foreach ($all_post as $post) {

					$post_filter .= '<div class="option_item"><a href="'.base_url('admin/post/').$post->id.'">'.$post->post_title.'</a></div>';

			}
			echo $post_filter;
		}

	}
	public function get_details()
	{
		$email_address = $_POST['email_address'];
		$user_data = $this->all_conn->select_data('users', '', 'email_address', $email_address);
		echo json_encode($user_data[0]);

	}
	public function get_crop_amount($stage = '', $crop_id = '')
	{
		if ($stage == 'early_bird') {
			$amount = $this->all_conn->select_data('early_bird', '', 'crop_id', $crop_id );

		}elseif ($stage == 'one') {
			$amount = $this->all_conn->select_data('stage_one_payment', '', 'crop_id', $crop_id );
		}
		if ($amount) {
			echo json_encode($amount[0]);
		}else {
			$response  = array(
				'amount' => 0.00,
			);
			echo json_encode($response);
		}
	}

	public function add_post()
	{
		foreach ($_POST as $key => $value) {
		$$key = $value;
		}

		$this->load->helper('form');
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|png|gif|';
		$config['max_size']             = 10000;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('featured_image'))
		{
			$featured_image_data = $this->upload->data();
			$post_data = array(
				'post_title' => $post_title,
				'slug' => '',
				'post_content' => $post_content,
				'post_image' => $featured_image_data['file_name'],
				'date_created' => date("Y-m-d H:i:s")
			);
			$post_id = $this->all_conn->insert_data('posts', $post_data);
			if ($post_id) {
				$slug = $post_id.'-'.str_replace(' ', '-', 	strtolower($post_title));
				$update_data  = array(
					'slug' => $slug,
				);
				$affected = $this->all_conn->modify_data('posts', $update_data, 'id', $post_id);
				if ($affected) {
					echo "1";
				}else {
					echo "-5";
				}
			}else {
				echo "-5";
			}
		}else {
			echo "-5";
		}

	}
	public function edit_post()
	{
		foreach ($_POST as $key => $value) {
		$$key = $value;
		}

		$this->load->helper('form');
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|png|gif|';
		$config['max_size']             = 10000;
		$this->load->library('upload', $config);
		if (isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name']))
		{
			if ($this->upload->do_upload('featured_image'))
			{
					$featured_image_data = $this->upload->data();
					$post_image = $featured_image_data['file_name'];
			}else {
				echo "-5";
				return;
			}
		}else {
		$post_image = $old_featured_image;
		}
		$update_data  = array(
			'post_title' => $post_title,
			'post_content' => $post_content,
			'post_image' => $post_image,
		);
		$affected =  $this->all_conn->modify_data('posts', $update_data, 'id', $post_id);
		if ($affected) {
			echo '1';
		}else {
			echo "1";
		}

	}
	public function add_testimonial()
	{
		foreach ($_POST as $key => $value) {
		$$key = $value;
		}
		$test_data  = array(
			'customer_name' => $customer_name,
			'testimony' => $testimony,
			'customer_location' => $customer_location,
			'rating' => $rating,
			'date_created' => date("Y-m-d H:i:s")
		);
		$test_id = $this->all_conn->insert_data('testimonials', $test_data);

		if ($test_id) {
			echo "1";
		}else {
			echo "-5";
		}
	}
	public function site_options($actions = '')
	{
		foreach ($_POST as $key => $value) {
		$$key = $value;
		}
		$this->load->helper('form');
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|png|gif|jpeg';
		$config['max_size']             = 10000;
		$this->load->library('upload', $config);
		if ($actions == 'home_banner') {
			if (isset($_FILES['home_banner']) && !empty($_FILES['home_banner']['name'][0])){
				$main = $_FILES['home_banner'];
				$exclude_all = [''];
				$exclude_size =[0];
				$exclude_error =[4];
				$main['name']  = array_diff($main['name'], $exclude_all);
				$main['type']  = array_diff($main['type'], $exclude_all);
				$main['tmp_name']  = array_diff($main['tmp_name'], $exclude_all);
				$main['error'] = array_diff($main['error'], $exclude_error);
				$main['size']  = array_diff($main['size'], $exclude_size);
				$_FILES['home_banner'] = $main;

				if($this->upload->do_multi_upload("home_banner")) {
					$uploaded_file = $this->upload->get_multi_upload_data();

				}
			}
			for ($i=0; $i <count($banner_title) ; $i++) {
				$option_data[] = array(
					'banner_title' => $banner_title[$i],
					'banner_sub_title' => $banner_sub_title[$i],
					'home_banner' => (isset($uploaded_file[$i]['file_name']))? $uploaded_file[$i]['file_name'] : $old_home_banner[$i],
				);

			}
		}elseif ($actions == 'info_banner') {
			if (isset($_FILES['info_banner']) && !empty($_FILES['info_banner']['name'])){
			 	if($this->upload->do_upload("info_banner")) {
				 $uploaded_file =  $this->upload->data();

			 	}
		 	}
			$option_data[] = array(
				'info_banner' => (isset($uploaded_file['file_name']))? $uploaded_file['file_name'] : $old_info_banner,
			);

		}elseif ($actions == 'early_bird') {
			$early_bird = $_POST['is_early'];
			$option_data[] = array(
				'is_early' => $early_bird,
			);
		}
		$bench_mark  = array(
			'option_key' => $actions,
		);
		$check_data = $this->all_conn->check_exist('site_options', $bench_mark, 'AND');
		if ($check_data) {
			$update_option = array(
				'option_value' => json_encode($option_data)
			);
			$updated = $this->all_conn->modify_data('site_options', $update_option, 'option_key', $actions);
			echo "1";
		}else {
			$insert_option = array(
				'option_key' => $actions,
				'option_value' => json_encode($option_data)
			);
			$insert_id = $this->all_conn->insert_data('site_options', $insert_option);
			if ($insert_id) {
				echo "1";
			}
		}

	}
	public function fetchUser($search, $limit = 0)
	{
		
		if($search == '' || $search == ' ' ){
			echo "";
			return;
		}
		$query = "SELECT * FROM users WHERE 
		user_role = 1 AND first_name like '%$search%' OR
		user_role = 1 AND last_name like '%$search%' OR
		user_role = 1 AND email_address like '%$search%' OR
		user_role = 1 AND phone_number like '%$search%'";
		if (!empty($limit)) {
			$query = $query . "LIMIT $limit";
		}
		$dbOptions = array(
			"my_query" => $query,
			"query_action" =>"select"
		);
		$result = $this->connectDb->custom_query(json_encode($dbOptions));
		echo json_encode($result);
		return;
	}
	public function callUserDashboard($userId)
	{
		$query = "SELECT * from user_dashboard WHERE UserId = $userId ORDER BY DateCreated DESC LIMIT 1";
		$dbOptions = array(
			"my_query" => $query,
			"query_action" => "select",
		);
		$result = $this->connectDb->custom_query(json_encode($dbOptions));

		echo json_encode($result[0]);
	
	}
	public function addDashboard()
	{
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		$dbOptions  = array(
			"table_name" => "users",
			"targets" => array("id" => $UserId)
		);
		$userDetails = $this->connectDb->select_data(json_encode($dbOptions));
		if(!$userDetails[0]->dashboard_enabled){
			$updateData = array(
				"dashboard_enabled" => true
			);
			$dbOptions  = array(
				"table_name" => "users",
				"process_data" => $updateData,
				"targets" => array("id" => $UserId)
			);
			$this->connectDb->modify_data(json_encode($dbOptions));
		}
		$dashboardData = array(
			"UserId" => $UserId,
			"AmountPayeable" => $AmountPayeable,
			"Slot" => $Slot,
			"PaymentUpdate" => $PaymentUpdate,
			"CreatedBy" => $this->session->userdata("user_id"),
			"DateCreated" => $this->all_conn->fetch_time(),
		);
		$dbOptions = array(
			"table_name" => "user_dashboard",
			"process_data" => $dashboardData
		);
		$response = $this->connectDb->insert_data(json_encode($dbOptions));
		if(!empty($response)){
			echo "1";
		}else{
			echo "0";
		}
	
	}

}
