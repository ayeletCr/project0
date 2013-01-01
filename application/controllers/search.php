<?php

  class Search extends CI_Controller {
  
    public function index() {
      
      $this->load->view('templates/header', array('title' => 'Search for Courses'));
  		  $this->load->view('search/index');
		    $this->load->view('templates/footer');
    }
  
    public function result() {
      
      $this->load->model('Result');
      $this->load->model('Course');
      $keyword = $this->input->get('keyword');
      $day = $this->input->get('day');
      $hour_begin = $this->input->get('hour_begin');
      $hour_end = $this->input->get('hour_end');
      $minute_begin = $this->input->get('minute_begin');
      $minute_end = $this->input->get('minute_end');
      $am_pm_begin = $this->input->get('am_pm_begin');
      $am_pm_end = $this->input->get('am_pm_end');

      if (($minute_begin != '0') || ($minute_end != '0') || ($hour_begin != '0') || ($hour_end != '0')) {
        if ((($minute_begin != '0') && ($minute_end != '0')) && (($hour_begin != '0') && ($hour_end != '0')) && (($am_pm_begin != '0') && ($am_pm_end != '0'))) {
          $search_schedule = $this->Result->get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end);
        }
        
        else {
          $error = 'All time values are required for a schedule search that includes hour or minute.';
        }
      }
      
      else if (($day != '0') || (($am_pm_begin != '0') && ($am_pm_end != '0'))) {
        $search_schedule = $this->Result->get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end);
      }

      if ($keyword) {
        $search_keyword = $this->Result->get_courses_keyword($keyword);
      }

      if ($search_keyword) {
        foreach ($search_keyword as $course) {
          $keywords[] = $course->cat_num;
        }
      }
      if ($search_schedule) {
        foreach ($search_schedule as $course) {
          $schedules[] = $course->cat_num;
        }
      }
    
      if (!($search_keyword) && ($search_schedule)) {
        $courses = $schedules;
      }
      else if (!($search_schedule) && ($search_keyword)) {
        $courses = $keywords;
      }
      else if (($search_schedule) && ($search_keyword)){
        $courses = array_intersect($keywords, $schedules);
      }
      else {
        $courses = 'none';
      }
    
      if ($courses != 'none') {
        $courses = $this->Course->get_courses($courses, 'search');
      }
    
      if ($error) {
        $this->load->view('templates/header', array('title' => $error));
      }
      else {
        $this->load->view('templates/header', array('title' => 'Search for Courses'));
      }
      $this->load->view('courses/list', array('courses' => $courses));
		    $this->load->view('templates/footer');
    }
  }