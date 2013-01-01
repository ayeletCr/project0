<?php

  class Courses extends CI_Controller {
    
    public function course($courses) {

      $this->load->model('Course');
      $this->load->model('Instructor');
      $this->load->model('Schedule');
      $this->load->model('Location');
      $this->load->model('Department');
      
      $courses = urldecode($courses);
      $course = $this->Course->get_courses($courses, 'course');
      $departments = $this->Department->get_departments($course[0]->course_group);
      $instructors = $this->Instructor->get_instructors($courses);
      $schedules = $this->Schedule->get_schedules($courses);
      
      if ($schedules) {
        foreach($schedules as $schedule) {
          $schedule->day = $this->map_day($schedule->day);
        }
      }

      $locations = $this->Location->get_locations($courses);
      
      $history = array($course[0]->cat_num);
      if ($history) {
        if ($this->session->userdata('history')) {
          $session_history = $this->session->userdata('history');
          $history = array_merge($session_history, $history);
        }
        $this->session->set_userdata('history', $history);
      }
      $this->session->set_userdata('last_page', 'courses/course/' . $course[0]->cat_num);
      
      $this->load->view('courses/course', array(
          'title' => $course[0]->title,
          'course' => $course, 
          'schedules' => $schedules,
          'department' => $departments,
          'locations' => $locations,
          'instructor_names' => $this->format_instructors($instructors)));
      $this->load->view('templates/footer');
    }
  
    public function map_day($day) {
      $map = array(
          1 => 'Monday',
          2 => 'Tuesday',
          3 => 'Wednesday',
          4 => 'Thrusday',
          5 => 'Friday',
          6 => 'Saturday'
      );
    
      return $map[$day];
    }
  
    public function format_instructors($instructors) {
      foreach ($instructors as $instructor) {
        $names[] =  implode(' ', array($instructor->prefix, $instructor->first, $instructor->middle, $instructor->last, $instructor->suffix));
      }
      return $names;
    }
  }
