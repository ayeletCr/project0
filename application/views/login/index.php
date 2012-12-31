<?php echo "<div data-role='header'>" . validation_errors() . "</div>" ?>

<?php echo form_open($this->config->item('base_url') . 'login') ?>
  <div>

    <ul data-role="listview">
      <li>Username:</li>
    </ul>
    <?php $data = array(
        'name' => 'username',
        'id' => 'username',
        'size' => '20') ?>
    <?php echo form_input($data, set_value('username')) ?>

    <ul data-role="listview">
      <li>Password:</li>
    </ul>
    <?php $data = array(
        'name' => 'password',
        'id' => 'password',
        'size' => '20') ?>
    <?php echo form_password($data, set_value('password')) ?>

    <?php $data = array(
        'name' => 'submit',
        'value' => 'Login',
        'data-inline' => 'true') ?>
    <?php echo form_submit($data) ?>
  </div>
<?php echo form_close() ?>

<div>
  <a href="<?php echo $this->config->item('base_url') ?>signup" data-role="button" data-inline="true">Sign Up</a>
</div>
