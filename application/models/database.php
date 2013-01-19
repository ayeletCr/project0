<?php

class Database extends CI_Model {
  
  public function get_words($number) {
    
    $this->db->select('title, description, cat_num');
    $this->db->from('courses');
    $this->db->limit(10, $number);
    $this->db->order_by('cat_num');
    $result = $this->db->get()->result();
    
    if (!$result) {
      return false;
    }
    
    $title = array();
    $description = array();
    $cat_num = array();
    
    foreach ($result as $row) {
      
      $title = explode(' ', $row->title);
      $description = explode(' ', $row->description);
      $cat_num = $row->cat_num;

      $title = $this->Database->filter_words($title);
      $description = $this->Database->filter_words($description);
      
      $this->Database->add_table($title, $description, $cat_num);
    }
  }
  
  public function make_table() {
    
    $this->db->empty_table('index');

    $number = 0;

    do {      
      $words = $this->Database->get_words($number);
      $number = $number + 10;      
    } while ($words !== false);
  }
  
  public function add_table($title, $description, $cat_num) {
    
    $words = array();
    $words = array_merge($title, $description);
    $words = array_unique($words);

    $title_relevance = array_count_values($title);        
    $description_relevance = array_count_values($description);
        
    foreach ($words as $word) {
      
      $relevance = 0;
      
      if (array_key_exists($word, $title_relevance)) {
        $relevance = $title_relevance[$word] * 2;
      }
      
      if (array_key_exists($word, $description_relevance)) {
        $relevance = $relevance + $description_relevance[$word];
      }
      
      $data = array(
          'keyword' => $word,
          'cat_num' => $cat_num,
          'relevance' => $relevance
      );
      $this->db->insert('index', $data);
    }
    
    print_r($words);
    print "<br>";
  }
  
  public function filter_words($words) {
    
    $words = array_filter($words);
    $words = array_map('strtolower', $words);
    $words = array_map(function($a) {
      return trim($a, '.,;:-=\"\'?&\(\)');
    }, $words);
    
    $common_words = array('the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 
        'have', 'i', 'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do',
        'at', 'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her',
        'she', 'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'what',
        'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'is', 'are');
    $words = array_diff($words, $common_words);
    $words = array_filter($words);
    $words = array_values($words);
    
    return $words;
  }
}