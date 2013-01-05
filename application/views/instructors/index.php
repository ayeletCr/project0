<form action="<?php echo $this->config->item('base_url') ?>instructors/result" method="get" >
  
  <div data-role="content">

    <ul data-role="listview" data-inset="true">
      <li data-role="list-divider">Instructor Name</li>
      <li><input type="search" name="instructor" id="insctuctor" value="<?php echo $this->input->get('instructor') ?>"/></li>
    </ul>

    <input type="submit" value="Search" data-inline="true"/>
  
  </div>

</form>