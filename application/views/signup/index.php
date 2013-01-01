<?php echo "<div data-role='header'>" . validation_errors() . "</div>" ?>

<?php echo form_open($this->config->item('base_url') . 'signup') ?>

  <div data-role="content">

    <ul data-role="listview" data-inset="true">
      <li data-role="list-divider">Username</li>
      <li><?php $data = array(
          'name' => 'username',
          'id' => 'username',
          'size' => '20') ?>
      <?php echo form_input($data, set_value('username')) ?></li>
    
      <li data-role="list-divider">Password</li>    
      <li><?php $data = array(
          'name' => 'password',
          'id' => 'password',
          'size' => '20') ?>
      <?php echo form_password($data, set_value('password')) ?></li>

      <li data-role="list-divider">Password Confirmation</li>
      <li><?php $data = array(
          'name' => 'password2',
          'id' => 'password2',
          'size' => '20') ?>
      <?php echo form_password($data, set_value('password2')) ?></li>
    
    </ul>
      
    <?php $data = array(
        'name' => 'submit',
        'value' => 'Sign Up',
        'data-inline' => 'true') ?>
    <?php echo form_submit($data) ?>
    
  </div>

<?php echo form_close() ?>
