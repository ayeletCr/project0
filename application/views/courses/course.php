<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript" src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
  <script type="text/javascript">
        
    $('#courses').ready(function() {
      if (Modernizr.localstorage) {

      }
      else {
        $('#message').text("Unfortunately your browser doesn't support local storage");
        $('#add_course').attr('disabled', 'disabled');
        $('#message').show();
      }
    });
    
    $('#add_shopping').ready(function() {

      if (localStorage.getItem('courses')) {
        var course = new Array();
        course = localStorage.getItem('courses').split(',');
        if (course.indexOf("<?php echo html_escape($course[0]->cat_num) ?>") != -1) {
          $('#button_shopping').val("Delete From Courses I'm Shopping");          
        }
      }
    });
  </script>
</head>
<body>
  <div data-role="page" id="courses">

    <div data-role="header">
      <a href="<?php echo $this->config->item('base_url') ?>" data-icon="home" data-iconpos="notext" data-transition="fade">Home</a>
      <h1><?php echo html_escape(urldecode($title)) ?></h1>
    </div>

  <div data-role="content">
    <ul data-role="listview" data-inset="true">
      <li data-role="list-divider">Description</li>
      <li><?= html_escape($course[0]->description) ?></li>
 
      <li data-role="list-divider">Department</li>
      <li><?= html_escape($department[0]->dept_short_name) ?></li>

      <li data-role="list-divider">Catalog Number</li>
      <li><?= html_escape($course[0]->cat_num) ?></li>

      <?php if ($instructor_names): ?>
        <li data-role="list-divider">Instructors</li>
        <?php foreach ($instructor_names as $name): ?>
          <li><?= html_escape($name) ?></li>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php if ($locations): ?>
        <li data-role="list-divider">Location</li>
        <?php foreach ($locations as $location): ?>
          <li><?= html_escape($location->building) ?>, room <?= html_escape($location->room) ?></li>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php if ($schedules): ?>
        <li data-role="list-divider">Schedule</li>
          <?php foreach ($schedules as $schedule): ?>
            <li><?= html_escape($schedule->day) ?> <?= html_escape($schedule->begin_time) ?> - <?= html_escape($schedule->end_time) ?></li>
          <?php endforeach ?>
      <?php endif ?>
    </ul>
    
    <div id="add_taking"
      <?php if ($this->session->userdata('id')): ?>
        
        <?php if (!$taking): ?>
          
          <?php echo "<div data-role='header'>" . validation_errors() . "</div>" ?>
          <?php echo form_open($this->config->item('base_url') . 'lists/add_delete_courses_taking') ?>
        
          <?php $data = array(
              'name' => 'course',
              'id' => 'course',
              'course' => html_escape($course[0]->cat_num),
              'add_delete' => 'add') ?>
          <?php echo form_hidden($data) ?>
          
          <?php $data = array(
              'name' => 'submit',
              'value' => "Add to Courses I'm Taking",
              'data-inline' => 'true') ?>
          <?php echo form_submit($data) ?>
         
        <?php else: ?>
          
          <?php echo "<div data-role='header'>" . validation_errors() . "</div>" ?>
          <?php echo form_open($this->config->item('base_url') . 'lists/add_delete_courses_taking') ?>

          <?php $data = array(
              'name' => 'course',
              'id' => 'course',
              'course' => html_escape($course[0]->cat_num),
              'add_delete' => 'delete') ?>
          <?php echo form_hidden($data) ?>
          
          <?php $data = array(
              'name' => 'submit',
              'value' => "Delete From Courses I'm Taking",
              'data-inline' => 'true') ?>
          <?php echo form_submit($data) ?>

        <?php endif ?>
         
      <?php endif ?>

    </div>

      <?php if (!($this->session->userdata('id'))): ?>
        <?php $this->load->helper('url') ?>
        <a href="<?php echo $this->config->item('base_url') ?>login" data-role="button" data-inline="true">Login to add course to Courses I'm Taking</a>
      <?php endif ?>
    
    <div id="add_shopping">
      <script>
        $('#add_shopping').on('click', function() {
          var course = new Array();
          if ($('#button_shopping').val() == "Add to Courses I'm Shopping") {

            if (localStorage.getItem('courses')) {
              course = localStorage.getItem('courses').split(',');
            }
            course.push("<?php echo html_escape($course[0]->cat_num) ?>");
            localStorage.setItem('courses', course);

            $('#button_shopping').val("Delete From Courses I'm Shopping");
          }
          else if ($('#button_shopping').val() == "Delete From Courses I'm Shopping") {
            
            $('#button_shopping').val("Add to Courses I'm Shopping");
            course = localStorage.getItem('courses').split(',');
            course.splice(course.indexOf(<?php echo html_escape($course[0]->cat_num) ?>,1));
            localStorage.setItem('courses', course);
          }
        });

      </script>
      <input type="button" id="button_shopping" value="Add to Courses I'm Shopping" data-inline="true" />
    </div>