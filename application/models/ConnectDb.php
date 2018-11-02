<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConnectDb extends CI_model
{


  public function select_data($options)
  {

    $options = json_decode($options);

    if (isset($options->is_distinct) && $options->is_distinct == 1) {
        $this->db->distinct();
    }
    if (isset($options->single_column) && $options->single_column) {
      $this->db->select($options->single_column);
    }
    if (isset($options->targets) && $options->targets) {
      $this->db->where((array)$options->targets);
    }
    if (isset($options->filter_key) && $options->filter_key) {
      $this->db->order_by($options->filters['key'], $options->filters['value']);
    }
    if (isset($options->limit) && $options->limit ) {
       $this->db->limit($options->limit);
    }
    if (isset($options->offset) && $options->offset) {
      $this->db->offset($options->offset);
    }
      $query = $this ->db ->get($options->table_name);
      return $query->result();

  }
  public function modify_data($options)
  {
    $options = json_decode($options);
    $this->db->where((array) $options->targets);
    $this->db->update($options->table_name, (array)$options->process_data);
    return $this->db->affected_rows();

  }
  public function delete_data($options)
  {

    if (isset($options->targets) && !empty($options->targets)) {
      $this->db->where((array)$options->targets);
      $this->db->delete($options->table_name);
    }else {
      $this->db->delete($options->table_name);
    }
    return $this->db->affected_rows();
  }
  public function insert_data($options)
  {
    $options = json_decode($options);
     $this->db->insert($options->table_name, (array)$options->process_data);
    return  $this->db->insert_id();
  }
  public function insert_batch_data($options)
  {
    $options = json_decode($options);
    $this->db->insert_batch($options->table_name, (array)$options->batch_data);
    return  $this->db->insert_id();

  }

  public function count_data($options)
  {
    $options = json_decode($options);
    if (isset($options->targets) && !empty($options->targets)) {
      if ($options->operator == 'AND' || $options->operator == 'and') {
        $this->db->where((array)$options->targets);
      }elseif ($options->operator == 'OR' || $options->operator == 'or') {
        $this->db->or_where((array) $options->targets);
      }else {
        $this->db->where( (array) $options->targets);
      }
    }
    $count = $this->db ->count_all_results($options->table_name);
    return $count;

  }

  public function custom_query($options)
  {
    $options = json_decode($options);
    if ($options->query_action == 'others') {
      $this->db->query($options->my_query);
      return $this->db->affected_rows();
    }elseif ($options->query_action == 'select') {
      $sql = $this->db->query($options->my_query);
      return $sql->result();
    }
  }
  public function fetchPost($limit = 0)
  {
    if (empty($limit)) {
      $postOptions = array(
        'table_name' => 'posts',
      );
    }else {
      $postOptions = array(
        'table_name' => 'posts',
        'limit' => $limit
      );
    }
    return $this->select_data(json_encode($postOptions));

  }
  public function fetchTestimonials($limit = 0)
  {
    if (empty($limit)) {
      $testmonialOptions = array(
        'table_name' => 'testimonials',
      );
    }else {
      $testmonialOptions = array(
        'table_name' => 'testimonials',
        'limit' => $limit
      );
    }
    return $this->select_data(json_encode($testmonialOptions));
  }
  public function FetchCrops($limit = 0)
  {
    if (empty($limit)) {
      $cropOptions = array(
        'table_name' => 'crops',
      );
    }else {
      $cropOptions = array(
        'table_name' => 'crops',
        'limit' => $limit
      );
    }
    return $this->select_data(json_encode($cropOptions));
  }
  public function FetchUser($userId, $column = "")
  {
      $dbOptions = array(
        'table_name' => 'users',
        'targets'=> array("id" => $userId)
      );
   $userData = $this->select_data(json_encode($dbOptions));
     if(empty($column)){
      return $userData[0];  
      }else{
       return $userData[0]->$column; 
      }
  }
  public function FetchCrop($cropId, $column ="")
  {
    $dbOptions = array(
      'table_name' => 'crops',
      'targets'=> array("id" => $cropId)
    );
 $cropData = $this->select_data(json_encode($dbOptions));
   if(empty($column)){
    return $cropData[0];  
    }else{
     return $cropData[0]->$column; 
    }
  }
  public function FetchInitialPayment($cropId)
  {
    $dbOptions = array(
      'table_name' => 'stage_one_payment',
      'targets'=> array("crop_id" => $cropId)
    );
    
       $dbData = $this->select_data(json_encode($dbOptions));
        return $dbData[0]->amount; 
   
  }

  // public function escape_data($string)
  // {
  //   return $this->db->escape($string);
  // }
  // public function escape_search($string)
  // {
  //   return $this->db->escape_like_str($search);
  // }



}
