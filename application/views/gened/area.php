<ul data-role="listview" data-filter="true">
  <?php foreach ($courses as $course): ?>
    <li><a href="<?php echo $this->config->item('base_url') ?>courses/course/<?= $course->cat_num ?>" ><?= htmlspecialchars($course->title) ?></a></li>
  <?php endforeach ?>
</ul>
