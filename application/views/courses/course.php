<div data-role="content">
  <?= $course[0]->description; ?>
</div>

<div data-role="content">
  Department: <?= $department[0]->dept_short_name; ?>
</div>

<div data-role="content">
  Catalog Number: <?= $course[0]->cat_num; ?>
</div>

<?php if ($instructor_names): ?>
  <div data-role="content">
    Instructors: <br>
    <?php foreach ($instructor_names as $name): ?>
      <?= $name; ?> <br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php if ($locations): ?>
  <div data-role="content">
    Location: <br>
    <?php foreach ($locations as $location): ?>
      <?= $location->building ?>, room <?= $location->room ?> <br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php if ($schedules): ?>
  <div data-role="content">
    Schedule: <br>
    <?php foreach ($schedules as $day=>$schedule): ?>
      <?= $day; ?> <?= $schedule->begin_time; ?> - <?= $schedule->end_time; ?><br>
    <?php endforeach; ?>
  </div>
<?php endif; ?>