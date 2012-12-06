<ul data-role="listview" data-filter="true">
  <?php foreach ($instructors as $instructor): ?>
  <li><a href="<?php echo $this->config->item('base_url') ?>instructors/instructor/<?= html_escape($instructor->id) ?>" ><?= html_escape($instructor->first) . " " . html_escape($instructor->last) ?></a></li>
  <?php endforeach ?>
</ul>
