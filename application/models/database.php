<?php

class Database extends CI_Model {
  
  public function get_words($number) {
    
    $this->db->select('title, description, cat_num');
    $this->db->from('courses');
    $this->db->limit(2, $number);
    $this->db->order_by('cat_num');
    $result = $this->db->get()->result();
    
    if (!$result) {
      return false;
    }
    
    $words = array();
    $title = array();
    $description = array();
    foreach ($result as $row) {
      $title = explode(' ', $row->title);
      $description = explode(' ', $row->description);
      $words = array_merge($words, $title, $description);
      $words = array_unique($words);
    }
      
    $words = array_filter($words);
    $words = array_map(function($a) {
      return trim($a, '.,;:-=\"\'?&\(\)');
    }, $words);
    $words = array_values($words);
      
    $i = 0;
    foreach ($words as $word) {
      $words[$i] = strtolower($word);
      $i++;
    }
    
    $i = 0;
    foreach ($words as $word) {
      if (($word == 'the') || ($word == 'be') || ($word == 'to') || 
            ($word == 'of') || ($word == 'and') || ($word == 'a') ||
            ($word == 'in') || ($word == 'that') || ($word == 'have') ||
            ($word == 'i') || ($word == 'it') || ($word == 'for') ||
            ($word == 'not') || ($word == 'on') || ($word == 'with') ||
            ($word == 'he') || ($word == 'as') || ($word == 'you') ||
            ($word == 'do') || ($word == 'at') || ($word == 'this') ||
            ($word == 'but') || ($word == 'his') || ($word == 'by') ||
            ($word == 'from') ||($word == 'they') || ($word == 'we') ||
            ($word == 'say') || ($word == 'her') || ($word == 'she') ||
            ($word == 'or') || ($word == 'an') || ($word == 'will') ||
            ($word == 'is') || ($word == 'are')) {
        unset($words[$i]);
        $words = array_values($words);
        $i--;
      }
      $i++;
    }
    
    $words = array_filter($words);
    $words = array_values($words);
    
    print_r($words);
    print " " . $number . "<br>";
    
    return $words;
  }
  
  public function make_table() {
    
    $this->db->empty_table('index');
    
    $number = 3490;

    do {
      
      $words = $this->Database->get_words($number);

      if ($words) {
      
        foreach ($words as $word) {
      
          $this->db->select();
          $this->db->from('index');
          $this->db->where('keyword', $word);
          if ($this->db->get()->result()) {
            print $word . "<br>";
          }
          else {
        
            $this->db->select('cat_num, title, description');
            $this->db->from('courses');
            $this->db->like('title', $word, 'both');
            $this->db->or_like('description', $word, 'both');
            $result = $this->db->get()->result();
      
            foreach ($result as $row) {
              $title_words = explode(' ', $row->title);
              $title_words = array_filter($title_words);      
              $title_words = array_map(function($a) {
                return trim($a, '.,;:-=\"\'?&\(\)');
              }, $title_words);
        
              $i = 0;
              foreach ($title_words as $title_word) {
                $title_words[$i] = strtolower($title_word);
                $i++;
              }
          
              $description_words = explode(' ', $row->description);
              $description_words = array_filter($description_words);      
              $description_words = array_map(function($a) {
                return trim($a, '.,;:-=\"\'?&\(\)');
              }, $description_words);

              $i = 0;
              foreach ($description_words as $description_word) {
                $description_words[$i] = strtolower($description_word);
                $i++;
              }
          
              $title_relevance = array_count_values($title_words);        
              $description_relevance = array_count_values($description_words);
          
              $relevance = 0;
              if (array_key_exists($word, $title_relevance)) {
                $relevance = $title_relevance[$word] * 2;
              }  
              if (array_key_exists($word, $description_relevance)) {
                $relevance = $relevance + $description_relevance[$word];
              }
          
              if ($relevance > 0) {
              
                $data = array(
                    'keyword' => $word,
                    'cat_num' => $row->cat_num,
                    'relevance' => $relevance
                );
                $this->db->insert('index', $data);
              }
            }
          }
        }
      }
      $number = $number + 2;      
    } while ($words !== false);
  }
}