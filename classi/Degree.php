<?php

require_once __DIR__ . '/db/QueryHandler.php';
require_once __DIR__ . '/db/QueryResult.php';

class Degree
{
  /**
   * 
   */
  public static function all($includeDipartimento = false): ?QueryResult
  {
    $query = "SELECT * FROM `degrees`";

    if ($includeDipartimento) {
      $query = "SELECT `degrees`.*,
                        `departments`.`name` AS `department_name`
                 FROM `degrees`
                 INNER JOIN `departments`
                     ON `degrees`.`department_id` = `departments`.`id`";
    }

    return QueryHandler::executeStatemnt($query);
  }


  public static function find($id): ?QueryResult
  {
    $query = "SELECT * FROM `degrees` WHERE `id` = {$id}";

    return QueryHandler::executeStatemnt($query);
  }
}
