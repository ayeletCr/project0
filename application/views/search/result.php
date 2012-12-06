<ul data-role="listview" data-filter="true">
  <?php foreach ($courses as $course): ?> 
    <li><a href="<?php echo $this->config->item('base_url') ?>courses/course/<?= html_escape($course->cat_num) ?>" ><?= html_escape($course->title) ?></a></li>
  <?php endforeach ?>
</ul>
