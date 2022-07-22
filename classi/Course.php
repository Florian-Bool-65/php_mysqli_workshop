<?php

require_once __DIR__ . '/db/QueryHandler.php';
require_once __DIR__ . '/db/QueryResult.php';

class Course {
  
  /**
   * 
   */
  public static function all($includeDegrees = false): ?QueryResult {
    $query = "SELECT * FROM `courses`";
    
    if ($includeDegrees) {
      $query = "SELECT `courses`.*,
                        `degrees`.`name` AS `degree_name`
                 FROM `courses`
                 INNER JOIN `degrees`
                     ON `degrees`.`id` = `courses`.`degree_id`";
    }
    
    return QueryHandler::execute($query);
  }
  
  public static function find($id): ?QueryResult {
    $query = "SELECT * FROM `courses` WHERE `id` = {$id}";
    
    return QueryHandler::executeStatemnt($query);
  }
}
