<form action="<?php echo $this->config->item('base_url') ?>search/result" method="get" >
  
  <div data-role="content">
    <ul data-role="listview" data-inset="true">
      <li data-role="list-divider">Keyword</li>
      <li><input type="search" name="keyword" id="keyword" value="<?php echo $this->input->get('keyword')?>" /></li>
      
      <li data-role="list-divider">Day</li>
      <li><select name="day" id="day" data-native-menu="false" data-inline="true" value="<?php echo $this->input->get('day')?>">
        <option value="0">All</option>
        <option value="1" <?php if($this->input->get('day') == "1") echo "selected = 'selected'" ?> >Monday</option>
        <option value="2" <?php if($this->input->get('day') == "2") echo "selected = 'selected'" ?> >Tuesday</option>
        <option value="3" <?php if($this->input->get('day') == "3") echo "selected = 'selected'" ?> >Wednesday</option>
        <option value="4" <?php if($this->input->get('day') == "4") echo "selected = 'selected'" ?> >Thursday</option>
        <option value="5" <?php if($this->input->get('day') == "5") echo "selected = 'selected'" ?> >Friday</option>
        <option value="6" <?php if($this->input->get('day') == "6") echo "selected = 'selected'" ?> >Saturday</option>
      </select></li>
      
      <li data-role="list-divider">Begin Time</li>
      <li><div data-role="controlgroup" data-type="horizontal">
        
        <select name="hour_begin" id="hour_begin" data-native-menu="false">
          <option value="0">Hour</option>
          <option value="1" <?php if($this->input->get('hour_begin') == "1") echo "selected = 'selected'" ?> >1</option>
          <option value="2" <?php if($this->input->get('hour_begin') == "2") echo "selected = 'selected'" ?> >2</option>
          <option value="3" <?php if($this->input->get('hour_begin') == "3") echo "selected = 'selected'" ?> >3</option>
          <option value="4" <?php if($this->input->get('hour_begin') == "4") echo "selected = 'selected'" ?> >4</option>
          <option value="5" <?php if($this->input->get('hour_begin') == "5") echo "selected = 'selected'" ?> >5</option>
          <option value="6" <?php if($this->input->get('hour_begin') == "6") echo "selected = 'selected'" ?> >6</option>
          <option value="7" <?php if($this->input->get('hour_begin') == "7") echo "selected = 'selected'" ?> >7</option>
          <option value="8" <?php if($this->input->get('hour_begin') == "8") echo "selected = 'selected'" ?> >8</option>
          <option value="9" <?php if($this->input->get('hour_begin') == "9") echo "selected = 'selected'" ?> >9</option>
          <option value="10" <?php if($this->input->get('hour_begin') == "10") echo "selected = 'selected'" ?> >10</option>
          <option value="11" <?php if($this->input->get('hour_begin') == "11") echo "selected = 'selected'" ?> >11</option>
          <option value="12" <?php if($this->input->get('hour_begin') == "12") echo "selected = 'selected'" ?> >12</option>
        </select>
        
        <select name="minute_begin" id="minute_begin" data-native-menu="false">
          <option value="0">Minute</option>
          <option value="00" <?php if($this->input->get('minute_begin') === "00") echo "selected = 'selected'" ?> >00</option>
          <option value="15" <?php if($this->input->get('minute_begin') == "15") echo "selected = 'selected'" ?> >15</option>
          <option value="30" <?php if($this->input->get('minute_begin') == "30") echo "selected = 'selected'" ?> >30</option>
          <option value="45" <?php if($this->input->get('minute_begin') == "45") echo "selected = 'selected'" ?> >45</option>
        </select>
        
        <select name="am_pm_begin" id="am_pm_begin" data-native-menu="false">
          <option value="0">AM/PM</option>
          <option value="1" <?php if($this->input->get('am_pm_begin') == "1") echo "selected = 'selected'" ?> >AM</option>
          <option value="2" <?php if($this->input->get('am_pm_begin') == "2") echo "selected = 'selected'" ?> >PM</option>
        </select>
      </div></li>
      
      <li data-role="list-divider">End Time</li>
      <li><div data-role="controlgroup" data-type="horizontal">

        <select name="hour_end" id="hour_end" data-native-menu="false">
          <option value="0">Hour</option>
          <option value="1" <?php if($this->input->get('hour_end') == "1") echo "selected = 'selected'" ?> >1</option>
          <option value="2" <?php if($this->input->get('hour_end') == "2") echo "selected = 'selected'" ?> >2</option>
          <option value="3" <?php if($this->input->get('hour_end') == "3") echo "selected = 'selected'" ?> >3</option>
          <option value="4" <?php if($this->input->get('hour_end') == "4") echo "selected = 'selected'" ?> >4</option>
          <option value="5" <?php if($this->input->get('hour_end') == "5") echo "selected = 'selected'" ?> >5</option>
          <option value="6" <?php if($this->input->get('hour_end') == "6") echo "selected = 'selected'" ?> >6</option>
          <option value="7" <?php if($this->input->get('hour_end') == "7") echo "selected = 'selected'" ?> >7</option>
          <option value="8" <?php if($this->input->get('hour_end') == "8") echo "selected = 'selected'" ?> >8</option>
          <option value="9" <?php if($this->input->get('hour_end') == "9") echo "selected = 'selected'" ?> >9</option>
          <option value="10" <?php if($this->input->get('hour_end') == "10") echo "selected = 'selected'" ?> >10</option>
          <option value="11" <?php if($this->input->get('hour_end') == "11") echo "selected = 'selected'" ?> >11</option>
          <option value="12" <?php if($this->input->get('hour_end') == "12") echo "selected = 'selected'" ?> >12</option>
        </select>
        
        <select name="minute_end" id="minute_end" data-native-menu="false">
          <option value="0">Minute</option>
          <option value="00" <?php if($this->input->get('minute_end') === "00") echo "selected = 'selected'" ?> >00</option>
          <option value="15" <?php if($this->input->get('minute_end') == "15") echo "selected = 'selected'" ?> >15</option>
          <option value="30" <?php if($this->input->get('minute_end') == "30") echo "selected = 'selected'" ?> >30</option>
          <option value="45" <?php if($this->input->get('minute_end') == "45") echo "selected = 'selected'" ?> >45</option>
        </select>

        <select name="am_pm_end" id="am_pm_end" data-native-menu="false">
          <option value="0">AM/PM</option>
          <option value="1" <?php if($this->input->get('am_pm_end') == "1") echo "selected = 'selected'" ?> >AM</option>
          <option value="2" <?php if($this->input->get('am_pm_end') == "2") echo "selected = 'selected'" ?> >PM</option>
        </select>
      
      </div></li>
    </ul>
  
    <input type="submit" value="Search" data-inline="true" />

  </div>
  
</form>

<div>
  <?php if ($error): ?>
    <?php echo $error ?>
  <?php endif ?>
</div>  
