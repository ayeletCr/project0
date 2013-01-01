<?php

  class Result extends CI_Model {
  
    public function get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end) {
    
      if ($am_pm_begin == '2') {
        $hour_begin = $hour_begin + 12;
      }
      if (($hour_end == '0') && ($am_pm_end == '1')){
        $hour_end = $hour_end + 12;
      }
      if (($am_pm_end == '2') && ($hour_end != '12')) {
        $hour_end = $hour_end + 12;
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
  }