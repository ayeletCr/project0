<ul data-role="listview" data-filter="true">
  <?php foreach ($departments as $department): ?>
    <li><a href="<?php echo $this->config->item('base_url') ?>departments/department/<?= $department->dept_short_name ?>" ><?= htmlspecialchars($department->dept_short_name) ?></a></li>
  <?php endforeach ?>
</ul>