<?php

  class Departments extends CI_Controller {

    public function index() {

      $this->load->model('Department');
      $course_group = NULL;
      $departments = $this->Department->get_departments($course_group);
      $this->load->view('templates/header', array('title' => 'Departments'));
      $this->load->view('departments/index', array('departments' => $departments));
      $this->load->view('templates/footer');
    }
  
    public function department($department) {

      $this->load->model('Department');
      $this->load->model('Course_group');
      $this->load->model('Course');
      $course_group = $this->Course_group->get_course_group($department);
      foreach ($course_group as $item) {
        $array[] = $item->course_group;
      }
      $course_group = $array;
      $courses = $this->Course->get_courses($course_group, 'course_group');
      $this->load->view('templates/header', array('title' => 'Department: ' . $department));
      $this->load->view('courses/list', array('courses' => $courses));
      $this->load->view('templates/footer');
    }
  }
