<?php

  class Course extends CI_Model {

    public function get_courses($courses, $type) {

      $this->db->distinct('cat_num, title, description, course_group');
      $this->db->from('courses');

      if ($type == 'course') {
        $this->db->where('cat_num', $courses);
      }
      else if ($type == 'course_group') {
        foreach ($courses as $course) {
          $this->db->or_where('course_group', $course);
        }
      }
      else if ($type == 'genedarea') {
        $this->db->like('notes', $courses, 'both');
      }
      else if ($type == 'search') {
        foreach ($courses as $course) {
          $this->db->or_where('cat_num', $course);
        }
      }

      $this->db->order_by('title asc');
      return $this->db->get()->result();
    }

    public function get_courses_instructor($instructor) {

      $this->db->select('cat_num');
      $this->db->from('course_instructors');
      $this->db->where('instructor_id', $instructor);
      return $this->db->get()->result();
    }

    public function get_courses_taking($id) {

      $this->db->select('cat_num');
      $this->db->from('user_lists');
      $this->db->where('id', $id);
      return $this->db->get()->result();
    }

    public function get_courses_schedule($day, $hour_begin, $hour_end, $minute_begin, $minute_end, $am_pm_begin, $am_pm_end) {

      if ($am_pm_begin == '2') {
        $hour_begin = $hour_begin + 12;
      }
      if (($hour_end == '0') && ($am_pm_end == '1')){
        $hour_end = $hour_end + 12;
      }
      if (($am_pm_end == '2') && ($hour_end != '12')) {
        $hour_end = $hour_end + 12;
      }
      $begin_time = ($hour_begin * 100) + $minute_begin;
      $end_time = ($hour_end * 100) + $minute_end;

      $this->db->select('cat_num');
      $this->db->from('schedule');
      if (($am_pm_begin != '0') && ($am_pm_end != '0')) {
        $this->db->where('begin_time >=', $begin_time);
        $this->db->where('end_time <=', $end_time);
      }
      if ($day != '0') {
        $this->db->where('day', $day);
      }
      $this->db->group_by('cat_num');
      $result = $this->db->get()->result();
      if (!$result) {
        $result[0]->cat_num = '';
      }
      return $result;
    }

    public function get_courses_keyword($keywords) {

      /*
       * This would be better done in SQL with something like:

SELECT i.cat_num, sum(relevance)
FROM `index` i
  INNER JOIN (SELECT cat_num, count(cat_num)
    FROM `index`
    WHERE keyword LIKE '%china%'
      OR keyword LIKE '%west%'
    GROUP BY cat_num
    HAVING count(cat_num) = 2) g ON i.cat_num = g.cat_num
WHERE keyword LIKE '%china%'
  OR keyword LIKE '%west%'
GROUP BY i.cat_num
ORDER BY sum(relevance) DESC;

       * But that's beyond the capability of Code Ignighter's query builder.
       */

      $keywords = explode(' ', $keywords);
      $courses = array();
      $key = 0;

      foreach ($keywords as $i => $keyword) {
        $this->db->select('cat_num, relevance');
        $this->db->from('index');
        if (is_numeric($keyword)) {
          $this->db->where('cat_num', $keyword);
          $this->db->or_where('keyword', $keyword);
        }
        else {
          $this->db->like('keyword', $keyword, 'both');
        }
        $this->db->order_by('relevance', 'desc');
        $result = $this->db->get()->result();
        if (!$result) {
          $result[$i]->cat_num = '';
          $result[$i]->relevance = '';
        }

        $results = array();
        if ($courses) {
          foreach ($result as $row) {
            foreach ($courses as $course) {
              if ($course->cat_num == $row->cat_num) {
                if (empty($results[$key])) {
                  $results[$key] = new stdClass();
                }

                $results[$key]->cat_num = $row->cat_num;
                $results[$key]->relevance = $row->relevance + $course->relevance;
                $key++;
              }
            }
          }
          $courses = $results;
        }
        else {
          $courses = $result;
        }
      }
      return $courses;
    }

    public function sort_courses($courses, $relevance) {

      usort($courses, function($course_a, $course_b) use ($relevance) {
        $a = $relevance[$course_a->cat_num];
        $b = $relevance[$course_b->cat_num];
        if ($a < $b) {
          return 1;
        }
        if ($a > $b) {
          return -1;
        }
        return 0;
      });

      return $courses;
  }

}
