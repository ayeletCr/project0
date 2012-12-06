<?php

  class Search extends CI_Controller {

    public function index() {
      $this->load->helper('form');
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
      
      if ($keyword != "") {
        $search_keyword = $this->Course->get_courses_keyword($keyword);
      
        foreach ($search_keyword as $course) {
          $keywords[] = $course->cat_num;
        }
      }
      else {
        $keywords = "";
      }
     
      if (($day != '0') || (($am_pm_begin != '0') && ($am_pm_end != '0'))) {
        $search_schedule = $this->Course->get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end);
      
        foreach ($search_schedule as $course) {
          $schedules[] = $course->cat_num;
        }
      }
      else {
        $schedules = "";
      }

      if (($keywords == "") && ($schedules != "")) {
        $courses = $schedules;
      }
      else if (($schedules == "") && ($keywords != "")) {
        $courses = $keywords;
      }
      else if (($schedules != "") && ($keywords != "")) {
        $courses = array_intersect($keywords, $schedules);
      }
      else {
        $courses = "";
      }

      $courses = $this->Course->get_courses($courses, 'search');

      $this->load->view('templates/header', array('title' => 'Search for Courses'));
      $this->load->view('search/result', array('courses' => $courses));
      $this->load->view('templates/footer');
    }  
  }