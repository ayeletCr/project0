<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.css" />
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  <script type="text/javascript" src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
  <script type="text/javascript">
        
    $('#courses').live('pagecreate', function() {
      if (Modernizr.localstorage) {

      }
      else {
        $('#message').text("Unfortunately your browser doesn't support local storage");
        $('#add_course').attr('disabled', 'disabled');
        $('#message').show();
      }
      
      $('#add_course').click(function(e) {
        if (localStorage.getItem('courses')) {
          array = localStorage.getItem('courses').split(',');
          array.push($('#entry').val());
          localStorage.setItem('courses', array);
        }
        else {
          localStorage.setItem('courses', $('#entry').val());
        }
        
      });
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
  
    <?php if ($this->session->userdata('id')): ?>
      <a href="<?php echo $this->config->item('base_url') ?>lists/add_courses_taking/<?= html_escape($course[0]->cat_num) ?>" data-role="button" data-inline="true">Add course to Courses I'm Taking</a>
    <?php endif ?>

    <?php if (!($this->session->userdata('id'))): ?>
      <?php $this->load->helper('url') ?>
      <a href="<?php echo $this->config->item('base_url') ?>login" data-role="button" data-inline="true">Login to add course to Courses I'm Taking</a>
    <?php endif ?>
    <input type="hidden" id="entry" name="entry" value ="<?= html_escape($course[0]->cat_num) ?>" />
    <input type="button" id="add_course" value="Add to Courses I'm Shopping" data-inline="true" />
