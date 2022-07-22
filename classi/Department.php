<?php

require_once __DIR__ . "/db/QueryHandler.php";

/**
 * Contiene diversi metodi statici che eseguono diverse query
 */
class Department
{

  /**
   * Ritorna tutti i dati presenti nel db
   */
  public static function all()
  {
    return QueryHandler::executeStatemnt("SELECT * FROM `departments`");
  }

  /**
   * Ritorna il dipartimento con l'id specificato
   */
  public static function find($departmentId)
  {
    $query = "SELECT * FROM `departments` WHERE `id` = ?";

    return QueryHandler::executeStatemnt($query, "d", [$departmentId]);
  }

  /**
   * Ritorna tutti gli insegnanti di tutti i corsi
   */
  public static function teachers($departmentId = null)
  {
    $query = "SELECT `departments`.*, 
                `teachers`.`name` AS `teacher_name`,
                `teachers`.`surname` AS `teacher_surnamename`,
                `teachers`.`phone` AS `teacher_phone`, 
                `teachers`.`email` AS `teacher_email`, 
                `teachers`.`office_address` AS `teacher_office_address`,
                `teachers`.`office_number` AS `teacher_office_number`
            FROM `teachers`
            JOIN `course_teacher` ON `teachers`.`id` = `course_teacher`.`teacher_id`
            JOIN `courses` ON `course_teacher`.`course_id` = `courses`.`id`
            JOIN `degrees` ON `courses`.`degree_id` = `degrees`.`id`
            JOIN `departments` ON `degrees`.`department_id` = `departments`.`id`";

    if (isset($departmentId)) {
      $query .= " WHERE `departments`.`id` = ?";

      $result = QueryHandler::executeStatemnt($query, "d", [$departmentId]);
    } else {
      $result = QueryHandler::executeStatemnt($query);
    }

    return $result;
  }
}
