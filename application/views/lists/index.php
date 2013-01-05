<div data-role="content">

  <ul data-role="listview">

    <?php if ($this->session->userdata('id')): ?>
      <li><a href="<?php echo $this->config->item('base_url') ?>lists/taking">Courses I'm Taking</a></li>
    <?php endif ?>

      <script type="text/javascript">
        courses = localStorage.getItem('courses');
        var url = "<?php echo $this->config->item('base_url') ?>" + "lists/shopping/" + courses;
        document.write("<li><a href=" + url + ">Courses I'm Shopping</a></li>");
      </script>
    
    <li><a href="<?php echo $this->config->item('base_url') ?>lists/history">Recently Viewed Courses</a></li>
  
  </ul>

</div>
