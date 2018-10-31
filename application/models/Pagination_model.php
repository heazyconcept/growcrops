<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagination_model extends CI_model
{
  public function record_count($table) {
return $this->db->count_all($table);
}

// Fetch data according to per_page limit.
public function fetch_data($limit, $id, $table) {

    $this->db->limit($limit);
    $this->db->offset($id);

// $this->db->limit($limit);
// $this->db->where('id', $id);
$query = $this->db->get($table);
return $query->result();
}
public function fetch_data_specific($limit, $id, $table) {

    $this->db->limit($limit);
    $this->db->offset($id);
    // $this->db->where($ref_key, $ref_val);

// $this->db->limit($limit);
// $this->db->where('id', $id);
$query = $this->db->get($table);
return $query->result();
}
function table_search($limit,$start,$table, $search, $search_param )
   {
       $query = $this
               ->db
               ->like('id', $search_param )
               ->or_like($search)
               ->limit($limit,$start)
               ->get($table);


       if($query->num_rows()>0)
       {
           return $query->result();
       }
       else
       {
           return null;
       }
   }

   function table_search_count($search, $table, $search_param)
   {
       $query = $this
               ->db
               ->like('id', $search_param )
               ->or_like($search)
               ->get($table);

       return $query->num_rows();
   }
}
