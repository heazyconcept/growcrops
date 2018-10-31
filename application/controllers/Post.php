<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {


	public function index()
	{


	}
  public function view($slug= '')
  {
    $post_data  = explode('-', $slug );
    $data['post'] = $post = $this->all_conn->select_data('posts', '', 'id', $post_data[0]);
    $data['page_title'] = $post[0]->post_title.' - Grow Crops Online';
		$this->load->template('post/index', $data);
  }
}
