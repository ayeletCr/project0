<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.css" />
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  <script type="text/javascript" src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>

  <script type="text/javascript">
        
    $('#add_courses_shopping').live('pagecreate', function() {
      if (Modernizr.localstorage) {

      }
      else {
        $('#message').text("Unfortunately your browser doesn't support local storage");
        $('#add_course').attr('disabled', 'disabled');
        $('#message').show();
      }

      $('#addToStorage').click(function(e) {
        localStorage.setItem('courses', $('#entry').val());
      });

//      if (localStorage.getItem('courses')) {
//        
//      }
//      else {
//        localStorage.setItem('courses', $('#entry').val());
//      }
    });

//              var key = "key";
//              var key2 = "key2";
//              if (localStorage.getItem(key)) {
//                var courses_shopping = new Array(localStorage.getItem(key));
//                localStorage.setItem(key, $('#entry').val());
//                courses_shopping.push(localStorage.getItem(key));
//                localStorage.setItem(key, $('#courses_shopping').val());
//                document.write(courses_shopping[0], courses_shopping[1], courses_shopping[2]);
//              }
//              else {
//                localStorage.setItem(key, $('#entry').val());
//                localStorage.setItem(key2, 0);
//                var courses_shopping = new Array();
//                courses_shopping[localStorage.getItem(key2)] = localStorage.getItem(key);
//                document.write(courses_shopping[localStorage.getItem(key2)]);
//                var array = [5, 6];
//                array[0] = 'abc';
//                array[1] = 'def';
//                array[2] = 'ghi';
//                array.push('jkl');
//                localStorage.setItem(key2, array);
//                array2 = localStorage.getItem(key2).split(',');
//                document.write(array[0], array2[0]);
//              }
        

    </script>
</head>
<body>
  <div data-role="page" id="add_courses_shopping">

    <div data-role="header">
      <a href="<?php echo $this->config->item('base_url') ?>" data-icon="home" data-iconpos="notext" data-transition="fade">Home</a>
      <h1><?php echo html_escape(urldecode($title)) ?></h1>
    </div>
    
        <?php $course = urldecode($course); ?>
        
                <input type="hidden" id="entry" name="entry" value ="<?= $course?>" />
                <input type="button" id="addToStorage" value="Add to local storage"/>

                <a href="<?php echo $this->config->item('base_url') ?>courses/course/<?= html_escape($course) ?>" data-role="button" data-inline="true" >Return to Course</a>
                

</div>

