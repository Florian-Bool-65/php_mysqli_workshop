<?php

class QueryResult
{
  private ?mysqli_result $result = null;

  function __construct($_mysqli_result)
  {
    $this->result = $_mysqli_result;
  }

  /**
   * Ritorna in un colpo solo TUTTI i dati ricevuti e letti
   */
  public function toArray()
  {
    // Resetto l'indice di lettura
    $this->result->data_seek(0);

    return $this->result->fetch_all(MYSQLI_ASSOC);
  }

  /**
   * Esegue un ciclo su ogni elemento ricevuto dal server e invoca la collback ad ogni iterazione
   */
  public function forEach($callback)
  {
    // Resetto l'indice di lettura
    $this->result->data_seek(0);

    while ($row = $this->result->fetch_assoc()) {
      $callback($row);
    }
  }
}
