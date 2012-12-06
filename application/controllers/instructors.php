<?php

  class Instructors extends CI_Controller {
  
    public function index() {
      $this->load->view('templates/header', array('title' => 'Search by Instructor Name'));
      $this->load->view('instructors/index');
      $this->load->view('templates/footer');
    }
  
    public function result() {
      $this->load->model('Instructor');
      $name = $this->input->get('instructor');
      $search = $this->Instructor->search_instructors($name);
      
      $this->load->view('templates/header', array('title' => 'Search by Instructor Name'));
      $this->load->view('instructors/result', array('instructors' => $search));
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
      $this->load->view('instructors/instructor', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
  }