<?php

  class Courses extends CI_Model {
  
    public function get_courses($courses, $type) { 
      $this->db->select('title, cat_num');
      $this->db->from('courses');
      if ($type == 'course_group') {
        foreach ($courses as $course):
          $this->db->or_where('course_group', $course);
        endforeach;
      }
      else if ($type == 'genedarea') {
        $this->db->like('notes', $courses, 'both');
      }
      else if ($type == 'search') {
        foreach ($courses as $course):
          $this->db->or_where('cat_num', $course);
        endforeach;
      }
      $this->db->order_by('title asc');
      $this->db->group_by('title');
      return $this->db->get()->result();
    }

  }