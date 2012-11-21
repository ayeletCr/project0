<?php

class Course extends CI_Model {

  public function get_course($courses) {
    $this->db->select('cat_num, title, description, course_group');
    $this->db->from('courses');
    $this->db->where('cat_num', $courses);
    return $this->db->get()->result();
  }
}



//  public function format_name() {
//    return implode(' ', array($this->prefix, $this->first, $this->middle, $this->last, $this->suffix));
//  }
//
//  public function get_department() {
//    // ... Run DB query.
//    return new Department($this->departmentId);
//  }
//}

//$instructors = $course->get_instructors();
//$dept = $instructors[0]->get_department();

