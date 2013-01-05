
<?php $course = urldecode($courses) ?>
<a href="<?php echo $this->config->item('base_url') ?>courses/course/<?= html_escape($course) ?>" data-role="button" data-inline="true" >Return to Course</a>