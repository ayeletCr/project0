<?php

  class Search extends CI_Controller {
  
    public function index() {
      
      $this->load->view('templates/header', array('title' => 'Search for Courses'));
  		  $this->load->view('search/index');
		    $this->load->view('templates/footer');
    }
  
    public function result() {
      
      $this->load->model('Course');
      $keyword = $this->input->get('keyword');
      $day = $this->input->get('day');
      $hour_begin = $this->input->get('hour_begin');
      $hour_end = $this->input->get('hour_end');
      $minute_begin = $this->input->get('minute_begin');
      $minute_end = $this->input->get('minute_end');
      $am_pm_begin = $this->input->get('am_pm_begin');
      $am_pm_end = $this->input->get('am_pm_end');
      $search_schedule = array();
      $search_keyword = array();
      $schedules = array();
      $keywords = array();
      $courses = array();
      $error = '';
      
      if (($minute_begin !== '0') || ($minute_end !== '0') || ($hour_begin != '0') || ($hour_end != '0')) {
        if ((($minute_begin !== '0') && ($minute_end !== '0')) && (($hour_begin != '0') && ($hour_end != '0')) && (($am_pm_begin != '0') && ($am_pm_end != '0'))) {
          $search_schedule = $this->Course->get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end);
        }        
        else {
          $error = 'All time values are required for a schedule search that includes hour or minute.';
        }
      }
      else if (($day != '0') || (($am_pm_begin != '0') && ($am_pm_end != '0'))) {
        $search_schedule = $this->Course->get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end);
      }
      
      if ($keyword) {
        $search_keyword = $this->Course->get_courses_keyword($keyword);
      }

      foreach ($search_schedule as $course) {
        $schedules[] = $course->cat_num;
      }

      foreach ($search_keyword as $course) {
        $keywords[] = $course->cat_num;
      }

      if ($schedules && $keywords) {
        $courses = array_intersect($keywords, $schedules);
      }
      else if ($schedules) {
        $courses = $schedules;
      }
      else if ($keywords) {
        $courses = $keywords;
      }

      if ($courses && !$error) {
        $courses = $this->Course->get_courses($courses, 'search');
        if (!$courses) {
          $courses = '';
        }
      }
      else {
        $courses = '';
      }
      
      if ($error) {
        $this->load->view('templates/header', array('title' => $error));
        $this->load->view('search/index');
      }
      else {
        $this->load->view('templates/header', array('title' => 'Search for Courses'));
        $this->load->view('search/index');
        $this->load->view('courses/list', array('courses' => $courses));
      }
		    $this->load->view('templates/footer');
    }
  }