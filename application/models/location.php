<?php

class Location extends CI_Model {
  
  public function get_locations($course) {
    $this->db->select('building, room');
    $this->db->from('locations');
    $this->db->where('cat_num', $course);
    return $this->db->get()->result();
  }
}