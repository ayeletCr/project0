<?php

  class Signup extends CI_Controller {
    
    function index() {
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $this->form_validation->set_rules('username', 'Username', 'callback_username_check');
      $this->form_validation->set_rules('password', 'Password', 'callback_password_check');
      $this->form_validation->set_rules('password2', 'Password Confirmation', 'callback_password2_check[' . $password . ']');
      
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', array('title' => 'Login'));
        $this->load->view('signup/index');
        $this->load->view('templates/footer');
      }
      else {
        $this->load->model('User');
        $this->User->add_user($username, $password);
        $this->User->login($username, $password);
        $this->load->view('templates/header', array('title' => 'Project 0'));
        $this->load->view('welcome/index');
        $this->load->view('templates/footer');
      }
    }
    
    function username_check($username) {
      if ($username == '') {
        $this->form_validation->set_message('username_check', 'The %s field is required.');
        return FALSE;
      }
      $this->db->select('username');
      $this->db->from('users');
      $this->db->where('username', $username);
      $result = $this->db->get()->result();
      if ($result[0]->username == $username) {
        $this->form_validation->set_message('username_check', 'Username ' . $username . ' is not available.');
        return FALSE;
      }
      else {
        return TRUE;
      }
    }
    
    function password_check($password) {
      if ($password == '') {
        $this->form_validation->set_message('password_check', 'The %s field is required.');
        return FALSE;
      }
      else {
        return TRUE;
      }
    }

    function password2_check($password2, $password) {
      if ($password2 == '') {
        $this->form_validation->set_message('password2_check', 'The %s field is required.');
        return FALSE;
      }
      else if ($password2 != $password) {
        $this->form_validation->set_message('password2_check', 'The passwords do not match.');
        return FALSE;
      }
      else {
        return TRUE;
      }
    }

  }
