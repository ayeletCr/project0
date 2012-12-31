<?php

  class User extends CI_Model {
    
    public function login($username, $password) {
      
      $this->db->select('id');
      $this->db->from('users');
      $this->db->where('username', $username);

      $query = $this->db->get()->result();

      session_start();
      $id = $query[0]->id;
      $this->session->set_userdata('id', $id);
    }
    
    public function add_user($username, $password) {
    
      $data = array('username' => $username, 'password' => crypt($password, $password));
      $this->db->insert('users', $data);
    }
  }
