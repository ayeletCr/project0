<?php //$uri = $this->session->userdata('last_page') ?>
<a href="<?php echo $this->config->item('base_url') ?><?= html_escape($this->session->userdata('last_page')) ?>" data-role="button" data-inline="true" >Return to Last Page</a>
