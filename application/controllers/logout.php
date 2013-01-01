<?php

  class Logout extends CI_Controller {
    
    public function index() {
      
      session_start();
      $this->session->unset_userdata('id');
      session_destroy();
      
      $this->load->view('templates/header', array('title' => 'Logout Successful'));
      $this->load->view('logout/success');
      $this->load->view('templates/footer');
    }
  }