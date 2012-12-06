<div data-role="content">
  <?= html_escape($course[0]->description) ?>
</div>

<div data-role="content">
  Department: <?= html_escape($department[0]->dept_short_name) ?>
</div>

<div data-role="content">
  Catalog Number: <?= html_escape($course[0]->cat_num) ?>
</div>

<?php if ($instructor_names): ?>
  <div data-role="content">
    Instructors: <br>
    <?php foreach ($instructor_names as $name): ?>
      <?= html_escape($name) ?> <br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php if ($locations): ?>
  <div data-role="content">
    Location: <br>
    <?php foreach ($locations as $location): ?>
      <?= html_escape($location->building) ?>, room <?= html_escape($location->room) ?> <br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php if ($schedules): ?>
  <div data-role="content">
    Schedule: <br>
    <?php foreach ($schedules as $schedule): ?>
      <?= html_escape($schedule->day) ?> <?= html_escape($schedule->begin_time) ?> - <?= html_escape($schedule->end_time) ?><br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>