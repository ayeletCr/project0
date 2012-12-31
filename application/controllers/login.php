<?php

  class Login extends CI_Controller {
    
    public function index() {
      
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $username = $this->input->post('username');
      $this->form_validation->set_rules('username', 'Username', 'callback_username_check');
      $this->form_validation->set_rules('password', 'Password', 'callback_password_check[' . $username . ']');
      
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', array('title' => 'Login'));
        $this->load->view('login/index');
        $this->load->view('templates/footer');
      }
      else {
        $this->load->view('templates/header', array('title' => 'Login Successful'));
        $this->load->view('login/success');
        $this->load->view('templates/footer');
      }
    }
    
    public function username_check($username) {
      
      if ($username == '') {
        $this->form_validation->set_message('username_check', 'The %s field is required.');
        return FALSE;
      }
      $this->db->select('username');
      $this->db->from('users');
      $this->db->where('username', $username);
      $result = $this->db->get()->result();
      if ($result[0]->username != $username) {
        $this->form_validation->set_message('username_check', 'Invalid username.');
        return FALSE;
      }
      else {
        return TRUE;
      }
    }
    
    public function password_check($password, $username) {
      
      if ($password == '') {
        $this->form_validation->set_message('password_check', 'The %s field is required.');
        return FALSE;
      }
      $this->db->select('password');
      $this->db->from('users');
      $this->db->where('username', $username);
      $result = $this->db->get()->result();
      
      if (crypt($password, $result[0]->password) != $result[0]->password) {
        $this->form_validation->set_message('password_check', 'Invalid password.');
        return FALSE;
      }
      else {
        $this->load->model('User');
        $this->User->login($username, $password);
        return TRUE;
      }
    }
  }
