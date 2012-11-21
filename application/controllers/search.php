<?php

class Search extends CI_Controller {

  public function index() {
    $this->load->view('templates/header', array('title' => 'Search for Courses'));
    $this->load->view('search/index');
    $this->load->view('templates/footer');
  }

  public function result() {
    $this->load->model('Result');
    $this->load->model('Courses');
    $keyword = $this->input->get('keyword');
    $day = $this->input->get('day');
    $hour_begin = $this->input->get('hour_begin');
    $hour_end = $this->input->get('hour_end');
    $minute_begin = $this->input->get('minute_begin');
    $minute_end = $this->input->get('minute_end');
    $am_pm_begin = $this->input->get('am_pm_begin');
    $am_pm_end = $this->input->get('am_pm_end');

    $search_schedule = $this->Result->get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end);
    $search_keyword = $this->Result->get_courses_keyword($keyword);

    if ($search_keyword != NULL) {
      foreach ($search_keyword as $course) {
        $keywords[] = $course->cat_num;
      }
    }
    if ($search_schedule != NULL) {
      foreach ($search_schedule as $course) {
        $schedules[] = $course->cat_num;
      }
    }

    if (($search_keyword == NULL) && ($search_schedule != NULL)) {
      $courses = $schedules;
    }
    else if (($search_schedule == NULL) && ($search_keyword != NULL)) {
      $courses = $keywords;
    }
    else {
      $courses = array_intersect($keywords, $schedules);
    }

    $courses = $this->Courses->get_courses($courses, 'search');

    $this->load->view('templates/header', array('title' => 'Search for Courses'));
    $this->load->view('search/result', array('courses' => $courses));
    $this->load->view('templates/footer');
  }
}