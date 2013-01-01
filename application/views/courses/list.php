<ul data-role="listview" data-filter="true">

  <?php if ($courses == 'none'): ?>
    <li>No courses found.</li>

  <?php else: ?>
    <?php foreach ($courses as $course): ?> 
      <li><a href="<?php echo $this->config->item('base_url') ?>courses/course/<?= html_escape($course->cat_num) ?>" ><?= html_escape($course->title) ?></a></li>
    <?php endforeach ?>

  <?php endif ?>

</ul>
