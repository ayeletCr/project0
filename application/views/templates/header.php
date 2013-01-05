<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo html_escape(urldecode($title)) ?></title>
  </head>
  <body>
  <div data-role="page" id="<?php echo html_escape(urldecode($title)) ?>">

    <div data-role="header">
      <a href="<?php echo $this->config->item('base_url') ?>" data-icon="home" data-iconpos="notext">Home</a>
      <h1><?php echo html_escape(urldecode($title)) ?></h1>
    </div>
