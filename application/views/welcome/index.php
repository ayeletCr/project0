<div data-role="content">
  <ul data-role="listview">
    <li><a href="<?php echo $this->config->item('base_url') ?>departments">Browse by Department</a></li>
    <li><a href="<?php echo $this->config->item('base_url') ?>gened">Browse by Gen Ed Area</a></li>
    <li><a href="<?php echo $this->config->item('base_url') ?>search">Search for Courses</a></li>
    <li><a href="<?php echo $this->config->item('base_url') ?>instructors">Search for Instructors</a></li>
    <li><a href="<?php echo $this->config->item('base_url') ?>lists">Lists</a></li>
    <?php if ($this->session->userdata('id')): ?>
      <li><a href="<?php echo $this->config->item('base_url') ?>logout">Logout</a></li>
    <?php elseif (!($this->session->userdata('id'))): ?>
      <li><a href="<?php echo $this->config->item('base_url') ?>login">Login</a></li>
    <?php endif ?>
  </ul>
</div>
