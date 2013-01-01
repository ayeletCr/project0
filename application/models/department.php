<?php

  class Department extends CI_Model {

    public function get_departments($course_group) {

      if ($course_group) {
        $this->db->select('dept_short_name');
        $this->db->from('departments');
        $this->db->where('course_group', $course_group);
      }
      
      else {
        $this->db->select('dept_short_name, course_group');
        $this->db->from('departments');
      }
      $this->db->order_by('dept_short_name asc');
      $this->db->group_by('dept_short_name');
      
      return $this->db->get()->result();
    }
  }
