<?php
require_once __DIR__ . "/QueryResult.php";

define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db_university");

/**
 * - occuparsi di creare il collegamento al DB
 * - esporre un metodo che mi permette di eseguire facilemente le query
 */
class QueryHandler
{
  private static ?mysqli $instance = null;

  /**
   * Metodo che crea un istanza di mysqli, 
   * controlla che il collegamneto al db sia andato a buon fine
   * salvo l'instanza create, dentro la classe per poterla usare successivamente
   */
  private static function createInstance(): mysqli
  {
    // creare una connessione con il DB
    $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Controlliamo che la connessione non abbia errori
    if ($conn->connect_error) {
      throw new Exception($conn->connect_error);
    }

    self::$instance = $conn;

    return self::$instance;
  }

  /**
   * Se non esiste ancora un istanza creata di mysqli, 
   * invoco il metodo che la crea e poi ritorno l'istanza creata
   * 
   * Se esiste già un istanza, la ritorno
   */
  private static function getInstance(): mysqli
  {
    if (isset(self::$instance)) {
      return self::$instance;
    }

    return self::createInstance();
  }

  /**
   * Execute a query and return its result
   *
   * @param  string  $query
   *
   * @return QueryResult|null
   * @throws DbException
   */
  public static function execute(string $query): ?QueryResult
  {
    $db     = self::getInstance();
    $result = $db->query($query);

    if ($db->error) {
      throw new Exception($db->error);
    }

    return $result ? new QueryResult($result) : null;
  }

  /**
   * Riceve la query da eseguire con relativi placeholder,
   * riceve le tipologie di ogni placeholder
   * riceve i valori con cui sostituire i palceholder
   */
  public static function executeStatemnt($query, $types = '', array $params = []): QueryResult
  {
    $inst = self::getInstance();

    $stmt = $inst->prepare($query);

    // esegue il bind_params SOLO se viene completata la variabile types e se params ha dei valori all'interno
    if ($types <> '' and count($params) > 0) {
      $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();

    return new QueryResult($stmt->get_result());
  }
}
