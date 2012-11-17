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

//    public function get_courses($course_group) { 
//      $this->db->select('departments.course_group, courses.title, courses.cat_num');
//      $this->db->from('departments, courses');
//      foreach ($course_group as $course_group):
//        $this->db->or_where('departments.course_group', $course_group->course_group);
//        $this->db->where('departments.course_group = courses.course_group');
//      endforeach;
//      $this->db->order_by('courses.title asc');
//      $this->db->group_by('courses.title');
//      return $this->db->get()->result();
//    }

  }