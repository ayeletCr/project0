<div data-role="content">

  <ul data-role="listview">

    <?php if ($this->session->userdata('id')): ?>
      <li><a href="<?php echo $this->config->item('base_url') ?>lists/taking">Courses I'm Taking</a></li>
    <?php endif ?>

    <li>
      <script type="text/javascript">
        array = localStorage.getItem('courses').split(',');
        hostAddress = top.location.host.toString();
        var url = "http://" + hostAddress + "/lists/shopping/," + array;      
        document.write("<a href=" + url + ">Courses I'm Shopping</a>");
      </script>
    </li>
    
    <li><a href="<?php echo $this->config->item('base_url') ?>lists/history">Recently Viewed Courses</a></li>
  
  </ul>

</div>
