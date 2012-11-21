<ul data-role="listview" data-filter="true">
  <?php foreach ($instructors as $instructor): ?>
    <li><a href="<?php echo $this->config->item('base_url') ?>instructors/instructor/<?= $instructor->id ?>" ><?= htmlspecialchars($instructor->first) . " " . htmlspecialchars($instructor->last) ?></a></li>
  <?php endforeach ?>
</ul>
