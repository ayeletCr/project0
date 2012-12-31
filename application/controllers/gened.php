<?php

  class Gened extends CI_Controller {
  
    public function index() {
      $this->load->view('templates/header', array('title' => 'General Education Area'));
      $this->load->view('gened/index', array('genedarea'));
      $this->load->view('templates/footer');
    }
  
    public function area($genedarea) {
      $this->load->model('Course');
      $genedarea = urldecode($genedarea);
      $courses = $this->Course->get_courses($genedarea, 'genedarea');
      $this->load->view('templates/header', array('title' => $genedarea));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
  }