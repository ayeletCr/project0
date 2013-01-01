<?php

  class Instructors extends CI_Controller {
  
    public function index() {

      $this->load->view('templates/header', array('title' => 'Search by Instructor Name'));
      $this->load->view('instructors/index');
      $this->load->view('templates/footer');
    }
  
    public function result() {
      
      $this->load->model('Instructor');
      $names = $this->input->get('instructor');
      $names = explode(' ', $names);
      $names = array_filter($names);      
      $names = array_map(function($a) {
        return trim($a, '.,');
      }, $names);
      
      $instructors = $this->Instructor->search_instructors($names);
      if (!($instructors)) {
        $instructors = 'none';
      }
      
      $this->load->view('templates/header', array('title' => 'Search by Instructor Name'));
      $this->load->view('instructors/result', array('instructors' => $instructors));
      $this->load->view('templates/footer');
    }
  
    public function instructor($instructor) {
      
      $this->load->model('Course');
    
      $search = $this->Course->get_courses_instructor($instructor);
      if ($search != "") {
        foreach ($search as $course) {
          $courses[] = $course->cat_num;
        }
      }
      
      else {
        $courses = $search;
      }
      $courses = $this->Course->get_courses($courses, 'search');
      
      $this->load->view('templates/header', array('title' => 'Courses by Instructor'));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
  }
