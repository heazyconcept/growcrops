<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fetch_tables extends CI_Controller {

public function index()
{

}

public function pending_transaction()
{
  	$this->load->model('pagination_model');


    $columns = array(
                            0 =>'transaction_ref',
                            1 =>'full_name',
                            2=> 'email_address',
                            3=> 'amount',
                            4=> 'crop_name',
                            5=> 'stage',
                            6=> 'slot',
                            7=> 'action',
                        );

		$limit = $this->input->get('length');
    $start = $this->input->get('start');
    $totalData = $this->all_conn->count_data('transactions', 'status', 'pending');
    $totalFiltered = $totalData;

        if(empty($this->input->get('search')['value']))
        {

          $query = "SELECT transactions.*, users.first_name, users.last_name, users.email_address, crops.crop_name FROM transactions INNER JOIN users on transactions.user_id = users.id INNER JOIN crops ON transactions.crop_id = crops.id where transactions.status = 'pending' LIMIT $limit OFFSET $start";
					$pending_transaction = $this->all_conn->custom_query('select', $query);
        }
        else {
            $search = $this->input->get('search')['value'];
            $query = "SELECT transactions.*, users.first_name, users.last_name, users.email_address, crops.crop_name FROM transactions
            INNER JOIN users on transactions.user_id = users.id
            INNER JOIN crops ON transactions.crop_id = crops.id  WHERE
            transactions.status = 'pending' AND transactions.transaction_ref LIKE '%$search%' OR
            transactions.status = 'pending' AND users.first_name LIKE '%$search%' OR
            transactions.status = 'pending' AND users.last_name LIKE '%$search%'  OR
            transactions.status = 'pending' AND users.email_address LIKE '%$search%'  OR
            transactions.status = 'pending' AND transactions.amount LIKE '%$search%'  OR
            transactions.status = 'pending' AND transactions.stage LIKE '%$search%'  OR
            transactions.status = 'pending' AND transactions.slot LIKE '%$search%'  OR
            transactions.status = 'pending' AND crops.crop_name LIKE '%$search%'
            LIMIT $limit OFFSET $start";
            $pending_transaction = $this->all_conn->custom_query('select', $query);
            $totalFiltered = count($pending_transaction);
        }

        $data = array();
        if(!empty($pending_transaction))
        {
            foreach ($pending_transaction as $obj)
            {

                $nestedData['transaction_ref'] = $obj->transaction_ref;
								$nestedData['full_name'] = $obj->first_name . ' '. $obj->last_name;
                $nestedData['email_address'] = $obj->email_address;
                $nestedData['amount'] = '&#8358;'. number_format($obj->amount, 2);
                $nestedData['crop_name'] = $obj->crop_name;
                $nestedData['stage'] = $obj->stage;
                $nestedData['slot'] = $obj->slot;
                $nestedData['action'] = '<a href="'.base_url('admin/payment_approve/'). $obj->id.'" class="btn btn-xs btn-primary crop-edit">Approve</a>';

                $data[] = $nestedData;

            }

        }

        $json_data = array(
                    "draw"            => intval($this->input->get('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);
	}
  public function transactions()
  {
    $this->load->model('pagination_model');


		$limit = $this->input->get('length');
    $start = $this->input->get('start');
    $totalData = $this->all_conn->count_data('transactions');
    $totalFiltered = $totalData;

        if(empty($this->input->get('search')['value']))
        {

          $query = "SELECT transactions.*, 
          users.first_name, users.last_name, users.email_address, crops.crop_name 
          FROM transactions 
          INNER JOIN users on transactions.UserId = users.id 
          INNER JOIN crops ON transactions.CropId = crops.id 
          LIMIT $limit OFFSET $start";
		    $transaction = $this->all_conn->custom_query('select', $query);
        }
        else {
            $search = $this->input->get('search')['value'];
            $query = "SELECT transactions.*, 
            users.first_name, users.last_name, users.email_address, crops.crop_name 
            FROM transactions
            INNER JOIN users on transactions.UserId = users.id
            INNER JOIN crops ON transactions.CropId = crops.id  WHERE
            transactions.TransactionRef LIKE '%$search%' OR
            users.first_name LIKE '%$search%' OR
            users.last_name LIKE '%$search%'  OR
            users.email_address LIKE '%$search%'  OR
            transactions.Amount LIKE '%$search%'  OR
            transactions.PaymentStatus LIKE '%$search%'  OR
            transactions.PaymentType LIKE '%$search%'  OR
            crops.crop_name LIKE '%$search%'
            LIMIT $limit OFFSET $start";
            $transaction = $this->all_conn->custom_query('select', $query);
            $totalFiltered = count($transaction);
        }

        $data = array();
        if(!empty($transaction))
        {
            foreach ($transaction as $obj)
            {

                $nestedData['transaction_ref'] = $obj->TransactionRef;
				$nestedData['full_name'] = $obj->first_name . ' '. $obj->last_name;
                $nestedData['email_address'] = $obj->email_address;
                $nestedData['amount'] = '&#8358;'. number_format($obj->Amount, 2);
                $nestedData['crop_name'] = $obj->crop_name;
                $nestedData['slot'] = $obj->Slot;
                $nestedData['payment_type'] = $this->paymentType($obj->PaymentType);
                if ($obj->PaymentStatus == "Confirmed") {
                    $nestedData['action'] = '<button type="button" disabled class="btn btn-xs btn-primary crop-edit">Confirmed</button>';
                } else {
                    $nestedData['action'] = '<a href="'.base_url('admin/payment_approve/'). $obj->Id.'" class="btn btn-xs btn-primary crop-edit">Confirm</a>';
                }
                $data[] = $nestedData;

            }

        }

        $json_data = array(
                    "draw"            => intval($this->input->get('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);
  }
  private function paymentType($paymentType)
  {
      if($paymentType == "bank_transfer"){
          return "Bank Transfer";
      }else{
          return $paymentType;
      }
  }
  public function users()
  {
    $this->load->model('pagination_model');


    $columns = array(
                            0 =>'full_name',
                            1 =>'email_address',
                            2 => 'phone_number',
                            3 => 'user_address',
                            4 => 'state',
                        );

		$limit = $this->input->get('length');
    $start = $this->input->get('start');
    $totalData = $this->all_conn->count_data('users');
    $totalFiltered = $totalData;

        if(empty($this->input->get('search')['value']))
        {
          $users = $this->pagination_model->fetch_data_specific($limit, $start, 'users', 'user_role', '1');
        }
        else {
            $search = $this->input->get('search')['value'];
            $search_parameter  = array(
							'first_name' => $search,
							'last_name' => $search,
							'phone_number' => $search,
              'email_address' => $search,
              'user_address' => $search,
							'state' => $search,
						);


            $users =  $this->pagination_model->table_search($limit, $start,'users', $search_parameter, $search);
            $totalFiltered = $this->pagination_model->table_search_count($search_parameter, 'users', $search);
        }

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $obj)
            {

								$nestedData['full_name'] = $obj->first_name . ' '. $obj->last_name;
                $nestedData['email_address'] = $obj->email_address;
                $nestedData['phone_number'] = $obj->phone_number;
                $nestedData['user_address'] = $obj->user_address;
                $nestedData['state'] = $obj->state;

                $data[] = $nestedData;

            }

        }

        $json_data = array(
                    "draw"            => intval($this->input->get('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);
  }
  public function usersDashboard()
  {
    $this->load->model('pagination_model');
	$limit = $this->input->get('length');
    $start = $this->input->get('start');
    $dbOption = array(
        "table_name" => "users",
        "targets"=> array("dashboard_enabled" => true)
    );
    $totalData = $this->connectDb->count_data(json_encode($dbOption));
    $totalFiltered = $totalData;

        if(empty($this->input->get('search')['value']))
        {
          $users = $this->pagination_model->fetch_data_specific($limit, $start, 'users', 'dashboard_enabled', true);
        }
        else {
            $search = $this->input->get('search')['value'];
            
            $search_parameter  = array(
                            'dashboard_enabled' => true,
							'first_name' => $search,
							'last_name' => $search,
							'phone_number' => $search,
                            'email_address' => $search,
						);


            $users =  $this->pagination_model->table_search($limit, $start,'users', $search_parameter, $search);
            $totalFiltered = $this->pagination_model->table_search_count($search_parameter, 'users', $search);
        }

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $obj)
            {

				$nestedData['full_name'] = $obj->first_name . ' '. $obj->last_name;
                $nestedData['email_address'] = $obj->email_address;
                $nestedData['phone_number'] = $obj->phone_number;
                $data[] = $nestedData;

            }

        }

        $json_data = array(
                    "draw"            => intval($this->input->get('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);
  }
}
