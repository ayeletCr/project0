<?php

  class Lists extends CI_Controller {

    public function index() {
      
      $this->load->view('templates/header', array('title' => 'Project 0'));
      $this->load->view('lists/index');
      $this->load->view('templates/footer');
    }
    
    public function shopping($courses) {
      
      $this->load->model('Course');
      $courses = urldecode($courses);
      $courses = explode(',', $courses);      
      $courses = $this->Course->get_courses($courses, 'search');
      if (!$courses) {
        $courses = '';
      }
      
      $this->load->view('templates/header', array('title' => "Courses I'm Shopping"));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
        
    public function taking() {
      
      $this->load->model('Course');
      $id = $this->session->userdata('id');
      
      $courses_taking = $this->Course->get_courses_taking($id);
      if ($courses_taking) {
        foreach ($courses_taking as $course) {
          $courses[] = $course->cat_num;
        }
      }
      else {
        $courses[0] = '';
      }
      $courses = $this->Course->get_courses($courses, 'search');
      
      if (!$courses) {
        $courses = '';
      }
      
      $this->load->view('templates/header', array('title' => "Courses I'm Taking"));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
    
    public function add_delete_courses_taking() {

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->model('Course');
      $course = $this->input->post('course');
      $add_delete = $this->input->post('add_delete');
      $course = $this->Course->get_courses($course, 'course');

      if ($course) { 

        $data = array('id' => $this->session->userdata('id'), 'cat_num' => $course[0]->cat_num);
        if ($add_delete == 'add') {
          $title = "Course Added to Courses I'm Taking";
          $result = $this->db->insert('user_lists', $data);
        }
        else {
          $title = "Course Deleted From Courses I'm Taking";
          $result = $this->db->delete('user_lists', $data);
        }
        
        if ($result) {
          $this->load->view('templates/header', array('title' => $title));        
          $this->load->view('lists/add_courses_taking', array('courses' => $course[0]->cat_num));
        }
      }
      else {
        $this->load->view('templates/header', array('title' => "Error Adding Course to Courses I'm Taking"));
      }
        
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
        $courses = '';
      }
      
      $this->load->view('templates/header', array('title' => 'Recently Viewed Courses'));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
  }
