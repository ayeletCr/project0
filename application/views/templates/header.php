<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  </head>
  <body>
  <div data-role="page">

    <div data-role="header">
      <a href="<?php echo $this->config->item('base_url') ?>" data-icon="home" data-iconpos="notext" data-transition="fade">Home</a>
      <h1><?php echo html_escape(urldecode($title)) ?></h1>
    </div>
