<ul data-role="listview" data-filter="true">
  <?php foreach ($departments as $department): ?>
    <li><a href="<?php echo $this->config->item('base_url') ?>departments/department/<?= html_escape($department->dept_short_name) ?>" ><?= html_escape($department->dept_short_name) ?></a></li>
  <?php endforeach ?>
</ul>