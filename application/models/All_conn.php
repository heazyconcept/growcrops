<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_conn extends CI_model
{
  public function select_data($table_name, $single_column = '', $targetcol = '', $target_val = '', $filter_key = '', $filter_val = '', $limit = '')
  {
    if (empty($single_column) && empty($targetcol)) {
      if (empty($filter_key)) {
         if (!empty($limit)) {
           $this->db->limit($limit);
         }
        $query = $this ->db ->get($table_name);
      }else {
        if (!empty($limit)) {
          $this->db->limit($limit);
        }
        $this->db->order_by($filter_key, $filter_val);
        $query = $this ->db ->get($table_name);
      }

    }elseif (empty($single_column)) {
      if (empty($filter_key)) {
        if (!empty($limit)) {
          $this->db->limit($limit);
        }
        $this->db->where($targetcol, $target_val);
        $query = $this ->db ->get($table_name);
      }else {
        if (!empty($limit)) {
          $this->db->limit($limit);
        }
        $this->db->order_by($filter_key, $filter_val);
        $this->db->where($targetcol, $target_val);
        $query = $this ->db ->get($table_name);
      }
    }elseif (!empty($single_column)) {
      if (empty($targetcol)) {
        if (empty($filter_key)) {
          if (!empty($limit)) {
            $this->db->limit($limit);
          }
          $this->db->select($single_column);
          $query = $this ->db ->get($table_name);
        }else {
          if (!empty($limit)) {
            $this->db->limit($limit);
          }
          $this->db->select($single_column);
          $this->db->order_by($filter_key, $filter_val);
          $query = $this ->db ->get($table_name);
        }
      }else {
        if (empty($filter_key)) {
          if (!empty($limit)) {
            $this->db->limit($limit);
          }
          $this->db->select($single_column);
          $this->db->where($targetcol, $target_val);
          $query = $this ->db ->get($table_name);
        }else {
          if (!empty($limit)) {
            $this->db->limit($limit);
          }
          $this->db->select($single_column);
          $this->db->where($targetcol, $target_val);
          $this->db->order_by($filter_key, $filter_val);
          $query = $this ->db ->get($table_name);
        }
      }

    }
    return $query->result();
  }
  public function modify_data($table_name, $update_data, $ref_key, $ref_val)
  {
    $this->db->where($ref_key, $ref_val);
    $this->db->update($table_name, $update_data);
    return $this->db->affected_rows();

  }
  public function delete_data($table_name, $ref_key ='', $ref_val = '')
  {
    if (empty($ref_key)) {
      $this->db->delete($table_name);
    }else {
      $this->db->where($ref_key, $ref_val);
      $this->db->delete($table_name);
    }
    return $this->db->affected_rows();
  }
  public function insert_data($table_name, $insert_data)
  {
     $this->db->insert($table_name, $insert_data);
    return  $this->db->insert_id();
  }
  public function selectd_data($table_name, $single_column = '', $targetcol = '', $target_val = '', $filter_key = '', $filter_val = '')
  {
    if (empty($single_column) && empty($targetcol)) {
      if (empty($filter_key)) {
        $this->db->distinct();
        $query = $this ->db ->get($table_name);
      }else {
        $this->db->distinct();
        $this->db->order_by($filter_key, $filter_val);
        $query = $this ->db ->get($table_name);
      }

    }elseif (empty($single_column)) {
      if (empty($filter_key)) {
        $this->db->distinct();
        $this->db->where($targetcol, $target_val);
        $query = $this ->db ->get($table_name);
      }else {
        $this->db->distinct();
        $this->db->order_by($filter_key, $filter_val);
        $this->db->where($targetcol, $target_val);
        $query = $this ->db ->get($table_name);
      }
    }elseif (!empty($single_column)) {
      if (empty($targetcol)) {
        if (empty($filter_key)) {
          $this->db->distinct();
          $this->db->select($single_column);
          $query = $this ->db ->get($table_name);
        }else {
          $this->db->distinct();
          $this->db->select($single_column);
          $this->db->order_by($filter_key, $filter_val);
          $query = $this ->db ->get($table_name);
        }
      }else {
        if (empty($filter_key)) {
          $this->db->distinct();
          $this->db->select($single_column);
          $this->db->where($targetcol, $target_val);
          $query = $this ->db ->get($table_name);
        }else {
          $this->db->distinct();
          $this->db->select($single_column);
          $this->db->where($targetcol, $target_val);
          $this->db->order_by($filter_key, $filter_val);
          $query = $this ->db ->get($table_name);
        }
      }

    }
    return $query->result();
  }
  public function count_data($table_name,  $targetcol = '', $target_val = '')
  {
    if (empty($targetcol)) {
      $count = $this ->db ->count_all_results($table_name);
    }else {
      $this->db->where($targetcol, $target_val);
      $count = $this ->db ->count_all_results($table_name);
    }
    return $count;

  }
  public function check_exist($table_name, $bench_mark, $operator = '')
  {
    if ($operator == 'AND' || $operator == 'and') {
      $this->db->where($bench_mark);
    }elseif ($operator == 'OR' || $operator == 'or') {
      $this->db->or_where($bench_mark);
    }
    $count = $this ->db ->count_all_results($table_name);
    return $count;

  }
  public function custom_query($actions, $query)
  {
    if ($actions == 'others') {
      $this->db->query($query);
      return $this->db->affected_rows();
    }elseif ($actions == 'select') {
      $sql = $this->db->query($query);
      return $sql->result();
    }
  }
  public function fetch_time()
  {
    return date("Y-m-d H:i:s");
  }
  // This function is peculiar for Growcrops
  public function fetch_post($limit = '')
  {
    $this->db->limit($limit);
    $this->db->order_by('date_created', 'DESC');
    $query = $this ->db ->get('posts');
    return $query->result();
  }
 public function strip_tags_content($text, $tags = '', $invert = FALSE) {

  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
  $tags = array_unique($tags[1]);

  if(is_array($tags) AND count($tags) > 0) {
    if($invert == FALSE) {
      return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    else {
      return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
    }
  }
  elseif($invert == FALSE) {
    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
  }
  return $text;
}
public function fetch_crops($limit = '')
{
  $this->db->limit($limit);
  $query = $this ->db ->get('crops');
  return $query->result();
}
public function fetch_testimonials($limit = '')
{
  $this->db->limit($limit);
  $query = $this ->db ->get('testimonials');
  return $query->result();
}
public function fetch_earlybird_price($crop_id)
{
  $this->db->where('crop_id', $crop_id);
  $query = $this ->db ->get('early_bird');
  return $query->result();
}

}
