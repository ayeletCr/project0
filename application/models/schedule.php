<?php

class Schedule extends CI_Model {
  
  public function get_schedules($course) {
    $this->db->select('day, begin_time, end_time');
    $this->db->from('schedule');
    $this->db->where('cat_num', $course);
    return $this->db->get()->result();
  }
}

?>
