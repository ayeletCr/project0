<?php

class Instructor extends CI_Model{
  
  public $prefix;
  public $first;
  public $middle;
  public $last;
  public $suffix;
  
  public function __construct($data = '') {
    $data = (array)$data;
    if (is_array($data)) {
      foreach ($data as $key => $value) {        
        $this->$key = $value;
      }
    }    
  }
  
  public function get_instructors($course) {
    $this->db->select('prefix, first, middle, last, suffix');
    $this->db->from('instructors, course_instructors');
    $this->db->where('course_instructors.cat_num', $course);
    $this->db->where('course_instructors.instructor_id = instructors.id');
    $records = $this->db->get()->result();
    $instructors = array();
    foreach ($records as $record) {
      $instructor = new Instructor($record);
      $instructors[] = $instructor;
    }
    return $instructors;
  }
  
  public function search_instructors($name) {
    
    if ($name == NULL) {
      return NULL;
    }
    
    $this->db->select('first, last, id');
    $this->db->from('instructors');
    $this->db->like('first', $name);
    $this->db->or_like('last', $name);
    return $this->db->get()->result();
  }
}
