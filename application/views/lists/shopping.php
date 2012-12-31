<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.css" />
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  <script type="text/javascript" src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>

  <script type="text/javascript">
        
    $('#courses_shopping').live('pagecreate', function() {
      if (Modernizr.localstorage) {

      }
      else {
        $('#message').text("Unfortunately your browser doesn't support local storage");
        $('#add_course').attr('disabled', 'disabled');
        $('#message').show();
      }
      array = localStorage.getItem('courses').split(',');
      hostAddress = top.location.host.toString();
      url = "http://" + hostAddress + "/courses/course/" + array;
      window.location = url;
    });
    </script>
</head>
<body>
  <div data-role="page" id="courses_shopping">

