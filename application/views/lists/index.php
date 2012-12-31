<div data-role="content">
  <ul data-role="listview">
    <?php if ($this->session->userdata('id')): ?>
      <li><a href="<?php echo $this->config->item('base_url') ?>lists/taking">Courses I'm Taking</a></li>
    <?php endif ?>
    <li><a href="<?php echo $this->config->item('base_url') ?>lists/shopping">Courses I'm Shopping</a></li>
    <li><a href="<?php echo $this->config->item('base_url') ?>lists/history">Recently Viewed Courses</a></li>
  </ul>
</div>
