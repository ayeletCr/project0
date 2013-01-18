<?php

class Table extends CI_Controller {
  
  public function index() {
    
    $this->load->model('Database');
    
    $table = $this->Database->make_table();
    
    $this->load->view('templates/header', array('title' => 'Table'));
    $this->load->view('table/index', array('table' => $table));
    $this->load->view('templates/footer');
  }
}