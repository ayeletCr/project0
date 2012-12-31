<?php

  class Lists extends CI_Controller {

    public function index() {
      
      $this->load->view('templates/header', array('title' => 'Project 0'));
      $this->load->view('lists/index');
      $this->load->view('templates/footer');
    }
    
    public function shopping() {
      
      //$this->load->view('templates/header', array('title' => "Courses I'm Shopping"));
      $this->load->view('lists/shopping');
      $this->load->view('templates/footer');
    }
    
    public function add_courses_shopping($courses) {
      
      $course = urldecode($courses);
      $this->load->view('lists/add_courses_shopping', array('title' => 'Course added', 'course' => $course));
      $this->load->view('templates/footer');
    }
    
    public function taking() {
      
      $this->load->model('Course');
      $id = $this->session->userdata('id');
      $courses_taking = $this->Course->get_courses_taking($id);
      foreach ($courses_taking as $course) {
        $courses[] = $course->cat_num;
      }
      if (!($courses)) {
        $courses = 'none';
      }
      else {
        $courses = $this->Course->get_courses($courses, 'search');
      }
      
      $this->load->view('templates/header', array('title' => "Courses I'm Taking"));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
    
    public function add_courses_taking($courses) {

      $course = urldecode($courses);
      $data = array('id' => $this->session->userdata('id'), 'cat_num' => $course);
      $result = $this->db->insert('user_lists', $data);
      if ($result) {
        $this->load->view('templates/header', array('title' => "Course Added to Courses I'm Taking"));
      }
      else {
        $this->load->view('templates/header', array('title' => "Error Adding Course to Courses I'm Taking"));
      }
        
      $this->load->view('lists/add_courses_taking', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
    
    public function history() {
      
      $this->load->model('Course');
      if ($this->session->userdata('history')) {
        $history = $this->session->userdata('history');
        $history = array_unique($history);
        $courses = $this->Course->get_courses($history, 'search');
      }
      else {
        $courses = 'none';
      }
      
      $this->load->view('templates/header', array('title' => 'Recently Viewed Courses'));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
  }
