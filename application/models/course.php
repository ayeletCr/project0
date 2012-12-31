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
    
    public function get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end) {
    
      if ($am_pm_begin == 'PM') {
        $hour_begin = $hour_begin + 12;
      }
      if (($hour_end == '0') && ($am_pm_end == 'am')){
        $hour_end = $hour_end + 12;
      }
      if (($am_pm_end == 'pm') && ($hour_end == '0')) {
        $hour_end = $hour_end + 24;
      }
      $begin_time = ($hour_begin * 100) + $minute_begin;
      $end_time = ($hour_end * 100) + $minute_end;

      $this->db->select('cat_num');
      $this->db->from('schedule');
      if (($am_pm_begin != '0') && ($am_pm_end != '0')) {
        $this->db->where('begin_time >=', $begin_time);
        $this->db->where('end_time <=', $end_time);
      }
      if ($day != '0') {
        $this->db->where('day', $day);
      }
      $this->db->group_by('cat_num');
      return $this->db->get()->result();
    }

    public function get_courses_keyword($keyword) {

      $this->db->select('cat_num');
      $this->db->from('courses');
      $this->db->like('title', $keyword, 'both');
      $this->db->or_like('description', $keyword, 'both');
      $this->db->or_like('cat_num', $keyword, 'both');
      $this->db->group_by('cat_num');
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

