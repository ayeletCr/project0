<?php

  class Welcome extends CI_Controller {

    public function index() {
      
      $this->session->set_userdata('last_page', '');
      $this->load->view('templates/header', array('title' => 'Project 0'));
      $this->load->view('welcome/index');
      $this->load->view('templates/footer');
    }
  }
