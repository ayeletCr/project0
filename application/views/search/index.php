<form action="<?php echo $this->config->item('base_url') ?>search/result" method="get" >
  
  <div data-role="content">
    <ul data-role="listview" data-inset="true">
      <li data-role="list-divider">Keyword</li>
      <li><input type="search" name="keyword" id="keyword" value="" /></li>
      
      <li data-role="list-divider">Day</li>
      <li><select name="day" id="day" data-native-menu="false" data-inline="true">
        <option value="0">All</option>
        <option value="1">Monday</option>
        <option value="2">Tuesday</option>
        <option value="3">Wednesday</option>
        <option value="4">Thursday</option>
        <option value="5">Friday</option>
        <option value="6">Saturday</option>
      </select></li>
      
      <li data-role="list-divider">Begin Time</li>
      <li><div data-role="controlgroup" data-type="horizontal">
        <select name="hour_begin" id="hour_begin" data-native-menu="false">
          <option value="0">Hour</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <select name="minute_begin" id="minute_begin" data-native-menu="false">
          <option value="0">Minute</option>
          <option value="00">00</option>
          <option value="15">15</option>
          <option value="30">30</option>
          <option value="45">45</option>
        </select>
        <select name="am_pm_begin" id="am_pm_begin" data-native-menu="false">
          <option value="0">AM/PM</option>
          <option value="1">AM</option>
          <option value="2">PM</option>
        </select>
      </div></li>
      
      <li data-role="list-divider">End Time</li>
      <li><div data-role="controlgroup" data-type="horizontal">
        <select name="hour_end" id="hour_end" data-native-menu="false">
          <option value="0">Hour</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <select name="minute_end" id="minute_end" data-native-menu="false">
          <option value="0">Minute</option>
          <option value="00">00</option>
          <option value="15">15</option>
          <option value="30">30</option>
          <option value="45">45</option>
        </select>
        <select name="am_pm_end" id="am_pm_end" data-native-menu="false">
          <option value="0">AM/PM</option>
          <option value="1">AM</option>
          <option value="2">PM</option>
        </select>
      </div></li>
    </ul>
  
    <input type="submit" value="Search" data-inline="true" />

  </div>
  
</form>