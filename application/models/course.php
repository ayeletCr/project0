<?php

  class Course extends CI_Model {
    
    public function get_courses($courses, $type) { 
      
      $this->db->distinct('cat_num, title, description, course_group');
      $this->db->from('courses');
      
      if ($type == 'course') {
        $this->db->where('cat_num', $courses);
      }
      
      else if ($type == 'course_group') {
        foreach ($courses as $course) {
          $this->db->or_where('course_group', $course);
        }
      }
      
      else if ($type == 'genedarea') {
        $this->db->like('notes', $courses, 'both');
      }
      
      else if ($type == 'search') {
        foreach ($courses as $course) {
          $this->db->or_where('cat_num', $course);
        }
      }
      
      $this->db->order_by('title asc');
      return $this->db->get()->result();
    }

    public function get_courses_instructor($instructor) {

      $this->db->select('cat_num');
      $this->db->from('course_instructors');
      $this->db->where('instructor_id', $instructor);
      return $this->db->get()->result();
    }
  
    public function get_courses_taking($id) {
      
      $this->db->select('cat_num');
      $this->db->from('user_lists');
      $this->db->where('id', $id);
      return $this->db->get()->result();
    }
  }
