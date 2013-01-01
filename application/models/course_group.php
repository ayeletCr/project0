<?php

  class Course_group extends CI_Model {
  
    public function get_course_group($department) {

      $department = urldecode($department);
      $this->db->select('course_group');
      $this->db->from('departments');
      $this->db->where('dept_short_name', $department);
      return $this->db->get()->result();
    }
  }