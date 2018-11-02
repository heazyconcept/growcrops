<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt extends CI_Controller {

    public function index()
    {
        // echo $transactionRef;

    }
    public function view($transactionRef)
    {
        $dbOption = array(
            'table_name' => "transactions", 
            'targets' => array('TransactionRef' => $transactionRef ) 
        );
        $data['transactionDetails'] = $this->connectDb->select_data(json_encode($dbOption))[0];
        $this->load->view('receipt/view', $data);
    
        
    }
}
